<?php

namespace App\Http\Livewire\Afiliado;

use App\Models\Afiliado;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads, ImageTrait;

    public $paramId;
    public $file;

    protected $rules = [];

    public function rules() {
        return [
            'model.numero_afiliado' => 'required|string|max:50',
            'model.cargo' => 'required|string|max:50',
            'model.nombre_completo' => 'required|string|max:50',
            'model.numero_matricula' => 'required|string|max:50',
            'model.ci' => 'required|string|max:50|unique:afiliados,ci,'.$this->model->id,
            'model.expedido' => 'required|string|max:50|',
            'model.fecha_nacimiento' => 'nullable|date',
            'model.grupo_sanguineo' => 'nullable|string',
            'model.egreso' => 'required|string|max:100',
            'model.domicilio' => 'nullable|string|max:300',
            'model.telefono' => 'nullable|string|max:20',
            'model.anos_servicio' => 'nullable|string|max:20',
            'model.costo_matricula' => 'nullable|numeric',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }

    protected $listeners = [
        'display-edit' => 'setAfiliadoId',
    ];

    public function mount() {
        $this->model = new Afiliado();
        $this->rules = $this->rules();
    }

    public function render()
    {
        return view('livewire.afiliado.edit');
    }

    public function setAfiliadoId($id = null)
    {
        $this->paramId = $id;
        $this->model = Afiliado::find($this->paramId);
        $this->dispatchBrowserEvent('modal', [
            'component' => 'afiliado-edit',
            'event' => 'show'
        ]);
    }

    public function update()
    {
        $this->validate();
        try {
            DB::beginTransaction();
            $this->model->save();
            if ($this->file) {
                $this->saveImage($this->file, $this->model, 'afiliado');
            }

            DB::commit();
            $this->emitTo('afiliado.index', 'search');
            $this->dispatchBrowserEvent('modal', [
                'component' => 'afiliado-edit',
                'event' => 'hide'
            ]);
            $this->initProperties();
            $this->dispatchBrowserEvent('switalert', [
                'type' => 'success',
                'title' => 'Afiliado',
                'message' => __('Se actualizó correctamente')
            ]);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();
        }
    }

    public function initProperties()
    {
        $this->model = new Afiliado();
        $this->file = null;
    }
}
