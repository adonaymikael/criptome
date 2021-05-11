<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;
use App\Models\User;

class HomeController extends Controller
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

      $client = new CoinGeckoClient();
      $data = $client->simple();
      $coin = $client->coins();

      $params = ['price_change_percentage' => '1h,24h,7d', 'per_page' => '15'];

      $allcoin[] =  $coin ->getMarkets('BRL',$params);
      //dd($allcoin);

       $coinDados =[
         'usuario' =>[
            'nome' => $username,
            'base64ID' => $base64ID,
            'id' => $userID
      ],
       'allcoin' => $allcoin
       ];

      return view('welcome',$coinDados);
   }
}


function base64url_decode( $data ){
   return base64_decode( strtr( $data, '-_', '+/') . str_repeat('=', 3 - ( 3 + strlen( $data )) % 4 ));
 }
