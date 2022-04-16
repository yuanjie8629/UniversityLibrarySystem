<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
   public function handle($request, Closure $next, $guard = null)
   {
      if (Auth::guard($guard)->check()) {
         $role = Auth::user()->role;

         switch ($role) {
            case 'ADMIN':
               return redirect('/manage-books');
               break;
            case 'STUDENT':
               return redirect('/home');
               break;
            case 'LECTURER':
               return redirect('/home');
               break;
            default:
               return redirect('/home');
               break;
         }
      }
      return $next($request);
   }
}
