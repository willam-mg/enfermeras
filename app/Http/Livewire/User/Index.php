<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['search'];

    public function render()
    {
        $data = $this->search();
        return view('livewire.user.index', [
            'data'=>$data
        ]);
    }

    public function search() {
        return User::orderBy('id', 'DESC')->paginate(5);
    }
}
