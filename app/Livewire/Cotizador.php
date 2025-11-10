<?php

namespace App\Livewire;


use Livewire\Component;
use App\Models\Material;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;



class Cotizador extends Component
{

    #[Layout('layouts.sidebar')] 

    public $maderasPrecioUnitario;
    public $maderasData = [
        [
            'material_id' => null,
            'piezas' => [
                ['largo' => 0, 'ancho' => 0, 'cantidad' => 1]
            ]
        ]
    ];

    // 🎨 Pinturas: Estructura simple para múltiples tipos de pintura y su volumen
    public $pinturasData = [
        [
            'material_id' => null, // ID del tipo de pintura
            'cantidad' => 1,       // Cantidad (ej. litros o galones)
        ]
    ];

    // 🔩 Herrajes: Estructura simple para múltiples herrajes y su cantidad
    public $herrajesData = [
        [
            'material_id' => null, // ID del herraje (tornillos, bisagras)
            'cantidad' => 1,       // Cantidad de unidades
        ]
    ];
    
    // 🧑‍🏭 Mano de Obra: Estructura simple, usualmente no dinámica
    public $manoDeObraData = [
        'horas' => 8,       // Horas estimadas
        'tarifa_hora' => 50, // Tarifa base (puede venir de la BD)
    ];


    // === 2. LISTAS DE BÚSQUEDA (Para los SELECTS) ===
    public $maderasList;
    public $pinturasList;
    public $herrajesList;

    public function mount()
    {

    $this->maderasList = Material::where('categories_id', '1')->pluck('name', 'id');
    $this->herrajesList = Material::where('categories_id', '2')->pluck('name', 'id');
    $this->pinturasList = Material::where('categories_id', '3')->pluck('name', 'id');
    
    // Carga de precios unitarios (por m²)
    $this->maderasPrecioUnitario = Material::where('categories_id', '1')
                                       ->pluck('price', 'id')
                                       ->toArray();
    }

    public function agregarOtraMadera()
{
    // Añade un nuevo ítem al array $maderasData
    $this->maderasData[] = [
        'material_id' => null, // El ID de la madera seleccionada
        'piezas' => [
            // Inicializa con al menos una pieza para que el usuario pueda empezar a llenar
            ['largo' => 0, 'ancho' => 0, 'cantidad' => 1]
        ]
    ];
}

public function removerMadera($maderaIndex)
{
    // 1. Elimina el elemento del array principal
    unset($this->maderasData[$maderaIndex]);
    
    // 2. Re-indexa el array. ESTO ES VITAL para que Livewire y Blade sigan el conteo.
    $this->maderasData = array_values($this->maderasData); 
}
    
    public function agregarPieza($maderaIndex)
{
    // Asegúrate de usar $this->maderasData ya que es la propiedad correcta para las maderas
    $this->maderasData[$maderaIndex]['piezas'][] = [
        'largo' => 0, 
        'ancho' => 0, 
        'cantidad' => 1
    ];
}

public function removerPieza($maderaIndex, $piezaIndex)
{
    // 1. Elimina la pieza específica usando unset()
    unset($this->maderasData[$maderaIndex]['piezas'][$piezaIndex]);
    
    // 2. Re-indexa el array interno de piezas. ESTO ES CRUCIAL.
    // Garantiza que los índices sean contiguos (0, 1, 2, ...) después de la eliminación.
    $this->maderasData[$maderaIndex]['piezas'] = array_values($this->maderasData[$maderaIndex]['piezas']);
}
    // ... (Métodos de Maderas: agregarOtraMadera, agregarPieza, etc. - ya definidos) ...

    // === 3. NUEVOS MÉTODOS DE PINTURA Y HERRAJES ===

    public function agregarPintura()
    {
        $this->pinturasData[] = ['material_id' => null, 'cantidad' => 1];
    }
    
    public function removerPintura($index)
    {
        unset($this->pinturasData[$index]);
        $this->pinturasData = array_values($this->pinturasData);
    }
    
    public function agregarHerraje()
    {
        $this->herrajesData[] = ['material_id' => null, 'cantidad' => 1];
    }

    public function removerHerraje($index)
    {
        unset($this->herrajesData[$index]);
        $this->herrajesData = array_values($this->herrajesData);
    }

public function getPrecioTotalMadera($maderaIndex, $piezaIndex)
{
    $maderaData = $this->maderasData[$maderaIndex];
    $pieza = $maderaData['piezas'][$piezaIndex];
    
    // 1. Obtener el ID de la madera seleccionada
    $materialId = $maderaData['material_id'];

    // 2. Obtener el precio unitario (por m²)
    // Si no hay ID seleccionado o el precio no existe, asumimos 0
    $precioUnitario = $this->maderasPrecioUnitario[$materialId] ?? 0;

    // 3. Obtener dimensiones y cantidad (tratando el string vacío como 0)
    $largo = (float) ($pieza['largo'] ?? 0);
    $ancho = (float) ($pieza['ancho'] ?? 0);
    $cantidad = (float) ($pieza['cantidad'] ?? 0);
    
    // 4. Calcular el costo total de la pieza
    $costoTotal = ($largo * $ancho * $cantidad * $precioUnitario);
    
    return number_format($costoTotal, 2);
}

    public function render()
    {
        return view('livewire.cotizador');
    }
}
