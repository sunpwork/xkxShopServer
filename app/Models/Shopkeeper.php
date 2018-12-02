<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shopkeeper extends Model
{
    protected $table = 'shopkeeper';

    public function shop()
    {
    	return $this->belongsTo(Shop::class,'shop_id','id');
    }
}
