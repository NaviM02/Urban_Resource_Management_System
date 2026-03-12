<?php

namespace App\Infrastructure\Http\Controllers;

use App\Application\Services\MaterialDeliveryService;
use App\View\Support\Toast;
use Illuminate\Http\Request;

class MaterialDeliveryController
{
    private MaterialDeliveryService $deliveryService;

    public function __construct(MaterialDeliveryService $deliveryService)
    {
        $this->deliveryService = $deliveryService;
    }

    public function store(Request $request)
    {
        $request->validate([
            'green_point_id' => 'required',
            'container_id' => 'required',
            'quantity_kg' => 'required|numeric|min:0.1',
        ]);

        $this->deliveryService->registerDelivery($request->all());

        Toast::success('Entrega registrada correctamente');

        return redirect()->back();
    }
}
