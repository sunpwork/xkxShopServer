<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
	protected $table = 'shop';

    public function orders()
    {
    	return $this->hasMany(Order::class,'shop_id',$this->primaryKey);
    }

    public function shopkeepers()
    {
    	return $this->hasMany(Shopkeeper::class,'shop_id',$this->primaryKey);
    }
}
