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
        $transaksi = Transaksi::find($request->transaksi_id);
        $transaksi->update(['status' => 'return_pending']);
        foreach($alat as $key => $al)
        {
            Pengembalian::create([
                'transaksi_id' => $request->transaksi_id,
                'alat_id' => $al->id,
                'jumlah' => $request->jumlah[$key],
                'keterangan' => $request->keterangan[$key],
                'created_at' => $transaksi->dari_tanggal,
            ]);
        }
        return redirect()->back()->with('success','Berhasil mengembalikan alat');
    }
}
