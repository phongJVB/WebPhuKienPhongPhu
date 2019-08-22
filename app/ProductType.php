<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $table = "type_products";
 
    /**
     * Description: Tạo liên kết với bảng Product: Quan hệ 1-n
     * id_type: Khóa ngoại ở bảng Product
     * id: Là khóa của bảng type_products
     */
    public function product(){
    	return $this->hasMany('App\Product','id_type','id');
    }
}
