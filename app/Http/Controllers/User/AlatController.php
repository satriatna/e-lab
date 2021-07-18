<?php

namespace App\Http\Controllers\User;

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
        return view('user.alat.index',compact('jenis'));
    }
    public function indexAlat($jenisId)
    {
        $alat = Alat::where('jenis_id',$jenisId)->get();
        return view('user.alat.index-alat',compact('alat','jenisId'));
    }
  
    public function show($id)
    {
        $alat = Alat::find($id);    
        return view('user.alat.show',compact('alat'));
    }
}
