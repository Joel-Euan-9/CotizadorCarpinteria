import './bootstrap';
import 'bootstrap';

/**
 * Configura un botón para mostrar/ocultar una contraseña.
 *
 * @param {string} toggleId - El ID del elemento (span/botón) que tiene el icono.
 * @param {string} passwordId - El ID del campo <input> de la contraseña.
 */
function setupPasswordToggle(toggleId, passwordId) {
    
    // 1. Seleccionamos los elementos basados en los IDs recibidos
    const toggleElement = document.querySelector(`#${toggleId}`);
    const passwordElement = document.querySelector(`#${passwordId}`);

    // 2. Si no se encuentran, salimos para evitar errores
    if (!toggleElement || !passwordElement) {
        return; 
    }

    const icon = toggleElement.querySelector('i');

    // 3. Añadimos el "escuchador" de clics
    toggleElement.addEventListener('click', function (e) {
        
        // 4. Cambiamos el tipo de input
        const type = passwordElement.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordElement.setAttribute('type', type);
        
        // 5. Cambiamos el icono
        if (type === 'password') {
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
}


// Espera a que el contenido del HTML esté completamente cargado
document.addEventListener('DOMContentLoaded', function() {

    // Configurar el primer campo de contraseña
    setupPasswordToggle('togglePassword', 'password');

    // Configurar el segundo campo (confirmación)
    setupPasswordToggle('togglePasswordConfirm', 'password_confirmation');

});