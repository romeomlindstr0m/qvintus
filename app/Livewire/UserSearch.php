<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class UserSearch extends Component
{
    public $query = '';
    public $users = [];

    public function render()
    {
        $this->users = User::where('name', 'LIKE', '%' . $this->query . '%')
            ->orWhere('email', 'LIKE', '%' . $this->query . '%')
            ->orderBy('name')
            ->take(10)
            ->get();

        return view('livewire.user-search');
    }
}