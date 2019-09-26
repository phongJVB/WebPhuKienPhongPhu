<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";

    public function bill_detail(){
    	return $this->hasMany('App\Model\OrderProduct','orders_id','id');
    }

    public function customer(){
    	return $this->belongsTo('App\Model\Customer','customers_id','id');
    }
}
