<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $table = 'order';
    protected $keyType = 'varchar';
    public $incrementing = false;

	protected $fillable = ['id','shop_id','platform_id','order_time','user_name','user_tel','user_address','user_remark'];

	public function shop()
    {
    	return $this->belongsTo(Shop::class,'shop_id','id');
    }

    public function goods()
    {
    	return $this->hasMany(Goods::class,'order_id',$this->primaryKey);
    }
}
