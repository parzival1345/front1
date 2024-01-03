<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Factor;
use Illuminate\Http\Request;

class SellerFactorController extends Controller
{
    public function index() {

        $id = auth()->user()->id;
        $checks = Factor::find($id);

        return view('Seller/SellerFactor/SellerFactorData',['checks' => $checks]);
    }
}
