<?php

namespace App;

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
    	return $this->belongsTo('App\Category','id_cate','id');
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
