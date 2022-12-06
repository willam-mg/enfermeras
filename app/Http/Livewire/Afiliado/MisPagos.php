<?php

namespace App\Http\Livewire\Afiliado;

use App\Models\Afiliado;
use App\Models\Aporte;
use App\Models\DetallePago;
use App\Models\Pago;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class MisPagos extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $selected_id,
        $keyWord,
        $model,
        // $fecha,
        // $hora,
        // $user_id,
        // $pago_matricula_id,
        $afiliado_id,
        $afiliado,
        $totalPagos;
        
    public $updateMode = false;

    protected $listeners = ['setParamId', 'search'];

    public function mount() {
        $this->afiliado = new Afiliado();
        $this->model = new Pago();
        $this->user_id = Auth::user()->id;
        // $this->total = $this->afiliado->costo_matricula;
    }
    
    public function render() {
        if ($this->afiliado_id)
            $this->totalPagos = $this->afiliado->totalPagos;
            // $this->totalPagos = DetallePago::join('pagos', 'pagos.id', '=', 'detalle_pagos.pago_id')->where('pago.afiliado_id', $this->afiliado_id)->sum('detalle_pago.monto');

        $keyWord = '%' . $this->keyWord . '%';
        $data = $this->search($keyWord);
        return view('livewire.afiliado.mis-pagos.view', [
            'pagoMatriculas' => $data,
        ]);
    }

    public function setParamId($id) {
        $this->afiliado_id = $id;
        $this->afiliado = Afiliado::find($this->afiliado_id);
        $this->search();
    }

    public function search($keyWord = "") {
        return Pago::latest()
            ->where('afiliado_id', $this->afiliado_id)
            ->paginate(5);
        echo('im here');
    }

    public function show($id)
    {
        $this->selected_id = $id;
        $this->model = Pago::findOrFail($id);

        // $this->fecha = $record->fecha;
        // $this->hora = $record->hora;
        // $this->user_id = $record->user_id;
        // $this->afiliado_id = $record->afiliado_id;
        // $this->pago_matricula_id = $record->pago_matricula_id;

        $this->updateMode = true;

        $this->dispatchBrowserEvent('modal', [
            'component' => 'mispagos-show',
            'event' => 'show'
        ]);
    }

    public function destroy($id)
    {
        if ($id) {
            try {
                DB::beginTransaction();
                $record = Pago::findOrFail($id);
                foreach ($record->detalle as $key => $det) {
                    $det->aporte->estado = Aporte::PENDIENTE;
                    $det->aporte->save();
                }
                foreach ($record->detalle as $key => $det) {
                    $det->delete();
                }
                $record->delete();
                DB::commit();
                $this->search();
                $this->emitTo('afiliado.mis-aportes', 'search');
                $this->dispatchBrowserEvent('switalert', [
                    'type' => 'success',
                    'title' => 'Pago',
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

    public function browserPrint($id) {
        $this->dispatchBrowserEvent('browserPrint', [
            'url' => url('pagos/recibopdf/'.$id)
        ]);
    }
}
