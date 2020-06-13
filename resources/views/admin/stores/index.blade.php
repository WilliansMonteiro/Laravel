@extends('layouts.app')
@section('content')
@if(!$store) <!-- so vai aparecer o botao para criar loja, se o usuario nao tiver loja -->
    <a href="{{route('admin.stores.create')}}" class="btn btn-lg btn-success">Criar Loja</a>
@else
<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>Loja</th>
        <th>Qtd produtos</th>
        <th>Ações</th>
    </tr>
    </thead>
    <tbody>
    <tr>

        <tr>
            <td>{{$store->id}}</td>
            <td>{{$store->name}}</td>
            <td>{{$store->products->count()}}</td> <!-- chamando a ligação (loja tem muitos produtos) -->
            <td>

                <div class="btn-group">
                    <a href="{{route('admin.stores.edit', ['store'=>$store->id])}}" class="btn btn-sm btn-primary">Editar</a>
                    <form action="{{route('admin.stores.destroy', ['store'=>$store->id])}}" method="post">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-danger">Remover</button>
                    </form>
                </div>
            </td>

        </tr>



    </tbody>

</table>
@endif


    @endsection
