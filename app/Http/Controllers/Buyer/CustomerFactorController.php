<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Factor;
use App\Models\Order;
use Illuminate\Http\Request;

class CustomerFactorController extends Controller
{
    public function index()
    {
        $id = auth()->user()->id;
//        dd($id);
        $checks = Factor::where('id' , $id)->get();
        return view('Customer/CustomerFactor/CustomerDataFactor', ['checks' => $checks]);
    }
    public function create($id){
        $order = Order::where('id' , $id)->first();
        return view('Customer/CustomerFactor/CustomerAddFactor' , ['order' => $order]);
    }
    public function store(Request $request)
    {
        Factor::create([
            'user_id' => $request->user_id,
            'order_id' => $request->order_id,
            'finally_price' => $request->total_pay,
            'created_at'=>date('Y-m-d H:i:s'),
        ]);
        return redirect('/customer/factors');
    }
    public function update_status($id) {
        $status = Factor::findOrfail($id);
        $status->update(['status' => 'پرداخت شده']);
        return redirect('/customer/factors');
    }
}
