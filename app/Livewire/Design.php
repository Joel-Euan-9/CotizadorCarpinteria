<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Design extends Component
{
    #[Layout('layouts.sidebar')]

    public $designs = [];

    public function mount()
    {
        $this->designs = [
            [
                'id' => 1,
                'name' => 'Mesa de Comedor Rústica',
                'description' => 'Mesa robusta de madera maciza con acabado natural, ideal para 6 personas.',
                'images' => [
                    'https://images.unsplash.com/photo-1577140917170-285929db55cc?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1604578762246-41134e37f9cc?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1533090368676-1fd25485db88?q=80&w=1000&auto=format&fit=crop',
                ],
                'dimensions' => [
                    'Largo' => '180 cm',
                    'Ancho' => '90 cm',
                    'Alto' => '75 cm',
                ],
                'materials' => [
                    'Madera: Pino de Primera',
                    'Acabado: Barniz Mate',
                    'Herrajes: Tornillos de acero inoxidable'
                ]
            ],
            [
                'id' => 2,
                'name' => 'Silla Moderna Minimalista',
                'description' => 'Diseño ergonómico con líneas limpias, perfecta para oficinas o comedores modernos.',
                'images' => [
                    'https://images.unsplash.com/photo-1592078615290-033ee584e267?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1503602642458-232111445657?q=80&w=1000&auto=format&fit=crop',
                ],
                'dimensions' => [
                    'Largo' => '45 cm',
                    'Ancho' => '50 cm',
                    'Alto' => '90 cm',
                ],
                'materials' => [
                    'Madera: Cedro Rojo',
                    'Asiento: Tapizado en tela gris',
                    'Acabado: Laca semibrillante'
                ]
            ],
            [
                'id' => 3,
                'name' => 'Ropero Empotrado',
                'description' => 'Solución de almacenamiento elegante con puertas corredizas y organizadores internos.',
                'images' => [
                    'https://images.unsplash.com/photo-1558997519-83ea9252edf8?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1616486338812-3dadae4b4f9d?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1595428774223-ef52624120d2?q=80&w=1000&auto=format&fit=crop',
                ],
                'dimensions' => [
                    'Largo' => '200 cm',
                    'Ancho' => '60 cm',
                    'Alto' => '240 cm',
                ],
                'materials' => [
                    'Madera: Melamina Texturizada',
                    'Herrajes: Rieles de cierre suave',
                    'Tiradores: Aluminio anodizado'
                ]
            ],
            [
                'id' => 4,
                'name' => 'Escritorio Ejecutivo',
                'description' => 'Escritorio amplio con cajonera lateral y gestión de cables integrada.',
                'images' => [
                    'https://images.unsplash.com/photo-1518455027359-f3f8164ba6bd?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1593640408182-31c70c8268f5?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1497215728101-856f4ea42174?q=80&w=1000&auto=format&fit=crop',
                ],
                'dimensions' => [
                    'Largo' => '160 cm',
                    'Ancho' => '80 cm',
                    'Alto' => '75 cm',
                ],
                'materials' => [
                    'Madera: Caoba',
                    'Acabado: Poliuretano brillante',
                    'Herrajes: Correderas telescópicas'
                ]
            ],
            [
                'id' => 5,
                'name' => 'Estantería Modular',
                'description' => 'Sistema de repisas ajustables, ideal para libros y decoración.',
                'images' => [
                    'https://images.unsplash.com/photo-1594620302200-9a762244a156?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1506377295352-e3154d43ea9e?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1524758631624-e2822e304c36?q=80&w=1000&auto=format&fit=crop',
                ],
                'dimensions' => [
                    'Largo' => '120 cm',
                    'Ancho' => '35 cm',
                    'Alto' => '180 cm',
                ],
                'materials' => [
                    'Madera: Pino Finger Joint',
                    'Acabado: Tinte color Nogal',
                    'Soportes: Invisibles de acero'
                ]
            ],
            [
                'id' => 6,
                'name' => 'Mesa de Centro',
                'description' => 'Pieza central con diseño geométrico y superficie de vidrio templado.',
                'images' => [
                    'https://images.unsplash.com/photo-1533090481720-856c6e3c1fdc?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1567016432779-094069958ea5?q=80&w=1000&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1499933374294-4584851497cc?q=80&w=1000&auto=format&fit=crop',
                ],
                'dimensions' => [
                    'Largo' => '100 cm',
                    'Ancho' => '60 cm',
                    'Alto' => '40 cm',
                ],
                'materials' => [
                    'Madera: Roble',
                    'Superficie: Vidrio templado 6mm',
                    'Acabado: Aceite natural'
                ]
            ],
        ];
    }

    public function render()
    {
        return view('livewire.design');
    }
}
