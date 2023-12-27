<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OneMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // فرض بر این است که نقش‌های کاربر در یک آرایه ذخیره شده‌اند
        $userRoles = auth()->user()->role;

        // چک می‌کند که آیا کاربر حداقل یکی از نقش‌های مورد نیاز را دارد
        if (in_array($userRoles, $roles)) {
            return $next($request);
        }
        // اگر هیچ یک از نقش‌های مورد نیاز را نداشت، کاربر را به صفحه قبلی ریدایرکت می‌کند
        return redirect()->back();
    }
}
