<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeliverMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {

            if (auth()->user()->role == 'deliver') {

                return $next($request);
            } else if (auth()->user()->role == 'admin') {

                return to_route('admin.home');
            } else if (auth()->user()->role == 'front_office') {

                return to_route('front_office.home');
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
        return to_route('user.home');
    }
}
