<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Order_product;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isNull;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('products')->with('user')->get();
        return view('orders.ordersData', ['orders' => $orders]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $products_available = Product::all();
        return view('orders.addOrder', ['users' => $users, 'products_available' => $products_available]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        //گام اول : محسابه قیمت نهایی
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
                //پایان عملیات گام اول

                //گام دوم : وارد کردن نام محصولات به جدول پیوت
                $last_order_id = Order::select('id')->get()->max('id');
                if ($last_order_id == null) {
                    $last_order_id = 1;
                }


                Order_product::create([
                    'order_id' => $last_order_id,
                    'product_id' => $product_id,
                    'count' => $product_count,
                ]);
            }
        }


        Order::where('id', $last_order_id)->update([
            'total_price' => $total_price,
            'created_at' => date('Y-m-d H:i:s'),

        ]);


        return redirect('/orders');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order_count = Order::all()->count();
        return view('workplace', ['order_count' => $order_count]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $order = Order::find($id)->first();
        $user = User::find($order->user_id)->first();
        $product_id = [];
        $orderProducts = Order_product::all();
        foreach ($orderProducts as $orderProduct){
            if ($orderProduct->order_id == $id){
                array_push($product_id, $orderProduct->product_id);
            }
        }
        // برای بدست اوردن تعداد
        $pro_count = Order_product::join('products', 'order_product.product_id', '=', 'products.id')->where('order_product.order_id' , $id)->get();
        //---- -//
        $products = Product::whereIn('id',$product_id)->get();
        $orders = Order::all();
        return view('orders.editOrderMenue', ['order_product' => $orderProducts, 'products' => $products,  'user' => $user, 'orders' => $orders, 'id' => $id, 'pro_count' => $pro_count]);
    }


    public function update(UpdateOrderRequest $request, string $id)
    {
        $total_price = 0;
        $products_id = [];

        foreach ($request->all() as $key => $product_count) {
            if (Str::is('Product*', $key)) {

                    $product_id = substr($key, -1);
                    array_push($products_id,$product_id);
                    $order_products = Order_product::where(['order_id' => $id, 'product_id' => $product_id])->get()->first();

                    if ($order_products->count != $product_count) {

                        $products = Product::where('id', $product_id)->get()->first();
                        $total_price += $products->price * $product_count;
                        //پایان عملیات گام اول

//                        Order_product::where(['order_id' => $id,'product_id' => $order_products->product_id])->update([
//                            'count' => $product_count,
//                        ]);
                    }else{
                        $products = Product::where('id', $product_id)->first();
                        $total_price += $products->price * $product_count;
                    }

            }
        }
        $order = Order::find($id);
        $order->products()->sync($products_id);

        Order::where('id',$id)->update([
            'total_price' => $total_price,
        ]);


        return redirect('/orders');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Order::destroy($id);
        return redirect('/orders');
    }
}
