<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;

class AdicionarMoedasController extends Controller
{
    public function index(){

        $client = new CoinGeckoClient();
        $base64ID = $_GET['keyid'];
        $userID =  base64url_decode($_GET['keyid']);

        $data = $client->simple();
        $coin = $client->coins();
  
        $params = ['price_change_percentage' => '1h,24h,7d', 'per_page' => '100'];
  
        $allcoin[] =  $coin ->getMarkets('BRL',$params);

        $coinDados =[
            'usuario' =>[
                'base64ID' => $base64ID,
          ],
            'allcoin' => $allcoin
        ];


        return view('adicionarMoedas',$coinDados);
    }
}

function base64url_decode( $data ){
    return base64_decode( strtr( $data, '-_', '+/') . str_repeat('=', 3 - ( 3 + strlen( $data )) % 4 ));
  }
