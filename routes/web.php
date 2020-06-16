<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');
Route::get('/product/{slug}', 'HomeController@single')->name('product.single');
Route::get('/category/{slug}', 'CategoryController@index')->name('category.single');
Route::get('/store/{slug}', 'StoreController@index')->name('store.single');
Route::prefix('cart')->name('cart.')->group(function(){
    Route::get('/', 'CartController@index')->name('index');
    Route::post('add', 'CartController@add')->name('add');
    Route::get('remove/{slug}', 'CartController@remove')->name('remove');
    Route::get('cancel', 'CartController@cancel')->name('cancel');
});
Route::prefix('checkout')->name('checkout.')->group(function(){
Route::get('/', 'CheckoutController@index')->name('index');
Route::post('/proccess', 'CheckoutController@proccess')->name('proccess');
Route::get('/thanks', 'CheckoutController@thanks')->name('thanks');
Route::post('/notification', 'CheckoutController@notification')->name('notification');
});

Route::get('/model', function(){
    //$products = \App\Product::all(); //equivale a select * from products
    //inserção atraves de Active Record
    //$user = new \App\User();
    // $user->name = 'Usuario Teste';
    // $user->email = 'email@teste.com';
    // $user->password = bcrypt('12345678');
    //inserção atraves de Mass Assignment
    //$user = \App\User::create([
    //  'name' => 'Willians Monteiro',
    //  'email' => 'williansgomes@email.com',
    //  'password'=> bcrypt('12345')
    //  ]);

    //$user = \App\User::find(82);
    //  $user->update([
    //   'name' => 'Atualizando com Mass Updade'
    //  ]);

    //como eu faria para pegar a loja de um usuario
    //$user = \App\User::find(4);
    //return $user->store;

    //Criar uma loja para um usuario
    //  $user = \App\User::find(10);
    // $store = $user->store()->create([
    //     'name' => 'Loja Teste',
    //      'description' => 'Loja de teste de informatica',
    //    'mobile_phone' => 'xx-xxxxx-xxxx',
    //   'phone'=>'xx-xxxx-xxxx',
    //   'slug'=>'loja-teste'
    //  ]);
    //  dd($store);
    //criar um produto para uma loja
    // $store = \App\Store::find(41);
    // $product = $store->products()->create([
    //     'name' => 'Notebook Dell',
    //    'description' => 'Core I5 10GB' ,
    //   'body' => 'Qualquer coisa...',
    //    'price' => 2999.90,
    //   'slug' => 'notebook-dell',
    //   ]);
    // dd($product);
    //criar uma categoria

    //  \App\Category::create([
    //    'name' => 'Games',
    //   'description'=>null,
    //   'slug'=>'games'
    // ]);
    // \App\Category::create([
    //    'name' => 'Notebooks',
    //   'description'=>null,
    //   'slug'=>'notebooks'
    // ]);

    // return \App\Category::all();

    //Adicionar um produto para uma categoria ou vice versa


    // return \App\User::where('name', 'Atualizando com Mass Updade')->first();
});

//Route::get('/admin/stores', 'Admin\\StoreController@index');
//Route::get('/admin/stores/create', 'Admin\\StoreController@create');
//Route::post('/admin/stores/store', 'Admin\\StoreController@store');


Route::get('my-orders', 'UserOrderController@index')->name('user.orders')->middleware('auth');

Route::group(['middleware' => ['auth', 'access.control.store.admin']], function(){



Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function(){
    /* Route::prefix('stores')->name('stores.')->group(function(){
          Route::get('/', 'StoreController@index')->name('index');
          Route::get('/create', 'StoreController@create')->name('create');
          Route::post('/store', 'StoreController@store')->name('store');
          Route::get('/{store}/edit', 'StoreController@edit')->name('edit');
          Route::post('/update/{store}', 'StoreController@update')->name('update');
          Route::get('/destroy/{store}', 'StoreController@destroy')->name('destroy');
      });*/
      Route::get('notifications', 'NotificationController@notifications')->name('notifications.index');
      Route::get('notifications/read-all', 'NotificationController@readAll')->name('notifications.read.all');
      Route::get('notifications/read/{notification}', 'NotificationController@read')->name('notifications.read');
      Route::resource('stores', 'StoreController');
      Route::get('orders/my', 'OrdersController@index')->name('orders.my');
      Route::resource('products', 'ProductController');
      Route::resource('categories', 'CategoryController');
      Route::post('photos/remove', 'ProductPhotoController@removePhoto')->name('photo.remove');
  });


});



Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('not', function(){

   // $user->notify(new  \App\Notifications\StoreReceiveNewOrder());
  // $notifications = $user->notifications->first();
  // $notifications->markAsRead();
   // $notification = $user->unreadNotifications->first();
  // $notification->markAsRead();



});
