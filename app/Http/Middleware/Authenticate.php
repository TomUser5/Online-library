<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        $guards = $request->route()->gatherMiddleware();
    
        foreach ($guards as $guard) {
            if (Auth::guard('web')->check()) {
                if ($guard == 'admin') {
                    return redirect()->route('index');
                }
                return redirect()->route('index');
            }
        }
    
        if (!$request->expectsJson()) {
            return route('login');
        }
    
        return $request->expectsJson() ? null : route('login');
    }
}
