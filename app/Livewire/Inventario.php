<?php
namespace App\Livewire;

// app/Livewire/Inventario.php

use Livewire\Component;
use App\Models\Material;
use App\Models\Category;
use Livewire\Attributes\Layout;
use Illuminate\Validation\Rule;

class Inventario extends Component
{
    #[Layout('layouts.sidebar')] 

    public $materials; 
    public $categories;

    // Propiedades para el nuevo elemento (CREATE)
    public $name = ''; 
    public $description = '';
    public $price = 0.00;
    
    // CORRECCIÓN 1: Propiedad para la clave foránea debe ser 'categories_id'
    public $categories_id = ''; 
    
    public $stock = 0; // Campo de Stock (que no existe en la BD, pero se mantiene en el componente)

    // Propiedades para la edición (UPDATE)
    public $editId = null;
    public $editName = '';
    public $editDescription = '';
    public $editPrice = 0.00;
    
    // CORRECCIÓN 2: Propiedad de edición, la nombramos 'editCategoriesId'
    public $editCategoriesId = ''; 
    
    public $editStock = 0; 
    public $isEditing = false;
    
    // Reglas de validación
    protected $rules = [
        'name' => 'required|min:3',
        'description' => 'required|max:500',
        'price' => 'required|numeric|min:0',
        
        // CORRECCIÓN 3: Validación para el campo 'categories_id'
        'categories_id' => 'required|exists:categories,id', 
        
        'stock' => 'required|integer|min:0', 
        
        'editName' => 'required|min:3',
        'editDescription' => 'required|max:500',
        'editPrice' => 'required|numeric|min:0',
        
        // CORRECCIÓN 4: Validación para la edición
        'editCategoriesId' => 'required|exists:categories,id',
        
        'editStock' => 'required|integer|min:0', 
    ];

    public function mount()
    {
        $this->loadData();
    }

    protected function loadData()
    {
        // CORRECCIÓN 5: Usamos la relación 'category' (definida en el modelo) para cargar el nombre.
        $this->materials = Material::with('category')->get(); 
        $this->categories = Category::all();
    }

    public function addItem()
    {
        $validatedData = $this->validate([
            'name' => $this->rules['name'],
            'description' => $this->rules['description'],
            'price' => $this->rules['price'],
            
            // Usamos 'categories_id' para la validación de la propiedad Livewire
            'categories_id' => $this->rules['categories_id'],
            
            'stock' => $this->rules['stock'],
        ]);

        // CORRECCIÓN 6: Usamos 'categories_id' para la inserción en la BD
        Material::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'categories_id' => $validatedData['categories_id'],
        ]);
        
        $this->loadData();
        $this->reset(['name', 'description', 'price', 'categories_id', 'stock']); 

        session()->flash('success', '¡Artículo agregado con éxito!');
    }

    public function editItem($materialId)
    {
        $material = Material::findOrFail($materialId);
        
        $this->editId = $materialId;
        $this->editName = $material->name;
        $this->editDescription = $material->description;
        $this->editPrice = $material->price;
        
        // CORRECCIÓN 7: Cargamos el valor desde la columna correcta de la BD
        $this->editCategoriesId = $material->categories_id;
        
        $this->editStock = $material->stock ?? 0;
        $this->isEditing = true;
    }
    
    public function saveItem()
    {
        $validatedData = $this->validate([
            'editName' => $this->rules['editName'],
            'editDescription' => $this->rules['editDescription'],
            'editPrice' => $this->rules['editPrice'],
            
            // Usamos 'editCategoriesId' para la validación
            'editCategoriesId' => $this->rules['editCategoriesId'],
            
            'editStock' => $this->rules['editStock'],
        ]);

        $material = Material::findOrFail($this->editId);
        
        // CORRECCIÓN 8: Guardamos el valor en la columna correcta de la BD
        $material->update([
            'name' => $validatedData['editName'],
            'description' => $validatedData['editDescription'],
            'price' => $validatedData['editPrice'],
            'categories_id' => $validatedData['editCategoriesId'],
        ]);
        
        $this->isEditing = false;
        $this->editId = null;
        $this->loadData();
        
        session()->flash('success', '¡Artículo actualizado con éxito!');
    }
    
    // ... Mantener cancelEdit, deleteItem, y render ...

    public function cancelEdit()
    {
        $this->isEditing = false;
        $this->editId = null;
        $this->resetErrorBag();
    }

    public function deleteItem($materialId)
    {
        Material::destroy($materialId);
        $this->loadData();
        session()->flash('success', '¡Artículo eliminado con éxito!');
    }

    public function render()
    {
        return view('livewire.inventario');
    }
}