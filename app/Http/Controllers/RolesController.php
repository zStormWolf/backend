<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RolesController extends Controller
{
    public function index(){
        try {
            $roles = Role::all();
            return response()->json(['roles' => $roles], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error en el servidor'], 500);
        }
    }

    public function show($id){
        try {

            $Roles = Role::findOrFail($id);


            return response()->json([$Roles], 200);

        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Rol no encontrado'], 404);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Error en el servidor'], 500);
        }
    }

    public function store(Request $request)
    {
        try {

            $data = $request->all();

            $existingName = Tariff::where('name', $data['name'])->first();
            if ($existingName) {
                return response()->json(['message' => 'El nombre ya está registrada'], 422);
            }

            $role = Role::create($request->all());

            return response()->json(['message' => 'Rol creado exitosamente', 'role' => $role], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error en el servidor'], 500);
        }
    }

    public function update(Request $request, Role $role)
    {
        try {
            $request->validate([
                'name' => 'required',
                'level' => 'required',
            ]);

            $role->update($request->all());

            return response()->json(['message' => 'Rol actualizado exitosamente', 'role' => $role], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error en el servidor'], 500);
        }
    }

    public function destroy(Role $role)
    {
        try {
            $role->delete();

            return response()->json(['message' => 'Rol eliminado exitosamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error en el servidor'], 500);
        }
    }
}
