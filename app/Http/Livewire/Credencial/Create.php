<?php

namespace App\Http\Livewire\Credencial;

use App\Models\Credencial;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public $afiliadoId;
    public $model;

    protected $rules = [
        'model.fecha_registro' => 'date',
        'model.fecha_emision' => 'date',
        'model.fecha_vencimiento' => 'date',
        'model.renovacion' => 'integer',
        'model.costo_renovacion' => 'number',
        'model.estado' => 'integer',
    ];

    protected $listeners = ['setIdAfiliado'];

    public function mount() {
        $this->initProperties();
    }

    public function render()
    {
        return view('livewire.credencial.create');
    }

    public function setIdAfiliado($id)
    {
        $this->afiliadoId = $id;
        $this->dispatchBrowserEvent('modal', [
            'component' => 'credencial-create',
            'event' => 'show'
        ]);
    }

    public function save() {
        $this->model->afiliado_id = $this->afiliadoId;
        $this->model->fecha_registro = date('Y-m-d');
        $this->model->user_id = Auth::user()->id;
        $this->model->save();
        $this->initProperties();
        $this->emitTo('credencial.index', 'search');
        $this->dispatchBrowserEvent('modal', [
            'component' => 'credencial-create',
            'event' => 'hide'
        ]);
    }

    public function initProperties() {
        $this->model = new Credencial();
        $dateNextYear = Carbon::now()->addDays(360)->toDateTimeString();
        $this->model->fecha_emision = date('Y-m-d');
        $this->model->fecha_vencimiento = Carbon::parse($dateNextYear)->format('Y-m-d');
        $this->model->renovacion = Credencial::RENOVACION_NO;
        $this->model->estado = Credencial::ESTADO_PENDIENTE;
        $this->model->costo_renovacion = 30;
    }
}
