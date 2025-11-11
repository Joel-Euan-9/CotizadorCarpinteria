<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class UserAccount extends Component
{

    #[Layout('layouts.sidebar')]

    public $name;
    public $email;
    public $password = '';
    public $password_confirmation = '';

    public function mount()
    {
        $user = Auth::user();

        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function save()
    {
        $validatedData = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'confirmed', Password::min(8)],
        ]);

        $user = Auth::user();

        $user->name = $this->name;

        if (!empty($this->password)){
            $user->password = $this->password;
        }

        $user->save();

        $this->dispatch('show-message', text:'¡Perfil actualizadocon éxito!');
        $this->reset('password', 'password_confirmation');
    }

    protected $messages = [
        'name.required' => 'El campo nombre es obligatorio.',
        'password.min' => 'La nueva contraseña debe tener al menos 8 caracteres.',
        'password.confirmed' => 'La confirmación de la contraseña no coincide.',
    ];

    public function render()
    {
        return view('livewire.user-account');
    }
}
