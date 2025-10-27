<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CotizadorController extends Controller
{
    /**
     * Muestra la vista del formulario del cotizador.
     */
    public function show()
    {
        // Simplemente le decimos que cargue la vista que crearemos
        // en 'resources/views/cotizador/show.blade.php'
        return view('cotizador.show');
    }

    /**
     * Muestra la vista de la lista de cotizaciones.
     */
    public function list()
    {
        // Carga la vista de la lista que crearemos
        // en 'resources/views/cotizador/list.blade.php'
        return view('cotizador.list');
    }

    public function users()
    {
        return view('cotizador.users');
    }
}