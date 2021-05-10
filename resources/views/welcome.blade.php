<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Home</title>

        <!-- bootstrap -->
        <link rel="stylesheet" href="{{ asset('site/bootstrap.css') }}" >
        <script src="{{ asset('site/bootstrap.js') }}"></script>
        <script src="{{ asset('site/jquery.js') }}"></script>
    </head>
    <body>

      <nav class="navbar fixed-top navbar-expand-md navbar-dark bg-primary mb-3">
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
                    <ul class="nav flex-column sticky-top pl-0 pt-5 mt-3">
                        {{-- <li class="nav-item"><a class="nav-link" href="#">Minha Conta</a></li> --}}
                    </ul>
                    <ul class="nav flex-column sticky-top">
                        <li class="nav-item"><a class="nav-link" href="#">Moedas</a></li>
                    </ul>
                </div>
                
                <!--/col-->
                <main class="col main pt-5 mt-3 overflow-auto">
                    <h1 class="display-4 d-none d-sm-block">
                    Criptomoedas
                    </h1>
                    
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allcoin[0] as $key => $moeda)
                            <tr>
                                <td>{{$key}}</td>
                                <td>{{$moeda['id']}}</td>
                                <td>BRL$ {{$moeda['current_price']}}</td>

                                @if ($moeda['price_change_percentage_1h_in_currency'] >= 0)
                                
                                <td style="color: green">{{number_format($moeda['price_change_percentage_1h_in_currency'], 1, '.', ' ')."%"}}</td>  
                                @else
                                <td style="color: red">{{number_format($moeda['price_change_percentage_1h_in_currency'], 1, '.', ' ')."%"}}</td>  
                                @endif
                                
                                @if ($moeda['price_change_percentage_24h_in_currency'] >= 0)
                                <td style="color: green">{{number_format($moeda['price_change_percentage_24h_in_currency'], 1, '.', ' ')."%"}}</td>  
                                @else
                                <td style="color: red">{{number_format($moeda['price_change_percentage_24h_in_currency'], 1, '.', ' ')."%"}}</td> 
                                @endif

                                @if ($moeda['price_change_percentage_7d_in_currency'] >= 0)
                                
                                <td style="color: green">{{number_format($moeda['price_change_percentage_7d_in_currency'], 1, '.', ' ')."%"}}</td> 
                                @else
                                <td style="color: red">{{number_format($moeda['price_change_percentage_7d_in_currency'], 1, '.', ' ')."%"}}</td>   
                                @endif
                                
                                <td>BRL$ {{$moeda['market_cap']}}</td>
                            </tr>
                            @endforeach 
                        </tbody>
                    </table>
                </div>
                </main>
            </div>
        
        </div>
    </body>
</html>
