<?php
use Illuminate\Support\Facades\Route;

//authorise//
    include __DIR__ . '/auth/authorise.php';
Route::middleware('auth:sanctum')->group(function () {
//workplace//
    include __DIR__ . '/workplace/workplace.php';
//Others_unusable_route
    include __DIR__ . '/others_Route/all.php';
//ADMIN//
    include __DIR__ . '/Admin/Filter/user_filter.php';
    include __DIR__ . '/Admin/Filter/product_filter.php';
    include __DIR__ . '/Admin/users.php';
    include __DIR__ . '/Admin/accept_&_reject_seller.php';
    include __DIR__ . '/Admin/products.php';
    include __DIR__ . '/Admin/orders.php';
    include __DIR__ . '/Admin/factors.php';
//CUSTOMER//
    include __DIR__ . '/Customer/orders.php';
    include __DIR__ . '/Customer/factors.php';
    include __DIR__ . '/Customer/Filter/order_filter.php';
//SELLER//
    include __DIR__ . '/Seller/orders.php';
    include __DIR__ . '/Seller/factors.php';
    include  __DIR__ . '/Seller/Filter/product_filter.php';

});
