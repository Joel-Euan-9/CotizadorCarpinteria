<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Quotation;
use Livewire\Attributes\Layout; // 1. Importas el atributo Layout

class QuotationList extends Component
{
    
    // 2. Usas el atributo para definir el layout
    #[Layout('layouts.sidebar')] 
    public function render()
    {
        // Obtenemos todas las cotizaciones de la base de datos
        $quotations = Quotation::all();

        // 3. Simplemente retornas la vista con los datos.
        //    Ya no se añade ->layout() aquí.
        return view('livewire.quotation-list', [
            'quotations' => $quotations,
        ]);
    }
}