<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SellerProductController extends Controller
{
    public function filter() {
        $products = QueryBuilder::for(User::class)
            ->allowedFilters([
                AllowedFilter::exact('title')->ignore(null),
                AllowedFilter::exact('description')->ignore(null),
            ])
            ->get();
        return view('Seller.SellerProduct.SellerProductsData', ['products' => $products]);
    }
    public function index()
    {
        $id = auth()->user()->id;
        $products = Product::where('user_id' , $id)->get();
        return view('Seller.SellerProducts.SellerProductsData', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        return view('Seller.SellerProducts.AddSellerProducts',['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        Product::create([
            'user_id' => $request->seller,
            'title' => $request->product_name,
            'price' => $request->price,
            'inventory' => $request->amount_available,
            'description' => $request->explanation,
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
        return view('Seller.SellerProducts.showproduct',['product'=>$product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $products = Product::where('id',$id)->get()->first();

        return view('Seller.SellerProducts.EditSellerProducts',['products'=> $products]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Product::where('id', $id)->update([
            'title' => $request->product_name,
            'price' => $request->price,
            'inventory' => $request->amount_available,
            'description' => $request->explanation,
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
