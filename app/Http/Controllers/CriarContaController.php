<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CriarContaController extends Controller
{
    public function index(){
        return view('criarConta',);
    }

    public function criar_conta(Request $request){
        $data = $request->all();
        $nome = $data['nome'];
        $email = $data['email'];
        $senha = $data['senha'];
        $senha2 = $data['senha2'];

        if($senha != $senha2){
            return redirect()->route('criar_conta_error','invalidPassword');
        }

        $novaSenha = password_hash($senha, PASSWORD_DEFAULT);

        $dados = [
            'nome' => $nome,
            'email' => $email,
            'senha' => $novaSenha
        ];

        $user = new User;
        $return = $user->criarConta($dados);
        if(!$return['result']){
            return redirect()->route('criar_conta_error',$return['error']->getMessage());
        }
        $id = $return['lastid'];
        $key = base64url_encode($id);
        return redirect()->route('home.key',$key);

    }
}

function base64url_encode( $data ){
    return rtrim( strtr( base64_encode( $data ), '+/', '-_'), '=');
}
