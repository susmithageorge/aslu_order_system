<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public function dealers()
    {
        return $this->hasMany('App\Product');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
