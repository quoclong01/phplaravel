<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartDetail;

class CartController extends Controller
{
    //
    public function index()
    {
        $userId = Auth::id();
        // User::join('products', 'users.id', '=', 'products.creater_id')->where('users.id', $userId)->get();
        // $carts = Cart::join('cart_details', 'carts.id', '=', 'cart_details.cart_id')->where('user_id', $userId)->groupBy('carts.id')->get();
        $carts = Cart::with('cartDetails')->where('carts.user_id', $userId)->get();
        return $carts;
    }
    public function addToCarts(Request $req)
    {
        $cart = new Cart();
        $cart->user_id = Auth::id();
        $cart->title = $req->title;
        $cart->save();
        foreach ($req->product_id as $productId) {
            $cartDetail = new CartDetail();
            $cartDetail->product_id = $productId;
            $cartDetail->cart_id = $cart->id;
            $cartDetail->save();
        }
    }
}