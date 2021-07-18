<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id','DESC')->get();
        return view('admin.user.index',compact('users'));
    }
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.user.show',compact('user'));
    }
    public function create()
    {
        return view('admin.user.create');
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit',compact('user'));
    }
    public function delete($id)
    {
        $user = User::find($id)->delete();
        return redirect()->back()->with('success','Berhasil dihapus');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'unique:user',
        ]);
        $user = User::create($request->all());
        return redirect(route('admin.user.index'))->with('success','Berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'username' => 'unique:user,username,'.$request->id,
        ]);
        $user = User::find($request->id);
        if($request->password != null){
            $request['password'] = $request->password;
        }else{
            $request['password'] = $user->password;
        }
        $user->update($request->all());
        return redirect(route('admin.user.index'))->with('success','Berhasil diubah');
    }
}
