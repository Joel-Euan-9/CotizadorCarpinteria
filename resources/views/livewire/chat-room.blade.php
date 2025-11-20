<div>
    <div
        class="card"
        style="height: 80vh;"
        x-data="{
            chatBox: null,

            init() {
                this.chatBox = this.$refs.chatBox;
                this.scrollToBottom();
            },

            scrollToBottom() {
                this.$nextTick(() => {
                    this.chatBox.scrollTop = this.chatBox.scrollHeight;
                });
            },

            preserveScroll(oldHeight) {
                this.$nextTick(() => {
                    this.chatBox.scrollTop = this.chatBox.scrollHeight - oldHeight;
                });
            }
        }">
        <!-- Header -->
        <div class="card-header bg-white shadow-sm">
            <h5 class="mb-0">Chat Global</h5>
        </div>

        <!-- Contenedor de mensajes -->
        <div
            class="card-body p-3"
            style="overflow-y: auto; flex-grow: 1;"
            x-ref="chatBox"
            @scroll.debounce.150ms="
                if (chatBox.scrollTop === 0 && $wire.hasMorePages) {
                    let oldHeight = chatBox.scrollHeight;
                    $wire.loadMore().then(() => {
                        preserveScroll(oldHeight);
                    });
                }
            ">
            <!-- Botón de cargar más -->
            @if ($hasMorePages)
            <div class="text-center mb-2">
                <button
                    wire:click="loadMore"
                    wire:loading.attr="disabled"
                    class="btn btn-sm btn-outline-primary">
                    <span
                        wire:loading
                        wire:target="loadMore"
                        class="spinner-border spinner-border-sm"
                        role="status"
                        aria-hidden="true"></span>
                    Cargar más
                </button>
            </div>
            @endif

            <!-- Lista de mensajes -->
            <div class="d-flex flex-column">
                @foreach ($messages as $message)
                @php
                $isOwnMessage = $message['user_id'] === auth()->id();
                @endphp

                <div class="d-flex mb-2 {{ $isOwnMessage ? 'justify-content-end' : 'justify-content-start' }}">
                    <div
                        class="p-2 rounded shadow-sm {{ $isOwnMessage ? 'bg-success text-white' : 'bg-light text-dark' }}"
                        style="max-width: 70%;">
                        @unless($isOwnMessage)
                        <small class="fw-bold">
                            {{ $message['user']['name'] ?? 'Usuario' }}
                        </small>
                        @endunless

                        <p class="mb-0" style="white-space: pre-wrap;">
                            {{ $message['body'] }}
                        </p>

                        <small
                            class="d-block text-end opacity-75 mt-1"
                            style="font-size: 0.75rem;">
                            {{ \Carbon\Carbon::parse($message['created_at'])->format('H:i') }}
                        </small>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Scroll automático -->
            <span
                @message.sent.window="scrollToBottom()"
                @message.received.window="scrollToBottom()"></span>
        </div>

        <!-- Formulario de envío -->
        <div class="card-footer bg-white p-3">
            <form wire:submit="sendMessage">
                <div class="input-group">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Escribe un mensaje..."
                        wire:model="newMessage"
                        autocomplete="off">
                    <button
                        type="submit"
                        class="btn btn-primary"
                        wire:loading.attr="disabled"
                        style="background-color: #2a296dff">
                        <span
                            wire:loading
                            wire:target="sendMessage"
                            class="spinner-border spinner-border-sm"
                            role="status"
                            aria-hidden="true"></span>
                        <span wire:loading.remove>Enviar</span>
                    </button>
                </div>
                @error('newMessage')
                <small class="text-danger mt-1">{{ $message }}</small>
                @enderror
            </form>
        </div>
    </div>
</div>

@script
<script>
    document.addEventListener('livewire:init', () => {
        if (!window.Echo) {
            console.error('Echo no está disponible');
            return;
        }

        console.log('Inicializando suscripción a Echo...');

        // Suscribirse al canal
        const channel = window.Echo.channel('global-chat');

        // Escuchar el evento
        channel.listen('.chat.message.sent', (data) => {
            console.log('Evento recibido desde Echo:', data);

            // Obtener el componente Livewire actual
            const wireId = document.querySelector('[wire\\:id]')?.getAttribute('wire:id');
            if (!wireId) {
                console.error('No se encontró el ID del componente Livewire');
                return;
            }

            // Obtener el componente Livewire
            const component = window.Livewire.find(wireId);
            if (!component) {
                console.error('No se encontró el componente Livewire');
                return;
            }

            // Llamar directamente al método receiveMessage del componente
            component.call('receiveMessage', data);
        });

        // Callbacks para debugging
        channel.subscribed(() => {
            console.log('✅ Suscrito al canal global-chat');
        });

        channel.error((error) => {
            console.error('❌ Error en el canal:', error);
        });
    });

    // Limpiar la suscripción cuando el componente se desmonte
    document.addEventListener('livewire:before-destroy', () => {
        if (window.Echo) {
            console.log('Desuscribiendo del canal global-chat');
            window.Echo.leave('global-chat');
        }
    });
</script>
@endscript