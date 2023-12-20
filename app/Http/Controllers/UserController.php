<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        try {
            $users = User::all();
            return response()->json($users, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error en el servidor']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    try {
        // Obtener los datos de la solicitud
        $data = $request->all();


        // Verificar si el email ya existe en la base de datos
        $existingEmail = User::where('email', $data['email'])->first();
        if ($existingEmail) {
            return response()->json(['message' => 'El correo electrónico ya está registrado'], 422);
        }

        // Verificar si la cedula ya existe en la base de datos
        $existingCedula = User::where('cedula', $data['cedula'])->first();
        if ($existingCedula) {
            return response()->json(['message' => 'La cédula ya está registrada'], 422);
        }

        // Verificar si el username ya existe en la base de datos
        $existingUsername = User::where('username', $data['username'])->first();
        if ($existingUsername) {
            return response()->json(['message' => 'El nombre de usuario ya está registrado'], 422);
        }

        $salt = bin2hex(random_bytes(16));

        // Combinar la contraseña del formulario con el salt y cifrarla
        $hashedPassword = Hash::make($data['password'] . $salt);

        // Almacenar el hash cifrado en el array de datos
        $data['hash'] = $hashedPassword;

        // Almacenar el salt en el array de datos
        $data['salt'] = $salt;

        // Crear el usuario con los datos proporcionados
        $user = User::create($data);

        return response()->json(['message' => 'Usuario creado exitosamente'], 201);
    } catch (QueryException $e) {
        return response()->json(500);
    } catch (\Exception $e) {
        // Manejar cualquier excepción que pueda ocurrir
        return response()->json(['message' => 'Error en el servidor: '], 500);
    }
}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            // Buscar el usuario por su ID
            $user = User::findOrFail($id);

            // Retornar la información del usuario
            return response()->json([
                'message' => 'Inicio de sesión exitoso',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'country' => $user->country,
                    'city' => $user->city,
                    'address' => $user->address,
                    'office' => $user->office,
                    'tel' => $user->tel,
                    'dateofbirth' => $user->dateofbirth,
                    'role' => $user->role,
                    'tariff' => $user->tariff,
                ],
            ], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error en el servidor'], 500);
        }
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
        try {
            // Obtener los datos de la solicitud
            $data = $request->all();

            $user = User::findOrFail($id);
            if ($data['email'] !== $user->email) {
                $existingEmail = User::where('email', $data['email'])->first();
                if ($existingEmail) {
                    return response()->json(['message' => 'El correo electrónico ya está registrado'], 422);
                }
            }

            if ($data['cedula'] !== $user->cedula) {
                $existingCedula = User::where('cedula', $data['cedula'])->first();
                if ($existingCedula) {
                    return response()->json(['message' => 'La cédula ya está registrada'], 422);
                }
            }

            if ($data['username'] !== $user->username) {
                $existingUsername = User::where('username', $data['username'])->first();
                if ($existingUsername) {
                    return response()->json(['message' => 'El nombre de usuario ya está registrado'], 422);
                }
            }

            $salt = bin2hex(random_bytes(16));

            $hashedPassword = Hash::make($data['password'] . $salt);

            $data['hash'] = $hashedPassword;

            $data['salt'] = $salt;

            $user->update($data);

            return response()->json(['message' => 'Usuario actualizado exitosamente']);
        } catch (\Exception $e) {
            // Manejar cualquier excepción que pueda ocurrir
            return response()->json(['message' => 'Error en el servidor: '], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);

            // Eliminar el usuario
            $user->delete();

            return response()->json(['message' => 'Usuario eliminado exitosamente']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error en el servidor: '], 500);
        }
    }
}
