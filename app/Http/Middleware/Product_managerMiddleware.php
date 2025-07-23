<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Product_managerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {

            if (auth()->user()->role == 'product_manager') {

                return $next($request);
            } else if (auth()->user()->role == 'admin') {

                return to_route('admin.home');
            } else if (auth()->user()->role == 'deliver') {

                return to_route('deliver.home');
            } else if (auth()->user()->role == 'front_office') {

                return to_route('front_office.home');
            } else if (auth()->user()->role == 'stock_keeper') {

                return to_route('stockKeeper.home');
            } else if (auth()->user()->role == 'cashier') {

                return to_route('cashier.home');
            }
        }
        return to_route('user.home');
    }
}
