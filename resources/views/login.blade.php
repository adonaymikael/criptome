<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login</title>

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
                            <span class="anchor" id="formLogin"></span>

                            <div class="card card-outline-secondary">
                                <div class="card-header">
                                    <h3 class="mb-0">Login</h3>
                                </div>
                                <div class="card-body">
                                    <form class="form" role="form" id="loginForm" method="POST" action="{{ route('user.login') }}">
                                        <div class="form-group">
                                            @csrf
                                            <label for="user">Email</label>
                                            <input type="text" class="form-control" name="email" id="email" required="">
                                            <div class="invalid-feedback">Por favor insira seu email</div>
                                        </div>
                                        <div class="form-group">
                                            <label>Senha</label>
                                            <input type="password" class="form-control" name="password" id="password" required="" autocomplete="new-password">
                                            <div class="invalid-feedback">Por favor insira sua senha</div>
                                        </div>
                                        <div style="padding-top: 0.5cm ">
                                        <button type="submit" class="btn btn-success btn-lg float-right" id="btnLogin" onclick="showSpinCadastro()">Entrar</button>
                                        <button type="button" class="btn btn-secondary btn-lg float-right" onclick="window.location='{{route('criar_conta')}}';showSpin()" id="btnLogin">Cadastrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div hidden class="loading" name="spin">
                <div class="loader" style="top: 5cm"></div>
            </div>

        </div>
    </body>                        
    </html>

<script>
    function showSpinCadastro(){
        var p = document.getElementsByName('spin');
        var form = $( "#loginForm" );
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