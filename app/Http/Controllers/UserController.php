<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {

    public function lista() {
        return User::get();
    }

    public function novo(Request $request) {
        $user = new User();

        $this->validate($request, $user->rules());
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();

        return $user->id;
    }

    public function editar($id, Request $request) {
        $user = User::find($id);
        $user->fill($request->all());
        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return $user->id;
    }

    public function excluir($id) {
        $res = User::find($id)->delete();
        return ["status" => ($res) ? 'ok' : 'erro'];
    }

}
