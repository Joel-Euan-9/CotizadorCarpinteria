<?php

namespace App\Events;

use App\Models\Message; // Importamos el modelo
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow; // ¡Importante!
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatMessageSent implements ShouldBroadcastNow // <-- 1. Implementamos la interfaz
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * El mensaje que se está enviando.
     * Al ser 'public', se incluirá automáticamente en el broadcast.
     */
    public Message $message;

    /**
     * Crea una nueva instancia del evento.
     *
     * @param  \App\Models\Message  $message
     */
    public function __construct(Message $message)
    {
        // 2. Cargamos el mensaje Y su relación con el usuario
        //    Usamos load('user') para asegurarnos de que los datos del usuario 
        //    (como el nombre) viajen en el evento.
        $this->message = $message->load('user');
    }

    /**
     * Obtiene los canales en los que el evento debe transmitirse.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        // 3. Este es el nombre de nuestro canal público.
        //    Cualquiera que escuche "global-chat" recibirá este evento.
        return [
            new Channel('global-chat'),
        ];
    }

    /**
     * El nombre con el que se transmitirá el evento.
     *
     * @return string
     */
    public function broadcastAs(): string
    {
        // 4. Esto es útil para el frontend (Echo).
        //    En lugar de escuchar 'ChatMessageSent', escucharemos 'chat.message.sent'
        return 'chat.message.sent';
    }
}