<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarifa;
class TarifaController extends Controller
{
    public function index()
    {
        $tarifas = Tarifa::all();
        return response()->json(['tarifas' => $tarifas]);
    }

    public function create()
    {
        // No necesitas una vista para la creación
    }

    public function store(Request $request)
    {
        $tarifa = new Tarifa();
        $tarifa->nombre = $request->input('nombre');
        $tarifa->precio = $request->input('precio');
        $tarifa->save();

        return response()->json(['message' => 'Tarifa creada exitosamente']);
    }

    public function edit($id)
    {
        // No necesitas una vista para la edición
    }

    public function update(Request $request, $id)
    {
        $tarifa = Tarifa::find($id);
        $tarifa->nombre = $request->input('nombre');
        $tarifa->precio = $request->input('precio');
        $tarifa->save();

        return response()->json(['message' => 'Tarifa actualizada exitosamente']);
    }

    public function destroy($id)
    {
        $tarifa = Tarifa::find($id);
        $tarifa->delete();

        return response()->json(['message' => 'Tarifa eliminada exitosamente']);
    }
}