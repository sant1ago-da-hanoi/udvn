<?php

namespace App\Http\Controllers\Auth;

//use sentinel
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class RegisterController extends Controller {
    public function register() {
        return view('auth.register');
    }

    public function postRegister(Request $request) {
        $rules = [
            'name'              => 'required|max:255',
            'email'             => 'required|email|max:255|unique:users',
            'password'          => 'required|min:6',
            'password-confirm'  => 'required|same:password',
        ];
        $messages = [
            'name.required'                 => trans('form/register.name-required'),
            'name.max'                      => trans('form/register.name-max'),
            'email.required'                => trans('form/register.email-required'),
            'email.email'                   => trans('form/register.email-invalid'),
            'email.max'                     => trans('form/register.email-max'),
            'email.unique'                  => trans('form/register.email-unique'),
            'password.required'             => trans('form/register.password-required'),
            'password.min'                  => trans('form/register.password-min'),
            'password-confirm.required'     => trans('form/register.password-confirm-required'),
            'password-confirm.same'         => trans('form/register.password-same'),
        ];
        $this->validate($request, $rules, $messages);

        // dd($credentials);
        $user = Sentinel::registerAndActivate($request->except('_token'));
        $role = Sentinel::findRoleBySlug('user');
        $role->users()->attach($user);
        return redirect('/login')->with('success', 'You are registered and can now login');
    }
}
