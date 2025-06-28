<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'captcha' => 'required|captcha',
        ]);

        // Cek apakah email ada di tabel users
        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan'])->withInput($request->only('email', 'remember'));
        }

        // Coba login dengan guard web (satu guard untuk semua)
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $request->filled('remember'))) {
            
            // Redirect berdasarkan role
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } else {
                return redirect()->intended('/home');
            }
        }

        // Jika gagal login
        return back()->withErrors(['email' => 'Email atau password salah'])->withInput($request->only('email', 'remember'));
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img('flat')]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}
