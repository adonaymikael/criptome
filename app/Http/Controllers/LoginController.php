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
         $data = $login->log_in($email, $senha);
         if(!$data){
           return redirect()->route('login');
         }

         $id = $data[0]->id;
         $key = base64_encode($id);
         return redirect()->route('home.key',$key);

     }
}
