<?php

namespace App\Http\Controllers;

use App\Models\AgendaEvento;
use Illuminate\Http\Request;

class AgendaEventoController extends Controller
{
    public function index(Request $request)
    {
        $query = AgendaEvento::orderBy('fecha_evento');

        if ($request->filled('correo')) {
            $query->where('correo', $request->query('correo'));
        }

        if ($request->boolean('paginate')) {
            return $query->paginate(20);
        }

        return response()->json([
            'ok' => true,
            'datos' => $query->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'correo' => 'required|email|max:191',
            'fecha_evento' => 'required|date',
            'titulo' => 'required|string|max:255',
        ]);

        $evento = AgendaEvento::create($data);

        return response()->json([
            'ok' => true,
            'id' => $evento->id,
            'datos' => $evento,
        ], 201);
    }

    public function show(AgendaEvento $agendaEvento)
    {
        return $agendaEvento;
    }

    public function update(Request $request, AgendaEvento $agendaEvento)
    {
        $data = $request->validate([
            'correo' => 'sometimes|email|max:191',
            'fecha_evento' => 'sometimes|date',
            'titulo' => 'sometimes|string|max:255',
        ]);

        $agendaEvento->update($data);

        return $agendaEvento;
    }

    public function destroy(AgendaEvento $agendaEvento)
    {
        $agendaEvento->delete();

        return response()->noContent();
    }
}
