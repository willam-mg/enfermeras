<?php

namespace App\View\Components\credencial;

use Illuminate\View\Component;

class back extends Component
{
    public $model;
    public $fechaInicio;
    public $fechaFin;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($model, $fechaInicio, $fechaFin)
    {
        $this->model = $model;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.credencial.back');
    }
}
