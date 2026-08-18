<?php

namespace Database\Seeders;

use App\Models\AlertaRiesgo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AlertaRiesgoSeeder extends Seeder
{
    public function run(): void
    {
        if (AlertaRiesgo::count() > 0) {
            return;
        }

        $alertas = [
            ['correo' => 'benjamin.diaz@alumnos.confia.edu', 'grado' => '4to B', 'extracto' => 'No aguanto más la presión, siento que nada de lo que hago está bien...', 'atendido' => false, 'dias' => 2],
            ['correo' => 'lucas.fernandez@alumnos.confia.edu', 'grado' => '4to A', 'extracto' => 'En casa todo es un desastre, a veces prefiero no volver.', 'atendido' => false, 'dias' => 1],
            ['correo' => 'sofia.martinez@alumnos.confia.edu', 'grado' => '5to B', 'extracto' => 'Últimamente no tengo ganas de hacer nada, ni de ver a mis amigos.', 'atendido' => true, 'dias' => 12],
            ['correo' => 'thiago.sanchez@alumnos.confia.edu', 'grado' => '3ro A', 'extracto' => 'Perdí a mi mejor amigo y siento que estoy solo en todo esto.', 'atendido' => true, 'dias' => 20],
            ['correo' => 'emma.ramirez@alumnos.confia.edu', 'grado' => '6to A', 'extracto' => 'Cada vez me cuesta más levantarme y venir al colegio.', 'atendido' => false, 'dias' => 0],
        ];

        foreach ($alertas as $alerta) {
            AlertaRiesgo::forceCreate([
                'correo' => $alerta['correo'],
                'grado' => $alerta['grado'],
                'extracto' => $alerta['extracto'],
                'atendido' => $alerta['atendido'],
                'fecha' => Carbon::now()->subDays($alerta['dias']),
            ]);
        }
    }
}
