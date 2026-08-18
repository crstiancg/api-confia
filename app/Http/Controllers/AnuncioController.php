<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AnuncioController extends Controller
{
    public function index(Request $request)
    {
        if ($request->boolean('paginate')) {
            return Anuncio::orderByDesc('fecha')->paginate(20);
        }

        return response()->json([
            'ok' => true,
            'datos' => Anuncio::orderByDesc('fecha')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id' => 'nullable|string|max:50',
            'titulo' => 'required|string|max:255',
            'mensaje' => 'required|string',
            'grado' => 'nullable|string|max:100',
            'autor' => 'nullable|string|max:191',
        ]);

        if (empty($data['id'])) {
            $data['id'] = (string) Str::uuid();
        }

        $anuncio = Anuncio::create($data);

        return response()->json([
            'ok' => true,
            'id' => $anuncio->id,
            'datos' => $anuncio,
        ], 201);
    }

    public function show(Anuncio $anuncio)
    {
        return $anuncio;
    }

    public function update(Request $request, Anuncio $anuncio)
    {
        $data = $request->validate([
            'titulo' => 'sometimes|string|max:255',
            'mensaje' => 'sometimes|string',
            'grado' => 'nullable|string|max:100',
            'autor' => 'nullable|string|max:191',
        ]);

        $anuncio->update($data);

        return $anuncio;
    }

    public function destroy(Anuncio $anuncio)
    {
        $anuncio->delete();

        return response()->noContent();
    }
}
