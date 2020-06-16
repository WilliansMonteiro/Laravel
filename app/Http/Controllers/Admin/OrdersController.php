<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UserOrder;

class OrdersController extends Controller
{
   private $order;
   public function __construct(UserOrder $order)
   {
       $this->order = $order;
   }

   public function index(){
       $user = auth()->user();
       if(!$user->store()->exists()){
           flash('Necessário ter uma loja para visualizar os pedidos');
           return redirect()->route('admin.stores.index');
       }
       $orders = $user->store->orders()->paginate(15);

       return view('admin.orders.index', compact('orders'));
   }
}
