<?php

namespace App\Http\Controllers;

use App\Models\ClubeModel;
use App\Models\RecursoModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ClubesController extends Controller
{
    public function listar()
    {
        $clubes = ClubeModel::get();

        if ($clubes->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Nehum Clube Cadastrado'
            ]);
        }
        return response()->json($clubes, 200);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $rules = [
                'clube' => 'required|string',
                'saldo_disponivel' => 'required|string',
            ];

            $messages = [
                'clube.required' => 'Nome do Clube não informado',
                'saldo_disponivel.required' => 'Saldo disponível não informado',
            ];

            $validator = Validator::make(request()->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first(),
                ]);
            }

            $exists_clube = ClubeModel::where('clube', $request->clube)->exists();

            if ($exists_clube) {
                return response()->json([
                    'success' => false,
                    'message' => "Clube já cadastrado",
                ]);
            }

            ClubeModel::create([
                'clube' => $request->clube,
                'saldo_disponivel' => $request->saldo_disponivel
            ]);

            return response()->json([
                'success' => true,
                'message' => "Clube cadastrado com Sucesso"
            ], 201);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Ocorreu um erro inesperado, tente novamente mais tarde'
            ]);
        }
    }

    public function consumirRecursos(Request $request)
    {
        try {
            DB::beginTransaction();

            $rules = [
                'clube_id' => 'required|integer',
                'recurso_id' => 'required|integer',
                'valor_consumo' => 'required'
            ];

            $messages = [
                'clube_id.required' => 'ID do clube não informado',
                'clube_id.integer' => 'Clube ID inválido',
                'recurso_id.required' => 'Id do recursos não informado',
                'recurso_id.integer' => 'Recurso ID inválido',
                'valor_consumo.required' => 'Valor do consumo não informado',
            ];

            $validator = Validator::make(request()->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first(),
                ]);
            }

            $clube = ClubeModel::find($request->clube_id);

            if (!$clube) {
                return response()->json([
                    'Clube Não Encontrado'
                ]);
            }

            $recurso = RecursoModel::find($request->recurso_id);

            if (!$recurso) {
                return response()->json([
                    'Recurso Não Encontrado'
                ]);
            }

            
            $valor = trim($request->valor_consumo);
            $valor = str_replace(".", "", $valor);
            $valor = number_format(intval($valor), 2, '.', '');

            if ($valor > $clube->saldo_disponivel) {
                return response()->json([
                    'O saldo disponível do clube é insuficiente.'
                ], 400);
            }
            
            if ($valor > $recurso->saldo_disponivel) {
                return response()->json([
                    'O saldo disponível do recurso é insuficiente.'
                ], 400);
            }

            $clube->update(['saldo_disponivel'=> $valor]);
            
            return response()->json($clube, 200);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Ocorreu um erro inesperado, tente novamente mais tarde'
            ]);
        }
    }
}
