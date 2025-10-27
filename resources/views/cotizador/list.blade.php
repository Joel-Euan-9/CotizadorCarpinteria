@extends('layouts.sidebar')

@section('content')
    <h4>Lista de Cotizaciones</h4>
    <p>Este es el contenido de la página de la lista de cotizaciones.</p>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Cliente de Ejemplo</td>
                <td>$100.00</td>
            </tr>
        </tbody>
    </table>
@endsection