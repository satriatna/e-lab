<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Attendance;
use App\Models\Pengembalian;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class PengembalianController extends Controller
{
    public function store(Request $request)
    {
        $alat = Alat::whereIn('id',$request->alat_id)->get();
        foreach($alat as $a)
        {
            foreach($request->jumlah as $key => $jumlah){
                if($a->stok < $jumlah)
                {
                    return redirect()->back()->with('alert','stok alat '. $a->nama. ' tidak mencukupi');
                }
            }
        }
        Transaksi::find($request->transaksi_id)->update(['status' => 'return_pending']);
        foreach($alat as $key => $al)
        {
            Pengembalian::create([
                'transaksi_id' => $request->transaksi_id,
                'alat_id' => $al->id,
                'jumlah' => $request->jumlah[$key],
                'keterangan' => $request->keterangan[$key],
            ]);
        }
        return redirect()->back()->with('success','Berhasil mengembalikan alat');
    }
}
