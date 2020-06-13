<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


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

        $this->belongsTo(User::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
    public function orders(){
        return $this->hasMany(UserOrder::class);
    }
}
