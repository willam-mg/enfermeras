<?php

namespace App\Http\Livewire;

use App\Models\Afiliado;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PagoMatricula;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PagoMatriculas extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $fecha, $hora, $user_id, $monto, $afiliado_id, $total, $apagar, $saldo, $afiliado, $totalPagos;
    public $updateMode = false;

    protected $listeners = ['setParamId'];

    public function mount() {
        $this->afiliado = new Afiliado();
        $this->user_id = Auth::user()->id;
        $this->total = $this->afiliado->costo_matricula;
    }

    public function render()
    {
        if ($this->afiliado)
            $this->total = $this->afiliado->costo_matricula;
            $this->totalPagos = PagoMatricula::where('afiliado_id', $this->afiliado_id)->sum('monto');
            $this->apagar = $this->total - $this->totalPagos;
            if (is_numeric($this->monto) && $this->monto > 0 && $this->monto <= $this->apagar) {
                $this->saldo = $this->total - ($this->totalPagos + $this->monto);
            } else {
                $this->saldo = $this->apagar;
            }

		$keyWord = '%'.$this->keyWord .'%';
        $data = $this->search($keyWord);
        return view('livewire.pago-matriculas.view', [
            'pagoMatriculas' => $data,
        ]);
    }

    public function setParamId($id) {
        $this->afiliado_id = $id;
        $this->afiliado = Afiliado::find($this->afiliado_id);
        $this->search();
    }

    public function search($keyWord = "") {
        return PagoMatricula::latest()
        ->where('afiliado_id', $this->afiliado_id)
        // ->orWhere('fecha', 'LIKE', $keyWord)
        // ->orWhere('hora', 'LIKE', $keyWord)
        // ->orWhere('monto', 'LIKE', $keyWord)
        ->paginate(5);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->fecha = null;
		$this->hora = null;
		$this->user_id = null;
		$this->monto = null;
    }

    public function store()
    {
        $this->validate([
            'monto' => 'required',
        ]);
        try {
            DB::beginTransaction();

            PagoMatricula::create([
                'fecha' => date("Y-m-d"),
                'hora' => date("H:i:s"),
                'user_id' => Auth::user()->id,
                'monto' => $this->monto,
                'afiliado_id' => $this->afiliado_id
            ]);

            DB::commit();
            $this->resetInput();
            session()->flash('message', 'PagoMatricula Successfully created.');
            $this->search();
            $this->dispatchBrowserEvent('switalert', [
                'type' => 'success',
                'title' => 'Matricula',
                'message' => 'Se registro correctamente'
            ]);
            $this->dispatchBrowserEvent('modal', [
                'component' => 'pagomatricula-create',
                'event' => 'hide'
            ]);
        } catch (\Throwable $th) {
            dd($th);
            session()->flash('message', $th->getMessage());
            DB::rollBack();
        }
    }

    public function edit($id)
    {
        $record = PagoMatricula::findOrFail($id);

        $this->selected_id = $id; 
		$this->monto = $record-> monto;
		
        $this->updateMode = true;

        $this->dispatchBrowserEvent('modal', [
            'component' => 'pagomatricula-edit',
            'event' => 'show'
        ]);
    }

    public function update()
    {
        $this->validate([
    		'monto' => 'required',
        ]);

        try {
            DB::beginTransaction();

            if ($this->selected_id) {
                $record = PagoMatricula::find($this->selected_id);
                if ($this->monto > $this->total) {
                    throw new Exception("El monto no puede ser mayor al costo");
                }
                $record->update([
                    'monto' => $this->monto,
                ]);

                DB::commit();
                $this->resetInput();
                $this->updateMode = false;
                $this->search();
                $this->dispatchBrowserEvent('switalert', [
                    'type' => 'success',
                    'title' => 'Matricula',
                    'message' => 'Se guardo correctamente'
                ]);
                $this->dispatchBrowserEvent('modal', [
                    'component' => 'pagomatricula-edit',
                    'event' => 'hide'
                ]);
            }
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('switalert', [
                'type' => 'warning',
                'title' => '',
                'message' => $th->getMessage()
            ]);
            DB::rollBack();
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = PagoMatricula::where('id', $id);
            $record->delete();
        }
    }

    public function create() {
        $this->dispatchBrowserEvent('modal', [
            'component' => 'pagomatricula-create',
            'event' => 'show'
        ]);
    }
}
