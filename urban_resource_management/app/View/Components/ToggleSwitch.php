<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ToggleSwitch extends Component
{
    public $name;
    public $checked;
    public $disabled;
    public $checkedLabel;
    public $uncheckedLabel;

    public function __construct(
        $name,
        $checked = false,
        $disabled = false,
        $checkedLabel = 'Activo',
        $uncheckedLabel = 'Inactivo'
    ) {
        $this->name = $name;
        $this->checked = $checked;
        $this->disabled = $disabled;
        $this->checkedLabel = $checkedLabel;
        $this->uncheckedLabel = $uncheckedLabel;
    }

    public function render(): View|Closure|string
    {
        return view('components.toggle-switch');
    }
}
