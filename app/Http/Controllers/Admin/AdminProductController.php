<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\User;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use CodeIgniter\Database\OCI8\Builder;


class AdminProductController extends Controller
{
    public function filter()
    {
        $products = QueryBuilder::for(User::class)
            ->allowedFilters([
                AllowedFilter::exact('title')->ignore(null),
                AllowedFilter::exact('description')->ignore(null),
            ])
            ->get();
        return view('Admin.MainProducts.productsData', ['products' => $products]);
    }
    public function index() {
        $role = auth()->user()->role;
        $products = Product::all();
        return view('Admin.MainProducts.productsData', ['products' => $products , 'role' => $role]);
    }

    public function create() {
        return view('Admin.MainProducts.addProduct');
    }

    public function store(StoreProductRequest $request) {
        Product::create([
            'title'=>$request->product_name,
            'price'=>$request->price,
            'inventory'=>$request->amount_available,
            'description'=>$request->explanation,
            'created_at'=>date('Y-m-d H:i:s'),
        ]);
        return redirect('/admin/products');
    }

    public function edit($id) {
        $products = Product::find($id);
        return view('Admin.MainProducts.editProductMenue' , ['products' => $products]);
    }

    public function update(UpdateProductRequest $request, $id) {
        Product::find($id)->update([
            'title'=>$request->product_name,
            'price'=>$request->price,
            'inventory'=>$request->amount_available,
            'description'=>$request->explanation,
        ]);
        return redirect('/admin/products');
    }

    public function destroy($id) {
        Product::find($id)->delete();
        return redirect('/admin/products');
    }
}
