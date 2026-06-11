<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Checking weather The user role is user(customer) or not.
        if (auth()->check()) {

            if (auth()->user()->role == 'user') {

                return $next($request);
            }
            //    If it isn't a user(customer) then redirect to particular page based on their role.
            else if (auth()->user()->role == 'admin') {

                return to_route('admin.home');
            } else if (auth()->user()->role == 'deliver') {

                return to_route('deliver.home');
            } else if (auth()->user()->role == 'supplier') {

                return to_route('supplier.home');
            } else if (auth()->user()->role == 'cashier') {

                return to_route('cashier.home');
            } else if (auth()->user()->role == 'product_manager') {

                return to_route('productManager.home');
            } else if (auth()->user()->role == 'stock_keeper') {

                return to_route('stockKeeper.home');
            }
        }
        return to_route('front_office.home');
    }
}
