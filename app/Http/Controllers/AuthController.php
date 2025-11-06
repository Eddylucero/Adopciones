<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * 
     */
    public function showLoginForm()
    {
        return view('Login.iniciar');
    }

    /**
     *
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $role = Auth::user()->role;

            if ($role === 'admin') {
                return redirect()->route('dashboard.index')->with('success', 'Bienvenido Administrador.');
            }

            return redirect()->route('home')->with('success', 'Bienvenido al portal de visitantes.');
        }

        return back()->with('error', 'Credenciales incorrectas.');
    }

    /**
     *
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Sesión cerrada correctamente.');
    }

    /**
     *
     */
    public function showRegisterForm()
    {
        return view('Login.registrar');
    }

    /**
     *
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'user';

        User::create($validated);

        return redirect('/login')->with('success', 'Usuario registrado correctamente.');
    }

    /**
     *
     */
    public function recoverPassword()
    {
        return redirect()->route('login')->with('info', 'Se ha contactado con el admin, espere su respuesta.');
    }
}
