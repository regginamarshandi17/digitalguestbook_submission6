<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function attemptLogin(Request $request)
{
    return $this->guard()->attempt(
        $this->credentials($request),
        $request->filled('remember'),
        true, // <-- Tambahkan parameter "true" untuk menyertakan role dalam percobaan login
    );
}

protected function authenticated(Request $request, $user)
{
    // Akses role yang telah disertakan pada saat login
    $role = $request->input('role');

    if ($role === 'admin') {
        return redirect()->intended('/admin/dashboard');
    } elseif ($role === 'tamu') {
        return redirect()->intended('/tamu/dashboard');
    }

    // Redirect ke halaman default jika tidak ada role yang sesuai
    return redirect()->intended('/');
}
}
