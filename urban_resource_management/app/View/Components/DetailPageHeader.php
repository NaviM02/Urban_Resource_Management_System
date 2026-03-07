<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DetailPageHeader extends Component
{
    public string $itemName;
    public ?string $description;
    public ?string $backRoute;
    public ?string $editRoute;
    public array $editParams;

    public function __construct(
        $itemName,
        $description = null,
        $backRoute = null,
        $editRoute = null,
        $editParams = []
    ) {
        $this->itemName = $itemName;
        $this->description = $description;
        $this->backRoute = $backRoute;
        $this->editRoute = $editRoute;
        $this->editParams = $editParams;
    }

    public function render(): View|Closure|string
    {
        return view('components.detail-page-header');
    }
}
