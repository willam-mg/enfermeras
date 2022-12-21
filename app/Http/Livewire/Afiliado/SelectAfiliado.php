<?php

namespace App\Http\Livewire\Afiliado;

use App\Models\Afiliado;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class SelectAfiliado extends Component
{
    use WithPagination;

    public $originComponent;
    public $afiliadoNumeroAfiliado;
    public $afiliadoNombreCompleto;
    public $afiliadoCi;
    public $searchField;
    public $advancedFilter;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'openSelectAfiliado',
    ];

    public function mount() {
        $this->advancedFilter = false;
    }

    public function render()
    {
        return view('livewire.afiliado.select-afiliado.index', [
            'afiliados' => $this->searchAfiliado(),
        ]);
    }

    public function initPropertiesSearch() {
        $this->originComponent = null;
        $this->afiliadoNumeroAfiliado = null;
        $this->afiliadoNombreCompleto = null;
        $this->afiliadoCi = null;
    }

    public function searchAfiliado()
    {
        if ($this->advancedFilter) {
            $this->searchField = null;
        }else {
            $this->initPropertiesSearch();
        }
        $data = Afiliado::when($this->searchField, function ($query) {
            $query->where(DB::Raw("CONCAT(nombre_completo,' ',ci)"), 'like', '%' . $this->searchField . '%');
        })->when($this->afiliadoNumeroAfiliado, function ($query) {
            $query->where('numero_afiliado', $this->afiliadoNumeroAfiliado);
        })->when($this->afiliadoNombreCompleto, function ($query) {
            $query->where('nombre_completo', $this->afiliadoNombreCompleto);
        })->when($this->afiliadoCi, function ($query) {
            $query->where('ci', $this->afiliadoCi);
        })->orderBy('id', 'DESC')
        ->paginate(5);

        $this->resetPage();
        return $data;
    }

    public function openSelectAfiliado($originComponent)
    {
        $this->originComponent = $originComponent;
        $this->searchAfiliado();
        $this->dispatchBrowserEvent('modal', [
            'component' => 'select-afiliado',
            'event' => 'show'
        ]);
    }

    public function selectAfiliado($id) {
        $this->emitTo($this->originComponent, 'setSearchIdAfiliado', $id);
        $this->dispatchBrowserEvent('modal', [
            'component' => 'select-afiliado',
            'event' => 'hide'
        ]);
    }
}
