<?php

namespace App\Http\Livewire\Obsequio;

use App\Models\Afiliado;
use App\Models\Obsequio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $fieldSearch;
    public $selected_id;
    public $fecha_entrega;
    public $hora_entrega;
    public $user_id;
    public $gestion;
    public $observacion;
    public $estado;

    protected $paginationTheme = 'bootstrap';
    
    public function mount() {
        $this->initPropertiesObsequios();
    }

    public function render()
    {
        return view('livewire.obsequio.index', [
            'data' => $this->search(),
        ]);
    }

    public function search()
    {
        $data = Obsequio::whereNull('deleted_at')
            ->orderBy('id', 'DESC')
            ->paginate(5);
        $this->resetPage();
        return $data;
    }

    // public function agregar() {
    //     if (Afiliado::latest()->first())  {
    //         $model = new Obsequio();
    //         $model->fecha_entrega = date("Y-m-d");
    //         $model->hora_entrega = date("H:i:s");
    //         $model->user_id = Auth::user()->id;
    //         $model->afiliado_id = Afiliado::latest()->first()->id;
    //         $model->observacion = 'Ninguna';
    //         $model->estado = 2;
    //         $model->save();
    //         $this->search();
    //     }
    // }

    private function initPropertiesObsequios()
    {
        $this->fecha_entrega = date("Y-m-d");
        $this->hora_entrega = date("H:i:s");
        $this->user_id = null;
        $this->gestion = null;
        $this->observacion = null;
        $this->estado = null;
    }

    public function selectObsequio($id, $toUpdate = false)
    {
        try {
            $this->selected_id = $id;
            $obsequio = Obsequio::findOrFail($id);
            if ($toUpdate) {
                $this->fecha_entrega = $obsequio->fecha_entrega;
                $this->hora_entrega = $obsequio->hora_entrega;
                $this->user_id = $obsequio->user_id;
                $this->afiliado_id = $obsequio->afiliado_id;
                $this->gestion = $obsequio->gestion;
                $this->estado = $obsequio->estado;
            }
            $this->observacion = $obsequio->observacion;
            $this->dispatchBrowserEvent('modal', [
                'component' => $toUpdate ? 'misobsequios-entrega-edit' : 'misobsequios-entrega-create',
                'event' => 'show'
            ]);
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('switalert', [
                'type' => 'warning',
                'title' => '',
                'message' => $th->getMessage()
            ]);
        }
    }

    public function entregar()
    {
        try {
            DB::beginTransaction();
            $obsequio = Obsequio::find($this->selected_id);
            $obsequio->estado = 1;
            $obsequio->fecha_entrega =  $this->fecha_entrega;
            $obsequio->hora_entrega =  $this->hora_entrega;
            $obsequio->user_id =  Auth::user()->id;
            $obsequio->observacion =  $this->observacion;
            $obsequio->save();
            DB::commit();
            $this->initPropertiesObsequios();
            $this->search();
            $this->dispatchBrowserEvent('modal', [
                'component' => 'misobsequios-entrega-create',
                'event' => 'hide'
            ]);
            $this->dispatchBrowserEvent('switalert', [
                'type' => 'success',
                'title' => 'Obsequios',
                'message' => 'Se guardo correctamente'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatchBrowserEvent('switalert', [
                'type' => 'warning',
                'title' => '',
                'message' => $th->getMessage()
            ]);
        }
    }
}
