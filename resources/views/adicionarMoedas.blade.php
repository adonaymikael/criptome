<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Nova Moeda</title>

        <!-- bootstrap -->
        <link rel="stylesheet" href="{{ asset('site/bootstrap.css') }}" >
        <script src="{{ asset('site/bootstrap.js') }}"></script>
        <script src="{{ asset('site/jquery.js') }}"></script>
    </head>
    <body>
        <div class="container py-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="card card-outline-secondary">
                                <div class="card-header">
                                    <h3 class="mb-0">Nova Moeda</h3>
                                </div>

                                <div class="card-body">
                                    

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="basic-addon1">
                                            <img src="{{URL::asset('/image/lupa.png')}}" class="img-responsive" alt="Responsive image" width="25" height="24" />
                                          </span>
                                        </div>
                                        <input type="text" style="form-control; width: 85%" id="searchInput" onkeyup="searchCoin()" placeholder="Pesquise uma criptomoeda..." title="Digite uma criptomoeda" autocomplete="off">
                                      </div>

                                    <form style="margin-top: 0.3cm" class="form" role="form" autocomplete="off" method="POST" action="{{ route('user.criar_conta') }}">
                                        @csrf
                                        <div class="form-group overflow-auto" style="max-height: 500px;">
                                            <table class="table table-striped" id="coinTable">
                                                <thead class="thead-inverse">
                                            <tr>
                                                <th>Selecione</th>
                                                <th>Moeda</th>
                                                <th>Preco</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($allcoin[0] as $index => $moeda)
                                            <tr>
                                                <td>
                                                    <input type= "checkbox" nome ="coins" value="{{$moeda['id']}}">
                                                </td>
                                                <td>
                                                    <img src="{{$moeda['image']}}" width="20" height="20">
                                                    {{$moeda['id']}}
                                                </td>
                                                <td>{{$moeda['current_price']}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                            </table>
                                        </div>
                                        <div class="form-group" style="padding-top: 0.5cm">
                                        {{-- lembrar de alterar o tipo do botao --}}
                                         <button type="button" class="btn btn-success btn-lg float-right" id="btnLogin">Adicionar</button> 
                                        <button type="button" class="btn btn-danger btn-lg float-right" onclick=window.location='{{route('user.moedas',$usuario['base64ID'])}}'>Voltar</button>
                                        </div>
                                    </form>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body> 
    
    <script>
        function searchCoin() {
          var input, filter, table, tr, td, i, txtValue;
          input = document.getElementById("searchInput");
          filter = input.value.toUpperCase();
          table = document.getElementById("coinTable");
          tr = table.getElementsByTagName("tr");
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
              txtValue = td.textContent || td.innerText;
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            }       
          }
        }
        </script>
</html>