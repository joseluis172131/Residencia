<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        // Intentar autenticar al usuario con las credenciales proporcionadas
        if (Auth::attempt(['name' => $request->name, 'password' => $request->password])) {
            // Autenticación exitosa
            $user = Auth::user(); // Obtener el usuario autenticado

            // Redirigir según el rol del usuario
            if ($user->hasRole('Administrador')) {
                return redirect()->route('datos'); // Ruta para administrador
            } elseif ($user->hasRole('Personal de Trabajo')) {
                return redirect()->route('paileriaPersonal'); // Ruta para personal de trabajo
            }
        }else{
            return back()->with('incorrecto', 'Las credenciales son incorrectas');
        }

        // Si las credenciales no coinciden
        return back()->withErrors([
            'name' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('name'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
