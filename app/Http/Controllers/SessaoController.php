<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sessao;
use Illuminate\Support\Facades\Validator;
use App\Rules\ValidateFKRule;

class SessaoController extends Controller {

    public function lista() {
        return Sessao::get();
    }

    public function get(Request $request) {
        return Sessao::with('leis.lei.vereador')
                        ->with('presenca.vereador')
                        ->find($request->sessao_id);
    }

    public function novo(Request $request) {
        $sessao = new Sessao();
        $sessao->fill($request->all());
        $sessao->save();

        return $sessao->id;
    }

    public function editar($id, Request $request) {
        $sessao = Sessao::find($id);
        $sessao->fill($request->all());
        $sessao->save();

        return $sessao->id;
    }

    public function excluir($id) {
        $validator = Validator::make(array('sessao_id' => $id), [
                    'sessao_id' => [
                        new ValidateFKRule('sessao_voto', 'sessao_id', $id, 'Registro de Voto'),
                        new ValidateFKRule('sessao_leis', 'sessao_id', $id, 'Registro de Lei'),
                        new ValidateFKRule('sessao_presenca', 'sessao_id', $id, 'Registro de Sessão'),
                    ],
        ]);
        if ($validator->fails()) {
            $message = $validator->errors()->first();
            return response()->json(['message' => $message], 422);
        }

        return 'oi';
        $res = Sessao::find($id)->delete();
        return ["status" => ($res) ? 'ok' : 'erro'];
    }

}
