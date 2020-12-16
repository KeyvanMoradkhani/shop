<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AtrributeGroup extends Model
{
    protected $table='atrributesgroup';

    public function atrributeValue()
    {
        return $this->hasMany(AtrributeValue::class,'atrributeGroup_id');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class,'atrributesGroup_categories','atrributeGroup_id','category_id');
    }
}
