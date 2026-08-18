<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = [
            ['correo' => 'valentina.rojas@alumnos.confia.edu', 'grado' => '5to A', 'rol' => 'alumno'],
            ['correo' => 'mateo.gonzalez@alumnos.confia.edu', 'grado' => '5to A', 'rol' => 'alumno'],
            ['correo' => 'sofia.martinez@alumnos.confia.edu', 'grado' => '5to B', 'rol' => 'alumno'],
            ['correo' => 'lucas.fernandez@alumnos.confia.edu', 'grado' => '4to A', 'rol' => 'alumno'],
            ['correo' => 'martina.lopez@alumnos.confia.edu', 'grado' => '4to A', 'rol' => 'alumno'],
            ['correo' => 'benjamin.diaz@alumnos.confia.edu', 'grado' => '4to B', 'rol' => 'alumno'],
            ['correo' => 'catalina.perez@alumnos.confia.edu', 'grado' => '3ro A', 'rol' => 'alumno'],
            ['correo' => 'thiago.sanchez@alumnos.confia.edu', 'grado' => '3ro A', 'rol' => 'alumno'],
            ['correo' => 'emma.ramirez@alumnos.confia.edu', 'grado' => '6to A', 'rol' => 'alumno'],
            ['correo' => 'santiago.torres@alumnos.confia.edu', 'grado' => '6to B', 'rol' => 'alumno'],
            ['correo' => 'directora.andrea@confia.edu', 'grado' => 'No especificado', 'rol' => 'admin'],
        ];

        foreach ($usuarios as $usuario) {
            Usuario::updateOrCreate(['correo' => $usuario['correo']], $usuario);
        }
    }
}
