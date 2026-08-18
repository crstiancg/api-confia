<?php

namespace Database\Seeders;

use App\Models\Denuncia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DenunciaSeeder extends Seeder
{
    public function run(): void
    {
        if (Denuncia::count() > 0) {
            return;
        }

        $denuncias = [
            ['grado' => '5to A', 'tipo' => 'Acoso escolar', 'descripcion' => 'Un grupo de compañeros molesta reiteradamente a un alumno durante el recreo.', 'estado' => 'pendiente', 'dias' => 1],
            ['grado' => '4to B', 'tipo' => 'Discriminación', 'descripcion' => 'Se reportaron comentarios discriminatorios hacia un alumno por su nacionalidad.', 'estado' => 'en_revision', 'dias' => 3],
            ['grado' => '3ro A', 'tipo' => 'Daño a instalaciones', 'descripcion' => 'Se encontraron bancos rotos en el aula, posible vandalismo.', 'estado' => 'atendida', 'dias' => 10],
            ['grado' => '6to A', 'tipo' => 'Acoso escolar', 'descripcion' => 'Situación de bullying reiterada hacia una alumna en redes sociales.', 'estado' => 'pendiente', 'dias' => 0],
            ['grado' => '5to B', 'tipo' => 'Conflicto entre alumnos', 'descripcion' => 'Pelea física entre dos alumnos durante la hora de educación física.', 'estado' => 'en_revision', 'dias' => 2],
            ['grado' => '4to A', 'tipo' => 'Robo', 'descripcion' => 'Desaparición de pertenencias del casillero de un alumno.', 'estado' => 'atendida', 'dias' => 15],
            ['grado' => '6to B', 'tipo' => 'Uso indebido de celular', 'descripcion' => 'Difusión de fotos sin consentimiento a través de un grupo de chat.', 'estado' => 'pendiente', 'dias' => 0],
            ['grado' => '3ro A', 'tipo' => 'Acoso escolar', 'descripcion' => 'Exclusión sistemática de un alumno en actividades grupales.', 'estado' => 'en_revision', 'dias' => 5],
        ];

        foreach ($denuncias as $denuncia) {
            Denuncia::forceCreate([
                'grado' => $denuncia['grado'],
                'tipo' => $denuncia['tipo'],
                'descripcion' => $denuncia['descripcion'],
                'estado' => $denuncia['estado'],
                'fecha' => Carbon::now()->subDays($denuncia['dias']),
            ]);
        }
    }
}
