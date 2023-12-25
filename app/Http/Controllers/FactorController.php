<?php

namespace App\Http\Controllers;

use App\Models\Factor;
use App\Models\Order;
use Illuminate\Http\Request;

class FactorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $checks = Factor::all();
        return view('factors.checksData',['checks' => $checks]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orders = Order::all();
        return view('factors.addCheck', ['orders' => $orders]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request);
        Factor::create([

            'factor_id' => $request->order_id,
            'finally_price' => $request->total_pay,
            'created_at'=>date('Y-m-d H:i:s'),
        ]);
        return redirect('/factors');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $orders = Order::all();
        $check = Factor::find($id);
        return view('factors.editCheckMenue',['check' => $check, 'orders' => $orders]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Factor::find($id)->update([
            'factor_id' => $request->order_id,
            'finally_price' => $request->total_pay,
            'status' => $request->status,
        ]);
        return redirect('/factors');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Factor::destroy($id);
        return redirect('/factors');
    }

    public function show() {
        $countFactor = Factor::all()->count();
        return view('workplace', ['countFactor' => $countFactor]);
    }

    public function update_status($id) {
        $status = Factor::findOrfail($id);
        $status->update(['status' => 'پرداخت شده']);
        return redirect('/factors');
    }
}
