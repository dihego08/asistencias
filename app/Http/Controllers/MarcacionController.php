<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Marcacion;

class MarcacionController extends Controller
{
    public function insertarBatch(Request $request)
    {
        $marcaciones = $request->all();

        if (empty($marcaciones)) {
            return response()->json(['status' => 'error', 'message' => 'No se recibieron registros'], 400);
        }

        // Eliminar duplicados en memoria (opcional)
        $marcaciones = collect($marcaciones)->unique(function ($m) {
            return $m['dni'] . '|' . $m['fecha_hora'] . '|' . $m['reloj_ip'];
        })->values()->all();

        try {
            DB::table('marcaciones')->insert($marcaciones);
            return response()->json([
                'status' => 'success',
                'inserted' => count($marcaciones),
                'message' => 'Marcaciones insertadas correctamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al insertar: ' . $e->getMessage()
            ], 500);
        }
    }
}
