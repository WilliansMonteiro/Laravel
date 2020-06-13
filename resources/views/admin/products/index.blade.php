@extends('layouts.app')

@section('content')
<a href="{{route('admin.products.create')}}" class="btn btn-lg btn-success">Criar Produto</a>
<div class="col-12">
<table class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>#</th>
        <th>Nome</th>
        <th>Preço</th>
        <th>Loja</th>
        <th>Ações</th>

    </tr>
    </thead>
    <tbody>

        @foreach($products as $p)
        <tr>
            <td>{{$p->id}}</td>
            <td>{{$p->name}}</td>
            <td>R$ {{number_format($p->price, 2, ',', '.')}}</td>
            <td>{{$p->store->name}}</td>
            <td>

            <div class="btn-group">
                    <a href="{{route('admin.products.edit', ['product'=>$p->id])}}" class="btn btn-primary">Editar</a>
                    <form action="{{route('admin.products.destroy', ['product'=>$p->id])}}" method="post">
                     @csrf
                     @method("DELETE")
                     <button type="submit" class="btn btn-sm btn-danger">Remover</button>
                    </form>
                </div>



            </td>

        </tr>
        @endforeach


    </tbody>

</table>

</div>
{{$products->links()}}
@endsection






