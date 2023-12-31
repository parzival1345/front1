<?php

namespace App\Http\Middleware;

use Closure;
use http\Message;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SellerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // چک می‌کند که آیا کاربر حداقل یکی از نقش‌های مورد نیاز را دارد
        if (auth()->user()->role == 'seller' && auth()->user()->status == 'تایید شده') {
            return $next($request);
        }elseif (auth()->user()->role == 'seller' && auth()->user()->status == 'در انتظار تایید') {
            return redirect()->back()->with('message' , 'کاربری شما توسط ادمین تایید نشده است');
        }
        // اگر هیچ یک از نقش‌های مورد نیاز را نداشت، کاربر را به صفحه قبلی ریدایرکت می‌کند
        return redirect()->back();
    }
}
