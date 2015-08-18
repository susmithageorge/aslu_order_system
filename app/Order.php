<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    //
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    //
    public function dealer()
    {
        return $this->belongsTo('App\Dealer', 'dealer_id');
    }

    public function manufacturer()
    {
        return $this->belongsTo('App\Manufacturer', 'manufacturer_id');
    }

    public function items()
    {
        return $this->hasMany('App\Item');
    }
}
