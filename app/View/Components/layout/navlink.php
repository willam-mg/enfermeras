<?php

namespace App\View\Components\layout;

use Illuminate\View\Component;

class navlink extends Component
{
    public $active;
    public $href;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($active = false, $href = "")
    {
        $this->active = $active;
        $this->href = $href;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layout.navlink');
    }
}
