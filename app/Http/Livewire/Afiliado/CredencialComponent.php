<?php

namespace App\Http\Livewire\Afiliado;

use Livewire\Component;
use App\Models\Credencial;
use App\Models\Afiliado;

class CredencialComponent extends Component
{
    public $model;
    public $afiliado;
    public $idCredencial;

    protected $rules = [
        'model.fecha_registro' => 'string|max:50',
        'model.fecha_emision' => 'required|string|max:50',
        'model.fecha_vencimiento' => 'required|string|max:50',
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
            $data = $this->afiliado->credenciales()->paginate(5);
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
        $this->model->save();
    }
}
