<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request) {

        $erro = '';
        if($request->get('erro') == 1){
            $erro = 'usuário e senha não existe, tente novamente';
        }

        if($request->get('erro') == 2){
            $erro = 'Necessário realizar o login para ter acesso a página';
        }
        return view('site.login', ['titulo' => 'Login', 'erro'=> $erro]);
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

        //recuperamos os dados do form
        $email = $request->usuario;
        $password = $request->senha;

        //Iniciando o  model user

        $user = new User();
        $usuario = $user->where('email', $email)->where('password', $password)->get()->first();

        if(isset($usuario->name)){
            session_start();
            $_SESSION['nome'] = $usuario->name;
            $_SESSION['email'] = $usuario->email;

            return redirect()->route('app.clientes');

        }else{
           

           return redirect()->route('site.login', ['erro'=> 1]);

        }

       
        //print_r($existe);
  }
}
