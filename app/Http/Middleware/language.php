<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    { $user=Auth::user();
        $language=array_keys(config('app.languages'));
        if($request->hasHeader('lang') && in_array($request->header('lang'),$language)){
        app()->setlocale($request->header('lang'));
    }
    else{
        app()->setlocale($user->language->code);

    }
        return $next($request);
    }
}
