<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketplace 6</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script
    src="https://code.jquery.com/jquery-3.5.1.js"
    integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
</head>
<body>



    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom: 40px;">
        <a class="navbar-brand" href="{{route('home')}}">Marketplace</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @auth
          <ul class="navbar-nav mr-auto">
            <li class="nav-item @if(request()->is('admin/stores*'))  active @endif">
              <a class="nav-link" href="{{route("admin.stores.index")}}">Lojas<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item @if(request()->is('admin/products*'))  active @endif">
              <a class="nav-link" href="{{route("admin.products.index")}}">Produtos</a>
            </li>
            <li class="nav-item @if(request()->is('admin/categories*'))  active @endif">
                <a class="nav-link" href="{{route("admin.categories.index")}}">Categorias</a>
              </li>
          </ul>

          <div class="my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <a class="nav-link" href="#" onclick="event.preventDefault();  document.querySelector('form.logout').submit(); ">Sair</a>
                  <form action="{{route('logout')}}" class="logout" method="POST" style="display:none;">
                    @csrf
                </form>
                </li>
                <li class="nav-item">
                    <span class="nav-link">{{auth()->user()->name}}</span>
                </li>
              </ul>
          </div>
          @endauth
        </div>
      </nav>

<div class="container">
    @include('flash::message')
    @yield('content')

</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
