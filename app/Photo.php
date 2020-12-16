<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $uploadpath = '/images/';
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPathAttribute($photo)
    {
        return $this->uploadpath .$photo;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }


}
