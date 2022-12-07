<?php

namespace App\Http\Livewire\Afiliado;

use App\Models\Aporte;
use Livewire\Component;
use App\Models\Afiliado;
use App\Models\DetallePago;
use App\Models\MisRequisitos;
use App\Models\Pago;
use App\Models\PagoMatricula;
use App\Models\Requisito;
use App\Traits\AporteTrait;
use App\Traits\ObsequioTrait;
use Livewire\WithFileUploads;
use App\Traits\ImageTrait;
use App\Traits\ProgressTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Create extends Component
{
    use WithFileUploads, ImageTrait, ProgressTrait, AporteTrait, ObsequioTrait;
    public Afiliado $model;
    public $file;
    public $requisitos;
    public $misRequisitos;
    public $porcentaje;
    public $porcentajeColor;
    public $aporte;
    public $mesActual;
    public $mesSeleccionado;
    public $years;
    public $actualYear;
    public $misAportes;
    public $yearsModo;
    public $yearStart;
    public $yearEnd;
    public $montoMatricula;
    public $saldoMatricula;
    public $totalAportes;

    protected $rules = [
        'model.numero_afiliado' => 'required|string|max:50|unique:afiliados,numero_afiliado',
        'model.cargo' => 'required|string|max:50',
        'model.nombre_completo' => 'required|string|max:50',
        'model.numero_matricula' => 'required|string|max:50',
        'model.ci' => 'required|string|max:50|unique:afiliados,ci',
        'model.expedido' => 'required|string|max:50|',
        'model.fecha_nacimiento' => 'nullable|date',
        'model.grupo_sanguineo' => 'nullable|string',
        'model.egreso' => 'required|string|max:100',
        'model.domicilio' => 'nullable|string|max:300',
        'model.telefono' => 'nullable|string|max:20',
        'model.anos_servicio' => 'nullable|string|max:20',
        'model.costo_matricula' => 'required|numeric',
        'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        'aporte.gestion' => 'numeric',
        'mesSeleccionado' => 'nullable|numeric',
        'aporte.monto' => 'numeric',
        'yearStart' => 'nullable|numeric',
        'yearEnd' => 'nullable|numeric',
        'yearsModo' => 'nullable|boolean',
        'montoMatricula' => 'required|numeric',
        'saldoMatricula' => 'nullable|numeric',
        'totalAportes' => 'nullable|numeric',
    ];

    public function mount() {
        $this->montoMatricula = 0;
        $this->saldoMatricula = 0;
        $this->totalAportes = 0;
        $this->initProperties();
    }

    public function render()
    {
        $this->mesActual = Carbon::create()->month(date("m"))->locale('es_ES')->monthName;
        $this->mesSeleccionado = Carbon::create()->month(date("m"))->locale('es_ES')->month;
        $this->saldoMatricula = floatval($this->model->costo_matricula) - floatval($this->montoMatricula);
        return view('livewire.afiliado.create');
    }

    private function updateTotalAportes($monto) {
        $sumaAportes = 0;
        if ($this->yearsModo) {
            if ($this->yearStart && $this->yearEnd) {
                for ($year = $this->yearStart; $year <= $this->yearEnd; $year++) {
                    for ($month = 1; $month <= 12; $month++) {
                        $sumaAportes += $monto;
                    }
                }
            }
        } else {
            foreach ($this->misAportes as $key => $value) {
                if ($value) {
                    $sumaAportes += $monto;
                }
            }
        }
        return $sumaAportes;
    }

    public function store() {
        $this->totalAportes = $this->updateTotalAportes($this->aporte->monto);
        $this->validate();
        try {
            DB::beginTransaction();
            // step 1 regsitrando afiliado
            $afiliado = Afiliado::create([
                'numero_afiliado'=> Str::lower($this->model->numero_afiliado),
                'cargo'=> Str::lower($this->model->cargo),
                'nombre_completo'=> Str::lower($this->model->nombre_completo),
                'numero_matricula'=> $this->model->numero_matricula,
                'ci'=> $this->model->ci,
                'expedido'=> $this->model->expedido,
                'fecha_nacimiento'=> $this->model->fecha_nacimiento,
                'grupo_sanguineo'=> Str::lower($this->model->grupo_sanguineo),
                'egreso'=> Str::lower($this->model->egreso),
                'domicilio'=> Str::lower($this->model->domicilio),
                'telefono'=> $this->model->telefono,
                'anos_servicio' => $this->model->anos_servicio,
                'costo_matricula' => $this->model->costo_matricula,
                'fecha_registro'=> date('Y-m-d')
            ]);
            if ($this->file) {
                $this->saveImage($this->file, $afiliado, 'afiliado');
            }
            // step 2 registrando requisitos
            foreach ($this->misRequisitos as $key => $item) {
                if ($item) {
                    $miRequisito = new MisRequisitos();
                    $miRequisito->requisito_id = $item;
                    $miRequisito->afiliado_id = $afiliado->id;
                    $miRequisito->fecha_presentacion = date('Y-m-d');
                    $miRequisito->hora_presentacion = date('His');
                    $miRequisito->save();
                }
            }
            // registrando matricula
            $pagoMatricula = new PagoMatricula();
            $pagoMatricula->fecha = date("Y-m-d");
            $pagoMatricula->hora = date("H:i:s");
            $pagoMatricula->user_id = Auth::user()->id;
            $pagoMatricula->monto = $this->montoMatricula;
            $pagoMatricula->afiliado_id = $afiliado->id;
            $pagoMatricula->save();

            // step3 registrando aportes
            $pago = Pago::create([
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s'),
                'user_id' => Auth::user()->id,
                'afiliado_id' => $afiliado->id,
                'pago_matricula_id' => $pagoMatricula->id,
            ]);
            if ($this->yearsModo) {
                if (!$this->yearStart) {
                    throw new \Exception("El campo Desde es requerido");
                }
                if (!$this->yearEnd) {
                    throw new \Exception("El campo Hasta es requerido");
                }
                for ($year = $this->yearStart; $year <= $this->yearEnd; $year++) {
                    for ($month = 1; $month <= 12; $month++) {
                        $aporte = Aporte::create([
                            'gestion' => $year,
                            'mes' => $month,
                            'monto' => $this->aporte->monto,
                            'afiliado_id' => $afiliado->id,
                            'estado' => Aporte::PAGADO,
                        ]);

                        $detalle = DetallePago::create([
                            'aporte_id' => $aporte->id,
                            'monto' => $aporte->monto,
                            'pago_id' => $pago->id,
                        ]);
                    }
                }
            } else {
                foreach ($this->misAportes as $key => $value) {
                    if ($value) {
                        $explodeValue = explode("-", $value);
                        $year = $explodeValue[0];
                        $month = $explodeValue[1];
                        $aporte = Aporte::create([
                            'gestion' => $year,
                            'mes' => $month,
                            'monto' => $this->aporte->monto,
                            'afiliado_id' => $afiliado->id,
                            'estado' => Aporte::PAGADO,
                        ]);

                        $detalle = DetallePago::create([
                            'aporte_id' => $aporte->id,
                            'monto' => $aporte->monto,
                            'pago_id' => $pago->id,
                        ]);
                    }
                }
            }

            // verificar aportes al dia para obsequio
            $gestionesPagadas = $this->findYears($this->misAportes, 0);
            $this->giveGiftByYears($afiliado->id, $gestionesPagadas);
            
            DB::commit();
            $this->emitTo('afiliado.index', 'search');
            $this->dispatchBrowserEvent('modal', [
                'component' => 'afiliado-create',
                'event' => 'hide'
            ]);
            $this->initProperties();
            $this->dispatchBrowserEvent('browserPrint', [
                'url' => url('pagos/recibopdf/'.$pago->id)
            ]);
            $this->dispatchBrowserEvent('switalert', [
                'type' => 'success',
                'title' => 'Afiliado',
                'message' => 'Se registro correctamente'
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

    public function initProperties() {
        $this->model = new Afiliado();
        $this->aporte = new Aporte();
        $this->requisitos = Requisito::where(['estado' => 1])->get();
        $this->misRequisitos = [];
        $this->porcentaje = 0;
        $this->porcentajeColor = "";
        $this->aporte->gestion = date("Y");
        $this->mesActual = Carbon::create()->month(date("m"))->locale('es_ES')->monthName;
        $this->model->costo_matricula = 100;
        $this->aporte->monto = 30;
        $this->model->expedido = "CBBA";
        // generate years for aportes in type meses
        $this->years = [];
        $this->actualYear = \Carbon\Carbon::create()->year(date("Y"))->locale('es_ES')->year;
        $countYear = $this->actualYear - 5;
        for ($i = 1; $i <= 5; $i++) {
            array_push($this->years, $countYear);
            $countYear++;
        }
        array_push($this->years, $this->actualYear);
        array_push($this->years, $this->actualYear + 1);
        $this->misAportes = [];
        $this->yearsModo = false;
        $this->yearStart = null;
        $this->yearEnd = null;
        $this->file = null;

        $this->montoMatricula = $this->model->costo_matricula;
        $this->saldoMatricula = 0;
    }
}
