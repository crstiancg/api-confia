<?php

namespace App\Http\Controllers;

use App\Models\Denuncia;
use Illuminate\Http\Request;

class DenunciaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->boolean('paginate')) {
            return Denuncia::orderByDesc('fecha')->paginate(20);
        }

        return response()->json([
            'ok' => true,
            'datos' => Denuncia::orderByDesc('fecha')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'grado' => 'required|string|max:100',
            'tipo' => 'required|string|max:100',
            'descripcion' => 'required|string',
            'estado' => 'nullable|in:pendiente,en_revision,atendida',
        ]);

        $denuncia = Denuncia::create($data);

        return response()->json([
            'ok' => true,
            'id' => $denuncia->id,
            'datos' => $denuncia,
        ], 201);
    }

    public function show(Denuncia $denuncia)
    {
        return $denuncia;
    }

    public function update(Request $request, Denuncia $denuncia)
    {
        $data = $request->validate([
            'grado' => 'sometimes|string|max:100',
            'tipo' => 'sometimes|string|max:100',
            'descripcion' => 'sometimes|string',
            'estado' => 'nullable|in:pendiente,en_revision,atendida',
        ]);

        $denuncia->update($data);

        return $denuncia;
    }

    public function destroy(Denuncia $denuncia)
    {
        $denuncia->delete();

        return response()->noContent();
    }
}
