<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateForLogin
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
