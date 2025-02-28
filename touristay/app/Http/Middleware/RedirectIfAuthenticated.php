<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   // App\Http\Middleware\RedirectIfAuthenticated.php
public function handle($request, Closure $next, ...$guards)
{
    $guards = empty($guards) ? [null] : $guards;

    foreach ($guards as $guard) {
        if (Auth::guard($guard)->check()) {
            $user = Auth::user();
            
            if ($user->role_id == 2) {
                return redirect('/touriste/dashboard'); // Chemin URL direct
            } elseif ($user->role_id == 3) {
                return redirect('/proprietaire/dashboard');
            }
            
            // Redirection par défaut si aucun rôle spécifique
            return redirect(RouteServiceProvider::HOME);
        }
    }

    return $next($request);
}
}
