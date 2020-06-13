@extends('layouts.front')

@section('content')

<div class="container">
<div class="row">
<div class="col-5">
    @if($product->photos->count())
    <img src="{{asset('storage/' . $product->photos->first()->image)}}" alt="" max-width="200px;" class="card-img-top img-fluid">
    <div class="row" style="margin-top: 20px;">
        @foreach ($product->photos as $photo)
        <div class="col-4">
            <img src="{{asset('storage/' . $photo->image)}}" alt="" class="img-fluid">
        </div>
        @endforeach
    </div>
    @else
    <img src="{{asset('assets/img/no-photo.jpg')}}" alt="" class="card-img-top">
    @endif
</div>
<div class="col-7">
    <h2>{{$product->name}}</h2>
    <p>{{$product->description}}</p>
    R${{number_format($product->price, '2', ',', '.')}}
    <span>Loja {{$product->store->name}} </span>

    <div class="product-add">
        <hr>
        <form action="{{route('cart.add')}}" method="post">
            @csrf
            <input type="hidden" name="product[name]" value="{{$product->name}}">
            <input type="hidden" name="product[price]" value="{{$product->price}}">
            <input type="hidden" name="product[slug]" value="{{$product->slug}}">
            <div class="form-group">
                <label>Quantidade</label>
                <input type="number" name="product[amount]"  class="form-control col-md-3" value="1">
            </div>
            <button class="btn btn-lg btn-danger">Comprar</button>
        </form>
        <hr>
        {{$product->body}}
    </div>
</div>
</div>
</div>


@endsection
