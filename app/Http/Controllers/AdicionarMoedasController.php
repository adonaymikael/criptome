<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;
use App\Models\User;
use App\Models\criptomoedas;

class AdicionarMoedasController extends Controller
{
    public function index(){
        $base64ID = $_GET['keyid'];
        $userID =  base64url_decode($_GET['keyid']);

        $client = new CoinGeckoClient();
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

    public function adicionarMoeda(Request $request){
        $data = $request->all();
        $coins = $data['coins'];
        $Base64userID = $data['keyid'];
        $userID = base64url_decode($Base64userID);

        $criptomoedas = new criptomoedas();
        //Verificando se a moeda existe para o usuario X
        foreach ($coins as $key => $value) {
            $dataVerify = $criptomoedas->verifica_moeda($userID,$value);
            if($dataVerify){
                //Adicionar error tag
                return redirect()->route('moeda.criar_moeda',$Base64userID);
            }
        }

       //Adicionando moedas para o usuario X
        foreach ($coins as $key => $value) {
            $data = $criptomoedas->insert_moeda($userID,$value);
            if(!$data){
                //Adicionar error tag
                return redirect()->route('user.moedas',$Base64userID);
            }
        }
        return redirect()->route('user.moedas',$Base64userID);
    }
}

function base64url_decode( $data ){
    return base64_decode( strtr( $data, '-_', '+/') . str_repeat('=', 3 - ( 3 + strlen( $data )) % 4 ));
  }
