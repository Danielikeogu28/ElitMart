<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public $cart = [];

    public function __construct()
    {
        $this->cart = Session::get('cart', []);
    }
    
    
    public function cart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $this->cart[$product->id] = [
            'id' => $product->id,
            'image' => $product->image,
            'name' => $product->name,
            'price' => $product->price,
            'color' => $request->color,
            'qty' => $request->qty,
        ];
        $request->session()->put('cart', $this->cart);
        return response([
            'status' => 'ok',
            'message' => 'Product added to cart successfully',
            'cart_count' => count($this->cart),
        ]);
    }
    public function checkout()
    {
        $products = Session::get('cart', []);
        return view('pages.cart', compact('products'));
    }

    public function destroy($id)
    {
        $cartItems = $this->cart;
        unset($cartItems[$id]);
        Session::put('cart', $cartItems);
        
        notyf()->success('Product removed from Cart');
        return redirect()->back();
    }

    public function updateQty(Request $request)
    {
        $cartItems = $this->cart;
        $cartItems[$request->id]['qty'] = $request->qty;
        Session::put('cart', $cartItems);
         
        notyf()->success('Product quantity Updated');
        return response([
            'status'=> 'ok'
        ]);
    }
}
    