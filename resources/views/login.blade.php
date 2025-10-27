<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title><link rel="icon" href="images/logoblanco.png">

    @vite(['resources/scss/app.scss', 'resources/js/guest.js'])
    
</head>
<body class="d-flex vh-100 align-items-center justify-content-center bg-light">
    <div class="container w-75 rounded shadow">
        <div class="row align-items-stretch">
            <div class="col bg d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded shadow">

            </div>
            <div class="col bg-white p-5">
                <div class="text-center">
                    <img src="{{ asset('images/logo.png') }}" width="100" alt="Descripción del logo">
                </div>
                <h2 class="fw-bold text-center py-5">Carpenter Studio</h2>

                    <form method="POST" action="{{ route('inicia-sesion') }}">
                        <div class="mb-4 form-floating">
                            <input type="email" class="form-control" name="email" id="floatingInput" placeholder="ejemplo@tudominio.com" required autocmplete="disabled">
                            <label for="floatingInput">Correo electrónico</label>
                            <span class="form-icon">
                                <i class="fa-solid fa-envelope"></i>
                            </span>
                        </div>
                        <div class="mb-4 form-floating">
                            <input type="password" class="form-control" name="password" id="password" placeholder="********" required autocmplete="disabled">
                            <label for="password" >Contraseña</label>
                            <span class="form-icon-clickable" id="togglePassword">
                                <i class="fa-solid fa-eye-slash"></i>
                            </span>
                        </div>
                        <div class="mb-4 form-check">
                            <input type="checkbox" name="connected" class="form-check-input" id="connected">
                            <label for="connected" class="form-check-label">Mantener sesión</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark">Iniciar sesión</button>
                        </div>

                        <div class="my-3 text-center">
                            <span>¿No tienes cuenta? <a href="{{ route('registro') }}">Regístrate</a></span>
                        </div>
                         <div class="my-3 text-center">
                            <span><a href="#">Recuperar contraseña</a></span>
                        </div>
                    </form>
                    
            </div>
        </div>
    </div>

</body>
</html> 