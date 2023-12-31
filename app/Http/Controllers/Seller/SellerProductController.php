<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class SellerProductController extends Controller
{
    public function index()
    {
        $id = auth()->user()->id;
        $products = Product::where('user_id',$id)->get();
        return view('Seller.products.productsData', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $id = auth()->user()->id;
        $user = User::find($id);
//        $categories = Category::all();
        return view('Seller.products.addProduct',['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Product::create([
            'user_id' => $request->seller,
            'category_id' =>$request->category,
            'title' => $request->title,
            'price' => $request->price,
            'inventory' => $request->inventory,
            'sold_number' => $request->sold_number,
            'discription' => $request->discription,
            'image_address' =>$request->image_address,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect('/seller/products');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        return view('Seller.products.showproduct',['product'=>$product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::where('id',$id)->get()->first();

        return view('Seller.products.editProductMenue',['product'=> $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Product::where('id', $id)->update([
            'title' => $request->title,
            'price' => $request->price,
            'inventory' => $request->inventory,
            'sold_number' => $request->sold_number,
            'discription' => $request->discription,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        return redirect('/seller/products');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::where('id', $id)->delete();
        return redirect('/seller/products');
    }

}
