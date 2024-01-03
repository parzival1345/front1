<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest\StoreAdminFactorRequest;
use App\Http\Requests\AdminRequest\UpdateAdminFactorRequest;
use App\Models\Factor;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminFactorController extends Controller
{
    public function index() {
        $checks = Factor::all();
        return view('Admin.MainFactors.checksData', ['checks' => $checks]);
    }

    public function create() {
        $orders = Order::all();
        return view('Admin.MainFactors.addCheck',['orders' => $orders]);
    }
    public function store(StoreAdminFactorRequest $request) {
        Factor::create([
            'order_id' => $request->order_id,
            'finally_price' => $request->total_pay,
            'created_at'=>date('Y-m-d H:i:s'),
        ]);
        return redirect('/admin/factors');
    }

    public function edit($id) {
        $orders = Order::all();
        $check = Factor::find($id);
        return view('Admin.MainFactors.editCheckMenue',['check' => $check, 'orders' => $orders]);
    }
    public function update(UpdateAdminFactorRequest $request, $id) {
        Factor::find($id)->update([
            'order_id' => $request->order_id,
            'finally_price' => $request->total_pay,
            'status' => $request->status,
        ]);
        return redirect('/admin/factors');
    }

    public function destroy($id) {
        Factor::find($id)->delete();
        return redirect('/admin/factors');
    }

    public function update_status($id) {
        $status = Factor::findOrfail($id);
        $status->update(['status' => 'پرداخت شده']);
        return redirect('/admin/factors');
    }
}
