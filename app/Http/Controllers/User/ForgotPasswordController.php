<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ForgotPassword;
use App\Models\User;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class ForgotPasswordController extends Controller
{
    public function forgot()
    {
        return view('user.forgot-password.index');
    }
    public function forgotPassword(Request $request)
    {
        $cek = User::where('username', $request->username)->count();
        if($cek == 0){
            return redirect()->back()->with('alert', 'Username tidak ditemukan'); 
        }
        ForgotPassword::create([
            'username'=>$request->username,
        ]);
        return redirect()->back()->with('success', 'Permintaan berhasil dikirim');
    }
}
