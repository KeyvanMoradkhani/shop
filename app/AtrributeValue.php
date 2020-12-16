<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AtrributeValue extends Model
{
    protected $table='atrributesValue';

    public function atrributeGroup()
    {
        return $this->belongsTo(AtrributeGroup::class,'atrributeGroup_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class,'atrributesvalue_products','atrributesValue_id','product_id');
    }
}
