<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpenter Studio</title><link rel="icon" href="images/logoblanco.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    @vite(['resources/scss/app.scss', 'resources/js/app.js'])

    @livewireStyles
</head>

<body id="body-pd">

    @include('layouts.partials.header')

    @include('layouts.partials.sidebar')

    <main>
        @yield('content')
    </main>

    
    @livewireScripts

    </body>
</html>