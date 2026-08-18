<?php

namespace Database\Seeders;

use App\Models\RegistroEmocional;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class RegistroEmocionalSeeder extends Seeder
{
    public function run(): void
    {
        if (RegistroEmocional::count() > 0) {
            return;
        }

        $registros = [
            ['correo' => 'valentina.rojas@alumnos.confia.edu', 'grado' => '5to A', 'emocion' => 'Alegría', 'intensidad' => 8, 'comentario' => 'Me fue muy bien en el examen de matemática.', 'dias' => 0],
            ['correo' => 'mateo.gonzalez@alumnos.confia.edu', 'grado' => '5to A', 'emocion' => 'Ansiedad', 'intensidad' => 6, 'comentario' => 'Tengo mucha carga de tareas esta semana.', 'dias' => 0],
            ['correo' => 'sofia.martinez@alumnos.confia.edu', 'grado' => '5to B', 'emocion' => 'Tristeza', 'intensidad' => 7, 'comentario' => 'Extraño mucho a mi familia que vive lejos.', 'dias' => 1],
            ['correo' => 'lucas.fernandez@alumnos.confia.edu', 'grado' => '4to A', 'emocion' => 'Enojo', 'intensidad' => 5, 'comentario' => null, 'dias' => 1],
            ['correo' => 'martina.lopez@alumnos.confia.edu', 'grado' => '4to A', 'emocion' => 'Calma', 'intensidad' => 3, 'comentario' => 'Buen día en general.', 'dias' => 2],
            ['correo' => 'benjamin.diaz@alumnos.confia.edu', 'grado' => '4to B', 'emocion' => 'Ansiedad', 'intensidad' => 9, 'comentario' => 'Mañana rindo un examen importante y no me siento preparado.', 'dias' => 2],
            ['correo' => 'catalina.perez@alumnos.confia.edu', 'grado' => '3ro A', 'emocion' => 'Alegría', 'intensidad' => 9, 'comentario' => 'Gané el torneo de vóley del colegio.', 'dias' => 3],
            ['correo' => 'thiago.sanchez@alumnos.confia.edu', 'grado' => '3ro A', 'emocion' => 'Tristeza', 'intensidad' => 8, 'comentario' => 'Discutí con mi mejor amigo.', 'dias' => 3],
            ['correo' => 'emma.ramirez@alumnos.confia.edu', 'grado' => '6to A', 'emocion' => 'Miedo', 'intensidad' => 6, 'comentario' => 'Me da nervios la exposición oral de la próxima semana.', 'dias' => 4],
            ['correo' => 'santiago.torres@alumnos.confia.edu', 'grado' => '6to B', 'emocion' => 'Calma', 'intensidad' => 4, 'comentario' => null, 'dias' => 4],
            ['correo' => 'valentina.rojas@alumnos.confia.edu', 'grado' => '5to A', 'emocion' => 'Enojo', 'intensidad' => 7, 'comentario' => 'Me peleé con un compañero por un malentendido.', 'dias' => 5],
            ['correo' => 'mateo.gonzalez@alumnos.confia.edu', 'grado' => '5to A', 'emocion' => 'Alegría', 'intensidad' => 6, 'comentario' => 'Salida con amigos el fin de semana.', 'dias' => 6],
            ['correo' => 'sofia.martinez@alumnos.confia.edu', 'grado' => '5to B', 'emocion' => 'Ansiedad', 'intensidad' => 8, 'comentario' => 'Presión por las notas finales del trimestre.', 'dias' => 7],
            ['correo' => 'lucas.fernandez@alumnos.confia.edu', 'grado' => '4to A', 'emocion' => 'Tristeza', 'intensidad' => 9, 'comentario' => 'Mis papás están discutiendo mucho últimamente.', 'dias' => 8],
            ['correo' => 'martina.lopez@alumnos.confia.edu', 'grado' => '4to A', 'emocion' => 'Alegría', 'intensidad' => 7, 'comentario' => 'Me eligieron para el equipo de ciencias.', 'dias' => 9],
        ];

        foreach ($registros as $registro) {
            RegistroEmocional::forceCreate([
                'correo' => $registro['correo'],
                'grado' => $registro['grado'],
                'emocion' => $registro['emocion'],
                'intensidad' => $registro['intensidad'],
                'comentario' => $registro['comentario'],
                'fecha' => Carbon::now()->subDays($registro['dias']),
            ]);
        }
    }
}
