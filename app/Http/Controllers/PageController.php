<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    function getHome(){
    	return view('pages.home');
    }

    function getProductType(){
    	return view('pages.productType');
    }

    function getProduct(){
    	return view('pages.product');
    }

    function getAbout(){
    	return view('pages.about');
    }

    function getContact(){
    	return view('pages.contact');
    }


}
