<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Inicio de sesión universal (Estudiantes en 'usuarios' y Administradores en 'users')
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|string',
        ]);

        $email = trim($request->input('email'));
        $password = $request->input('password');

        // 1. Verificar si es un Administrador (Tabla 'users')
        $admin = User::where('email', $email)->first();
        if ($admin && Hash::check($password, $admin->password)) {
            return response()->json([
                'ok' => true,
                'tipo' => 'admin',
                'user' => [
                    'id' => $admin->id,
                    'name' => $admin->name,
                    'email' => $admin->email,
                    'rol' => 'admin',
                ],
                'token' => 'admin-token-' . bin2hex(random_bytes(16)),
            ]);
        }

        // 2. Verificar si es un Estudiante (Tabla 'usuarios')
        $estudiante = Usuario::where('correo', $email)->first();
        if ($estudiante) {
            // Si tiene contraseña, verificar hash; si aún no tenía contraseña guardada, inicializarla
            if (!empty($estudiante->password)) {
                if (!Hash::check($password, $estudiante->password)) {
                    return response()->json([
                        'ok' => false,
                        'message' => 'Contraseña incorrecta para el estudiante.',
                    ], 401);
                }
            } else {
                $estudiante->password = Hash::make($password);
                $estudiante->save();
            }

            return response()->json([
                'ok' => true,
                'tipo' => 'alumno',
                'user' => [
                    'id' => $estudiante->id,
                    'email' => $estudiante->correo,
                    'grado' => $estudiante->grado,
                    'rol' => $estudiante->rol ?? 'alumno',
                ],
                'token' => 'student-token-' . bin2hex(random_bytes(16)),
            ]);
        }

        // Si no existe ni en users ni en usuarios
        return response()->json([
            'ok' => false,
            'message' => 'Credenciales inválidas. Usuario no encontrado.',
        ], 401);
    }

    /**
     * Registro de Estudiantes (Público general en tabla 'usuarios')
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|max:191',
            'password' => 'required|min:4',
            'grado' => 'nullable|string|max:100',
        ]);

        $email = trim($data['email']);
        $grado = $data['grado'] ?? 'No especificado';

        $estudiante = Usuario::where('correo', $email)->first();
        if ($estudiante) {
            $estudiante->password = Hash::make($data['password']);
            $estudiante->grado = $grado;
            $estudiante->save();
        } else {
            $estudiante = Usuario::create([
                'correo' => $email,
                'password' => Hash::make($data['password']),
                'grado' => $grado,
                'rol' => 'alumno',
            ]);
        }

        return response()->json([
            'ok' => true,
            'tipo' => 'alumno',
            'user' => [
                'id' => $estudiante->id,
                'email' => $estudiante->correo,
                'grado' => $estudiante->grado,
                'rol' => 'alumno',
            ],
            'token' => 'student-token-' . bin2hex(random_bytes(16)),
        ], 201);
    }

    /**
     * Registro de Administrador (Tabla 'users' mediante PIN institucional)
     */
    public function adminRegister(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|max:191',
            'password' => 'required|min:6',
            'codigo' => 'required|string',
        ]);

        if ($data['codigo'] !== '290709') {
            return response()->json([
                'ok' => false,
                'message' => 'El código de administrador no es correcto.',
            ], 403);
        }

        $admin = User::updateOrCreate(
            ['email' => trim($data['email'])],
            [
                'name' => explode('@', $data['email'])[0],
                'password' => Hash::make($data['password']),
            ]
        );

        return response()->json([
            'ok' => true,
            'tipo' => 'admin',
            'user' => [
                'id' => $admin->id,
                'name' => $admin->name,
                'email' => $admin->email,
                'rol' => 'admin',
            ],
            'token' => 'admin-token-' . bin2hex(random_bytes(16)),
        ], 201);
    }
}
