<?php

namespace App\Livewire;

use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use App\Models\Material;
use App\Models\Quotation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;



class Cotizador extends Component
{

    #[Layout('layouts.sidebar')] 


    public $productName = ''; // Para el campo 'name'
    public $customerName = ''; // Para el campo 'customer'
    public $description = '';
    public $long = '';
    public $width = '';
    public $height = '';
    public $quantity = '';
    public $creationDate;
    public $expirationDate;
    public $maderasPrecioUnitario;

    public $herrajesPrecioUnitario;

    public $pinturasPrecioUnitario;

    public $margenGanancia = 25.0;

    public $costoTotal = 0.00;

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

    $this->herrajesPrecioUnitario = Material::where('categories_id', '2')
                                        ->pluck('price', 'id')
                                        ->toArray();

    $this->pinturasPrecioUnitario = Material::where('categories_id','3')
                                        ->pluck('price', 'id')
                                        ->toArray();

    $this->creationDate = now()->toDateString();
    $this->expirationDate = now()->addDays(30)->toDateString();
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

public function getPrecioTotalHerraje($herrajeIndex)
{
    $herraje = $this->herrajesData[$herrajeIndex];
    
    // 1. Obtener ID del material seleccionado
    $materialId = $herraje['material_id'];

    // 2. Obtener el precio unitario (asumiendo que es el precio por unidad)
    // Usamos ?? 0 por si aún no se selecciona el herraje.
    $precioUnitario = $this->herrajesPrecioUnitario[$materialId] ?? 0;

    // 3. Obtener la cantidad (tratando el string vacío como 0)
    $cantidad = (float) ($herraje['cantidad'] ?? 0);
    
    // 4. Calcular el costo total: Cantidad * Precio Unitario
    $costoTotal = $cantidad * $precioUnitario;
    
    return number_format($costoTotal, 2);
}


public function getPrecioTotalPintura($pinturaIndex){
    $pintura = $this->pinturasData[$pinturaIndex];
    $materialId = $pintura['material_id'];
    $precioUnitario = $this->pinturasPrecioUnitario[$materialId] ?? 0;

    $cantidad = (float) ($pintura['cantidad'] ?? 0);

    $costoTotal = $cantidad * $precioUnitario;
    return number_format($costoTotal, 2);
}

public function getSubtotalHerrajes()
    {
        $total = 0;
        foreach ($this->herrajesData as $herraje) {
            $materialId = $herraje['material_id'];
            $precioUnitario = $this->herrajesPrecioUnitario[$materialId] ?? 0;
            $cantidad = (float) ($herraje['cantidad'] ?? 0);
            
            $total += ($cantidad * $precioUnitario);
        }
        return $total;
    }

    public function getSubtotalPinturas()
    {
        $total = 0;
        foreach ($this->pinturasData as $pintura) {
            $materialId = $pintura['material_id'];
            $precioUnitario = $this->pinturasPrecioUnitario[$materialId] ?? 0;
            $cantidad = (float) ($pintura['cantidad'] ?? 0);
            
            $total += ($cantidad * $precioUnitario);
        }
        return $total;
    }

    public function getSubtotalMaderas()
    {
        $total = 0;
        foreach ($this->maderasData as $madera) {
            $materialId = $madera['material_id'];
            $precioUnitario = $this->maderasPrecioUnitario[$materialId] ?? 0;

            foreach ($madera['piezas'] as $pieza) {
                $largo = (float) ($pieza['largo'] ?? 0);
                $ancho = (float) ($pieza['ancho'] ?? 0);
                $cantidad = (float) ($pieza['cantidad'] ?? 0);
                
                // Largo * Ancho * Cantidad * Precio Unitario
                $total += ($largo * $ancho * $cantidad * $precioUnitario);
            }
        }
        return $total;
    }

    public function getSubtotalManoDeObra()
    {
        $horas = (float) ($this->manoDeObraData['horas'] ?? 0);
        $tarifa = (float) ($this->manoDeObraData['tarifa_hora'] ?? 0);
        
        return $horas * $tarifa;
    }


   public function calcularCosto()
    {
        $subtotalMaderas = $this->getSubtotalMaderas();
        $subtotalHerrajes = $this->getSubtotalHerrajes();
        $subtotalManoDeObra = $this->getSubtotalManoDeObra();
        $subtotalPinturas = $this->getSubtotalPinturas(); 

        // Costo base (suma de todos los materiales y mano de obra)
        $costoBase = $subtotalMaderas + $subtotalHerrajes + $subtotalManoDeObra + $subtotalPinturas; 
        
        // 1. Obtener el margen de ganancia (tratando el string vacío como 0)
        $gananciaPorcentaje = (float) ($this->margenGanancia ?? 0);
        
        // 2. Calcular el factor multiplicador (Ej: 25% -> 1.25)
        $factorGanancia = 1 + ($gananciaPorcentaje / 100);

        // 3. Aplicar la ganancia al costo base
        $totalConGanancia = $costoBase * $factorGanancia;
        
        // Almacenar el resultado final
        $this->costoTotal = number_format($totalConGanancia, 2, '.', '');

        $quotation = Quotation::create([
            'name' => $this->productName,
            'customer' => $this->customerName,
            'creation_date' => $this->creationDate,
            'expiration_date' => $this->expirationDate,
            'total' => $this->costoTotal,

        ]);

        $user = Auth::user();
        
        $datosPdf = [
        'quotation' => $quotation, // El objeto de la cotización guardada
        'user' => $user,
        'description' => $this->description,
        'long' => $this->long,
        'width' => $this->width,
        'height'=> $this->height,
        'quantity' => $this->quantity,
        // ... (otros detalles como pinturas, mano de obra)
    ];

    $pdf = Pdf::loadView('pdf.cotizacion', $datosPdf)
          ->setPaper('A4', 'portrait')
          ->setOption('margin-top', 0)
          ->setOption('margin-bottom', 0)
          ->setOption('margin-left', 0)
          ->setOption('margin-right', 0);;


        session()->flash('success', 'El costo total ha sido calculado incluyendo la ganancia.');

        return response()->streamDownload(function () use ($pdf) {
        echo $pdf->output();
    }, 'cotizacion-' . $quotation->id . '.pdf');
    }


    public function render()
    {
        return view('livewire.cotizador');
    }
}
