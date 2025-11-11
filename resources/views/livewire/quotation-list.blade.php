<div>
    {{-- div principal requerido por Livewire --}}

    <h3>Lista de Cotizaciones</h3>
    

    <div class="table-responsive mt-3">
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Folio (ID)</th>
                    <th>Nombre (Producto)</th>
                    <th>Cliente</th>
                    <th>Fecha de creación</th>
                    <th>Fecha de vencimiento</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                {{-- Iteramos sobre las cotizaciones --}}
                @forelse ($quotations as $quotation)
                    <tr>
                        
                        <td>{{ $quotation->id }}</td>
                        <td>{{ $quotation->name }}</td>
                        <td>{{ $quotation->customer }}</td>
                        <td>{{ $quotation->creation_date->format('d/m/Y') }}</td>
                        <td>{{ $quotation->expiration_date->format('d/m/Y') }}</td>
                        {{-- El modelo se encarga de formatear el decimal --}}
                        <td>${{ number_format($quotation->total, 2) }}</td>
                    </tr>
                @empty
                    {{-- Esto se muestra si no hay registros --}}
                    <tr>
                        <td colspan="6" class="text-center">No hay cotizaciones registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>