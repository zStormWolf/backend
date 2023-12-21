<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tariff;
class TarifaController extends Controller
{
    public function index()
    {
        try {
            $tariffs = Tariff::all();
            return response()->json($tariffs, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error en el servidor'], 500);
        }
    }

    public function show($id)
    {
        try {

            $tarifa = Tariff::findOrFail($id);


            return response()->json([$tarifa], 200);
        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Tarifa no encontrada'], 404);
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

        $existingColor = Tariff::where('color', $data['color'])->first();
        if ($existingColor) {
            return response()->json(['message' => 'El color ya está registrado'], 422);
        }



        $tarifa = Tariff::create($data);


            return response()->json(['message' => 'Tarifa creado exitosamente'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error en el servidor'], 500);
        }
    }

    public function edit($id)
    {
        // No necesitas una vista para la edición
    }

    public function update(Request $request,string $id)
    {
       try {

        $data = $request->all();

        $tarifa = Tariff::findOrFail($id);

            $tarifa->update($data);


            return response()->json(['message' => 'Tarifa actualizado exitosamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error en el servidor'], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $tarifa = Tariff::findOrFail($id);

            $tarifa->delete();


            return response()->json(['message' => 'Tarifa eliminado exitosamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error en el servidor'], 500);
        }
    }
}
