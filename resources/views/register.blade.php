<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="icon" href="images/logoblanco.png">

    @vite(['resources/scss/app.scss', 'resources/js/guest.js'])
    
</head>
<body class="d-flex vh-100 align-items-center justify-content-center bg-light">

    <div class="col-lg-4 col-md-6 col-sm-8 col-11 bg-white p-5 rounded shadow">
        
        <div class="text-center">
            <img src="{{ asset('images/logo.png') }}" width="100" alt="Descripción del logo">
        </div>
        
        <h2 class="fw-bold text-center py-3">Crear Cuenta</h2>

        @error('password')
            <div class="alert alert-danger py-2" role="alert">
                {{ $message }}

            </div>
        @enderror

        @error('password_confirmation')
            <div class="alert alert-danger py-2" role="alert">
                {{ $message }}
            </div>
        @enderror

        <form method="POST" action="{{ route('validar-registro') }}"> <!-- Ruta de ejemplo -->
            @csrf

            <!-- Campo: Nombre -->
            <div class="mb-3 form-floating">
                <input type="text" class="form-control" name="name" id="floatingName" placeholder="Tu Nombre Completo" required autocomplete="name">
                <label for="floatingName">Nombre</label>
                <span class="form-icon">
                    <i class="fa-solid fa-user"></i>
                </span>
            </div>

            <!-- Campo: Email -->
            <div class="mb-3 form-floating">
                <input type="email" class="form-control" name="email" id="floatingInput" placeholder="ejemplo@tudominio.com" required autocomplete="email">
                <label for="floatingInput">Correo electrónico</label>
                <span class="form-icon">
                    <i class="fa-solid fa-envelope"></i>
                </span>
            </div>

            <!-- Campo: Contraseña -->
            <div class="mb-3 form-floating">
                <input type="password" class="form-control" name="password" id="password" placeholder="********" required autocomplete="new-password">
                <label for="password" >Contraseña</label>
                <span class="form-icon-clickable" id="togglePassword">
                    <i class="fa-solid fa-eye-slash"></i>
                </span>
            </div>

            <!-- Campo: Confirmar Contraseña -->
            <div class="mb-3 form-floating">
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="********" required autocomplete="new-password">
                <label for="password_confirmation" >Confirmar Contraseña</label>
                <span class="form-icon-clickable" id="togglePasswordConfirm">
                    <i class="fa-solid fa-eye-slash"></i>
                </span>
            </div>

            <!-- Botón de submit -->
            <div class="d-grid">
                <button type="submit" class="btn btn-dark">Registrarse</button>
            </div>

            <!-- Link inferior -->
            <div class="my-3 text-center">
                <span>¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a></span>
            </div>
        </form>
            
    </div>

</body>
</html>