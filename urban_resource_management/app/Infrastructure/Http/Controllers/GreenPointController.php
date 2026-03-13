<?php

namespace App\Infrastructure\Http\Controllers;

use App\Application\Services\GreenPointService;
use App\Application\Services\UserService;
use App\Models\User;
use App\View\Support\Toast;
use Illuminate\Http\Request;

class GreenPointController
{
    private GreenPointService $greenPointService;
    private UserService $userService;

    public function __construct(
        GreenPointService $greenPointService,
        UserService $userService
    ){
        $this->greenPointService = $greenPointService;
        $this->userService = $userService;
    }

    public function index()
    {
        $greenPoints = $this->greenPointService->findAll();

        return view('pages.operator.green-points.index', compact('greenPoints'));
    }

    public function map()
    {
        $greenPoints = $this->greenPointService->findAll();

        return view(
            'pages.operator.green-points-map.index',
            compact('greenPoints')
        );
    }

    public function create()
    {
        $managers = $this->userService->findOperators();

        return view('pages.operator.green-points.form', compact('managers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'capacity_m3' => 'required',
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
        $users = $this->userService->findCivils();

        foreach ($greenPoint->containers as $container) {

            if ($container->capacity_kg == 0) {
                continue;
            }

            $percent = ($container->current_kg / $container->capacity_kg) * 100;

            $material = $container->materialType->name;

            if ($percent >= 100) {

                Toast::error("Contenedor lleno ($material). Requiere atención inmediata");

            } elseif ($percent >= 90) {

                Toast::warning("Contenedor casi lleno ($material). Programar vaciado");

            } elseif ($percent >= 75) {

                Toast::info("Contenedor al 75% ($material). Alerta temprana");

            }
        }

        return view(
            'pages.operator.green-points.show',
            compact('greenPoint','users')
        );
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
            'capacity_m3' => 'required',
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
            'user_id' => 'nullable|exists:users,id',
            'citizen_code' => 'nullable|string'
        ]);

        if (!$request->user_id && !$request->citizen_code) {
            return back()->withErrors([
                'citizen_code' => 'Debe ingresar usuario o DPI'
            ]);
        }

        $this->greenPointService->registerDelivery($request->all());

        Toast::success('Material registrado correctamente');

        return back();
    }

    public function emptyContainer(Request $request)
    {
        $containerId = $request->container_id;

        $this->greenPointService->emptyContainer($containerId);

        Toast::success('Contenedor vaciado');

        return back();
    }

    public function destroy($id)
    {
        $this->greenPointService->delete($id);

        Toast::success('Punto verde eliminado');

        return redirect()->route('green-points.index');
    }
}
