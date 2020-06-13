
@extends('layouts.app')

@section('content')
    <h1>Atualizar Produto</h1>
    <form action="{{route('admin.products.update', ['product' =>$product->id])}}" method="post"  enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        @method('PUT')
        <div class="form-group">
            <label>Nome Produto</label>
            <input type="text" name="name" class="form-control" value="{{$product->name}}">
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="description" class="form-control" value="{{$product->description}}">
        </div>


        <div class="form-group">
            <label>Conteúdo</label>
            <textarea name="body" id="" cols="30" rows="10" class="form-control">{{$product->body}}</textarea>
        </div>

        <div class="form-group">
            <label>Preço</label>
            <input type="text" name="price" class="form-control" value="{{$product->price}}">
        </div>

        <div class="form-group">
            <label for="">Categorias</label>
            <select name="categories[]" id="" class="form-control" multiple> <!--Categories[] e multiple pq vai ter a opc de selecionar mais de uma categoria -->
                @foreach ($categories as $category)
                <option value="{{$category->id}}" @if($product->categories->contains($category)) selected @endif >
                    {{$category->name}}
                </option>

                @endforeach
            </select>
        </div>

        <div class="form-gourp">
            <label for="">Fotos do produto</label>
          <input type="file" name="photos[]" class="form-control @error('photos.*') is-invalid @enderror" multiple>
          @error('photos')
          <div class="invalid-feedback">
              {{$message}}
          </div>
       @enderror
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-primary">Atualizar Produto</button>
        </div>

    </form>

    <div class="row">
       @foreach ($product->photos as $photo)
             <div class="col-4 text-center">
                 <img src="{{asset('storage/'.$photo->image)}}" alt="" class="img-fluid">
                 <form action="{{route('admin.photo.remove', ['photoName' => $photo->image])}}" method="post">
                   <input type="hidden" name="photoName" value="{{$photo->image}}">

                    @csrf
                   <button type="submit" class="btn btn-danger">Remover</button>
                </form>
             </div>
       @endforeach
    </div>
@endsection
