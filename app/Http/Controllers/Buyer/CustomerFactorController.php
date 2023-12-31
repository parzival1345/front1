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
        $checks = Factor::find($id);
//        dd($checks);
        return view('Customer/CustomerFactor/CustomerDataFactor', ['checks' => $checks]);
    }
    public function create(){
        $id = auth()->user()->id;
        $orders = Order::find($id);
        return view('Customer/CustomerFactor/CustomerAddFactor' , ['orders' => $orders]);
    }
    public function store(Request $request)
    {
        Factor::create([
            'factor_id' => $request->order_id,
            'finally_price' => $request->total_pay,
            'created_at'=>date('Y-m-d H:i:s'),
        ]);
        return redirect('/customer/factor');
    }
    public function update_status($id) {
        $status = Factor::findOrfail($id);
        $status->update(['status' => 'پرداخت شده']);
        return redirect('/customer/factor');
    }
}
