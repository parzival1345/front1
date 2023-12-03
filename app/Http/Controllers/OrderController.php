<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        $orders = DB::table('users')
            ->join('orders','users.id','=','orders.user_id')->get();
        $products = DB::table('products')->get();
        $order_products = DB::table('order_products')->get();
        return view('orders.ordersData', ['orders' => $orders,'products' => $products,'order_products'=>$order_products]);

    }
    public function create()
    {
        $users = DB::table('users')->get();
        $products_available = DB::table('products')->get();
    return view('orders.addOrder',['users' => $users, 'products_available' => $products_available]);
    }
    public function store(Request $request)
    {

        $total_price = 0;

        foreach ($request->all() as $key => $product_count) {

            if (Str::is('Product*', $key)) {
                for ($i = 0; $i < $product_count; $i += 1) {
                    $product_id = substr($key, -1);
                    $products =  DB::table('products')->where('id', $product_id)->first();
                    $total_price += $products->price;
                    //پایان عملیات گام اول

                    //گام دوم : وارد کردن نام محصولات به جدول پیوت
                    $order_count = DB::table('orders')->select('id')->get();

                    if (isset($order_count->id)) {
                        $last_order_id = (DB::table("orders")->orderBy('id', 'desc')->first()->id) + 1;
                    } else {
                        $last_order_id = 1;
                    }
                    DB::table('order_products')->insert([
                        'order_id' => $last_order_id,
                        'product_id' => $product_id,
                    ]);
                    //پایان گام دوم
                }
                //گام سوم : تعیین مجدد موجودی درون جدول محصولات

                $product_inventory = ($products->inventory - $product_count);
                $product_sold_number = ($products->sold_number + $product_count);

                DB::table('products')->where('id', $product_id)->update([
                    'inventory' => $product_inventory,
                    'sold_number' => $product_sold_number,
                ]);
                //پایان گام سوم
            }
        }


        DB::table('orders')->insert([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'total_price' => $total_price,
            'created_at' => date('Y-m-d H:i:s'),

        ]);


        return redirect('/orders');
    }
    public function edit($id)
    {
        $order = DB::table('orders')->where('id',$id)->first();
        $user =DB::table('users')->where('id',$id)->first();
        $product =DB::table('products')->where('id',$id)->first();

        $products = DB::table('products')->get();
        $order_products = DB::table('order_products')->get();

        return view('orders.editOrderMenue', ['order' => $order , 'user' => $user, 'product' => $product, 'products' => $products, 'order_products' => $order_products]);
    }
    public function update(Request $request,$id )
    {
        $total_price = 0;
        $title = DB::table('orders')->where('id',$id)->first()->title;
        foreach ($request->all() as $key => $product_count) {

            if (Str::is('Product*', $key)) {
                for ($i = 0; $i < $product_count; $i++) {
                    $product_id = substr($key, -1);
                    $products = DB::table('products')->where('id', $product_id)->first();
                    $total_price += ($products->price);
//                $product_sold_number = ($products['sold_number'] + $product_count);
                    if (isset($order_count->id)) {
                        $last_order_id = (DB::table("orders")->orderBy('id', 'desc')->first()->id) + 1;
                    } else {
                        $last_order_id = 1;
                    }
                    DB::table('order_products')->insert([
                        'order_id' => $last_order_id,
                        'product_id' => $product_id,
                    ]);
                }

                $product_inventory = ($products->inventory - $product_count);
                DB::table('products')->where('id', $product_id)->update([
                    'inventory' => $product_inventory,
                ]);
            }
        }
        DB::table('orders')->insert([
            'user_id' => $request->user_id,
            'title' => $title,
            'total_price' => $total_price,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        return redirect('/orders');
    }
    public function destroy($id)
    {
        DB::table('orders')->where('id' , $id)->update(['status' => 'disable']);
        return redirect('/orders');
    }
}
