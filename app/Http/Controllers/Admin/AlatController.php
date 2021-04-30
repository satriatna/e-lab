<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use function GuzzleHttp\Promise\all;

class AlatController extends Controller
{
    public function index()
    {
        $jenis = Jenis::all();
        return view('admin.alat.index',compact('jenis'));
    }
    public function indexAlat($jenisId)
    {
        $alat = Alat::where('jenis_id',$jenisId)->get();
        return view('admin.alat.index-alat',compact('alat','jenisId'));
    }
  
    public function show($id)
    {
        $alat = Alat::find($id);    
        return view('admin.alat.show',compact('alat'));
    }
    public function edit($id)
    {
        $alat = Alat::find($id);    
        $jenis = Jenis::all();
        return view('admin.alat.edit',compact('alat','jenis'));
    }
    public function create($jenisId)
    {
        $jenis = Jenis::all();
        return view('admin.alat.create',compact('jenis','jenisId'));
    }
    public function delete($id)
    {
        $jenis = Alat::find($id)->delete();
        return redirect()->back()->with('success','Berhasil dihapus');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'unique:alat',
            'kode' => 'unique:alat',
        ]);
        $data['nama'] = $request->nama;
        $data['harga'] = $request->harga;
        $data['kode'] = $request->kode;
        $data['stok'] = $request->stok;
        $data['jenis_id'] = $request->jenis_id;
        
        if($request->photo != null){
            $photo = $request->file('photo');
            $size = $photo->getSize();
            $namePhoto = time() . "_" . $photo->getClientOriginalName();
            $path = 'images';
            $photo->move($path, $namePhoto);
            $data['photo'] =  $namePhoto;
        }
        $alat = Alat::create($data);
        return redirect(route('admin.alat.index'))->with('success','Berhasil ditambahkan');
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'nama' => 'unique:alat,nama,'.$request->id,
            'kode' => 'unique:alat,kode,'.$request->id,
        ]);
        $alat = Alat::find($request->id);
        $data['nama'] = $request->nama;
        $data['harga'] = $request->harga;
        $data['kode'] = $request->kode;
        $data['stok'] = $request->stok;
        $data['jenis_id'] = $request->jenis_id;
        
        if($request->photo != null){
            $imgWillDelete = public_path() . '/images/'.$alat->photo;
            File::delete($imgWillDelete);

            $photo = $request->file('photo');
            $size = $photo->getSize();
            $namePhoto = time() . "_" . $photo->getClientOriginalName();
            $path = 'images';
            $photo->move($path, $namePhoto);
            $data['photo'] =  $namePhoto;
        }
        $alat->update($data);
        return redirect(route('admin.alat.indexAlat', $request->jenis_id))->with('success','Berhasil diubah');
    }
    public function pinjam(Request $request)
    {
        dd($request->all());
    }
}
