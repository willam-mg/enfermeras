<?php

namespace App\View\Components\layout;

use Illuminate\View\Component;

class sidenavbar extends Component
{
    public $orientation;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($orientation = "vertical")
    {
        $this->orientation = $orientation;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layout.sidenavbar');
    }
}
