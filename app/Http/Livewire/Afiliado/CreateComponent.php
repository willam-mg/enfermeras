<?php

namespace App\Http\Livewire\Afiliado;

use Livewire\Component;
use App\Models\Afiliado;
use Livewire\WithFileUploads;
use App\Traits\ImageTrait;
use App\Traits\ProgressTrait;

class CreateComponent extends Component
{
    use WithFileUploads, ImageTrait, ProgressTrait;
    public Afiliado $model;
    public $file;

    protected $rules = [
        'model.numero_afiliado' => 'required|string|max:50',
        'model.cargo' => 'required|string|max:50',
        'model.nombre_completo' => 'required|string|max:50',
        'model.numero_matricula' => 'required|string|max:50',
        'model.ci' => 'required|string|max:50|unique:afiliados,ci',
        'model.expedido' => 'required|string|max:50|',
        'model.fecha_nacimiento' => 'date',
        'model.grupo_sanguineo' => 'string',
        'model.egreso' => 'string|max:100',
        'model.domicilio' => 'string|max:300',
        'model.telefono' => 'string|max:20',
        'model.anos_servicio' => 'string|max:20',
        'file' => 'image|mimes:jpeg,png,jpg,gif,svg',
    ];

    public function mount() {
        $this->model = new Afiliado();
    }
    
    public function render()
    {
        return view('livewire.afiliado.create-component');
    }

    public function store() {
        $this->validate();
        
        $afiliado = Afiliado::create([
            'numero_afiliado'=> $this->model->numero_afiliado,
            'cargo'=> $this->model->cargo,
            'nombre_completo'=> $this->model->nombre_completo,
            'numero_matricula'=> $this->model->numero_matricula,
            'ci'=> $this->model->ci,
            'expedido'=> $this->model->expedido,
            'fecha_nacimiento'=> $this->model->fecha_nacimiento,
            'grupo_sanguineo'=> $this->model->grupo_sanguineo,
            'egreso'=> $this->model->egreso,
            'domicilio'=> $this->model->domicilio,
            'telefono'=> $this->model->telefono,
            'anos_servicio' => $this->model->anos_servicio,
            'fecha_registro'=> date('Y-m-d')
        ]);

        if ($this->file) {
            $this->saveImage($this->file, $afiliado, 'afiliado');
        }

        $this->emit('afiliadoAdded',$this->model->id);
        $this->resetData();
        // return redirect()->to('/afiliados');
    }

    public function resetData() {
        $this->model = new Afiliado();
        $this->file = null;
    }
}
