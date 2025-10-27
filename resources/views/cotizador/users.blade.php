@extends('layouts.sidebar')

@section('content')
    <h4>Lista de usuarios</h4>
    <p>Este es el contenido de la página de la lista de usuarios.</p>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo Electrónico</th>
                <th>Password</th>
                <th>Cargo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Julio César Olivera Baleón</td>
                <td>julio@carpenterstudio.com</td>
                <td>Password</td>
                <td>Administrador</td>
            </tr>
        </tbody>
    </table>
@endsection