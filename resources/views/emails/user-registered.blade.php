<h1>Olá, {{$user->name}}, Tudo bem? Espero que sim!</h1>
     <h3>Obrigado por sua inscrição!</h3>

<p>
    Faça um bom proveito e excelente compras em nosso sistema! <br>
    Seu email de cadastro é: <strong>{{$user->email}}</strong> <br>
    Sua senha é: <strong>Por questões de segurança não enviamos sua senha mas você deve se lembrar!</strong>
</p>

Email enviado em {{date('d/m/Y H:i:s')}}.
