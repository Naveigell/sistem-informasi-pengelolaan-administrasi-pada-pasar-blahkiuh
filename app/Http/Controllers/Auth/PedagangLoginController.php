<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class PedagangLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/pedagang/dashboard';

    public function __construct()
    {
        $this->middleware('guest:pedagang')->except('logout')->except('index');
    }

    public function index(){
        return view('home');
    }

    public function showLoginForm()
    {
        return view('auth.login_pedagang');
    }

    protected function guard()
    {
        return Auth::guard('pedagang');
    }
}
