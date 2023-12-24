<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
        return view('products.addProduct');
    }
    public function index()
    {
        $products = Product::all();
        return view('products.productsData' , ['products' => $products]);
    }
    public function edit($id)
    {
        $products =  Product::find($id);
        return view('products.editProductMenue', ['products' => $products]);
    }
    public function store(StoreProductRequest $request)
    {
        Product::create([
            'title'=>$request->product_name,
            'price'=>$request->price,
            'inventory'=>$request->amount_available,
            'description'=>$request->explanation,
            'created_at'=>date('Y-m-d H:i:s'),
        ]);
        return redirect('/products');
    }

    public function update(UpdateProductRequest $request,$id )
    {
        Product::find($id)->update([
            'title'=>$request->product_name,
            'price'=>$request->price,
            'inventory'=>$request->amount_available,
            'description'=>$request->explanation,
        ]);
        return redirect('/products');
    }
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect('/products');
    }

    public function show() {
        $product_count = Product::count();
        return view('workplace', ['product_count' => $product_count]);
    }
}

