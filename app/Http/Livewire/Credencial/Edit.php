<?php

namespace App\Http\Livewire\Credencial;

use App\Models\Credencial;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Edit extends Component
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
        return view('livewire.credencial.edit');
    }

    public function setCredencial($id)
    {
        $this->paramId = $id;
        $this->model = Credencial::find($this->paramId);
        $this->dispatchBrowserEvent('modal', [
            'component' => 'credencial-edit',
            'event' => 'show'
        ]);
    }

    public function save()
    {
        $this->model->save();
        $this->initProperties();
        $this->emitTo('credencial.index', 'search');
        $this->dispatchBrowserEvent('modal', [
            'component' => 'credencial-edit',
            'event' => 'hide'
        ]);
        $this->dispatchBrowserEvent('switalert', [
            'type' => 'success',
            'title' => 'Credencial',
            'message' => 'Se modifico correctamente'
        ]);
    }

    public function initProperties()
    {
        $this->model = new Credencial();
    }
}
