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
            return response()->json(['tariffs' => $tariffs], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error en el servidor'], 500);
        }
    }

    public function show(Tariff $tariff)
    {
        try {
            return response()->json(['tariff' => $tariff], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error en el servidor'], 500);
        }
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'cost' => 'required',
                'color' => 'required',
            ]);

            $tariff = Tariff::create($request->all());

            return response()->json(['message' => 'Tarifa creado exitosamente', 'tariff' => $tariff], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error en el servidor'], 500);
        }
    }

    public function edit($id)
    {
        // No necesitas una vista para la edición
    }

    public function update(Request $request, Tariff $tariff)
    {
       try {
            $request->validate([
                'name' => 'required',
                'cost' => 'required',
                'color' => 'required',
            ]);

            $tariff->update($request->all());

            return response()->json(['message' => 'Tarifa actualizado exitosamente', 'tariff' => $tariff], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error en el servidor'], 500);
        }
    }

    public function destroy(Tariff $tariff)
    {
        try {
            $tariff->delete();
            return response()->json(['message' => 'Tarifa eliminado exitosamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error en el servidor'], 500);
        }
    }
}
