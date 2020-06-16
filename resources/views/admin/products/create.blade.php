
@extends('layouts.app')

@section('content')
<h1>Criar Produto</h1>
<form action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
<div class="form-group">
    <label>Nome Produto</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid  @enderror" value="{{old('name')}}">
    @error('name')
        <div class="invalid.feedback">
            {{$message}}
        </div>
    @enderror
</div>

<div class="form-group">
    <label>Descrição</label>
    <input type="text" name="description" value="{{old('description')}}" class="form-control @error('description') is-invalid @enderror">
    @error('description')
    <div class="invalid.feedback">
        {{$message}}
    </div>

    @enderror
</div>


<div class="form-group">
    <label>Conteúdo</label>
    <textarea name="body" id="" cols="30" rows="10"  class="form-control @error('body') is-invalid @enderror">
    </textarea>
    @error('body')
        <div class="invalid.feedback">
            {{$message}}
        </div>
    @enderror
</div>

<div class="form-group">
    <label>Preço</label>
    <input type="text" name="price" id="price" value="{{old('price')}}" class="form-control @error('price') is-invalid @enderror">
     @error('price')
         <div class="invalid.feedback">
             {{$message}}
         </div>
     @enderror
</div>

<div class="form-group">
    <label for="">Categorias</label>
    <select name="categories[]" id="" class="form-control" multiple> <!--Categories[] e multiple pq vai ter a opc de selecionar mais de uma categoria -->
        @foreach ($categories as $category)
        <option value="{{$category->id}}">{{$category->name}}</option>

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
    <button type="submit" class="btn btn-lg btn-primary">Criar Produto</button>
</div>

</form>
@endsection

@section('scripts')
<script src="https://cdn.rawgit.com/plentz/jquery-maskmoney/master/dist/jquery.maskMoney.min.js"></script>
<script>
     $('#price').maskMoney({prefix: '', allowNegative: false, thousands: '.', decimal: ','});
</script>

@endsection
