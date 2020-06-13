<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller

{

    use UploadTrait;
    public function __construct()
    {
        //este construtor com o middleware tem a condição only, que faz com que apenas
        //Os metodos create e store possam usalos.
        //esse midleware foi criado para que o usuario so possa acessar as paginas create e store se ele nao tiver loja
        //verifique a classe UserHAsStoreMiddleware e a linha 64 para entender melhor
      $this->middleware('user.has.store')->only(['create', 'store']);
    }






    public function index() {
       // $stores =  \App\Store::paginate(10); fazendo com que apareça todas as lojas
       $store = auth()->user()->store; //fazendo aparecer apenas a loja do usuario que esta logado(autenticado)
      return view('admin.stores.index', compact('store'));


    }

    public function create(){
        $users =  \App \User::all(['id', 'name']);
        return view('admin.stores.create', compact('users'));
    }

    public function store(StoreRequest $request){

        $data = $request->all();//recebendo os dados do form
        $user = auth()->user();//essa linha traz um objeto do usuario que esta autenticado no momento
        if($request->hasFile('logo')){
            $data['logo'] = $this->imageUpload($request->file('logo'));
        }
        $store = $user->store()->create($data);//criando a loja para o usuario escolhido na busca
        flash('Loja criada com sucesso')->success();
        return redirect()->route('admin.stores.index');
    }

    public function edit($store){
        $store = \App\Store::find($store);
        return view('admin.stores.edit', compact('store'));
    }

    public function update(StoreRequest $request, $store){
        $data = $request->all();
        $store = \App\Store::find($store);
        if($request->hasFile('logo')){
            if(Storage::disk('public')->exists($store->logo)){
                Storage::disk('public')->delete($request->file('logo'));
            }
            $data['logo'] = $this->imageUpload($request->file('logo'));
        }
        $store->update($data);
        flash('Loja atualizada com sucesso')->success();
        return redirect()->route('admin.stores.index');
    }
     public function destroy ($store)//Parametro que sera passado pela url
     {
       $store = \App\Store::find($store);
       $store->delete();
       flash('Loja removida com sucesso')->success();
       return redirect()->route('admin.stores.index');
     }





}
