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
        <script src="{{ asset('site/bootstrap.js') }}"></script>
        <script src="{{ asset('site/jquery.js') }}"></script>

        <script src="{{ asset('site/validate/jquery.validate.js') }}"></script>
        <script src="{{ asset('site/validate/messages_pt_BR.js')}}"></script>
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
                                <th>Preço</th>
                                <th>1h</th>
                                <th>24h</th>
                                <th>7d</th>
                                <th>Capitalização do mercado</th>
                                {{-- <th>Opções</th> --}}
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
                                
                                <td>{{Money::BRL($moeda['market_cap'])}}</td>

                                {{-- <td>
                                    <a href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="margin-left: 0.5cm" color="red" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                    </a>
                                </td> --}}
                            </tr>
                            @endforeach 
                        </tbody>
                    </table>
                </div>
                </main>
            </div>
        </div>

        <div hidden class="loading" name="spin">
            <div class="loader" style="top: 10cm"></div>
        </div>

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