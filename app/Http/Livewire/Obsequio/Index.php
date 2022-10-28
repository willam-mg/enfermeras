<?php

namespace App\Http\Livewire\Obsequio;

use App\Models\Afiliado;
use App\Models\Obsequio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $fieldSearch;

    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        return view('livewire.obsequio.index', [
            'data' => $this->search(),
        ]);
    }

    public function search()
    {
        $data = Obsequio::whereNull('deleted_at')
            ->orderBy('id', 'DESC')
            ->paginate(5);
        $this->resetPage();
        return $data;
    }

    public function agregar() {
        if (Afiliado::latest()->first())  {
            $model = new Obsequio();
            $model->fecha_entrega = date("Y-m-d");
            $model->hora_entrega = date("H:i:s");
            $model->user_id = Auth::user()->id;
            $model->afiliado_id = Afiliado::latest()->first()->id;
            $model->observacion = 'Ninguna';
            $model->estado = 2;
            $model->save();
            $this->search();
        }
    }
}
