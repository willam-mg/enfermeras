<?php

namespace App\Http\Livewire\Credencial;

use Livewire\Component;
use App\Models\Afiliado;
use App\Models\Credencial;
use Livewire\WithPagination;
use Ramsey\Uuid\Type\Integer;

class Index extends Component
{
    use WithPagination;

    public $afiliado;
    public $model;
    public $idCredencial;
    public $paramId;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['setAfiliado', 'search'];

    protected $rules = [
        'model.fecha_registro' => 'date',
        'model.fecha_emision' => 'date',
        'model.fecha_vencimiento' => 'date',
        'model.renovacion' => 'integer',
        'model.costo_renovacion' => 'number',
        'model.estado' => 'integer',
    ];

    public function updatingFieldSearch()
    {
        $this->resetPage();
    }
    
    public function mount() {
        $this->model = new Credencial();
        $this->afiliado = new Afiliado();
        $this->resetPage();
    }

    public function render()
    {
        $data = [];
        if ($this->paramId)
            $this->afiliado = Afiliado::find($this->paramId);
            $data = $this->search();
        return view('livewire.credencial.index', [
            'data'=>$data
        ]);
    }

    public function search() {
        $data = Credencial::when($this->paramId, function ($query) {
                $query->where('afiliado_id', $this->paramId);
            })
            ->when($this->model->fecha_emision, function ($query) {
                $query->where('fecha_emsion', $this->model->fecha_emision);
            })
            ->when($this->model->fecha_vencimiento, function ($query) {
                $query->where('fecha_vencimiento', $this->model->fecha_vencimiento);
            })
            ->when($this->model->renovacion, function ($query) {
                $query->where('renovacion', $this->model->renovacion);
            })
            ->when($this->model->estado, function ($query) {
                $query->where('estado', $this->model->estado);
            })
            ->orderBy('id', 'DESC')
            ->paginate(5);
        return $data;
    }

    public function setAfiliado($id) {
        $this->paramId = $id;
        $this->idCredencial = null;
    }

    public function destroy($id)
    {
        $model = Credencial::find($id);
        if ( $id = $this->idCredencial ) {
            $this->idCredencial = null;
        }
        $model->delete();
        $this->search();
        $this->resetPage();
        $this->dispatchBrowserEvent('switalert', [
            'type' => 'success',
            'title' => 'Afiliado',
            'message' => 'Se elimino correctamente'
        ]);
    }
}
