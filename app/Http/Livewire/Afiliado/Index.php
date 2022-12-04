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

    public function search() {
        $data = DB::table('afiliados')
            ->when($this->fieldSearch, function($query) {
                if (!$this->advancedFilter)
                    $query->where(DB::Raw("CONCAT(nombre_completo, ' ', numero_afiliado,' ',ci)"), 'like', '%'.$this->fieldSearch.'%');
            })
            ->when($this->modelFilter->nombre_completo, function($query) {
                if ($this->advancedFilter)
                    $query->where('nombre_completo', 'like', '%'.$this->modelFilter->nombre_completo.'%');
            })
            ->when($this->modelFilter->numero_afiliado, function($query) {
                if ($this->advancedFilter)
                    $query->where('numero_afiliado', 'like', '%'.$this->modelFilter->numero_afiliado.'%');
            })
            ->when($this->modelFilter->ci, function($query) {
                if ($this->advancedFilter)
                    $query->where('ci', 'like', '%'.$this->modelFilter->ci.'%');
            })
            ->whereNull('deleted_at')
            ->orderBy('id', 'DESC')
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
