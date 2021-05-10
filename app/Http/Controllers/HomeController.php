<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;
use App\Models\User;

class HomeController extends Controller
{

   public function index(){
      if(isset($_GET['keyid'])){
      $userID = base64_decode($_GET['keyid']);
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
