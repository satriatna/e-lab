<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ForgotPassword;
use App\Models\User;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        $forgot = ForgotPassword::all();
        return view('admin.forgot-password.index',compact('forgot'));
    }
    public function delete($id)
    {
        $jenis = ForgotPassword::find($id)->delete();
        return redirect()->back()->with('success','Permintaan berhasil dihapus');
    }
    public function update(Request $request)
    {
        $forgot = ForgotPassword::find($request->id);
        $user = User::where('username',$forgot->username)->first();
        User::where('username',$forgot->username)->update([
            'password'=> bcrypt($user->username)
        ]);
        $forgot = ForgotPassword::where('username', $request->username)->delete();
        return redirect()->back()->with('success','Permintaan berhasil dikonfirmasi');
    }
}
