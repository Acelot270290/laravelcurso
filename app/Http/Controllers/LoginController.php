<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index() {
        return view('site.login', ['titulo' => 'Login']);
    }

    public function autenticar(Request $request) {

        $regras = [
            'usuario' => 'email',
            'senha'=>'required'
        ];

        //as mensagens

        $feedback = [
            'usuario.email'=> 'O Campo usuário (email) é obrigatório',
            'senha.required'=> 'O Campo é obrigatório'
        ];

        $request->validate($regras, $feedback);
        print_r($request->all());
  }
}
