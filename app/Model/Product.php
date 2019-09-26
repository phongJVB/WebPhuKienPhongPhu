<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    /**
     * Description: Tạo liên kết với bảng category
     * id_type: Khóa ngoại ở bảng Product
     * id: Là khóa của bảng Product ( vì 1 sản phẩm thuộc về loại sản phẩm)
     */
    public function category(){
    	return $this->belongsTo('App\Model\Category','categories_id','id');
    }

    /**
     * Description: Tạo liên kết với bảng OrderProduct
     * id_product: Khóa ngoại ở bảng OrderProduct
     * id: Là khóa của bảng Product
     */
    public function order_product(){
    	return $this->hasMany('App\Model\OrderPoduct','products_id','id');
    }
}
