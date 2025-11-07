<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Marcacion;
/*
class MarcacionController extends Controller
{
    public function insertarBatch(Request $request)
    {
        $marcaciones = $request->all();
    
        if (empty($marcaciones)) {
            return response()->json([
                'status' => 'error', 
                'message' => 'No se recibieron registros'
            ], 400);
        }
    
        // Eliminar duplicados en memoria
        $marcaciones = collect($marcaciones)->unique(function ($m) {
            return $m['dni'] . '|' . $m['fecha_hora'] . '|' . $m['reloj_ip'];
        })->values()->all();
    
        try {
            $values = [];
            $bindings = [];
    
            foreach ($marcaciones as $m) {
                $values[] = "(?, ?, ?, ?, NOW())";
                $bindings[] = $m['dni'];
                $bindings[] = $m['fecha_hora'];
                $bindings[] = $m['estado'] ?? 0;
                $bindings[] = $m['reloj_ip'];
            }
    
            $sql = "INSERT INTO marcaciones (dni, fecha_hora, estado, reloj_ip, created_at) 
                    VALUES " . implode(',', $values) . "
                    ON DUPLICATE KEY UPDATE id=id"; // No hace nada si existe
    
            DB::statement($sql, $bindings);
    
            return response()->json([
                'status' => 'success',
                'received' => count($marcaciones),
                'inserted' => count($marcaciones),
                'message' => 'Marcaciones procesadas (duplicados omitidos)'
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error al insertar: ' . $e->getMessage()
            ], 500);
        }
    }
}
*/

class MarcacionController extends Controller
{
    const CHUNK_SIZE = 500; // Ajusta según tu servidor

    public function insertarBatch(Request $request)
    {
        $marcaciones = $request->all();

        if (empty($marcaciones)) {
            return response()->json([
                'status' => 'error', 
                'message' => 'No se recibieron registros'
            ], 400);
        }

        // Eliminar duplicados en memoria
        $marcaciones = collect($marcaciones)->unique(function ($m) {
            return $m['dni'] . '|' . $m['fecha_hora'] . '|' . $m['reloj_ip'];
        })->values();

        $totalRecibidos = $marcaciones->count();
        $totalChunks = 0;
        $errores = [];

        try {
            DB::beginTransaction();

            // Procesar en chunks
            $marcaciones->chunk(self::CHUNK_SIZE)->each(function($chunk, $index) use (&$totalChunks, &$errores) {
                try {
                    $values = [];
                    $bindings = [];

                    foreach ($chunk as $m) {
                        $values[] = "(?, ?, ?, ?, NOW())";
                        $bindings[] = $m['dni'];
                        $bindings[] = $m['fecha_hora'];
                        $bindings[] = $m['estado'] ?? 0;
                        $bindings[] = $m['reloj_ip'];
                    }

                    $sql = "INSERT INTO marcaciones (dni, fecha_hora, estado, reloj_ip, created_at) 
                            VALUES " . implode(',', $values) . "
                            ON DUPLICATE KEY UPDATE updated_at = NOW()";

                    DB::statement($sql, $bindings);
                    $totalChunks++;

                } catch (\Exception $e) {
                    $errores[] = "Chunk " . ($index + 1) . ": " . $e->getMessage();
                }
            });

            DB::commit();

            return response()->json([
                'status' => 'success',
                'received' => $totalRecibidos,
                'inserted' => $totalRecibidos,
                'chunks_processed' => $totalChunks,
                'chunk_size' => self::CHUNK_SIZE,
                'errors' => $errores,
                'message' => 'Marcaciones procesadas correctamente'
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'Error crítico: ' . $e->getMessage(),
                'errors' => $errores
            ], 500);
        }
    }
}