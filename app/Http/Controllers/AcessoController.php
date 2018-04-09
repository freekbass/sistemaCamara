<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AcessoController extends Controller {

    public function validarAcesso(Request $request) {
        return Auth::check() ? 1 : 0;
    }

}
