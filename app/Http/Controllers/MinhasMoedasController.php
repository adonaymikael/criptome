<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;
use App\Models\criptomoedas;
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

        $criptomoedas = new criptomoedas();
        $userMoedas = $criptomoedas->getByUserID($userID);
        //dd($userMoedas);
        $stringMoedas = "";
        foreach ($userMoedas as $key => $value) {
            $stringMoedas = $value->apiID.",".$stringMoedas;
        }

        $stringMoedas =  substr($stringMoedas, 0 , -1);
        $params = ['price_change_percentage' => '1h,24h,7d', 'ids' => $stringMoedas];

        $coinGeckoClient = new CoinGeckoClient();
        $coins = $coinGeckoClient->coins();
        $allcoin[] =  $coins ->getMarkets('BRL',$params);
        //dd($allcoin);


        $coinDados =[
            'usuario' =>[
               'nome' => $username,
               'base64ID' => $base64ID,
               'id' => $userID
            ],
            'allcoin' => $allcoin
          ];


        return view('minhasMoedas',$coinDados);
    }

    function excluirMoeda(Request $request){
        $data = $request->all();
        $coinID = $data['coinID'];
        $userID = $data['userID'];
        $base64ID = $data['base64ID'];

        $criptomoedas = new criptomoedas();
        $response = $criptomoedas->delete_moedaByID($userID, $coinID);
        //Fazer error
        if(!$response){
            return redirect()->route('user.moedas',$base64ID);
        }

        return redirect()->route('user.moedas',$base64ID);
    }
}

function base64url_decode( $data ){
    return base64_decode( strtr( $data, '-_', '+/') . str_repeat('=', 3 - ( 3 + strlen( $data )) % 4 ));
  }
