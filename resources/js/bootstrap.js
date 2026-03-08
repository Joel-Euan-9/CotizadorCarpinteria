import axios from 'axios';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.axios = axios;
window.Pusher = Pusher;

const reverBKey = import.meta.env.VITE_REVERB_APP_KEY;

if (reverBKey) {
    window.Echo = new Echo({
        broadcaster: 'reverb', // ¡Importante! Usa 'reverb'
        key: reverBKey,
        wsHost: import.meta.env.VITE_REVERB_HOST,
        wsPort: import.meta.env.VITE_REVERB_PORT,
        wssPort: import.meta.env.VITE_REVERB_PORT,
        forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'http') === 'https',
        enabledTransports: ['ws', 'wss'], // Habilita ws y wss
    });
} else {
    console.warn('VITE_REVERB_APP_KEY no está definido; Laravel Echo no se inicializará.');
}

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
