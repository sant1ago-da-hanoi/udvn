<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Hashing\BcryptHasher;

class UserPermission {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) {
        Sentinel::setHasher(new BcryptHasher());

        $user = Sentinel::check();

        if (!$user) {
            return redirect()->guest('login');
        }

        #This Is Admin User?
        $roles = Sentinel::getRoles()->pluck('slug')->all();

        if (is_array($roles)) {
            if (in_array('admin', $roles)) {
                return $next($request);
            }
        }

        #Check Access When User Is Not Admin
        if ($user->inRole($roles)) {
            return $next($request);
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response(trans('backpack::base.unauthorized'), 401);
        }

        return abort(404, 'Unauthorized action.');
    }
}
