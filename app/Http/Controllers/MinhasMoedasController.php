<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;
use App\Models\User;

class MinhasMoedasController extends Controller
{
    public function index(){
        if(isset($_GET['keyid'])){
        $base64ID = $_GET['keyid'];
        $userID =  base64url_decode($_GET['keyid']);
        $user = new User();
    
        if(!$user->getByID($userID)){
            return redirect()->route('login');
        }
        
        $data = $user->getByID($userID);
        $username = $data[0]->nome; 
        }else{
            return redirect()->route('login');
        }


        $coinDados =[
            'usuario' =>[
               'nome' => $username,
               'base64ID' => $base64ID,
               'id' => $userID
         ]
          ];


        return view('minhasMoedas',$coinDados);
    }
}

function base64url_decode( $data ){
    return base64_decode( strtr( $data, '-_', '+/') . str_repeat('=', 3 - ( 3 + strlen( $data )) % 4 ));
  }
