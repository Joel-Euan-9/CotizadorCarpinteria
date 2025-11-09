<div>
    <div class="container-md my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg rouded-3">
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
                            {{-- @error('name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror --}}
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

                        <div class="mb-3">
                            <label for="password" class="form-label">Nueva Contraseña</label>
                            <input wire:model.defer="password" id="password" name="password" type="password" autocomplete="new-password"
                            class="form-control">
                            {{-- Mensaje de error (para el backend) --}}
                            {{-- @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror --}}
                        </div>

                        <div class="mb-3">
                            <label for="password-confirmation" class="form-label">Confirmar Nueva Contraseña</label>
                            <input wire:model.defer="password_confirmation" id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                            class="form-control">
                        </div>
                    </form>
                    </div>

                    <div class="card-footer bg-light p-4 d-flex justify-content-between align-items-center">
                        <div class="min-height: 1.5em;">
                            @if(session()->has('message'))
                                <span class_="text-success small">
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-init="setTimeout(() => show = false, 3000)"
                                        x-transition>
                                    {{ session('message') }}
                                </span>
                            @endif
                        </div>
                        <button type="submit" form="profile-form"
                            class="btn text-light"
                            style="background-color: #19183B;"
                            wire:click="save"
                            wire:loading.attr="disabled"
                            wire:target="save">

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
