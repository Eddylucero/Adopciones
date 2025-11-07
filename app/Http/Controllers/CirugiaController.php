<?php

namespace App\Http\Controllers;

use App\Models\Cirugia;
use App\Models\Mascota;
use Illuminate\Http\Request;

class CirugiaController extends Controller
{
    public function index()
    {
        $cirugias = Cirugia::with('mascota')->orderBy('fecha_cirugia', 'desc')->get();
        return view('cirugias.index', compact('cirugias'));
    }

    public function create()
    {
        $mascotasConCirugia = Cirugia::pluck('mascota_id')->toArray();

        $mascotas = Mascota::whereIn('estado', ['Disponible', 'Adoptado'])
            ->whereNotIn('id', $mascotasConCirugia)
            ->get();

        return view('cirugias.nuevacirugia', compact('mascotas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mascota_id' => 'required|exists:mascotas,id',
            'fecha_cirugia' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $fecha = strtotime($value);
                    $hoy = strtotime(date('Y-m-d'));
                    $inicioMes = strtotime(date('Y-m-01'));
                    $finMes = strtotime(date('Y-m-t'));
                    if ($fecha < $inicioMes || $fecha > $hoy) {
                        $fail('La fecha debe ser hoy o anterior, pero dentro del mes actual.');
                    }
                },
            ],
            'duracion' => 'nullable|string|max:50',
            'motivo' => 'nullable|string|max:1000',
            'estado' => 'nullable|string|in:Programada,Realizada,Cancelada',
        ]);

        Cirugia::create([
            'mascota_id' => $request->mascota_id,
            'fecha_cirugia' => $request->fecha_cirugia,
            'duracion' => $request->duracion,
            'motivo' => $request->motivo,
            'estado' => $request->estado ?? 'Programada',
        ]);

        return redirect()->route('cirugias.index')->with('success', 'Cirugía registrada correctamente.');
    }

    public function edit($id)
    {
        $cirugia = Cirugia::findOrFail($id);
        $mascotas = Mascota::whereIn('estado', ['Disponible', 'Adoptado'])->get();
        return view('cirugias.editarcirugia', compact('cirugia', 'mascotas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'mascota_id' => 'required|exists:mascotas,id',
            'fecha_cirugia' => 'required|date',
            'duracion' => 'nullable|string|max:50',
            'motivo' => 'nullable|string|max:1000',
            'estado' => 'nullable|string|in:Programada,Realizada,Cancelada',
        ]);

        $cirugia = Cirugia::findOrFail($id);
        $cirugia->update($request->all());

        return redirect()->route('cirugias.index')->with('success', 'Cirugía actualizada correctamente.');
    }

    public function destroy($id)
    {
        $cirugia = Cirugia::findOrFail($id);
        $cirugia->delete();

        return redirect()->route('cirugias.index')->with('success', 'Cirugía eliminada correctamente.');
    }
}
