<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function address()
    {
        return $this->hasMany(Address::class);
    }
}
