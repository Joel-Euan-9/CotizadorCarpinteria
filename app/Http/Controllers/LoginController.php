<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller{
    public function register(Request $request){

        //Lógica de validación de datos de entrada

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        //Creación del usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            //'password' => $request->password,
            'password' => Hash::make($request->password),
        ]);
        
        //Iniciar sesión automaticamente al nuevo usuario
        Auth::login($user);

        return redirect(route('inicio'));

    }

    public function login(Request $request){

        //Validar los datos del input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',

        ]);

        //Preparar las credenciales para el intento de login

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // Lógica de opción de "Mantener sesión"
        $remember = $request->boolean('connected');

        // Intentar iniciar la sesión
        if(Auth::attempt($credentials, $remember)){

            //Regenera la sesión por seguridad evitamos "Session Fixation"
            $request->session()->regenerate();

            // Redirigir al usuario a la ruta de inicio
            return redirect()->intended(route('inicio'));
        }

        // En caso de que las credenciales sean incorrectas
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no son correctas',
        ]);

    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}