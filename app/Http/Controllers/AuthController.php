<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;
class AuthController extends Controller
{
     public function __construct()
     {
         $this->middleware('auth:sanctum', ['except' => ['login','register'] ]);
     }
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
            $user = User::where('username', $credentials['username'])->first();
            if (!$user) {
                // El usuario no existe en la base de datos
                return response()->json(['message' => 'El usuario no existe'], 404);
            }
            if ($user && Hash::check($credentials['password'] . $user->salt, $user->hash)) {
                $token = $user->createToken('auth_token')->plainTextToken;

                Log::info('Inicio de sesión exitoso para el usuario: ' . $user->username);

                $user = User::with('role', 'tariff')->find($user->id);

                return response()->json([
                    'token' => $token,
                    // 'user' => collect($user)->only([
                        'user' => [
                            'id' => $user->id,
                            'name' => $user->name,
                            'email' => $user->email,
                            'cedula' => $user->cedula,
                            'username' => $user->username,
                            'country' => $user->country,
                            'city' => $user->city,
                            'address' => $user->address,
                            'office' => $user->office,
                            'tel' => $user->tel,
                            'dateofbirth' => $user->dateofbirth,
                            'status' => $user->status,
                        // 'role',
                        // 'tariff'
                        'role' => [
                            'id' => $user->role->id,
                            'level' => $user->role->level,
                            'name' => $user->role->name,
                        ],
                        'tariff' => [
                            'id' => $user->tariff->id,
                            'name' => $user->tariff->name,
                            'color' => $user->tariff->color,
                        ],
                    ],
                ]);
            }

            Log::warning('Intento de inicio de sesión fallido para el usuario: ' . $credentials['username']);

            return response()->json(['message' => 'Contreaseña incorrecta'], 401);

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
