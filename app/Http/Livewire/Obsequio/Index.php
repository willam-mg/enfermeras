<?php

namespace App\Http\Livewire\Obsequio;

use App\Models\Afiliado;
use App\Models\Obsequio;
use App\Models\User;
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
    public $searchAfiliadoId;
    public $searchGestion;
    public $searchUserId;
    public $searchEstado;
    public $afiliado_id;
    public $updateMode;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'setSearchIdAfiliado',
    ];
    
    public function mount() {
        $this->initPropertiesObsequios();
    }

    public function render()
    {
        return view('livewire.obsequio.index', [
            'data' => $this->search(),
            'users' => User::all(),
        ]);
    }

    public function search()
    {
        $data = Obsequio::when($this->searchAfiliadoId, function($query) {
                $query->where('afiliado_id', $this->searchAfiliadoId);
            })
            ->when($this->searchGestion, function($query) {
                $query->where('gestion', $this->searchGestion);
            })->when($this->searchUserId, function($query) {
                $query->where('user_id', $this->searchUserId);
            })->when($this->searchEstado, function($query) {
                $query->where('estado', $this->searchEstado);
            })->orderBy('id', 'DESC')
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
        $this->updateMode = false;
    }

    private function initPropertiesSearch() {
        $this->searchAfiliadoId = null;
        $this->searchGestion = null;
        $this->searchUserId = null;
        $this->searchEstado = null;
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

    public function openSelectAfiliado() {
        $this->emitTo('afiliado.select-afiliado', 'openSelectAfiliado', 'obsequio.index');
    }

    public function setSearchIdAfiliado($id) {
        $this->searchAfiliadoId = $id;
    }

    public function edit($id)
    {
        try {
            $this->selected_id = $id;
            $obsequio = Obsequio::findOrFail($this->selected_id);
            $this->fecha_entrega = $obsequio->fecha_entrega;
            $this->hora_entrega = $obsequio->hora_entrega;
            $this->gestion = $obsequio->gestion;
            $this->observacion = $obsequio->observacion;
            $this->estado = $obsequio->estado;
            $this->updateMode = true;
            $this->dispatchBrowserEvent('modal', [
                'component' => 'obsequio-edit',
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

    public function update()
    {
        if ($this->updateMode) {
            try {
                DB::beginTransaction();
                $obsequio = Obsequio::findOrFail($this->selected_id);
                $obsequio->fecha_entrega = $this->fecha_entrega;
                $obsequio->hora_entrega = $this->hora_entrega;
                $obsequio->gestion = $this->gestion;
                $obsequio->observacion = $this->observacion;
                $obsequio->estado = $this->estado;
                if (!$obsequio->save()) {
                    throw new \Exception($obsequio->errors->all());
                }
                DB::commit();
                $this->initPropertiesObsequios();
                $this->dispatchBrowserEvent('modal', [
                    'component' => 'obsequio-edit',
                    'event' => 'hide'
                ]);
                $this->dispatchBrowserEvent('switalert', [
                    'type' => 'success',
                    'title' => 'Obseqios',
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

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $obsequio = Obsequio::findOrFail($id);
            $obsequio->delete();
            DB::commit();
            $this->search();
            $this->dispatchBrowserEvent('switalert', [
                'type' => 'success',
                'title' => 'Obsequios',
                'message' => 'Se elimino correctamente'
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
