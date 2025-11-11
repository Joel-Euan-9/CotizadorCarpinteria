<div>
    
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <button wire:click="create" class="btn mb-4 shadow-sm mt-3 text-light" style="background-color: #2a296dff">
        <i class="fas fa-plus"></i> Crear Nueva Nota
    </button>

    <div class="row">
        @forelse ($notes as $note)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $note->title }}</h5>
                        
                        <p class="card-text flex-grow-1" style="white-space: pre-wrap;">{{ $note->description }}</p>
                    </div>
                    <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            Modificado: {{ $note->updated_at->format('d/m/Y H:i') }}
                        </small>
                        
                        <div>
                            <button wire:click="edit({{ $note->id }})" class="btn btn-sm btn-outline-secondary" title="Editar">
                                <i class="fas fa-edit"></i>
                            </button>
                            
                            <button 
                                wire:click="delete({{ $note->id }})" 
                                wire:confirm="¿Estás seguro de que quieres eliminar esta nota?" 
                                class="btn btn-sm btn-outline-danger" 
                                title="Eliminar">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info" role="alert">
                    <i class="fas fa-info-circle"></i> No tienes notas todavía. ¡Crea una!
                </div>
            </div>
        @endforelse
    </div>

    @teleport('body')
    <div class="modal fade @if($showModal) show d-block @endif" 
     tabindex="-1" 
     role="dialog" 
     style="background-color: rgba(0,0,0,0.5); z-index: 9999; @if(!$showModal) display: none; @endif">
         
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ $selectedNoteId ? 'Editar Nota' : 'Crear Nueva Nota' }}
                    </h5>
                    <button wire:click="closeModal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form wire:submit.prevent="save">
                    <div class="modal-body">
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Título</label>
                            <input wire:model="title" type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Escribe un título">
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="10" placeholder="Escribe tu nota aquí..."></textarea>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                    <div class="modal-footer">
                        <button wire:click="closeModal" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        
                        <button type="submit" class="btn text-light" style="background-color: #2a296dff">
                            {{ $selectedNoteId ? 'Actualizar Nota' : 'Guardar Nota' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div> @endteleport </div>