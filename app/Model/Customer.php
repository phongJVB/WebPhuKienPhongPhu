<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customer";

    public function bill(){
    	return $this->belongsTo('App\Bill','id_customer','id');
    }
}
