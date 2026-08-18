<?php

namespace App\Http\Controllers;

use App\Models\RegistroEmocional;
use Illuminate\Http\Request;

class RegistroEmocionalController extends Controller
{
    public function index(Request $request)
    {
        $query = RegistroEmocional::orderByDesc('fecha');

        if ($request->filled('correo')) {
            $query->where('correo', $request->query('correo'));
        }

        return $query->paginate(20);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'correo' => 'required|email|max:191',
            'grado' => 'nullable|string|max:100',
            'emocion' => 'required|string|max:50',
            'intensidad' => 'nullable|integer|min:0|max:10',
            'factores' => 'nullable|array',
            'comentario' => 'nullable|string',
        ]);

        return response()->json(RegistroEmocional::create($data), 201);
    }

    public function show(RegistroEmocional $registroEmocional)
    {
        return $registroEmocional;
    }

    public function update(Request $request, RegistroEmocional $registroEmocional)
    {
        $data = $request->validate([
            'correo' => 'sometimes|email|max:191',
            'grado' => 'nullable|string|max:100',
            'emocion' => 'sometimes|string|max:50',
            'intensidad' => 'nullable|integer|min:0|max:10',
            'factores' => 'nullable|array',
            'comentario' => 'nullable|string',
        ]);

        $registroEmocional->update($data);

        return $registroEmocional;
    }

    public function destroy(RegistroEmocional $registroEmocional)
    {
        $registroEmocional->delete();

        return response()->noContent();
    }
}
