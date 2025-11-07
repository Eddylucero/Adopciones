<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Mascota;
use App\Models\Adopcion;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    public function index()
    {
        $personas = Persona::all();
        return view('personas.index', compact('personas'));
    }

    public function nuevovisi()
    {
        $usuario = auth()->user();

        if (!$usuario) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tus adopciones.');
        }

        $persona = Persona::where('correo', $usuario->email)->first();

        if (!$persona) {
            return redirect('/home')
                ->with('error', 'Aún no tienes una cédula registrada. Debes realizar una adopción primero.');
        }

        $adopciones = Adopcion::where('persona_id', $persona->id)
                        ->where('estado', 'Aprobada')
                        ->with('mascota')
                        ->get();

        $mascotas = $adopciones->pluck('mascota');

        return view('personas.nuevovisi', compact('mascotas', 'persona'));
    }


    public function create()
    {
        return view('personas.nuevapersona');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'cedula' => 'required|string|max:10|unique:personas,cedula',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'nullable|email|max:255',
        ]);

        $existe = Persona::where('cedula', $request->cedula)
            ->orWhere('correo', $request->correo)
            ->first();

        if ($existe) {
            return back()
                ->with('error', 'Ya existe un registro con esta cédula o correo electrónico.')
                ->withInput();
        }

        Persona::create($datos);

        if ($request->input('origen') === 'visitante') {
            return redirect('/')
                ->with('success', '¡Gracias por registrarte! Tu información fue enviada correctamente.');
        }

        return redirect()
            ->route('personas.index')
            ->with('success', 'Persona registrada correctamente.');
    }

    public function edit(Persona $persona)
    {
        return view('personas.editarpersona', compact('persona'));
    }

    public function update(Request $request, Persona $persona)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'cedula' => 'required|string|max:10|unique:personas,cedula,' . $persona->id,
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'nullable|email|max:255',
        ]);

        $persona->update($datos);

        return redirect()->route('personas.index')->with('success', 'Persona actualizada correctamente.');
    }

    public function destroy(Persona $persona)
    {
        if ($persona->adopciones()->count() > 0) {
            return redirect()->route('personas.index')
                ->with('error', 'No se puede eliminar la persona porque tiene adopciones registradas.');
        }

        $persona->delete();

        return redirect()->route('personas.index')
            ->with('success', 'Persona eliminada correctamente.');
    }
}
