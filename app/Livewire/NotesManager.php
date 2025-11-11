<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Note;
use Livewire\Attributes\Layout;


class NotesManager extends Component
{
    #[Layout('layouts.sidebar')]
    public $title;
    public $description;

    public $selectedNoteId;

    public $showModal = false;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
    ];

    /**
     * Muestra la vista y le pasa las notas del usuario.
     */
    public function render()
    {
        $notes = auth()->user()->notes()
                        ->orderBy('updated_at', 'desc')
                        ->get();
                        
        return view('livewire.notes-manager', [
            'notes' => $notes
        ]);
    }
    /**
     * Prepara el componente para crear una nueva nota.
    */

    public function create()
    {
        $this->resetInput();
        $this->showModal = true;
    }

    /**
     * Prepara el componente para editar una nota existente.
     */

    public function edit($noteId)
    {
        // Busca la nota y asegura de que le pertenece al usuario
        $note = auth()->user()->notes()->findOrFail($noteId);

        $this->selectedNoteId = $note->id;
        $this->title = $note->title;
        $this->description = $note->description;

        $this->showModal = true;
    }

    /**
     * Guarda la nota (ya sea nueva o actualizada).
     */
    public function save()
    {
        $this->validate();

        if ($this->selectedNoteId){
            // Actualizar
            $note = auth()->user()->notes()->findOrFail($this->selectedNoteId);
            $note->update([
                'title' => $this->title,
                'description' => $this->description,
            ]);
            session()->flash('success', '¡Nota actualizada!');
        } else {
            // Crear
            auth()->user()->notes()->create([
                'title' => $this->title,
                'description' => $this->description,
            ]);
            session()->flash('success', '¡Nota creada!');
        }

        $this->closeModal();
    }

    /**
     * Elimina una nota.
     */
    public function delete($noteId)
    {
        //Busca la nota (asegurándose que es del usuario) y la borra
        auth()->user()->notes()->findOrFail($noteId)->delete();
        session()->flash('success', '¡Nota eliminada!');
    }

    /**
     * Cierra el modal y resetea los campos.
     */

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetInput();
    }

    /**
     * Resetea las propiedades del formulario.
     */
    public function resetInput()
    {
        $this->title = '';
        $this->description = '';
        $this->selectedNoteId = null;

    }

}