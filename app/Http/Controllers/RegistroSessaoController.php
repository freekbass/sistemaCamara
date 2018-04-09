<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sessao;
use App\SessaoLei;
use App\SessaoPresenca;
use App\SessaoVoto;
use App\Rules\ValidarPresenca;
use Illuminate\Support\Facades\Validator;

class RegistroSessaoController extends Controller {

    public function iniciarSessao(Request $request) {
        $sessao = Sessao::with('leis')->find($request->sessao_id);
        $sessao->registrarInicio();
        $sessao->save();

        return response()->json(['data' => $sessao]);
    }

    public function vincularLei(Request $request) {
        $sessaoLei = new SessaoLei();
        $sessaoLei->fill($request->all());
        $sessaoLei->save();

        return response()->json();
    }

    public function desvincularLei(Request $request) {
        SessaoLei::where('lei_id', $request->lei_id)
                ->where('sessao_id', $request->sessao_id)->delete();

        return response()->json();
    }

    public function RegistrarPresenca(Request $request) {
        $sessaoPresenca = SessaoPresenca::firstOrNew(
                        [
                            'sessao_id' => $request->sessao_id,
                            'vereador_id' => $request->vereador_id,
                        ]
        );
        $sessaoPresenca->fill($request->all());
        $sessaoPresenca->presente = $request->presenca;
        $sessaoPresenca->save();

        return response()->json();
    }

    public function removerPresenca(Request $request) {
        SessaoPresenca::where('vereador_id', $request->vereador_id)
                ->where('sessao_id', $request->sessao_id)->delete();

        return response()->json();
    }

    public function registrarVoto(Request $request) {
        $validator = Validator::make($request->all(), [
                    'vereador_id' => [new ValidarPresenca($request->sessao_id, $request->vereador_id)],
        ]);

        if ($validator->fails()) {
            $message = $validator->errors()->first();
            return response()->json(['message' => $message], 422);
        }

        $registroVoto = SessaoVoto::firstOrNew(
                        [
                            'sessao_id' => $request->sessao_id,
                            'vereador_id' => $request->vereador_id,
                            'lei_id' => $request->lei_id,
                        ]
        );

        $registroVoto->aprovado = $request->aprovado;
        $registroVoto->save();
    }

    public function getVotos(Request $request) {
        $request->all();
        return SessaoVoto::where('sessao_id', $request->sessao_id)
                        ->where('lei_id', $request->lei_id)
                        ->with('vereador')->get();
    }

}
