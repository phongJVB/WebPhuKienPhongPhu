<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    /**
     * Description: Tạo liên kết với bảng ProductType
     * id_type: Khóa ngoại ở bảng Product
     * id: Là khóa của bảng Product ( vì 1 sản phẩm thuộc về loại sản phẩm)
     */
    public function product_type(){
    	return $this->belongsTo('App\ProductType','id_type','id');
    }

    /**
     * Description: Tạo liên kết với bảng BillDetail
     * id_product: Khóa ngoại ở bảng BillDetail
     * id: Là khóa của bảng Product
     */
    public function bill_detail(){
    	return $this->hasMany('App\BillDetail','id_product','id');
    }
}
