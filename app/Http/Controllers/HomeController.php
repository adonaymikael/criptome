<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;
use App\Models\User;

class HomeController extends Controller
{

   public function index(){
      $userID = base64_decode($_GET['keyid']);
      $user = new User();
      $data = $user->getByID($userID)[0];
      $username = $data->nome; 


      $client = new CoinGeckoClient();
      $data = $client->simple();
      $coin = $client->coins();

      $params = ['price_change_percentage' => '1h,24h,7d', 'per_page' => '10'];

      $allcoin[] =  $coin ->getMarkets('brl',$params);

       $coinDados =[
         'usuario' =>[
            'nome' => $username
      ],
       'allcoin' => $allcoin
       ];

      return view('welcome',$coinDados);
   }
}
