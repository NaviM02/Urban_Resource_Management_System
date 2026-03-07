<?php

namespace App\Infrastructure\Http\Controllers;

use App\Application\Services\ZoneService;
use App\View\Support\Toast;
use Illuminate\Http\Request;

class ZoneController
{
    private ZoneService $zoneService;

    public function __construct(ZoneService $zoneService)
    {
        $this->zoneService = $zoneService;
    }

    public function index()
    {
        $zones = $this->zoneService->findAll();

        return view('pages.coordinator.zones.index', compact('zones'));
    }

    public function create()
    {
        return view('pages.coordinator.zones.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'status_id' => 'required'
        ]);

        $this->zoneService->create($request->all());

        Toast::success('Zona creada correctamente');

        return redirect()->route('zones.index');
    }

    public function show($id)
    {
        $zone = $this->zoneService->findById($id);

        return view('pages.coordinator.zones.show', compact('zone'));
    }

    public function edit($id)
    {
        $zone = $this->zoneService->findById($id);

        return view('pages.coordinator.zones.form', compact('zone'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'status_id' => 'required'
        ]);

        $this->zoneService->update($id, $request->all());

        Toast::success('Zona actualizada correctamente');

        return redirect()->route('zones.index');
    }

    public function destroy($id)
    {
        $this->zoneService->delete($id);

        return redirect()
            ->route('zones.index')
            ->with('success', 'Zona eliminada');
    }
}
