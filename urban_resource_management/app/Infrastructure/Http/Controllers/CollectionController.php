<?php

namespace App\Infrastructure\Http\Controllers;

use App\Application\Services\CollectionService;
use App\Models\Route;
use App\Models\Truck;
use App\View\Support\Toast;
use Illuminate\Http\Request;

class CollectionController
{
    private CollectionService $collectionService;

    public function __construct(CollectionService $collectionService)
    {
        $this->collectionService = $collectionService;
    }

    public function index()
    {
        $collections = $this->collectionService->findAll();

        return view('pages.coordinator.collections.index', compact('collections'));
    }

    public function create()
    {
        $routes = Route::all();
        $trucks = Truck::all();

        return view('pages.coordinator.collections.form', compact('routes', 'trucks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'route_id' => 'required',
            'truck_id' => 'required',
            'scheduled_date' => 'required',
        ]);

        $this->collectionService->create($request->all());

        Toast::success('Recolección creada y puntos generados');

        return redirect()->route('collections.index');
    }

    public function show($id)
    {
        $collection = $this->collectionService->findById($id);

        return view('pages.coordinator.collections.show', compact('collection'));
    }

    public function start($id)
    {
        $this->collectionService->start($id);

        Toast::success('Recolección iniciada');

        return redirect()->back();
    }

    public function cancel(Request $request, $id)
    {
        $request->validate([
            'observations' => 'nullable'
        ]);

        $this->collectionService->cancel($id, $request->all());

        Toast::warning('Recolección cancelada');

        return redirect()->route('collections.index');
    }

    public function finish(Request $request, $id)
    {
        $request->validate([
            'observations' => 'nullable'
        ]);

        $this->collectionService->finish($id, $request->all());

        Toast::success('Recolección finalizada');

        return redirect()->route('collections.index');
    }

    public function addIncidence(Request $request, $id)
    {
        $request->validate([
            'description' => 'required'
        ]);

        $this->collectionService->addIncidence($id, $request->description);

        Toast::success('Incidencia registrada');

        return redirect()->back();
    }

}
