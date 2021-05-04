<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function loginForm()
    {
        if (Auth::guard(session()->get('role'))->user() != null) {
            return redirect()->route(session()->get('role') == 'admin' ? 'admin.dashboard.index' : session()->get('role') .'.dashboard.index');
        }

        return view('auth.login');
    }

    public function validator(Request $request)
    
    {

        $rules = [
            'username' => 'required|string|exists:' . $request->role . ',username',
            'password' => 'required|string',
            'role' => 'required|string'
        ];

        $messages = [
            'username.exists' => 'Identitas tersebut tidak cocok dengan data kami.',
        ];

        $request->validate($rules, $messages);
    }

    public function login(Request $request)
    {
        $this->validator($request);

        if (session()->has('role')) {
            Auth::guard(session()->get('role'))->logout();
            session()->flush('role');
        }

        if (Auth::guard($request->role)->attempt(['username' => $request->username, 'password' => $request->password], $request->filled('remember'))) {
            session()->put('role', $request->role);
            return redirect()
                ->intended(route($request->role == 'admin' ? 'admin.dashboard.index' : $request->role .'.dashboard.index'))
                ->with('status', 'Selamat datang!'); 
        }
        
        return redirect()->back()->with('error','Identitas tersebut tidak cocok dengan data kami.');
    }

    public function logout()
    {
        Auth::guard(session()->get('role'))->logout();
        session()->flush();
        return redirect('/')
            ->with('status', 'Anda telah keluar!');
    }

    public function registerForm()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $this->validate($request, [
            'username' => 'unique:user',
            'nip' => 'unique:user',
        ]);
        $request['password'] = bcrypt($request->password);
        User::create($request->all());
        return redirect(route('login'))->with('success','Pendaftaran berhasil');
    }
}
