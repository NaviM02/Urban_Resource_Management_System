<?php

namespace App\Infrastructure\Http\Controllers;

use App\Application\Services\TruckService;
use App\Models\TruckStatus;
use App\View\Support\Toast;
use Illuminate\Http\Request;

class TruckController
{
    private TruckService $truckService;

    public function __construct(TruckService $truckService)
    {
        $this->truckService = $truckService;
    }

    public function index()
    {
        $trucks = $this->truckService->findAll();

        return view('pages.coordinator.trucks.index', compact('trucks'));
    }

    public function create()
    {
        $statuses = TruckStatus::all();

        return view('pages.coordinator.trucks.form', compact('statuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plate' => 'required',
            'capacity_tons' => 'required',
            'truck_status_id' => 'required',
            'driver_name' => 'required',
        ]);

        $this->truckService->create($request->all());

        Toast::success('Camión creado correctamente');

        return redirect()->route('trucks.index');
    }

    public function show($id)
    {
        $truck = $this->truckService->findById($id);

        return view('pages.coordinator.routes.show', compact('truck'));
    }

    public function edit($id)
    {
        $truck = $this->truckService->findById($id);
        $statuses = TruckStatus::all();

        return view('pages.coordinator.trucks.form', compact('truck','statuses'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'plate' => 'required',
            'capacity_tons' => 'required',
            'truck_status_id' => 'required',
            'driver_name' => 'required',
        ]);

        $this->truckService->update($id, $request->all());

        Toast::success('Camión actualizado');

        return redirect()->route('trucks.index');
    }

    public function destroy($id)
    {
        $this->truckService->delete($id);

        Toast::success('Camión eliminado');

        return redirect()->route('trucks.index');
    }
}
