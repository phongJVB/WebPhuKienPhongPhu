<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.product.index');
    }

    public function create()
    {
        return view('admin.product.create');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('admin.product.edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

}
