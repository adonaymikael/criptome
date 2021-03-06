<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php
        use Akaunting\Money\Currency;
        use Akaunting\Money\Money;

        $color= "";
        ?>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CriptoME</title>

        <!-- bootstrap -->
        <link rel="stylesheet" href="{{  asset('site/myTemplate.css')}}" >
        <link rel="stylesheet" href="{{ asset('site/bootstrap.css') }}" >
        <link rel="stylesheet" href="{{ asset('site/bootstrap-icons.css') }}" >
    </head>
    <body>
      <nav class="navbar navbar-expand-md navbar-dark bg-primary mb-3" id="header" name="header">
            <div class="flex-row d-flex">
                <button type="button" class="navbar-toggler mr-2 " data-toggle="offcanvas" title="Toggle responsive left sidebar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" style="padding-left: 1cm" ><strong>CriptoME</strong></a>
                <div class="navbar-collapse collapse" id="collapsingNavbar">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link"href="#">
                                 Ola! {{$usuario['nome']}}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav> 

        <div class="container-fluid" id="main">
            <div class="row row-offcanvas row-offcanvas-left vh-100">

                <div class="col-md-3 col-lg-2 sidebar-offcanvas h-100 overflow-auto bg-light pl-0" id="sidebar" role="navigation">
                    <ul class="nav flex-column ">
                        {{-- <li class="nav-item"><a class="nav-link" href="#">Minha Conta</a></li> --}}
                    </ul>
                    <ul class="nav flex-column ">
                        <li class="nav-item"><a class="nav-link" href="{{route('home.key',$usuario['base64ID'])}}">Moedas</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('user.moedas',$usuario['base64ID'])}}">Minhas Moedas</a></li>
                    </ul>
                </div>
                
                <!--/col-->
                <main class="col main overflow-auto">
                    <h1 class="display-4 d-none d-sm-block">
                    Minhas Criptomoedas
                    </h1>
                    
                    <button type="button" class="btn btn-success btn-lg float-right" id="btnLogin" onclick="window.location='{{route('moeda.criar_moeda',$usuario['base64ID'])}}';showSpin()">Adicionar Criptomoedas</button>
                    
                <div class="col-lg-9 col-md-8">
                    <table class="table table-striped">
                        <thead class="thead-inverse">
                            <tr>
                                <th>#</th>
                                <th>Moeda</th>
                                <th>Pre??o</th>
                                <th>1h</th>
                                <th>24h</th>
                                <th>7d</th>
                                <th>Capitaliza????o do mercado</th>
                                <th>Op????es</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allcoin[0] as $key => $moeda)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                <img src="{{$moeda['image']}}" width="20" height="20">
                                {{ucfirst($moeda['id'])}}
                                </td>
                                <td>{{Money::BRL($moeda['current_price'])}}</td>

                                @if ($moeda['price_change_percentage_1h_in_currency'] >= 0)
                                <?php $color="green"?>  @else <?php $color="red"?>
                                @endif
                                <td style="color:{{$color}}">{{number_format($moeda['price_change_percentage_1h_in_currency'], 1, '.', ' ')."%"}}</td> 
                                
                                @if ($moeda['price_change_percentage_24h_in_currency'] >= 0) 
                                <?php $color="green"?> @else <?php $color="red"?>
                                @endif
                                <td style="color:{{$color}}">{{number_format($moeda['price_change_percentage_24h_in_currency'], 1, '.', ' ')."%"}}</td> 

                                @if ($moeda['price_change_percentage_7d_in_currency'] >= 0)
                                <?php $color="green"?> @else <?php $color="red"?>   
                                @endif
                                <td style="color:{{$color}}">{{number_format($moeda['price_change_percentage_7d_in_currency'], 1, '.', ' ')."%"}}</td>  
                                
                                <td style="width: 250px">{{Money::BRL($moeda['market_cap'])}}</td>

                                <td style="width: 15px">
                                    <button class="btn" onclick="showModal({
                                        'coinKey': '{{$key}}',
                                        'coinName': '{{ucfirst($moeda['id'])}}',
                                        'userID': '{{$usuario['id']}}',
                                        'base64ID': '{{$usuario['base64ID']}}',
                                        'coinID': '{{$moeda['id']}}',
                                        'coinImg': '{{$moeda['image']}}'
                                    })">
                                        <i class="bi bi-trash" style="color:red"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach 
                        </tbody>
                    </table>
                </div>
                </main>
            </div>
        </div>

    <!-- Modal Excluir Criptomoeda -->
    <div class="modal fade" id="deleteCoin" tabindex="-1" aria-labelledby="deleteCoin" aria-hidden="true">
        <form class="form" id="deleteCoinForm" nome="deleteCoinForm" role="form" autocomplete="off" method="POST" action="{{ route('moeda.excluir') }}" >
        @csrf
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteCoin">Deseja confirmar e excluir a moeda <br><strong><span id="coinName"></span></strong> ?</h3>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td><span id="coinKeyText"></span></td>
                            <td>
                                <img id="coinImg" width="20" height="20"> 
                                <span id="coinName"></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            <!-- hidden Form --->
            <input hidden type="text" id="coinID" name="coinID">
            <input hidden type="text" id="userID" name="userID">
            <input hidden type="text" id="base64ID" name="base64ID">
            </div>
            <div class="modal-footer">
                <fieldset class="w-100">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>  
                <button type="submit" class="btn btn-danger" onclick="showSpin()">Excluir</button> 
                <fieldset>   
            </div>
        </form>
          </div>
        </div>

        <div hidden class="loading" name="spin">
            <div class="loader" style="top: 10cm"></div>
        </div>
      </div>

      <script src="{{ asset('site/bootstrap.js') }}"></script>
      <script src="{{ asset('site/jquery.js') }}"></script>
    </body>

</html>

<script>
    function showSpin(){
        let p = document.getElementsByName('spin');
        let header = document.getElementsByName('header');
        console.log(header);

        let myText;
            for (i = 0; i < p.length; i++) {
            myText = p[i];
            break;
        }
        myText.removeAttribute("hidden"); 
        
    }
</script>

<script>
    function showModal(allCoinInfo){
        //console.log(allCoinInfo);
        // coinKey, coinName, userID, base64ID, coinID, coinImg
        var coinKeyTable = parseInt(allCoinInfo['coinKey'])+1;
        var modal = $('#deleteCoin');
        $('#deleteCoin #coinName').text(allCoinInfo['coinName']);
        $('#deleteCoin #userID').val(allCoinInfo['userID']);
        $('#deleteCoin #base64ID').val(allCoinInfo['base64ID']);
        $('#deleteCoin #coinKey').val(allCoinInfo['coinKey']);
        $('#deleteCoin #coinKeyText').text(coinKeyTable);
        $('#deleteCoin #coinID').val(allCoinInfo['coinID']);
        $('#deleteCoin #coinImg').attr({
        src: allCoinInfo['coinImg'],
        });
        modal.modal('show');
    }
    
</script>