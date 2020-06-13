<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;
use App\Traits\UploadTrait;

class ProductController extends Controller
{
    use UploadTrait;
    private $product;//criando um atributo e construtor da model Product. Assim n precisara instanciar sempre que precisar usar algo da model
    public function __construct(Product $product){
      $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userStore = auth()->user()->store;//acessando loja do usuario autenticado
        $products =  $userStore->products()->paginate(10);//acessando produtos dessa loja
        //$products = DB::table('products')->leftJoin('stores', 'products.store_id', '=', 'stores.id')->
        //select('products.*', 'stores.name as NomeLoja')->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = \App\Category::all(['id', 'name']);
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {


          $data = $request->all();
          $categories = $request->get('categories', null);
          $store = auth()->user()->store;//acessando a loja para usuario autenticado
          $product = $store->products()->create($data);//criando produto para essa loja
          //o metodo create retorna um objeto com os dados do produto recem criado
          $product->categories()->sync($categories);//agora a variavel product possui os dados inclusive o id do produto
          //a partir do id, é acessado a ligação entre produto e categorias fazendo com que dados sejam inseridos na tabela intermediaria

          if($request->hasFile('photos')){
              $images = $this->imageUpLoad($request->file('photos'), 'image');
              $product->photos()->createMany($images);
            }

          flash('Produto criado com sucesso!')->success();
          return redirect()->route('admin.products.index');





    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($product)
    {
        $product = $this->product->find($product);
        $categories = \App\Category::all(['id', 'name']);
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        $categories = $request->get('categories', null);
        $product = $this->product->find($id);
        $product->update($data);
        if(!is_null($categories))
        $product->categories()->sync($categories);

        if($request->hasFile('photos')){
            $images = $this->imageUpLoad($request->file('photos'), 'image');
            $product->photos()->createMany($images);
          }

        flash('Produto atualizado com sucesso')->success();
        return redirect()->route('admin.products.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $remover = $this->product->find($id);
        $remover->delete();

        flash('Produto deletado com sucesso')->success();
        return redirect()->route('admin.products.index');
    }


}
