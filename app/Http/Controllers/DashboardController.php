<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use App\Models\Persona;
use App\Models\Adopcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMascotas = Mascota::count();
        $totalPersonas = Persona::count();
        $totalAdopciones = Adopcion::count();

        $adopcionesPorEspecie = Mascota::select('especie', DB::raw('count(*) as total'))
            ->join('adopcions', 'adopcions.mascota_id', '=', 'mascotas.id')
            ->groupBy('especie')
            ->get();

        $adopcionesPorMes = Adopcion::select(
                DB::raw("EXTRACT(MONTH FROM fecha_adopcion) AS mes"),
                DB::raw('COUNT(*) AS total')
            )
            ->groupBy('mes')
            ->orderBy('mes', 'asc')
            ->get();

        $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

        $labelsMeses = [];
        $valoresMeses = [];

        foreach ($adopcionesPorMes as $dato) {
            $labelsMeses[] = $meses[$dato->mes - 1];
            $valoresMeses[] = $dato->total;
        }

        $especies = $adopcionesPorEspecie->pluck('total', 'especie');

        return view('dashboard.das', compact(
            'totalMascotas',
            'totalPersonas',
            'totalAdopciones',
            'especies',
            'labelsMeses',
            'valoresMeses'
        ));
    }
}
