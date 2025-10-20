import './bootstrap';
import 'bootstrap';

// Espera a que el contenido del HTML esté completamente cargado
document.addEventListener('DOMContentLoaded', function() {

    // 1. Seleccionamos el icono y el campo de contraseña
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    // IMPORTANTE:
    // Si no encuentras el botón, sal del script para evitar errores.
    // Esto es útil si cargas este JS en páginas que no tienen el formulario.
    if (!togglePassword || !password) {
        return; 
    }

    const icon = togglePassword.querySelector('i');

    // 2. Añadimos un "escuchador" de clics al icono
    togglePassword.addEventListener('click', function (e) {
        
        // 3. Cambiamos el tipo de input
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        // 4. Cambiamos el icono
        if (type === 'password') {
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });

});
