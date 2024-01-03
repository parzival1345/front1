<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest\StoreAdminOrderRequest;
use App\Http\Requests\AdminRequest\UpdateAdminOrderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AdminOrderController extends Controller
{
    public function filter() {
        $products = QueryBuilder::for(User::class)
            ->allowedFilters([
                AllowedFilter::exact('title')->ignore(null),
                AllowedFilter::exact('total_price')->ignore(null),
            ])
            ->get();
        return view('Admin.MainProducts.productsData', ['products' => $products]);
    }
    public function index() {
        $orders = Order::all();
        return view('Admin.MainOrders.ordersData', ['orders' => $orders]);
    }
    public function create() {
        $users = User::all();
        $products_available = Product::all();
        return view('Admin\MainOrders\addOrder' , ['users' => $users , 'products_available' => $products_available]);
    }
    public function store(StoreAdminOrderRequest $request) {
        $total_price = 0;
        Order::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'total_price' => $total_price,
            'created_at' => date('Y-m-d H:i:s'),

        ]);
        foreach ($request->all() as $key => $product_count) {

            if (Str::is('Product*', $key)) {

                $product_id = substr($key, -1);
                $products = Product::where('id', $product_id)->first();
                $total_price += $products->price * $product_count;

                $last_order_id = Order::select('id')->get()->max('id');
                if ($last_order_id == null) {
                    $last_order_id = 1;
                }

                $order = Order::find($last_order_id);
                $order->products()->attach($product_id, ['count' => $product_count]);
            }
        }

        Order::where('id', $last_order_id)->update([
            'total_price' => $total_price,
        ]);

        return redirect('/admin/orders');
    }
    public function edit($id) {
            $order = Order::find($id)->first();
            $user = User::find($order->user_id)->first();
            $order_products = $order->products()->where('order_id',$id)->get();

            $products = Product::all();
            $orders = Order::all();
            return view('Admin.MainOrder.editOrderMenue',['order_products' => $order_products, 'user' => $user , 'products' => $products , 'orders' => $orders]);
    }

    public function update(UpdateAdminOrderRequest $request , $id) {
        $total_price = 0;
        $order = Order::find($id);
        $flage = true;
        foreach ($request->all() as $key => $product_count) {

            if (Str::is('Product*', $key)) {

                $product_id = substr($key, -1);

//                $order_products = $order->products()->where(['order_id' => $id, 'product_id' => $product_id])->first();

                $products = Product::where('id', $product_id)->first();
                $total_price += $products->price * $product_count;

                if ($flage == true) {

                    $order->products()->sync([$product_id => ['count' => $product_count]]);
                    $flage = false;

                } else{
                    $order->products()->attach($product_id, ['count' => $product_count]);
                }

            }
        }

        Order::find($id)->update([
            'total_price' => $total_price,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect('/admin/orders');
    }

    public function destroy($id) {
        Order::find($id)->delete();
        return redirect('/admin/orders');
    }
}
