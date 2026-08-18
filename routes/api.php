<?php

use App\Http\Controllers\AgendaEventoController;
use App\Http\Controllers\AlertaRiesgoController;
use App\Http\Controllers\AnuncioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DenunciaController;
use App\Http\Controllers\RegistroEmocionalController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/health', fn () => response()->json(['ok' => true, 'servicio' => 'CONFIA API']));

Route::middleware('auth:api')->get('/user', function (Request $request) {
    $user = $request->user();

    return [
        'user' => $user->only(['id', 'name', 'email']),
        'roles' => $user->getRoleNames(),
        'permissions' => $user->getAllPermissions()->pluck('name'),
    ];
});

Route::get('/dashboard/kpis', [DashboardController::class, 'kpis']);

Route::apiResource('usuarios', UsuarioController::class);
Route::apiResource('denuncias', DenunciaController::class);
Route::apiResource('registros-emocionales', RegistroEmocionalController::class)
    ->parameters(['registros-emocionales' => 'registroEmocional']);
Route::apiResource('alertas-riesgo', AlertaRiesgoController::class)
    ->parameters(['alertas-riesgo' => 'alertaRiesgo']);
Route::apiResource('anuncios', AnuncioController::class);
Route::apiResource('agenda-eventos', AgendaEventoController::class)
    ->parameters(['agenda-eventos' => 'agendaEvento']);
