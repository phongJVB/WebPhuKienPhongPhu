<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Order;
use App\Model\OrderProduct;
use App\Model\Product;
use App\Model\Stock;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productSale = DB::table('order_products')
                     ->select('products_id','products.name',DB::raw('SUM(products_quantity) AS total_sale_quantity'))
                     ->join('orders', 'orders.id', '=', 'order_products.orders_id')
                     ->join('products', 'products.id', '=', 'order_products.products_id')
                     ->where('orders.status', '<>', 3)
                     ->groupBy('products_id')
                     ->get();
         return view('admin.dashboard.index',compact('productSale'));
    }
}
