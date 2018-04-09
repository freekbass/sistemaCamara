<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vereador;
use App\Rules\ValidateFKRule;
use Illuminate\Support\Facades\Validator;

class VereadorController extends Controller {

    public function lista() {
        return Vereador::get();
    }

    public function novo(Request $request) {
        $vereador = new Vereador();
        $vereador->fill($request->all());
        $vereador->save();

        return $vereador->id;
    }

    public function editar($id, Request $request) {
        $vereador = Vereador::find($id);
        $vereador->fill($request->all());
        $vereador->save();

        return $vereador->id;
    }

    public function excluir(Request $request, $id) {
        $validator = Validator::make(array('vereador_id' => $id), [
                    'vereador_id' => [
                        new ValidateFKRule('sessao_voto', 'vereador_id', $id, 'Registro de Voto'),
                        new ValidateFKRule('sessao_presenca', 'vereador_id', $id, 'Registro de Presença'),
                    ],
        ]);
        if ($validator->fails()) {
            $message = $validator->errors()->first();
            return response()->json(['message' => $message], 422);
        }
        
        $res = Vereador::find($id)->delete();
        return ["status" => ($res) ? 'ok' : 'erro'];
    }

}
