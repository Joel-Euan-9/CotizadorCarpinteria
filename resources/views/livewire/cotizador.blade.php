<div>
    <form wire:submit.prevent="calcularCosto">
        <h2>Cotizador de Maderas 🌲</h2>
        <p>Agregue cada tipo de madera y sus respectivas piezas.</p>

        @foreach ($maderasData as $maderaIndex => $maderaData)
            <div class="border p-4 mb-4 rounded shadow-sm bg-light">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4>Tipo de Madera</h4>
                    @if ($maderaIndex > 0)
                        <button type="button" class="btn btn-sm btn-danger" 
                                wire:click="removerMadera({{ $maderaIndex }})">
                            Remover Madera
                        </button>
                    @endif
                </div>

                <div class="mb-3">
    <label for="madera-{{ $maderaIndex }}" class="form-label">Seleccionar Madera:</label>
    <select id="madera-{{ $maderaIndex }}" class="form-select" 
            wire:model.live="maderasData.{{ $maderaIndex }}.material_id">
        <option value="">-- Seleccione una Madera --</option>
        @foreach ($maderasList as $id => $nombre)
            <option value="{{ $id }}">{{ $nombre }}</option>
        @endforeach
    </select>
</div>
<hr>
<h5>Piezas de esta Madera:</h5>
@foreach ($maderaData['piezas'] as $piezaIndex => $piezaData)
    <div class="row g-2 mb-2 align-items-end">
        <div class="col-md-3">
            <label class="form-label">Largo (m)</label>
            <input type="number" class="form-control" placeholder="Largo" 
                wire:model.live="maderasData.{{ $maderaIndex }}.piezas.{{ $piezaIndex }}.largo" 
                step="0.01" min="0">
        </div>
        <div class="col-md-3">
            <label class="form-label">Ancho (m)</label>
            <input type="number" class="form-control" placeholder="Ancho" 
                wire:model.live="maderasData.{{ $maderaIndex }}.piezas.{{ $piezaIndex }}.ancho"
                step="0.01" min="0">
        </div>
        <div class="col-md-3">
            <label class="form-label">Cantidad</label>
            <input type="number" class="form-control" 
                wire:model.live="maderasData.{{ $maderaIndex }}.piezas.{{ $piezaIndex }}.cantidad"
                min="1">
        </div>
        <div class="col-md-3">
            <label class="form-label">Precio</label>
            <input type="text" disabled class="form-control" 
                value="$ {{ $this->getPrecioTotalMadera($maderaIndex, $piezaIndex) }}">
        </div>
                        <div class="col-md-3 text-end">
                            @if (count($maderaData['piezas']) > 1)
                                <button type="button" class="btn btn-sm btn-outline-danger w-100" 
                                        wire:click="removerPieza({{ $maderaIndex }}, {{ $piezaIndex }})">
                                    Quitar Pieza
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach

                <div class="mt-3">
                    <button type="button" class="btn btn-sm btn-primary" 
                            wire:click="agregarPieza({{ $maderaIndex }})">
                        + Agregar otra Pieza de esta Madera
                    </button>
                </div>
            </div>
        @endforeach

        <hr class="my-4">

        <div class="mb-4">
            <button type="button" class="btn btn-success btn-lg" wire:click="agregarOtraMadera">
                + Agregar Otro Tipo de Madera
            </button>
        </div>



        <div class="mt-5 pt-3 border-top">
            <h2>🔩 Herrajes</h2>

            @foreach ($herrajesData as $herrajeIndex => $herrajeData)
                <div class="row g-2 mb-3">
                    <div class="col-md-5">
                        <label class="form-label">Tipo de Herraje</label>
                        <select class="form-select" 
                                wire:model.live="herrajesData.{{ $herrajeIndex }}.material_id">
                            <option value="">-- Seleccione Herraje --</option>
                            @foreach ($herrajesList as $id => $nombre)
                                <option value="{{ $id }}">{{ $nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Cantidad</label>
                        <input type="number" class="form-control" min="1" 
                            wire:model.live="herrajesData.{{ $herrajeIndex }}.cantidad">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="button" class="btn btn-sm btn-outline-danger w-100" 
                                wire:click="removerHerraje({{ $herrajeIndex }})">
                            Quitar Herraje
                        </button>
                    </div>
                </div>
            @endforeach

            <button type="button" class="btn btn-sm btn-primary" wire:click="agregarHerraje">
                + Agregar Otro Herraje
            </button>
        </div>



        <div class="mt-5 pt-3 border-top">
            <h2>🎨 Pinturas</h2>

            @foreach ($pinturasData as $pinturaIndex => $pinturaData)
                <div class="row g-2 mb-3">
                    <div class="col-md-5">
                        <label class="form-label">Tipo de Pintura</label>
                        <select class="form-select" 
                                wire:model.live="pinturasData.{{ $pinturaIndex }}.material_id">
                            <option value="">-- Seleccione Tipo --</option>
                            @foreach ($pinturasList as $id => $nombre)
                                <option value="{{ $id }}">{{ $nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Volumen (Litros)</label>
                        <input type="number" class="form-control" min="1" 
                            wire:model.live="pinturasData.{{ $pinturaIndex }}.cantidad">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="button" class="btn btn-sm btn-outline-danger w-100" 
                                wire:click="removerPintura({{ $pinturaIndex }})">
                            Quitar Pintura
                        </button>
                    </div>
                </div>
            @endforeach

            <button type="button" class="btn btn-sm btn-primary" wire:click="agregarPintura">
                + Agregar Otra Pintura
            </button>
        </div>



        <div class="mt-5 pt-3 border-top">
            <h2>🧑‍🏭 Mano de Obra</h2>
            
            <div class="row g-2">
                <div class="col-md-4">
                    <label class="form-label">Horas Estimadas</label>
                    <input type="number" class="form-control" min="0" step="0.5" 
                        wire:model.live="manoDeObraData.horas">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tarifa por Hora</label>
                    <input type="number" class="form-control" min="0" step="0.01" 
                        wire:model.live="manoDeObraData.tarifa_hora">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Costo Total</label>
                    {{-- Muestra el costo total calculado --}}
                    <p class="form-control-plaintext">
                        $ {{ number_format(
            // ¡La solución está aquí! Usamos (float) para forzar la conversión.
            (float) $manoDeObraData['horas'] * (float) $manoDeObraData['tarifa_hora'], 
            2
        ) }}
                    </p>
                </div>
            </div>
        </div>
        


        <button type="submit" class="btn btn-info btn-lg w-100">
            Calcular Cotización
        </button>
    </form>
</div>
