<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AnuncioController extends Controller
{
    public function index()
    {
        return Anuncio::orderByDesc('fecha')->paginate(20);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'mensaje' => 'required|string',
            'grado' => 'nullable|string|max:100',
            'autor' => 'nullable|string|max:191',
        ]);

        $data['id'] = (string) Str::uuid();

        return response()->json(Anuncio::create($data), 201);
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
