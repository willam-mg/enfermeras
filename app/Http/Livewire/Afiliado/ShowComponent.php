<?php

namespace App\Http\Livewire\Afiliado;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Afiliado;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Requisito;
use App\Models\MisRequisitos;
use App\Models\Acreditacion;
use App\Traits\ProgressTrait;
use Illuminate\Support\Carbon;

class ShowComponent extends Component
{
    use ProgressTrait;

    public $paramId;
    public $model;
    public $requisitos;
    public $misRequisitos;
    public $porcentaje;
    public $acreditacionMd;
    // public $afiliados;
    public $selected;
    // public $data;
    public $tabActive;

    protected $listeners = [
        'display-modal' => 'toggleModal',
        'abrir-modal' => 'toggleModal',
    ];

    public function mount() {
        $this->model = new Afiliado();
        $this->requisitos = [];
        $this->misRequisitos = [];
        $this->porcentaje = $this->porcentaje($this->misRequisitos, $this->requisitos);
        // acreditaciones
        $this->acreditacionMd = new Acreditacion();
        // $this->afiliados = Afiliado::all();
        $this->selected = true;
        $this->tabActive = 1;
    }

    public function render()
    {
        if ($this->paramId != null) {
            $this->model = Afiliado::find($this->paramId);
            $this->requisitos = Requisito::where(['estado'=>1])->get();
            $this->misRequisitos = $this->model->misRequisitos->pluck('requisito_id')->toArray();
            // $this->requisitosSeleccionados = $this->misRequisitos;
            $this->porcentaje = $this->porcentaje($this->misRequisitos, $this->requisitos);
            // acreditaciones
            $this->acreditacionMd = new Acreditacion();
            // $this->afiliados = Afiliado::all();
            $this->selected = true;
            // $this->data = Array(Afiliado);
        }
        $data = [];
        if ($this->paramId != null) {
            $data = Acreditacion::where('afiliado_id', '=', $this->model->id)
                ->when($this->acreditacionMd->gestion, function($query) {
                    $query->where('gestion', 'like', '%'.$this->acreditacionMd->gestion);
                })
                ->paginate(5);
        }
    
        return view('livewire.afiliado.show-component', [
            'model'=>$this->model,
            'requisitos'=>$this->requisitos,
            'misRequisitos'=>$this->misRequisitos,
            'porcentaje'=>$this->porcentaje,
            'porcentajeColor'=>$this->porcentajeColor($this->porcentaje),
            'data'=>$data,
            'acreditacionMd'=>$this->acreditacionMd,
            'selected'=>$this->selected,
        ]);
    }

    public function toggleModal($id = null) {
        $this->paramId = $id;
        $this->dispatchBrowserEvent('show-modal');
    }

    public function saveRequisitos($requisitoId = null) {
        // $model = Afiliado::find($id);
        // $misRequisitos = $model->misRequisitos->pluck('requisito_id')->toArray();

        // $requisitos = $request->requisitos?$request->requisitos:[];
        // eliminadno los que no estan seleccionados
        // foreach ($model->misRequisitos as $key => $miRequisito) {
        if ($requisitoId) {
            if (in_array($requisitoId, $this->misRequisitos)) {
                // $miRequisito = MisRequisitos::find($requisitoId);
                $this->model->misRequisitos()->where('requisito_id', $requisitoId)->delete();
                // $miRequisito->delete();
            } else {
                $miRequisito = new MisRequisitos();
                $miRequisito->requisito_id = $requisitoId;
                $miRequisito->afiliado_id = $this->model->id;
                $miRequisito->fecha_presentacion = date('Y-m-d');
                $miRequisito->hora_presentacion = date('His');
                $miRequisito->save();
            }
        }else {
            // foreach ($this->misRequisitos as $key => $miRequisito) {
            //     if (!in_array($miRequisito->requisito_id, $this->requisitosSeleccionados)) {
            //         $miRequisito->delete();
            //     }
            // }
            // Agregando regquisitos seleccionados
            // foreach ($requisitos as $key => $item) {
            foreach ($this->requisitos as $key => $item) {
                // if (!in_array($item, $misRequisitos)) {
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
        // $this->dispatchBrowserEvent('success-requisitos');

        // return redirect()
        //     ->route('afiliados.show', $model->id)
        //     ->with('success','Guardado');
    }
}
