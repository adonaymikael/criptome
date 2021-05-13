<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cadastro</title>

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
                                    <h3 class="mb-0">Cadastro</h3>
                                </div>
                                <div class="card-body">
                                    <form class="form" id="cadastroForm" nome="cadastroForm" role="form" autocomplete="off" method="POST" >
                                        @csrf
                                        <div class="form-group">
                                            <label for="inputName">Nome</label>
                                            <input type="text" name="nome" class="form-control" id="inputName" placeholder="Nome Completo"  required="" minlength="8">
                                        </div>
                                        <div class="form-group" style="padding-top: 0.2cm">
                                            <label for="inputEmail3">Email</label>
                                            <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email" required="" minlength="8">
                                        </div>
                                        <div class="form-group" style="padding-top: 0.2cm">
                                            <label for="inputPassword3">Senha</label>
                                            <input type="password" name="senha" class="form-control" id="inputPassword3" placeholder="Senha" required="" minlength="6">
                                        </div>
                                        <div class="form-group" style="padding-top: 0.2cm">
                                            <label for="inputVerify3">Verificar senha</label>
                                            <input type="password" name="senha2" class="form-control" id="inputVerify3" placeholder="Senha (Novamente)" required="" minlength="6">
                                        </div>
                                        <div class="form-group" style="padding-top: 0.5cm">
                                            <button type="submit" class="btn btn-success btn-lg float-right" onclick="showSpinCadastro()">Cadastrar</button>
                                            <button type="button" class="btn btn-danger btn-lg float-right" onclick="window.location='{{route('user.login')}}',showSpin()">Voltar</button>
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
            <div class="loader" style="top: 5cm"></div>
        </div>

    </body>                        
</html>

<script>
    function showSpinCadastro(){
        var p = document.getElementsByName('spin');
        var form = $( "#cadastroForm" );
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