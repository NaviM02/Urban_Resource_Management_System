<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormPageHeader extends Component
{
    public string $title;
    public string $description;
    public string $backRoute;
    public $titleComplement;

    public function __construct(
        $title,
        $description = '',
        $backRoute = '',
        $titleComplement = ''
    )
    {
        $this->title = $title;
        $this->description = $description;
        $this->backRoute = $backRoute;
        $this->titleComplement = $titleComplement;
    }

    public function render(): View|Closure|string
    {
        return view('components.form-page-header');
    }
}
