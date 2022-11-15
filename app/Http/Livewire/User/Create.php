<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Create extends Component
{
    public $model;
    public $passwordConfirmation;
    public $password;

    protected $rules = [
        'model.name' => 'required|string|max:255',
        'model.email' => 'required|string|email|max:255|unique:users,email',
        'model.rol' => 'required|string',
        'password' => 'required|string|min:6|required_with:passwordConfirmation|same:passwordConfirmation',
        'passwordConfirmation' => 'min:6'
    ];

    protected $listeners = ['openModal'];

    public function mount() {
        $this->password = "";
        $this->model = new User();
    }

    public function render()
    {
        return view('livewire.user.create');
    }

    public function openModal() {
        $this->dispatchBrowserEvent('modal', [
            'component' => 'user-create',
            'event' => 'show'
        ]);
    }

    public function save() {
        $this->validate();
        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $this->model->name,
                'email' => $this->model->email,
                'rol' => $this->model->rol,
                'password' => Hash::make($this->password),
            ]);
            DB::commit();
            $this->initProperties();
            $this->dispatchBrowserEvent('modal', [
                'component' => 'user-create',
                'event' => 'hide'
            ]);
            $this->dispatchBrowserEvent('switalert', [
                'type' => 'success',
                'title' => 'Usuario',
                'message' => 'Se registro correctamente'
            ]);
            $this->emitTo('user.index', 'search');

        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();

        }
    }

    public function initProperties() {
        $this->model = new User();
        $this->password = "";
        $this->passwordConfirmation = "";
    }
}
