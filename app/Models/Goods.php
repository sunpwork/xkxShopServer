<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
	protected $table = 'goods';
    protected $keyType = 'varchar';
    public $incrementing = false;

	protected $fillable = ['id','name','price','count'];

    public function order()
    {
    	return $this->belongsTo(Order::class,'order_id','id');
    }
}