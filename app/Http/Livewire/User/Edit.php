<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Edit extends Component
{
    public $model;
    public $paramId;

    protected $listeners = ['setUser'];

    public function mount() {
        $this->model = new User();
    }

    public function render()
    {
        return view('livewire.user.edit');
    }

    public function setUser($id) {
        $this->paramId = $id;
        $this->model = User::find($this->paramId);
        $this->dispatchBrowserEvent('modal', [
            'component' => 'user-edit',
            'event' => 'show'
        ]);
    }

    public function save() {
        $this->validate();
        try {
            DB::beginTransaction();
            $this->model->save();
            DB::commit();
            $this->initProperties();
            $this->dispatchBrowserEvent('modal', [
                'component' => 'user-edit',
                'event' => 'hide'
            ]);
            $this->dispatchBrowserEvent('switalert', [
                'type' => 'success',
                'title' => 'Usuario',
                'message' => 'Se actualizo correctamente'
            ]);
            $this->emitTo('user.index', 'search');
        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();
        }
    }
}
