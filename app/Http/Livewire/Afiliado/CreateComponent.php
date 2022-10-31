<?php

namespace App\Http\Livewire\Afiliado;

use App\Models\Acreditacion;
use Livewire\Component;
use App\Models\Afiliado;
use App\Models\DetallePago;
use App\Models\MisRequisitos;
use App\Models\Pago;
use App\Models\Requisito;
use Livewire\WithFileUploads;
use App\Traits\ImageTrait;
use App\Traits\ProgressTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreateComponent extends Component
{
    use WithFileUploads, ImageTrait, ProgressTrait;
    public Afiliado $model;
    public $file;
    public $requisitos;
    public $misRequisitos;
    public $porcentaje;
    public $porcentajeColor;
    public $acreditacion;
    public $mesActual;
    public $mesSeleccionado;

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
        'model.costo_matricula' => 'nullable|numeric',
        'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        'acreditacion.gestion' => 'numeric',
        'mesSeleccionado' => 'required',
        'acreditacion.monto' => 'numeric',
    ];

    public function mount() {
        $this->model = new Afiliado();
        $this->acreditacion = new Acreditacion();
        $this->requisitos = Requisito::where(['estado' => 1])->get();
        $this->misRequisitos = [];
        $this->porcentaje = 0;
        $this->porcentajeColor = "";
        $this->acreditacion->gestion = date("Y");
        $this->mesActual = Carbon::create()->month(date("m"))->locale('es_ES')->monthName;
        $this->model->costo_matricula = 100;
        $this->acreditacion->monto = 30;
        $this->model->expedido = "CBBA";
    }
    
    public function render()
    {
        return view('livewire.afiliado.create-component');
    }

    public function store(Request $request) {
        $this->validate();
        try {
            DB::beginTransaction();
            // step 1 regsitrando afiliado
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
                'anos_servicio' => $this->model->costo_matricula,
                'fecha_registro'=> date('Y-m-d')
            ]);
            if ($this->file) {
                $this->saveImage($this->file, $afiliado, 'afiliado');
            }
            // step 2 registrando requisitos
            foreach ($this->misRequisitos as $key => $item) {
                $miRequisito = new MisRequisitos();
                $miRequisito->requisito_id = $item;
                $miRequisito->afiliado_id = $afiliado->id;
                $miRequisito->fecha_presentacion = date('Y-m-d');
                $miRequisito->hora_presentacion = date('His');
                $miRequisito->save();
            }
            
            // step3 registrando acreditaciones
            $acreditacion = Acreditacion::create([
                'gestion' => $this->acreditacion->gestion,
                'mes' => $this->mesSeleccionado,
                'monto' => $this->acreditacion->monto,
                'afiliado_id' => $afiliado->id,
                'pendiente' => 1,
            ]);
            
            $pago = Pago::create([
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s'),
                'user_id' => Auth::user()->id,
            ]);
            $detalle = DetallePago::create([
                'acreditacion_id' => $acreditacion->id,
                'monto' => $acreditacion->monto,
                'pago_id' => $pago->id,
            ]);
            $acreditacion->pendiente = 2;
            $acreditacion->save();
            
            DB::commit();
            // $this->emit('afiliadoAdded',$this->model->id);
            $this->emit('afiliadoAdded',$pago->id);
            $this->resetData();
            $this->dispatchBrowserEvent('switalert', [
                'type' => 'success',
                'title' => 'Afiliado',
                'message' => 'Se registro correctamente'
            ]);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();
        }
    }

    public function resetData() {
        $this->model = new Afiliado();
        $this->file = null;
    }
}
