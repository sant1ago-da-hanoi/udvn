<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Languague {
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse {
        if ($request->has('lang')) {
            $lang = $request->lang;
            app()->setLocale($lang);
            $response = $next($request);
            return $response->withCookie(cookie()->forever('lang', $lang));
        } else {
            $lang = $request->cookie('lang', 'vi');
            app()->setLocale($lang);
            return $next($request);
        }
    }
}
