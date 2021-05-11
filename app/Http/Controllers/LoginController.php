<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class LoginController extends Controller
{
    public function index(){
        return view('login');
     }

     public function login(Request $request){
         $data = $request->all();
         $email = $data['email'];
         $senha = $data['password'];

         $login = new User();
         if(!isset($login->log_in($email)[0])){
          return redirect()->route('login'); 
         }

         $data = $login->log_in($email)[0];
         if(!password_verify($senha, $data->senha)){
           return redirect()->route('login');
         }

         $id = $data->id;
         $key = base64url_encode($id);
         return redirect()->route('home.key',$key);

     }
}

 function base64url_encode( $data ){
  return rtrim( strtr( base64_encode( $data ), '+/', '-_'), '=');
}
