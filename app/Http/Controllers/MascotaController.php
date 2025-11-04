<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use Illuminate\Http\Request;

class MascotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mascotas = Mascota::all();
        return view('mascotas.index', compact('mascotas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mascotas.nuevamascota');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'especie' => 'required|string|max:255',
            'raza' => 'nullable|string|max:255',
            'edad' => 'nullable|integer|min:0',
            'sexo' => 'nullable|string|max:20',
            'descripcion' => 'nullable|string',
            'estado' => 'required|string|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $nombreArchivo = time() . '_' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move(public_path('imagen/'), $nombreArchivo);
            $datos['foto'] = 'imagen/' . $nombreArchivo;
        }

        Mascota::create($datos);

        return redirect()->route('mascotas.index')->with('success', 'Mascota registrada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mascota $mascota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mascota = Mascota::findOrFail($id);
        return view('mascotas.editarmascota', compact('mascota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mascota = Mascota::findOrFail($id);

        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'especie' => 'required|string|max:255',
            'raza' => 'nullable|string|max:255',
            'edad' => 'nullable|integer|min:0|max:25',
            'sexo' => 'nullable|string|max:50',
            'descripcion' => 'nullable|string',
            'estado' => 'required|string|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($mascota->foto && file_exists(public_path($mascota->foto))) {
                unlink(public_path($mascota->foto));
            }

            $nombreArchivo = time() . '_' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move(public_path('imagen/'), $nombreArchivo);
            $datos['foto'] = 'imagen/' . $nombreArchivo;
        }

        $mascota->update($datos);
        return redirect()->route('mascotas.index')->with('success', 'Mascota actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mascota = Mascota::findOrFail($id);

        if ($mascota->foto && file_exists(public_path($mascota->foto))) {
            unlink(public_path($mascota->foto));
        }

        $mascota->delete();
        return redirect()->route('mascotas.index')->with('success', 'Mascota eliminada correctamente.');
    }
}
