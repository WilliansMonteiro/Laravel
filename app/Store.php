<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Notifications\StoreReceiveNewOrder;

class Store extends Model
{

//metodo abaixo relacionamento 1:1 user e store. Usando o belongTo(pertencepara) pq uma store percente a um user
    protected $fillable = ['name', 'description', 'phone', 'mobile_phone', 'slug', 'logo'];
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value, '-');
    }


    public function user(){

       return $this->belongsTo(User::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
    public function orders(){
        return $this->belongsToMany(UserOrder::class, 'order_store', 'store_id', 'order_id');
    }
    public function notifyStoreOwners(array $storesId = []){
       $stores = $this->whereIn('id', $storesId)->get();

         $stores->map(function($store){
          return $store->user;
       })->each->notify(new StoreReceiveNewOrder());
    }
}
