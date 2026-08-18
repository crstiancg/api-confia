<?php

namespace App\Http\Controllers;

use App\Models\AgendaEvento;
use App\Models\AlertaRiesgo;
use App\Models\Anuncio;
use App\Models\Denuncia;
use App\Models\RegistroEmocional;
use App\Models\Usuario;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function kpis()
    {
        $sieteDiasAtras = Carbon::now()->subDays(7);
        $hoy = Carbon::today();
        $enSieteDias = Carbon::today()->addDays(7);

        return [
            'usuarios' => [
                'total' => Usuario::count(),
                'por_grado' => Usuario::selectRaw('grado, count(*) as total')
                    ->groupBy('grado')
                    ->orderByDesc('total')
                    ->get(),
            ],
            'denuncias' => [
                'total' => Denuncia::count(),
                'ultimos_7_dias' => Denuncia::where('fecha', '>=', $sieteDiasAtras)->count(),
                'por_estado' => [
                    'pendiente' => Denuncia::where('estado', 'pendiente')->count(),
                    'en_revision' => Denuncia::where('estado', 'en_revision')->count(),
                    'atendida' => Denuncia::where('estado', 'atendida')->count(),
                ],
            ],
            'registros_emocionales' => [
                'total' => RegistroEmocional::count(),
                'ultimos_7_dias' => RegistroEmocional::where('fecha', '>=', $sieteDiasAtras)->count(),
                'promedio_intensidad' => round((float) RegistroEmocional::avg('intensidad'), 1),
                'por_emocion' => RegistroEmocional::selectRaw('emocion, count(*) as total')
                    ->groupBy('emocion')
                    ->orderByDesc('total')
                    ->get(),
            ],
            'alertas_riesgo' => [
                'total' => AlertaRiesgo::count(),
                'sin_atender' => AlertaRiesgo::where('atendido', false)->count(),
                'atendidas' => AlertaRiesgo::where('atendido', true)->count(),
                'ultimos_7_dias' => AlertaRiesgo::where('fecha', '>=', $sieteDiasAtras)->count(),
            ],
            'anuncios' => [
                'total' => Anuncio::count(),
                'ultimos_7_dias' => Anuncio::where('fecha', '>=', $sieteDiasAtras)->count(),
            ],
            'agenda_eventos' => [
                'total' => AgendaEvento::count(),
                'proximos_7_dias' => AgendaEvento::whereBetween('fecha_evento', [$hoy, $enSieteDias])->count(),
            ],
        ];
    }
}
