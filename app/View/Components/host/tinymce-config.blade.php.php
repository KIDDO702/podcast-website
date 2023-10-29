<?php

namespace App\View\Components\host;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class tinymce-config.blade.php extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.host.tinymce-config.blade.php');
    }
}
