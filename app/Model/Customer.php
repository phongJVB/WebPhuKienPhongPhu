<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customers";

    public function bill(){
    	return $this->hasMany('App\Model\Bill','customers_id','id');
    }
}
