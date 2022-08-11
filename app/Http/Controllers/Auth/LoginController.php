<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;

class LoginController extends Controller {
    public function login(): Factory|View|Application {
        return view('login');
    }

    public function postLogin(LoginRequest $request): RedirectResponse {
        $credentials = $request->except('_token');

        try {
            if (Sentinel::authenticate($credentials)) {
                $request->session()->regenerate();

                return redirect()->intended(route('dashboard'));
            } else {
                $msg = 'The provided credentials do not match our records.';
            }
        } catch (NotActivatedException $th) {
            $msg = 'The user is not activated';
        } catch (ThrottlingException $th) {
            $msg = 'The user is banded in ' . round($th->getDelay() / 60) . ' minute';
        }

        return back()->withErrors([
            'email' => $msg,
        ])->onlyInput('email');
    }
}
