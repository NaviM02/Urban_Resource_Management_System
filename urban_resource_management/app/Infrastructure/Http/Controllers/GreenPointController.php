<?php

namespace App\Infrastructure\Http\Controllers;

use App\Application\Services\GreenPointService;
use App\Models\User;
use App\View\Support\Toast;
use Illuminate\Http\Request;

class GreenPointController
{
    private GreenPointService $greenPointService;

    public function __construct(GreenPointService $greenPointService)
    {
        $this->greenPointService = $greenPointService;
    }

    public function index()
    {
        $greenPoints = $this->greenPointService->findAll();

        return view('pages.operator.green-points.index', compact('greenPoints'));
    }

    public function create()
    {
        $managers = User::all();

        return view('pages.operator.green-points.form', compact('managers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'open_time' => 'required',
            'close_time' => 'required',
        ]);

        $this->greenPointService->create($request->all());

        Toast::success('Punto verde creado correctamente');

        return redirect()->route('green-points.index');
    }

    public function show($id)
    {
        $greenPoint = $this->greenPointService->findById($id);

        return view('pages.operator.green-points.show', compact('greenPoint'));
    }

    public function edit($id)
    {
        $greenPoint = $this->greenPointService->findById($id);

        $managers = User::all();

        return view(
            'pages.operator.green-points.form',
            compact('greenPoint', 'managers')
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'open_time' => 'required',
            'close_time' => 'required',
        ]);

        $this->greenPointService->update($id, $request->all());

        Toast::success('Punto verde actualizado correctamente');

        return redirect()->route('green-points.index');
    }

    public function registerDelivery(Request $request)
    {
        $request->validate([
            'green_point_id' => 'required',
            'container_id' => 'required',
            'quantity_kg' => 'required|numeric|min:1',
            'citizen_code' => 'nullable'
        ]);

        $this->greenPointService->registerDelivery([
            ...$request->all(),
            'user_id' => auth()->id()
        ]);

        Toast::success('Material registrado correctamente');

        return back();
    }

    public function destroy($id)
    {
        $this->greenPointService->delete($id);

        Toast::success('Punto verde eliminado');

        return redirect()->route('green-points.index');
    }
}
