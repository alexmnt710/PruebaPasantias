<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        // Check if the email already exists
        if (User::where('email', $request->email)->exists()) {
            return response()->json(['success' => false, 'message' => 'El email ya está registrado'], 400);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['success' => true, 'message' => 'Usuario registrado'], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['success' => false ,'message' => 'Credenciales inválidas'], 401);
        }

        // Generar un token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Inicio de sesión exitoso',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
            'success' => true,
        ], 200);
    }
    public function checkSession(Request $request)
    {
        $user = $request->user(); // Obtiene el usuario autenticado
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'No autenticado'], 401);
        }

        return response()->json([
            'success' => true,
            'message' => 'Sesión válida',
            'user' => $user, // Puedes devolver información del usuario si lo necesitas
        ]);
    }

    public function logout(Request $request)
    {
        // Revoca todos los tokens del usuario
        $request->user()->tokens()->delete();

        return response()->json(['success' => true, 'message' => 'Cierre de sesión exitoso']);
    }

}
