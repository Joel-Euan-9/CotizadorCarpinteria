<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\Layout;

class UserAccount extends Component
{

    #[Layout('layouts.sidebar')]
    public function render()
    {
        return view('livewire.user-account');
    }
}
