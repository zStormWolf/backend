<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paquete;

class PaqueteController extends Controller
{
    public function index()
    {
        $paquetes = Paquete::all();
        return response()->json(['paquetes' => $paquetes]);
    }

    public function create()
    {
        // No necesitas una vista para la creación
    }

    public function store(Request $request)
    {
        try {
            $paquete = new Paquete();
            $paquete->nombre = $request->input('nombre');
            $paquete->descripcion = $request->input('descripcion');
            $paquete->save();

            $idPaquete = $paquete->id;

            $paqueteCreado = Paquete::find($idPaquete);

            return response()->json([$paquete],201);
        
        }catch (\Exception $e) {
            // Manejar otros errores
            return response()->json(['message' => 'Error en el servidor']);
        }
    }

    public function edit($id)
    {
        // No necesitas una vista para la edición
    }

    public function update(Request $request, $id)
    {
        $paquete = Paquete::find($id);
        $paquete->nombre = $request->input('nombre');
        $paquete->descripcion = $request->input('descripcion');
        $paquete->save();

        return response()->json(['message' => 'Paquete actualizado exitosamente']);
    }

    public function destroy($id)
    {
        $paquete = Paquete::find($id);
        $paquete->delete();

        return response()->json(['message' => 'Paquete eliminado exitosamente']);
    }
}
