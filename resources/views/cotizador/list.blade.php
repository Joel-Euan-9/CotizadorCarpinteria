@extends('layouts.sidebar')

@section('content')
    <h4>Lista de Cotizaciones</h4>
    <p>Este es el contenido de la página de la lista de cotizaciones.</p>

    <table class="table">
        <thead>
            <tr>
                <th>Folio</th>
                <th>Producto</th>
                <th>Cliente</th>
                <th>Fecha de creación</th>
                <th>Fecha de vencimiento</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Ropero grande</td>
                <td>Lalito Heredia</td>
                <td>11/01/2025</td>
                <td>14/01/2025</td>
                <td>$100.00</td>
            </tr>
        </tbody>
    </table>
@endsection