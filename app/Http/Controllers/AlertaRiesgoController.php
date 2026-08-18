<?php

namespace App\Http\Controllers;

use App\Models\AlertaRiesgo;
use Illuminate\Http\Request;

class AlertaRiesgoController extends Controller
{
    public function index(Request $request)
    {
        $query = AlertaRiesgo::orderByDesc('fecha');

        if ($request->filled('atendido')) {
            $query->where('atendido', $request->boolean('atendido'));
        }

        return $query->paginate(20);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'correo' => 'required|email|max:191',
            'grado' => 'nullable|string|max:100',
            'extracto' => 'required|string',
            'atendido' => 'nullable|boolean',
        ]);

        return response()->json(AlertaRiesgo::create($data), 201);
    }

    public function show(AlertaRiesgo $alertaRiesgo)
    {
        return $alertaRiesgo;
    }

    public function update(Request $request, AlertaRiesgo $alertaRiesgo)
    {
        $data = $request->validate([
            'correo' => 'sometimes|email|max:191',
            'grado' => 'nullable|string|max:100',
            'extracto' => 'sometimes|string',
            'atendido' => 'nullable|boolean',
        ]);

        $alertaRiesgo->update($data);

        return $alertaRiesgo;
    }

    public function destroy(AlertaRiesgo $alertaRiesgo)
    {
        $alertaRiesgo->delete();

        return response()->noContent();
    }
}
