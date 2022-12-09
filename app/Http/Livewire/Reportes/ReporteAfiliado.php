<?php

namespace App\Http\Livewire\Reportes;

use App\Models\Afiliado;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Livewire\Component;

class ReporteAfiliado extends Component
{
    public $nombreCompleto;
    public $fechaInicio;
    public $fechaFin;

    public function mount() {
        $this->fechaInicio = date("Y-m-d");
        $this->fechaFin = date("Y-m-d");
    }

    public function render()
    {
        $data = Afiliado::paginate(20);
        return view('livewire.reportes.reporte-afiliado', [
            'data'=>$data
        ]);
    }

    public function print() {
        $data = Afiliado::paginate(20);
        return view('livewire.reportes.reporte-afiliado-print')->with('data', $data);
    }

    public function imprimir($url)
    {
        $this->dispatchBrowserEvent('browserPrint', [
            'url' => url($url)
        ]);
    }
}
