<?php

namespace App\Http\Livewire\Afiliado;

use Livewire\Component;
use App\Models\Credencial;
use App\Models\Afiliado;
use Illuminate\Support\Facades\Auth;

class CredencialComponent extends Component
{
    public $model;
    public $afiliado;
    public $idCredencial;
    public $fecha_emision;
    public $fecha_vencimiento;
    public $renovacion;
    public $costo_renovacion;
    public $estado;

    protected $rules = [
        'model.fecha_registro' => 'string|max:50',
        'model.fecha_emision' => 'date',
        'model.fecha_vencimiento' => 'date',
        'model.renovacion' => 'string',
        'model.costo_renovacion' => 'number',
        'model.estado' => 'string|max:50|',
    ];
    protected $listeners = ['list-credenciales'=>'setAfiliado'];

    public function mount(Afiliado $afiliado) {
        $this->afiliado = $afiliado;
        $this->model = new Credencial();
        $this->idCredencial = 0;
    }

    public function render()
    {
        $data = [];
        if ($this->afiliado)
            $data = $this->afiliado->credenciales()->orderBy('id', 'DESC')->paginate(5);
        return view('livewire.afiliado.credencial-component', [
            'data'=>$data,
            'model'=>$this->model
        ]);
    }

    public function setAfiliado(Afiliado $afiliado) {
        $this->afiliado = $afiliado;
    }

    public function edit($model) {
        $this->model = $model;
    }
    
    public function show($model) {
        $this->model = $model;
    }

    public function save() {
        $mimodelo = new Credencial();
        $mimodelo->fecha_registro = date('Y-m-d');
        $mimodelo->afiliado_id = $this->afiliado->id;
        $mimodelo->user_id = Auth::user()->id;
        $mimodelo->fecha_emision = $this->fecha_emision;
        $mimodelo->fecha_vencimiento = $this->fecha_vencimiento;
        $mimodelo->renovacion = $this->renovacion;
        $mimodelo->costo_renovacion = $this->costo_renovacion;
        $mimodelo->estado = $this->estado;
        $mimodelo->save();
    }
}
