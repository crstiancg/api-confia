<?php

namespace Database\Seeders;

use App\Models\AgendaEvento;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AgendaEventoSeeder extends Seeder
{
    public function run(): void
    {
        if (AgendaEvento::count() > 0) {
            return;
        }

        $eventos = [
            ['correo' => 'valentina.rojas@alumnos.confia.edu', 'titulo' => 'Entrega de trabajo práctico de Historia', 'dias' => 2],
            ['correo' => 'valentina.rojas@alumnos.confia.edu', 'titulo' => 'Examen de Matemática', 'dias' => 5],
            ['correo' => 'mateo.gonzalez@alumnos.confia.edu', 'titulo' => 'Salida educativa al museo', 'dias' => 7],
            ['correo' => 'sofia.martinez@alumnos.confia.edu', 'titulo' => 'Entrevista con orientadora escolar', 'dias' => 1],
            ['correo' => 'lucas.fernandez@alumnos.confia.edu', 'titulo' => 'Presentación oral de Biología', 'dias' => 3],
            ['correo' => 'martina.lopez@alumnos.confia.edu', 'titulo' => 'Torneo de ajedrez', 'dias' => 10],
            ['correo' => 'catalina.perez@alumnos.confia.edu', 'titulo' => 'Entrega de boletín de calificaciones', 'dias' => 14],
            ['correo' => 'emma.ramirez@alumnos.confia.edu', 'titulo' => 'Reunión de orientación vocacional', 'dias' => 6],
        ];

        foreach ($eventos as $evento) {
            AgendaEvento::forceCreate([
                'correo' => $evento['correo'],
                'fecha_evento' => Carbon::now()->addDays($evento['dias'])->toDateString(),
                'titulo' => $evento['titulo'],
                'fecha_creacion' => Carbon::now()->subDays(1),
            ]);
        }
    }
}
