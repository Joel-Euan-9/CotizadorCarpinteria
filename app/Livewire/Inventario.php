<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Material;
use Livewire\Attributes\Layout;

class Inventario extends Component
{
    #[Layout('layouts.sidebar')] 

    public function render()
    {
        return view('livewire.inventario');
    }
}
