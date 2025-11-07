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

        $adopcionesAprobadas = Adopcion::where('estado', 'Aprobada')->count();
        $adopcionesRechazadas = Adopcion::where('estado', 'Rechazada')->count();

        $adopcionesPorEspecie = Mascota::select('especie', DB::raw('count(*) as total'))
            ->join('adopcions', 'adopcions.mascota_id', '=', 'mascotas.id')
            ->where('adopcions.estado', 'Aprobada')
            ->groupBy('especie')
            ->get();

        $adopcionesPorMes = Adopcion::selectRaw('EXTRACT(MONTH FROM fecha_adopcion) as mes, COUNT(*) as total')
            ->whereNotNull('fecha_adopcion')
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        $labelsMeses = [];
        $valoresMeses = [];

        foreach ($adopcionesPorMes as $dato) {
            $indice = intval($dato->mes) - 1;
            if (isset($meses[$indice])) {
                $labelsMeses[] = $meses[$indice];
                $valoresMeses[] = $dato->total;
            }
        }

        $especies = $adopcionesPorEspecie->pluck('total', 'especie');

        return view('dashboard.das', compact(
            'totalMascotas',
            'totalPersonas',
            'totalAdopciones',
            'especies',
            'labelsMeses',
            'valoresMeses',
            'adopcionesAprobadas',
            'adopcionesRechazadas'
        ));
    }
}
