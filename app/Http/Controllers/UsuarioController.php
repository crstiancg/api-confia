<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        return Usuario::orderByDesc('fecha_registro')->paginate(20);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'correo' => 'required|email|max:191|unique:usuarios,correo',
            'grado' => 'nullable|string|max:100',
            'rol' => 'nullable|in:alumno,admin',
        ]);

        return response()->json(Usuario::create($data), 201);
    }

    public function show(Usuario $usuario)
    {
        return $usuario;
    }

    public function update(Request $request, Usuario $usuario)
    {
        $data = $request->validate([
            'correo' => 'sometimes|email|max:191|unique:usuarios,correo,' . $usuario->id,
            'grado' => 'nullable|string|max:100',
            'rol' => 'nullable|in:alumno,admin',
        ]);

        $usuario->update($data);

        return $usuario;
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();

        return response()->noContent();
    }
}
