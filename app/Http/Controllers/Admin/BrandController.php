<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $merks = Brand::all();
        return view('admin.merk.index',compact('merks'));
    }
    public function show($id)
    {
        $merk = Brand::find($id);
        return view('admin.merk.show',compact('merk'));
    }
    public function create()
    {
        return view('admin.merk.create');
    }
    public function edit($id)
    {
        $merk = Brand::find($id);
        return view('admin.merk.edit',compact('merk'));
    }
    public function delete($id)
    {
        $merk = Brand::find($id)->delete();
        return redirect()->back()->with('success','Berhasil dihapus');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'unique:brands',
        ]);
        $data['name'] = $request->name;
        $data['description'] = $request->description;
        $merk = Brand::create($data);
        return redirect(route('admin.merk.index'))->with('success','Berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'unique:brands,name,'.$request->id,
        ]);
        $merk = Brand::find($request->id);
        $data['name'] = $request->name;
        $data['description'] = $request->description;
        $merk->update($data);
        return redirect(route('admin.merk.index'))->with('success','Berhasil diubah');
    }
}
