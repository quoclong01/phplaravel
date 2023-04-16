<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact(['products']));
    }
    public function create()
    {
        return view('product.create');
    }
    public function edit($id)
    {
        return view('product.edit', ['id' => $id]);
    }
    public function store(Request $req)
    {
        $product = new Product;
        $product->price = $req->price;
        $product->save();
        // Product::create($product);
        return redirect()->route('product.index');
    }
    public function update(Request $req, $id)
    {
        $product = Product::find($id);
        $product->price = $req->price;
        $product->save();
        return redirect()->route('product.index');
    }
    public function delete($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return redirect()->route('product.index');
        }
    }
    public function getProductByCreater()
    {
        $userId = Auth::id();
        // $products = User::join('products', 'users.id', '=', 'products.creater_id')->where('users.id', $userId)->get();
        $users = User::with('products')->where('users.id', $userId)->first();
        $products = $users->products;
        foreach ($products as $product) {
            $price = $product->price;
        }
    }
}