<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthVendorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If the user is authenticated with the 'vendor' guard
        if (Auth::guard('vendor')->check()) {

            return redirect()->route('vendor.home');

        } else if (Auth::guard('admin')->check()) {

            return redirect()->route('admin.home');

        }

        return $next($request);
    }
}
