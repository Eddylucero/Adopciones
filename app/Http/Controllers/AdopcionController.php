<?php

namespace App\Http\Controllers;

use App\Models\Adopcion;
use App\Models\Mascota;
use App\Models\Persona;
use Illuminate\Http\Request;

class AdopcionController extends Controller
{
    public function index()
    {
        $adopciones = Adopcion::with(['persona', 'mascota'])->get();
        return view('adopciones.index', compact('adopciones'));
    }

    public function create()
    {
        $personas = Persona::all();
        $mascotas = Mascota::where('estado', 'Disponible')->get();
        return view('adopciones.nuevaadopcion', compact('personas', 'mascotas'));
    }

    public function adopvisi($id)
    {
        $mascota = Mascota::findOrFail($id);
        return view('adopciones.adopvisi', compact('mascota'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mascota_id' => 'required|exists:mascotas,id',
            'persona_id' => 'nullable|exists:personas,id',
            'fecha_adopcion' => 'nullable|date',
            'lugar_adopcion' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string',
            'contrato' => 'nullable|mimes:pdf|max:2048',
            'origen' => 'nullable|string',
            'nombre' => 'nullable|string|max:255',
            'correo' => 'nullable|email|max:255',
            'telefono' => 'nullable|string|max:20',
            'motivo' => 'nullable|string|max:500',
        ]);

        // 🧡 Si proviene del formulario visitante
        if ($request->input('origen') === 'visitante') {
            return redirect('/')
                ->with('success', 'Tu solicitud de adopción fue enviada correctamente. Nos pondremos en contacto contigo pronto.');
        }
        $data = $request->only([
            'persona_id', 'mascota_id', 'fecha_adopcion', 'lugar_adopcion', 'observaciones'
        ]);

        if ($request->hasFile('contrato')) {
            $file = $request->file('contrato');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('contratos'), $filename);
            $data['contrato'] = 'contratos/' . $filename;
        }

        $adopcion = Adopcion::create($data);
        $adopcion->mascota->update(['estado' => 'Adoptado']);

        return redirect()->route('adopciones.index')->with('success', 'Adopción registrada correctamente.');
    }

    public function edit($id)
    {
        $adopcion = Adopcion::findOrFail($id);
        $personas = Persona::all();
        $mascotas = Mascota::all();
        return view('adopciones.editaradopcion', compact('adopcion', 'personas', 'mascotas'));
    }

    public function update(Request $request, $id)
    {
        $adopcion = Adopcion::findOrFail($id);

        $request->validate([
            'persona_id' => 'required|exists:personas,id',
            'mascota_id' => 'required|exists:mascotas,id',
            'fecha_adopcion' => 'required|date',
            'lugar_adopcion' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string',
            'contrato' => 'nullable|mimes:pdf|max:2048',
        ]);

        $data = $request->only([
            'persona_id', 'mascota_id', 'fecha_adopcion', 'lugar_adopcion', 'observaciones'
        ]);

        if ($request->hasFile('contrato')) {
            if ($adopcion->contrato && file_exists(public_path($adopcion->contrato))) {
                unlink(public_path($adopcion->contrato));
            }

            $file = $request->file('contrato');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('contratos'), $filename);
            $data['contrato'] = 'contratos/' . $filename;
        }

        $adopcion->update($data);

        return redirect()->route('adopciones.index')->with('success', 'Adopción actualizada correctamente.');
    }

    public function destroy($id)
    {
        $adopcion = Adopcion::findOrFail($id);

        if ($adopcion->contrato && file_exists(public_path($adopcion->contrato))) {
            unlink(public_path($adopcion->contrato));
        }

        if ($adopcion->mascota) {
            $adopcion->mascota->update(['estado' => 'Disponible']);
        }

        $adopcion->delete();

        return redirect()->route('adopciones.index')->with('success', 'Adopción eliminada correctamente y mascota disponible.');
    }
}
