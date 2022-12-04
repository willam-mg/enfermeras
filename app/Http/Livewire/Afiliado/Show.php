<?php

namespace App\Http\Livewire\Afiliado;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Afiliado;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Requisito;
use App\Models\MisRequisitos;
use App\Models\Aporte;
use App\Traits\ProgressTrait;
use Illuminate\Support\Carbon;

class Show extends Component
{
    use ProgressTrait;

    public $model;
    public $requisitos;
    public $misRequisitos;
    public $porcentaje;
    public $aporteMd;
    public $selected;
    public $porcentajeColor;
    public $paramId;

    protected $rules = [
        'model.id' => 'integer',
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
    ];

    protected $listeners = [
        'display-show' => 'setAfiliadoId',
    ];

    public function mount() {
        $this->model = new Afiliado();
        $this->requisitos = Requisito::where(['estado' => 1])->get();
        $this->misRequisitos = [];
        $this->porcentaje = 0;
        $this->porcentajeColor = "";
        $this->aporteMd = new Aporte();
        $this->selected = true;
    }

    public function render()
    {
        $data = [];
        if (!empty($this->paramId)) {
            $this->model = Afiliado::find($this->paramId);
            $this->misRequisitos = $this->model->misRequisitos->pluck('requisito_id')->toArray();
            $this->porcentaje = $this->porcentaje($this->misRequisitos, $this->requisitos);
            $this->porcentajeColor = $this->porcentajeColor($this->porcentaje);    
        
            $data = Aporte::where('afiliado_id', '=', $this->model->id)
                ->when($this->aporteMd->gestion, function($query) {
                    $query->where('gestion', 'like', '%'.$this->aporteMd->gestion);
                })
                ->paginate(12);
        }
    
        return view('livewire.afiliado.show', [
            'data'=>$data
        ]);
    }

    public function setAfiliadoId($id = null) {
        $this->paramId = $id;
        $this->emitTo('credencial.index', 'setAfiliado', $this->paramId);
        $this->emitTo('pago-matriculas', 'setParamId', $this->paramId);
        $this->emitTo('pago-matriculas', 'setParamId', $this->paramId);
        $this->emitTo('afiliado.mis-aportes', 'setParamId', $this->paramId);
        $this->emitTo('afiliado.mis-pagos', 'setParamId', $this->paramId);
        $this->dispatchBrowserEvent('modal', [
            'component' => 'afiliado-show',
            'event' => 'show'
        ]);
    }

    public function saveRequisitos($requisitoId = null) {
        if ($requisitoId) {
            if (in_array($requisitoId, $this->misRequisitos)) {
                $this->model->misRequisitos()->where('requisito_id', $requisitoId)->delete();
            } else {
                $miRequisito = new MisRequisitos();
                $miRequisito->requisito_id = $requisitoId;
                $miRequisito->afiliado_id = $this->model->id;
                $miRequisito->fecha_presentacion = date('Y-m-d');
                $miRequisito->hora_presentacion = date('His');
                $miRequisito->save();
            }
        }else {
            // Agregando regquisitos seleccionados
            foreach ($this->requisitos as $key => $item) {
                if (!in_array($item->id, $this->misRequisitos)) {
                    $miRequisito = new MisRequisitos();
                    $miRequisito->requisito_id = $item->id;
                    $miRequisito->afiliado_id = $this->model->id;
                    $miRequisito->fecha_presentacion = date('Y-m-d');
                    $miRequisito->hora_presentacion = date('His');
                    $miRequisito->save();
                }
            }
        }
    }
}
