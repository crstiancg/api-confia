<?php

namespace Database\Seeders;

use App\Models\Anuncio;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class AnuncioSeeder extends Seeder
{
    public function run(): void
    {
        $anuncios = [
            ['titulo' => 'Inicio del ciclo lectivo', 'mensaje' => 'Les damos la bienvenida al nuevo ciclo lectivo. Las clases comienzan el lunes 2 de marzo.', 'grado' => 'todos', 'autor' => 'Administración', 'dias' => 15],
            ['titulo' => 'Reunión de padres 5to A', 'mensaje' => 'Se convoca a los padres de 5to A a la reunión informativa del viernes a las 18hs en el salón de actos.', 'grado' => '5to A', 'autor' => 'Dirección', 'dias' => 5],
            ['titulo' => 'Semana de exámenes finales', 'mensaje' => 'Recordamos que la semana del 20 al 24 se realizarán los exámenes finales del trimestre.', 'grado' => 'todos', 'autor' => 'Administración', 'dias' => 3],
            ['titulo' => 'Jornada de bienestar emocional', 'mensaje' => 'El equipo de orientación invita a todos los alumnos a la jornada de bienestar emocional este jueves.', 'grado' => 'todos', 'autor' => 'Equipo de Orientación', 'dias' => 1],
            ['titulo' => 'Torneo intercolegial de vóley', 'mensaje' => 'Se realizará la inscripción para el torneo intercolegial de vóley. Consultar con el profesor de educación física.', 'grado' => '6to A', 'autor' => 'Educación Física', 'dias' => 0],
        ];

        foreach ($anuncios as $anuncio) {
            if (Anuncio::where('titulo', $anuncio['titulo'])->exists()) {
                continue;
            }

            Anuncio::forceCreate([
                'id' => (string) Str::uuid(),
                'titulo' => $anuncio['titulo'],
                'mensaje' => $anuncio['mensaje'],
                'grado' => $anuncio['grado'],
                'autor' => $anuncio['autor'],
                'fecha' => Carbon::now()->subDays($anuncio['dias']),
            ]);
        }
    }
}
