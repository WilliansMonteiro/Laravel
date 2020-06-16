@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-12">
        <h2>Pedidos Recebidos</h2>
        <hr>
    </div>
    <div class="col-12">
        <div id="accordion">
            @forelse($orders as $key => $order)
            <div class="card">
              <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                  <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapseOne">
                    Pedido n: {{$order->reference}}
                  </button>
                </h5>
              </div>

              <div id="collapse{{$key}}" class="collapse @if($key ==0) show @endif" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">

                    <ul>
                        @php
                            $items = unserialize($order->items);
                        @endphp
                        @foreach(filterItemsByStoreId($items, auth()->user()->store->id) as $item)
                        <li><span style="font-weight: bold;"> Nome do produto</span> : {{$item['name']}} <br>
                            <span style="font-weight: bold;"> Valor unitario: R$ </span>{{number_format($item['price'], 2, ',', '.')}} <br>
                            <span style="font-weight: bold;"> Quantidade pedida:</span> {{$item['amount']}} <br>
                            <span style="font-weight: bold;"> Valor total da compra: R$ </span> {{number_format($item['price'] * $item['amount'], 2, ',', '.')}} <br>

                        </li> <br>
                        @endforeach
                    </ul>
                </div>
              </div>
            </div>
            @empty
            <div class="alert alert-warning">Nenum pedido recebido</div>
            @endforelse

    </div>
    <div class="col-12">
        <hr>
        {{$orders->links()}}
    </div>

</div>

@endsection

