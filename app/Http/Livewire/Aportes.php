<?php

namespace App\Http\Livewire;

use App\Models\Afiliado;
use App\Models\Aporte;
use App\Models\DetallePago;
use App\Models\Pago;
use App\Traits\AporteTrait;
use App\Traits\ObsequioTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Aportes extends Component
{
    use WithPagination, AporteTrait, ObsequioTrait;

    public $searchAfiliadoId;
    public $searchAfiliadoNombre;
    public $searchGestion;
    public $searchMes;
    public $searchEstado;
    public $aportesToPay;
    public $totalAportes;
    public $countAportesToPay;

    public $updateMode = false;
    public $selected_id;
    public $attrMonto;
    public $attrGestion;
    public $attrMes;
    public $attrEstado;
    public $attrAfiliado_id;
    public $attrPagos;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'setSearchIdAfiliado',
    ];

    public function mount() {
        $this->aportesToPay = [];
        $this->totalAportes = 0;
        $this->initPorperties();
    }

    public function render()
    {
        $data = $this->search();
        $this->updateTotalAportes();

        return view('livewire.aportes.view', [
            'data' => $data,
        ]);
    }

    public function initPorperties() {
        $this->aportesToPay = [];
        $this->totalAportes = 0;
        $this->countAportesToPay = 0;
    }

    public function search() {
        $data = Aporte::select("*")
            ->when($this->searchAfiliadoId, function ($query) {
                $query->where('afiliado_id', $this->searchAfiliadoId);
            })
            ->when($this->searchGestion, function ($query) {
                $query->where('gestion', $this->searchGestion);
            })
            ->when($this->searchMes, function ($query) {
                $query->where('mes', $this->searchMes);
            })
            ->when($this->searchEstado, function ($query) {
                $query->where('estado', $this->searchEstado);
            })
            ->orderBy('gestion', 'DESC')
            ->orderBy('mes', 'ASC')
            ->paginate(12);
        $this->resetPage();
        return $data;
    }

    public function openSelectAfiliado()
    {
        $this->emitTo('afiliado.select-afiliado', 'openSelectAfiliado', 'obsequio.index');
    }

    public function setSearchIdAfiliado($id)
    {
        $this->searchAfiliadoId = $id;
        $afiliado = Afiliado::findOrFail($id);
        $this->searchAfiliadoNombre = $afiliado->nombre_completo;
    }

    public function emptySearchAfiliadoId() {
        $this->searchAfiliadoId = null;
        $this->searchAfiliadoNombre = null;
        $this->initPorperties();
    }

    public function updateTotalAportes()
    {
        $sumaAportes = 0;
        $count = 0;
        foreach ($this->aportesToPay as $key => $value) {
            if ($value) {
                $explodeValue = explode("-", $value);
                $monto = $explodeValue[2];
                $sumaAportes += $monto;
                $count++;
            }
        }
        
        $this->countAportesToPay = $count;
        $this->totalAportes = $sumaAportes;
    }

    public function store() {
        $this->updateTotalAportes();
        $this->validate([
            'aportesToPay' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $isEmpty = 0;
            foreach ($this->aportesToPay as $key => $value) {
                if ($value) {
                    $isEmpty++;
                }
            }
            if ($isEmpty == 0) {
                throw new \Exception("Debe seleccionar un aporte");
            }

            $pago = Pago::create([
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s'),
                'user_id' => Auth::user()->id,
                'afiliado_id' => $this->searchAfiliadoId,
                'pago_matricula_id' => null,
            ]);
            foreach ($this->aportesToPay as $key => $value) {
                if ($value) {
                    $aporte = Aporte::find($key);
                    $aporte->estado = Aporte::PAGADO;
                    $aporte->save();

                    $explodeValue = explode("-", $value);
                    $monto = $explodeValue[2];
                    $detalle = DetallePago::create([
                        'aporte_id' => $key,
                        'monto' => $monto,
                        'pago_id' => $pago->id,
                    ]);
                }
            }

            // verificar aportes al dia para obsequio
            $gestionesPagadas = $this->findYears($this->aportesToPay, 0);
            $this->giveGiftByYears($this->searchAfiliadoId, $gestionesPagadas);

            DB::commit();
            $this->aportesToPay = [];
            $this->search();
            $this->updateTotalAportes();
            $this->emitTo('afiliado.mis-pagos', 'search');
            $this->emitTo('afiliado.mis-obsequios', 'search');
            $this->dispatchBrowserEvent('switalert', [
                'type' => 'success',
                'title' => 'Aportes',
                'message' => 'Se registro correctamente'
            ]);
            $this->dispatchBrowserEvent('browserPrint', [
                'url' => url('pagos/recibopdf/' . $pago->id)
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

    public function edit($id)
    {
        try {
            $this->selected_id = $id;
            $aporte = Aporte::findOrFail($this->selected_id);
            $this->attrMonto = $aporte->monto;
            $this->attrGestion = $aporte->gestion;
            $this->attrMes = $aporte->mes_name;
            $this->attrEstado = $aporte->estado;
            $this->attrAfiliado_id = $aporte->afiliado_id;
            $this->attrPagos = $aporte->detallePagos;
            $this->updateMode = true;
            $this->dispatchBrowserEvent('modal', [
                'component' => 'aporte-edit',
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
    
    public function show($id)
    {
        try {
            $this->selected_id = $id;
            $aporte = Aporte::findOrFail($this->selected_id);
            $this->attrMonto = $aporte->monto;
            $this->attrGestion = $aporte->gestion;
            $this->attrMes = $aporte->mes_name;
            $this->attrEstado = $aporte->estado;
            $this->attrAfiliado_id = $aporte->afiliado_id;
            $this->attrPagos = $aporte->detallePagos;
            // $this->updateMode = true;
            $this->dispatchBrowserEvent('modal', [
                'component' => 'aporte-show',
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
                $aporte = Aporte::findOrFail($this->selected_id);
                $aporte->monto = $this->attrMonto;
                if (!$aporte->save()) {
                    throw new \Exception($aporte->errors->all());
                }
                DB::commit();
                $this->initPropertiesAporte();
                $this->dispatchBrowserEvent('modal', [
                    'component' => 'aporte-edit',
                    'event' => 'hide'
                ]);
                $this->dispatchBrowserEvent('switalert', [
                    'type' => 'success',
                    'title' => 'Aportes',
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
            $aporte = Aporte::findOrFail($id);
            $aporte->delete();
            DB::commit();
            $this->search();
            $this->dispatchBrowserEvent('switalert', [
                'type' => 'success',
                'title' => 'Aportes',
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
