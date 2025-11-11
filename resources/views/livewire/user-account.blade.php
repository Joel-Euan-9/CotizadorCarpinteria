<div>
    <div class="container-md my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg rounded-3">
                    <div class="card-body p-4 p-md-5">

                    <h2 class="card-title h3 mb-2">Mi Cuenta</h2>

                    <p class="text-muted mb-4">Administra tu información personal y contraseña.</p>

                    <form wire:submit.prevent="save" id="profile-form">

                        <div class="d-flex flex-column align-items-center text-center mb-4">
                            <img src="https://i.imgur.com/hczKIze.jpg" 
                                alt="Foto de perfil del usuario"
                                class="rounded-circle img-thumbnail"
                                style="width: 128px; height: 128px; object-fit: cover;">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input wire:model.defer="name" id="name" name="name" autocomplete="name" required class="form-control" type="text">
                            {{-- Mensaje de error (para el backend) --}}
                            @error('name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input wire:model.defer="email" id="email" name="email" autocomplete="email" type="email" 
                            readonly
                            class="form-control bg-light">
                            <div class="form-text">El correo electrónico no se puede modificar.</div>
                        </div>

                        <hr class="my-4">
                        <h3 class="h5 mb-3">Cambiar Contraseña</h3>
                        <p class="text-muted small mb-3">Deja los campos en blanco si no deseeas cambiar tu contraseña</p>

                        {{-- 1. Añadimos x-data="{ show: false }" para este campo --}}
                        <div class="mb-3 form-floating" x-data="{ show: false }">
                            
                            {{-- 2. Vinculamos el 'type' a la variable 'show' de Alpine --}}
                            <input wire:model.defer="password" 
                                id="password" 
                                name="password" 
                                :type="show ? 'text' : 'password'"  {{-- <--- CAMBIO AQUÍ --}}
                                autocomplete="new-password"
                                class="form-control">
                            
                            <label for="password" class="form-label">Nueva Contraseña</label>
                            
                            {{-- 3. Añadimos un @click que cambia la variable 'show' --}}
                            <span class="form-icon-clickable" 
                                id="togglePassword" 
                                @click="show = !show" {{-- <--- CAMBIO AQUÍ --}}
                                style="cursor: pointer;">
                                
                                {{-- 4. Vinculamos la clase del ícono a la variable 'show' --}}
                                <i class="fa-solid" 
                                :class="show ? 'fa-eye' : 'fa-eye-slash'"></i> {{-- <--- CAMBIO AQUÍ --}}
                            </span>
                            
                            @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>

                        {{-- 5. Repetimos lo mismo para el campo de confirmación --}}
                        <div class="mb-3 form-floating" x-data="{ show: false }">
                            
                            <input wire:model.defer="password_confirmation" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                :type="show ? 'text' : 'password'" {{-- <--- CAMBIO AQUÍ --}}
                                autocomplete="new-password"
                                class="form-control">
                            
                            {{-- Corregí el 'for' para que coincida con el 'id' --}}
                            <label for="password_confirmation" class="form-label">Confirmar Nueva Contraseña</label> 
                            
                            <span class="form-icon-clickable" 
                                id="togglePasswordConfirm" 
                                @click="show = !show" {{-- <--- CAMBIO AQUÍ --}}
                                style="cursor: pointer;">
                                
                                <i class="fa-solid" 
                                :class="show ? 'fa-eye' : 'fa-eye-slash'"></i> {{-- <--- CAMBIO AQUÍ --}}
                            </span>
                        </div>
                    </form>
                    </div>

                    <div class="card-footer bg-light p-4 d-flex justify-content-between align-items-center">
                    
                        {{-- Mensaje de éxito (AHORA MANEJADO 100% POR ALPINE) --}}
                        <div style="min-height: 1.5em;"
                            x-data="{ show: false, message: '' }"
                            x-on:show-message.window="message = $event.detail.text; show = true; setTimeout(() => show = false, 3000)">
                            
                            <span x-show="show" 
                                x-transition.opacity.out.duration.1500ms 
                                class="text-success small" 
                                x-text="message">
                            </span>
                        </div>

                        {{-- Botón de guardar (sin cambios) --}}
                        <button type="submit" form="profile-form"
                                class="btn text-light"
                                wire:click="save"
                                wire:loading.attr="disabled"
                                wire:target="save"
                                style="background-color: #19183B">
                            
                            <span wire:loading wire:target="save" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            
                            <span wire:loading.remove wire:target="save">Guardar Cambios</span>
                            <span wire:loading wire:target="save">Guardando...</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
