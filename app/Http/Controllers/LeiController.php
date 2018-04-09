<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lei;
use Illuminate\Support\Facades\Validator;
use App\Rules\ValidateFKRule;

class LeiController extends Controller {

    public function lista() {
        return Lei::with('vereador')->get();
    }

    public function novo(Request $request) {
        $lei = new Lei();
        $lei->fill($request->all());
        $lei->save();

        return $lei->id;
    }

    public function editar($id, Request $request) {
        $lei = Lei::find($id);
        $lei->fill($request->all());
        $lei->save();

        return $lei->id;
    }

    public function excluir($id) {
        $validator = Validator::make(array('lei_id' => $id), [
                    'lei_id' => [
                        new ValidateFKRule('sessao_voto', 'lei_id', $id, 'Registro de Voto'),
                        new ValidateFKRule('sessao_leis', 'lei_id', $id, 'Registro de Sessão'),
                    ],
        ]);
        if ($validator->fails()) {
            $message = $validator->errors()->first();
            return response()->json(['message' => $message], 422);
        }
        
        $res = Lei::find($id)->delete();
        return ["status" => ($res) ? 'ok' : 'erro'];
    }

    public function getTipo() {
        return config('enum.lei.tipo');
    }

}
