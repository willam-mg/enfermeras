<?php

namespace App\Http\Livewire\Afiliado;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Afiliado;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Traits\ImageTrait;
use App\Models\Requisito;
use App\Models\MisRequisitos;
use App\Models\Aporte;
use App\Traits\ProgressTrait;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $modelFilter;
    public $advancedFilter = false;
    public $fieldSearch;

    public $afiliadoNumeroAfiliado;
    public $afiliadoNombreCompleto;
    public $afiliadoCi;
    public $afiliadoNumeroMatricula;
    public $afiliadoTelefono;
    public $afiliadoFechaRegistro;
    public $afiliadoFechaNacimiento;
 
    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'modelFilter.nombre_completo' => 'string|min:50',
        'modelFilter.numero_afiliado' => 'string|min:50',
        'modelFilter.ci' => 'string|min:50',
    ];

    protected $listeners = [
        'search' => 'search',
    ];

    public function mount() {
        $this->modelFilter = new Afiliado;
        $this->advancedFilter = false;
        $this->fieldSearch = "";
        $this->resetPage();
    }

    public function updatingFieldSearch()
    {
        $this->resetPage();
    }

    public function render(Request $request)
    {
        return view('livewire.afiliado.index', [
            'data'=>$this->search(),
        ]);
    }

    public function initPropertiesSearch() {
        $this->afiliadoNumeroAfiliado = null;
        $this->afiliadoNombreCompleto = null;
        $this->afiliadoCi = null;
        $this->afiliadoNumeroMatricula = null;
        $this->afiliadoTelefono = null;
        $this->afiliadoFechaRegistro = null;
        $this->afiliadoFechaNacimiento = null;
    }

    public function search() {
        if ($this->advancedFilter) {
            $this->fieldSearch = null;
        } else {
            $this->initPropertiesSearch();
        }
        $data = DB::table('afiliados')
            ->when($this->fieldSearch, function($query) {
                    $query->where(DB::Raw("CONCAT(nombre_completo, ' ', numero_afiliado,' ',ci)"), 'like', '%'.$this->fieldSearch.'%');
            })
            ->when($this->afiliadoNumeroAfiliado, function($query) {
                $query->where('numero_afiliado', 'like', '%'.$this->afiliadoNumeroAfiliado.'%');
            })
            ->when($this->afiliadoNombreCompleto, function($query) {
                $query->where('nombre_completo', 'like', '%'.$this->afiliadoNombreCompleto.'%');
            })
            ->when($this->afiliadoCi, function($query) {
                $query->where('ci', 'like', '%'.$this->afiliadoCi.'%');
            })
            ->when($this->afiliadoNumeroMatricula, function($query) {
                $query->where('numero_matricula', 'like', '%'.$this->afiliadoNumeroMatricula.'%');
            })
            ->when($this->afiliadoTelefono, function($query) {
                $query->where('telefono', 'like', '%'.$this->afiliadoTelefono.'%');
            })
            ->when($this->afiliadoFechaNacimiento, function($query) {
                $query->where('fecha_nacimiento', $this->afiliadoFechaNacimiento);
            })
            ->when($this->afiliadoFechaRegistro, function($query) {
                $query->where('fecha_registro', $this->afiliadoFechaRegistro);
            })
            ->whereNull('deleted_at')
            ->orderByRaw('CONVERT(numero_afiliado, SIGNED) ASC')
            ->orderByRaw('nombre_completo ASC')
            ->paginate(5);
        $this->resetPage();
        return $data;
    }

    public function setFilterAdvaced() {
        $this->advancedFilter = $this->advancedFilter?false:true;
    }

    public function destroy($id)
    {
        $model = Afiliado::find($id);
        $model->delete();
        $this->search();
        $this->dispatchBrowserEvent('switalert', [
            'type' => 'success',
            'title' => 'Afiliado',
            'message' => 'Se elimino correctamente'
        ]);
    }
}
