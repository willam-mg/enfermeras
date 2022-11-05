<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Show extends Component
{
    public $model;
    public $paramId;

    protected $listeners = ['setUser'];

    protected $rules = [];

    public function rules()
    {
        return [
            'model.name' => 'required|string|max:255',
            'model.email' => 'required|string|email|max:255|unique:users,email,' . $this->model->id,
            'model.rol' => 'required|string',
        ];
    }

    public function mount()
    {
        $this->initProperties();
        $this->rules = $this->rules();
    }

    public function render()
    {
        return view('livewire.user.show');
    }

    public function setUser($id)
    {
        $this->paramId = $id;
        $this->model = User::find($this->paramId);
        $this->dispatchBrowserEvent('modal', [
            'component' => 'user-show',
            'event' => 'show'
        ]);
    }

    public function initProperties()
    {
        $this->model = new User();
        $this->paramId = null;
    }
}
