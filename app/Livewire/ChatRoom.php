<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Message;
use App\Models\User;
use App\Events\ChatMessageSent;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

#[Layout('layouts.sidebar')]
class ChatRoom extends Component
{
    /**
     * Almacena los mensajes cargados (como array para evitar error de serialización).
     */
    public $messages = [];

    /**
     * Mensaje nuevo (campo de texto vinculado con wire:model).
     */
    #[Validate('required|string|max:1000')]
    public $newMessage = '';

    /**
     * Cuántos mensajes cargar por página (paginación inversa).
     */
    public $perPage = 30;

    /**
     * Página actual que estamos cargando.
     */
    public $page = 1;

    /**
     * Si hay más mensajes antiguos por cargar.
     */
    public $hasMorePages;

    /**
     * Se ejecuta al montar el componente.
     */
    public function mount()
    {
        $this->messages = $this->loadMessages()->toArray();
    }

    /**
     * Renderiza la vista.
     */
    public function render()
    {
        return view('livewire.chat-room');
    }

    /**
     * Escucha el evento de broadcast (desde Reverb/Echo).
     */
    #[On('echo:global-chat,.chat.message.sent')]
    public function receiveMessage($data)
    {
        $messageArray = $data['message'];

        // Evitar duplicados: si el mensaje ya existe en la lista (porque lo enviamos nosotros), no lo agregamos de nuevo.
        if (collect($this->messages)->contains('id', $messageArray['id'])) {
            return;
        }

        // Rehidratar modelo a formato array
        $message = $this->hydrateMessage($messageArray)->toArray();

        // Agregar mensaje al final del array
        $this->messages[] = $message;

        $this->dispatch('message.received');
    }

    /**
     * Envía un nuevo mensaje.
     */
    public function sendMessage()
    {
        $this->validateOnly('newMessage');

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $message = $user->messages()->create([
            'body' => $this->newMessage
        ])->load('user');

        // Convertir a array y agregar al arreglo local
        $this->messages[] = $message->toArray();

        // Broadcast del evento
        broadcast(new ChatMessageSent($message));

        $this->reset('newMessage');

        $this->dispatch('message.sent');
    }

    /**
     * Carga más mensajes (scroll up).
     */
    public function loadMore()
    {
        if (!$this->hasMorePages) {
            return;
        }

        $newMessages = $this->loadMessages()->toArray();

        // Fusionar los mensajes nuevos al principio
        $this->messages = array_merge($newMessages, $this->messages);

        $this->dispatch('messages.loaded');
    }

    /**
     * Lógica para cargar mensajes paginados.
     */
    private function loadMessages()
    {
        $messagesQuery = Message::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(
                $this->perPage,
                ['*'],
                'page',
                $this->page
            );

        $this->hasMorePages = $messagesQuery->hasMorePages();

        $this->page++;

        // Invertimos el orden para mostrar los más antiguos primero
        return $messagesQuery->getCollection()->reverse()->values();
    }

    /**
     * Convierte un array recibido por broadcast a un modelo Eloquent.
     */
    private function hydrateMessage(array $messageArray): Message
    {
        $user = (new User)->forceFill($messageArray['user']);
        $message = (new Message)->forceFill($messageArray);
        $message->setRelation('user', $user);
        return $message;
    }
}
