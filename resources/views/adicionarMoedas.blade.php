<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php 
        use Akaunting\Money\Currency;
        use Akaunting\Money\Money;
        ?>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Nova Moeda</title>

        <!-- bootstrap -->
        <link rel="stylesheet" href="{{  asset('site/myTemplate.css')}}" >
        <link rel="stylesheet" href="{{ asset('site/bootstrap.css') }}" >
        <script src="{{ asset('site/bootstrap.js') }}"></script>
        <script src="{{ asset('site/jquery.js') }}"></script>

        <script src="{{ asset('site/validate/jquery.validate.js') }}"></script>
        <script src="{{ asset('site/validate/messages_pt_BR.js')}}"></script>
    </head>
    <body>
        <div class="container py-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="card card-outline-secondary">
                                <div class="card-header">
                                    <h3 class="mb-0">Adicione uma Criptomoeda</h3>
                                </div>

                                <div class="card-body">

                                    <div class="alert alert-danger alert-dismissible fade show" role="alert" hidden id="LimitAlert" >
                                         Só é possível selecionar <Strong>6</Strong> criptomoeda por vez.
                                      </div>

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="basic-addon1">
                                            <img src="{{URL::asset('/image/lupa.png')}}" class="img-responsive" alt="Responsive image" width="25" height="24" />
                                          </span>
                                        </div>
                                        <input type="text" style="form-control; width: 85%" id="searchInput" onkeyup="searchCoin()" placeholder="Pesquise uma criptomoeda..." title="Digite uma criptomoeda" autocomplete="off">
                                      </div>

                                    <form style="margin-top: 0.3cm" nome="moedaCadastro" id="moedaCadastro" class="form" role="form" autocomplete="off" method="POST" action="{{ route('moeda.criar_moeda_insert',$usuario['base64ID'])}}">
                                        @csrf
                                        <div class="form-group overflow-auto" style="max-height: 500px;">
                                            <table class="table table-striped" id="coinTable">
                                                <thead class="thead-inverse">
                                            <tr>
                                                <th>Selecione</th>
                                                <th>Moeda</th>
                                                <th>Preço</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($allcoin[0] as $index => $moeda)
                                            <tr>
                                                <td>
                                                    <input type= "checkbox" name ="coins[]" value="{{$moeda['id']}}">
                                                </td>
                                                <td>
                                                    <img src="{{$moeda['image']}}" width="20" height="20">
                                                    {{ucfirst($moeda['id'])}}
                                                </td>
                                                <td>{{Money::BRL($moeda['current_price'])}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                            </table>
                                        </div>
                                        <div class="form-group" style="padding-top: 0.5cm">
                                         <button type="submit" class="btn btn-success btn-lg float-right" id="btnADD" onclick="showSpinCadastro()">Adicionar</button> 
                                        <button type="button" class="btn btn-danger btn-lg float-right" onclick="window.location='{{route('user.moedas',$usuario['base64ID'])}}',showSpin()">Voltar</button>
                                        </div>
                                    </form>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div hidden class="loading" name="spin">
            <div class="loader" style="top: 9cm"></div>
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

<script>
    function showSpinCadastro(){
        var p = document.getElementsByName('spin');
        var form = $( "#moedaCadastro" );
        let myText;
            if(form.valid()){
                for (i = 0; i < p.length; i++) {
                console.log(myText, p[0].innerHTML);
                myText = p[i];
                break;
            }
            myText.removeAttribute("hidden"); 
        }
    }
</script>

<script>
    function showSpin(){
        var p = document.getElementsByName('spin');
        let myText;
            for (i = 0; i < p.length; i++) {
            console.log(myText, p[0].innerHTML);
            myText = p[i];
            break;
        }
        myText.removeAttribute("hidden"); 
    }
</script>

<script>
var limit = 6;
var alert = document.getElementById("LimitAlert");
    $('input[type=checkbox]').on('change', function (e) {
    var LimitLenght = $('input[type=checkbox]:checked').length;
        switch (LimitLenght) {
        case limit+1:
            $(this).prop('checked', false);
            alert.removeAttribute("hidden");
            break;

        default:
            alert.setAttribute("hidden", true);
            break;
    }
});
</script>
</html>