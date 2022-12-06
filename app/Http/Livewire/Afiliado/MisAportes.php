<?php

namespace App\Http\Livewire\Afiliado;

use App\Models\Afiliado;
use App\Models\Aporte;
use Livewire\Component;
use Livewire\WithPagination;

class MisAportes extends Component
{
    use WithPagination;

    public $model;
    public $aporteMd;
    public $years;
    public $actualYear;
    public $focusYear;
    public $aportesToPay;
    public $totalAportes;

    protected $paginationTheme = 'bootstrap';
    
    protected $listeners = ['setParamId', 'search'];

    public function mount() {
        $this->initiProperties();
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
                if ( !in_array($this->focusYear, $this->years) ) {
                    $this->focusYear = in_array($this->actualYear, $this->years)?$this->actualYear:$this->years[count($this->years) - 1];
                }
            }
            $misaportes = $this->search();
        }
        return view('livewire.afiliado.mis-aportes', [
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

    public function initiProperties() {
        $this->model = new Afiliado();
        $this->aporteMd = new Aporte();

        $this->years = [];
        $this->actualYear = \Carbon\Carbon::create()->year(date("Y"))->locale('es_ES')->year;
        $this->focusYear = null;
        $this->aportesToPay = [];
        $this->totalAportes = 0;
    }

    public function updateFocusYear($year) {
        $this->focusYear = $year;
        $this->updateTotalAportes();
    }

    private function updateTotalAportes()
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
}
