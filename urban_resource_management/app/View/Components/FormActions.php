<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormActions extends Component
{
    public string $cancelRoute;
    public bool $showDelete;
    public bool $showSave;
    public string $saveText;

    public function __construct(
        $cancelRoute = null,
        $showDelete = false,
        $showSave = true,
        $saveText = 'Guardar'
    ) {
        $this->cancelRoute = $cancelRoute;
        $this->showDelete = $showDelete;
        $this->showSave = $showSave;
        $this->saveText = $saveText;
    }

    public function render(): View|Closure|string
    {
        return view('components.form-actions');
    }
}
