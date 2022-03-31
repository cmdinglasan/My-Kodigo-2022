<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Redirect;

class ConfirmAccount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $redirectToRoute
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|null
     */
    public function handle($request, Closure $next, $redirectToRoute = null)
    {
      if (! $request->user()->isConfirmed()) {
          return $request->expectsJson()
              ? abort(403, 'Your account is not yet confirmed.')
              : redirect(URL::route($redirectToRoute ?: 'verification.confirmation'));
      }

      return $next($request);
    }
}