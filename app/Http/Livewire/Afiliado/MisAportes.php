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
use App\Traits\AporteTrait;
use App\Traits\ObsequioTrait;

class MisAportes extends Component
{
    use WithPagination, AporteTrait, ObsequioTrait;

    public $model;
    public $aporteMd;
    public $years;
    public $actualYear;
    public $focusYear;
    public $aportesToPay;
    public $totalAportes;
    public $miAporteSelected_id;
    public $gestionToAdd;
    public $montoToAddGestion;
    public $updateMode = false;
    public $selected_id;
    public $attrMonto;
    public $attrGestion;
    public $attrMes;
    public $attrEstado;
    public $attrAfiliado_id;
    public $attrPagos;

    protected $paginationTheme = 'bootstrap';
    
    protected $listeners = ['setParamId', 'search'];

    public function mount() {
        $this->initProperties();
    }

    public function render()
    {
        $misaportes = [];
        if (!empty($this->paramId)) {
            $this->years = Aporte::select('gestion')->where('afiliado_id', '=', $this->model->id)
                ->groupBy('gestion')->pluck('gestion')->toArray();
            if (!$this->focusYear && count($this->years) > 0) {
                $this->focusYear = in_array($this->actualYear, $this->years)?$this->actualYear:$this->years[count($this->years) - 1];
            }else {
                if (count($this->years) > 0)  {
                    if ( !in_array($this->focusYear, $this->years) ) {
                        $this->focusYear = in_array($this->actualYear, $this->years)?$this->actualYear:$this->years[count($this->years) - 1];
                    }
                }
            }
            $misaportes = $this->search();
        }
        return view('livewire.afiliado.mis-aportes.index', [
            'misaportes' => $misaportes
        ]);
    }

    public function search() {
        return Aporte::where('afiliado_id', '=', $this->model->id)
            ->where('gestion', $this->focusYear)
            ->orderBy('mes', 'ASC')
            ->take(12)->get();
    }

    public function setParamId($id = null)
    {
        $this->paramId = $id;
        $this->model = Afiliado::find($this->paramId);
        $this->aportesToPay = [];
    }

    public function initProperties() {
        $this->model = new Afiliado();
        $this->aporteMd = new Aporte();

        $this->years = [];
        $this->actualYear = \Carbon\Carbon::create()->year(date("Y"))->locale('es_ES')->year;
        $this->focusYear = null;
        $this->aportesToPay = [];
        $this->totalAportes = 0;
        $this->gestionToAdd = null;
        $this->montoToAddGestion = 30;
        $this->initPropertiesAporte();
    }

    private function initPropertiesAporte() {
        $this->updateMode = false;
        $this->selected_id = null;
        $this->attrMonto = null;
        $this->attrGestion = null;
        $this->attrMes = null;
        $this->attrEstado = null;
        $this->attrAfiliado_id = null;
        $this->attrPagos = [];
    }

    public function updateFocusYear($year) {
        $this->focusYear = $year;
        $this->updateTotalAportes();
    }
    
    public function updateTotalAportes()
    {
        $sumaAportes = 0;
        foreach ($this->aportesToPay as $key => $value) {
            if ($value) {
                $explodeValue = explode("-", $value);
                $monto = $explodeValue[2];
                $sumaAportes += $monto;
            }
        }
        $this->totalAportes = $sumaAportes;
    }

    public function store() {
        $this->updateTotalAportes();
        $this->validate([
            'aportesToPay'=>'required'
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
                'afiliado_id' => $this->model->id,
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
            $this->giveGiftByYears($this->model->id, $gestionesPagadas);

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

    public function edit($id) {
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
                'component' => 'misaportes-edit',
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
    public function update() {
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
                    'component' => 'misaportes-edit',
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

    public function addGestion() {
        try {
            $this->createAportes($this->model->id, $this->gestionToAdd, $this->montoToAddGestion);
            $this->gestionToAdd = null;
            $this->montoToAddGestion = 30;
            $this->search();
            $this->dispatchBrowserEvent('modal', [
                'component' => 'misaportes-add-gestion',
                'event' => 'hide'
            ]);
            $this->dispatchBrowserEvent('switalert', [
                'type' => 'success',
                'title' => 'Aportes',
                'message' => 'Se registro correctamente'
            ]);
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('switalert', [
                'type' => 'warning',
                'title' => '',
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Elimina los aportes seleccionados
     */
    public function destroyAportes() {
        try {
            DB::beginTransaction();

            foreach ($this->aportesToPay as $key => $value) {
                if ($value) {
                    $aporte = Aporte::find($key);
                    $aporte->delete();
                }
            }
            DB::commit();
            $this->aportesToPay = [];
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
