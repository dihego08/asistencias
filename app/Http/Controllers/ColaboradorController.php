<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Colaborador;
use Carbon\Carbon;


class ColaboradorController extends BaseController
{
    public function index()
    {
        return response()->json(['message' => 'Hola desde ColaboradorController']);
    }
    public function lista()
    {
        return response()->json(Colaborador::all());
    }

    public function insertar(Request $request)
    {
        $id = Colaborador::create([
            'tipo' => $request->input('tipo'),
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Colaborador creado correctamente',
            'id' => $id
        ], 200);
    }

    public function editar($id)
    {
        return response()->json(Colaborador::find($id));
    }
    public function eliminar($id)
    {
        $tipoPermiso = Colaborador::find($id);

        if (!$tipoPermiso) {
            return response()->json([
                'status' => 'error',
                'message' => 'Colaborador no encontrada o no se pudo eliminar'
            ], 404);
        }

        $tipoPermiso->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Colaborador eliminado correctamente'
        ], 200);
    }
    public function editarEstado(Request $request, $id)
    {
        $colaborador = Colaborador::find($id);

        if (!$colaborador) {
            return response()->json([
                'status' => 'error',
                'message' => 'Colaborador no encontrada o no se pudo editar'
            ], 404);
        }
        $colaborador->update([
            'estado' => $request->input('estado'),  
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Colaborador actualizado correctamente',
            'id' => $id
        ], 200);
    }
    public function editarMarcacion(Request $request, $id)
    {
        $colaborador = Colaborador::find($id);

        if (!$colaborador) {
            return response()->json([
                'status' => 'error',
                'message' => 'Colaborador no encontrada o no se pudo editar'
            ], 404);
        }
        $colaborador->update([
            'marcacion' => $request->input('marcacion'),  
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Colaborador actualizado correctamente',
            'id' => $id
        ], 200);
    }
    public function actualizar(Request $request, $id)
    {
        Colaborador::where('id', $id)
            ->update([
                'tipo' => $request->input('tipo'),
            ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Colaborador actualizada correctamente',
            'id' => $id
        ], 200);
    }
}
