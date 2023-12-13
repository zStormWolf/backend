<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function login(Request $request)
    {
        try {
            $credentials = $request->only('username', 'password');
    
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken('auth_token')->plainTextToken;
    
                Log::info('Inicio de sesión exitoso para el usuario: ' . $user->username);
    
                return response()->json([
                    'message' => 'Inicio de sesión exitoso',
                    'token' => $token,
                    'user' => collect($user)->except('password'),
                ]);
            }
    
            Log::warning('Intento de inicio de sesión fallido para el usuario: ' . $credentials['username']);
    
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        } catch (\Exception $e) {
            Log::error('Error en el servidor: ' . $e->getMessage());
    
            return response()->json(['message' => 'Error en el servidor: ' . $e->getMessage()], 500);
        }
    }
    
    
    
    
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
