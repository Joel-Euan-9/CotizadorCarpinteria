<div>
    
    {{-- NOTIFICACIÓN DE ÉXITO ESTILO TOAST FLOTANTE --}}
    @if (session()->has('success'))
        <div 
            {{-- Alpine: Muestra el toast, lo oculta después de 3000ms --}}
            x-data="{ show: true }" 
            x-init="setTimeout(() => { show = false; }, 3000)" 
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:leave="transition ease-in duration-200"
            
            {{-- Posicionamiento Fijo para que no mueva la tabla --}}
            class="position-fixed top-0 start-50 translate-middle-x mt-3" 
            style="z-index: 1060; width: 350px;" 
        >
            <div 
                class="toast align-items-center text-white bg-success border-0 fade show" 
                role="alert" 
                aria-live="assertive" 
                aria-atomic="true"
            >
              <div class="d-flex">
                <div class="toast-body d-flex align-items-center">
                    <i class="fas fa-check-circle me-2 fa-lg"></i>
                    <strong class="me-auto fs-6">{{ session('success') }}</strong>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
              </div>
            </div>
        </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i> Añadir Nuevo Artículo</h5>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="addItem">
                {{-- PRIMERA FILA: Nombre, Precio, Categoría --}}
                <div class="row g-3">
                    
                    {{-- Nombre --}}
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model.defer="name" placeholder="Ej: Teclado Mecánico">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    {{-- Precio --}}
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <label for="price" class="form-label">Precio ($)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            <input type="number" step="0.01" class="form-control text-end @error('price') is-invalid @enderror" id="price" wire:model.defer="price" min="0">
                        </div>
                        @error('price') 
                            <div class="text-danger small mt-1">{{ $message }}</div> 
                        @enderror
                    </div>

                    {{-- Categoría ID --}}
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <label for="categories_id" class="form-label">Categoría</label>
                        <select class="form-select @error('categories_id') is-invalid @enderror" id="categories_id" wire:model.defer="categories_id">
                            <option value="">Seleccione Categoría</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('categories_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div> {{-- Fin de la primera fila --}}
                
                {{-- SEGUNDA FILA: Descripción y Botón --}}
                <div class="row g-3 mt-1 align-items-end"> 
                    
                    {{-- Descripción (Columna ancha) --}}
                    <div class="col-lg-10 col-md-10 col-sm-12">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" wire:model.defer="description" placeholder="Breve descripción del producto..."></textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    {{-- Botón Guardar --}}
                    <div class="col-lg-2 col-md-2 col-sm-12 d-grid"> 
                        <button type="submit" class="btn btn-success" wire:loading.attr="disabled" title="Guardar Artículo">
                            <span wire:loading.remove><i class="fas fa-save"></i> Guardar Material</span>
                            <span wire:loading><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></span>
                        </button>
                    </div>
                </div> {{-- Fin de la segunda fila --}}
                
            </form>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col" style="width: 25%">Nombre</th>
                            <th scope="col" style="width: 40%">Descripción</th>
                            <th scope="col">Categoría</th>
                            <th scope="col" class="text-end">Precio</th>
                            <th scope="col" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($materials as $material)
                            <tr wire:key="material-{{ $material->id }}">
                                <th scope="row" class="text-center align-middle">{{ $material->id }}</th>
                                
                                {{-- MODO EDICIÓN --}}
                                @if ($isEditing && $editId == $material->id)
                                    
                                    {{-- Nombre --}}
                                    <td>
                                        <input type="text" class="form-control form-control-sm @error('editName') is-invalid @enderror" wire:model.defer="editName">
                                        @error('editName') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                    </td>
                                    
                                    {{-- Descripción --}}
                                    <td>
                                        <textarea class="form-control form-control-sm @error('editDescription') is-invalid @enderror" wire:model.defer="editDescription" rows="1"></textarea>
                                        @error('editDescription') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                    </td>
                                    
                                    {{-- Categoría (Select) --}}
                                    <td>
                                        <select class="form-select form-select-sm @error('editCategoriesId') is-invalid @enderror" wire:model.defer="editCategoriesId">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('editCategoriesId') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                    </td>
                                    
                                    {{-- Precio --}}
                                    <td class="text-end">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text">$</span>
                                            <input type="number" step="0.01" class="form-control text-end @error('editPrice') is-invalid @enderror" wire:model.defer="editPrice" min="0">
                                        </div>
                                        @error('editPrice') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                    </td>

                                    {{-- Acciones Edición --}}
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <button type="button" class="btn btn-sm btn-primary me-1" wire:loading.attr="disabled" wire:click.prevent="saveItem">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary" wire:click="cancelEdit">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </td>
                                @else
                                    {{-- MODO LECTURA --}}
                                    
                                    {{-- Nombre --}}
                                    <td>
                                        <div class="fw-bold">{{ $material->name }}</div>
                                    </td>
                                    {{-- Descripción --}}
                                    <td>
                                        <span class="text-muted small text-truncate d-block">{{ Str::limit($material->description, 50) }}</span>
                                    </td>
                                    
                                    {{-- Categoría --}}
                                    <td class="align-middle">
                                        <span class="badge bg-secondary">{{ $material->category->name ?? 'N/A' }}</span>
                                    </td>
                                    {{-- Precio --}}
                                    <td class="text-end fw-semibold text-muted">
                                        ${{ number_format($material->price, 2) }}
                                    </td>
                                    
                                    {{-- Acciones Lectura --}}
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-info text-white me-1" wire:click="editItem({{ $material->id }})">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" wire:click="deleteItem({{ $material->id }})" onclick="confirm('¿Estás seguro de eliminar el material: {{ $material->name }}?') || event.stopImmediatePropagation()">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fas fa-box-open fa-3x mb-3"></i><br>
                                    **No se encontraron materiales.**
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  
</div>