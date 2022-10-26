<?php

namespace App\View\Components\layout;

use Illuminate\View\Component;

class loading extends Component
{
    public $target;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($target = null)
    {
        $this->target = $target;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layout.loading');
    }
}
