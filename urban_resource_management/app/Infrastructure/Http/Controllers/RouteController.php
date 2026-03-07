<?php

namespace App\Infrastructure\Http\Controllers;

use App\Application\Services\RouteService;
use App\Models\Zone;
use App\Models\WasteType;
use App\View\Support\Toast;
use Illuminate\Http\Request;

class RouteController
{
    private RouteService $routeService;

    public function __construct(RouteService $routeService)
    {
        $this->routeService = $routeService;
    }

    public function index()
    {
        $routes = $this->routeService->findAll();

        return view('pages.coordinator.routes.index', compact('routes'));
    }

    public function create()
    {
        $zones = Zone::all();
        $wasteTypes = WasteType::all();

        return view('pages.coordinator.routes.form', compact('zones', 'wasteTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'zone_id' => 'required',
            'waste_type_id' => 'required',
            'path_coordinates' => 'required',
            'distance_km' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'collection_days' => 'required',
        ]);

        $this->routeService->create($request->all());

        Toast::success('Ruta creada correctamente');

        return redirect()->route('routes.index');
    }

    public function show($id)
    {
        $route = $this->routeService->findById($id);

        return view('pages.coordinator.routes.show', compact('route'));
    }

    public function edit($id)
    {
        $route = $this->routeService->findById($id);
        $zones = Zone::all();
        $wasteTypes = WasteType::all();

        return view('pages.coordinator.routes.form', compact('route'), compact('zones', 'wasteTypes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'zone_id' => 'required',
            'waste_type_id' => 'required',
            'path_coordinates' => 'required',
            'distance_km' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'collection_days' => 'required',
        ]);

        $this->routeService->update($id, $request->all());

        Toast::success('Ruta actualizada correctamente');

        return redirect()->route('routes.index');
    }

    public function destroy($id)
    {
        $this->routeService->delete($id);

        return redirect()
            ->route('routes.index')
            ->with('success', 'Ruta eliminada');
    }
}
