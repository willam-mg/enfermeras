<?php

namespace App\Http\Livewire\Credencial;

use App\Models\Credencial;
use Livewire\Component;

class Show extends Component
{
    public $paramId;
    public $model;

    protected $rules = [
        'model.fecha_registro' => 'date',
        'model.fecha_emision' => 'date',
        'model.fecha_vencimiento' => 'date',
        'model.renovacion' => 'integer',
        'model.costo_renovacion' => 'number',
        'model.estado' => 'integer',
    ];

    protected $listeners = ['setCredencial'];

    public function mount()
    {
        $this->initProperties();
    }

    public function render()
    {
        return view('livewire.credencial.show');
    }

    public function setCredencial($id)
    {
        $this->paramId = $id;
        $this->model = Credencial::find($this->paramId);
        $this->dispatchBrowserEvent('modal', [
            'component' => 'credencial-show',
            'event' => 'show'
        ]);
    }

    public function initProperties()
    {
        $this->model = new Credencial();
    }
}
