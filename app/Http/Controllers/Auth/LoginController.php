<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::SHOP;

    protected function authenticated(Request $request, $user)
    {
        if ($user->role == 'admin') {
            return redirect()->intended('/app');
        } else {
            return redirect()->intended('/');
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
