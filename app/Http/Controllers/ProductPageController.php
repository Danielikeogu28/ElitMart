<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductPageController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('pages.home', compact('products'));
    }

    public function show(string $id)
    {
       
        $product = Product::findOrFail($id);
        return view('pages.product-details', compact('product'));
    }

    public function about(){
        return view('pages.about');
    }

    public function service(){
        return view('pages.service');
    }

    public function shop(){
        return view('pages.shop');
    }

    public function portfolio(){
        return view('pages.portfolio');
    }

    public function blog(){
        return view('pages.blog');
    }
}
