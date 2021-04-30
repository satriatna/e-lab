<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class JenisController extends Controller
{
    public function index()
    {
        $jenis = Jenis::all();
        return view('admin.jenis.index',compact('jenis'));
    }
    public function show($id)
    {
        $jenis = Jenis::find($id);
        return view('admin.jenis.show',compact('jenis'));
    }
    public function create()
    {
        return view('admin.jenis.create');
    }
    public function edit($id)
    {
        $jenis = Jenis::find($id);
        return view('admin.jenis.edit',compact('jenis'));
    }
    public function delete($id)
    {
        $jenis = Jenis::find($id)->delete();
        return redirect()->back()->with('success','Berhasil dihapus');
    }
    public function store(Request $request)
    {
        $data['photo'] = null;
        if($request->photo != null){
            $photo = $request->file('photo');
            $size = $photo->getSize();
            $namePhoto = time() . "_" . $photo->getClientOriginalName();
            $path = 'images';
            $photo->move($path, $namePhoto);
            $request['photo'] =  $namePhoto;
            $data['photo'] = $namePhoto;
        }
        $data['nama'] = $request->nama;
        $jenis = Jenis::create($data);
        return redirect(route('admin.jenis.index'))->with('success','Berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        $jenis = Jenis::find($request->id);
        $data['photo'] = null;
        if($request->photo != null){
            $imgWillDelete = public_path() . '/images/'.$jenis->photo;
            File::delete($imgWillDelete);

            $photo = $request->file('photo');
            $size = $photo->getSize();
            $namePhoto = time() . "_" . $photo->getClientOriginalName();
            $path = 'images';
            $photo->move($path, $namePhoto);
            $data['photo'] =  $namePhoto;
        }
        $data['nama'] = $request->nama;
        $jenis->update($data);
        return redirect(route('admin.jenis.index'))->with('success','Berhasil diubah');
    }
}
