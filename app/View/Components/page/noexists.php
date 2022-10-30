<?php

namespace App\View\Components\page;

use Illuminate\View\Component;

class noexists extends Component
{
    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($value = null)
    {
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.page.noexists');
    }
}
