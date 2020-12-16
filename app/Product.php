<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function atrributevalues()
    {
        return $this->belongsToMany(AtrributeValue::class,'atrributesvalue_products','product_id','atrributesValue_id');
    }
    public function photos()
    {
        return $this->belongsToMany(Photo::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

}
