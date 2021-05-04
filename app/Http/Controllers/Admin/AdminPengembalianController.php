<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengembalian;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use PDF;
class AdminPengembalianController extends Controller
{
    public function konfirmasi(Request $request)
    {   
        $transaksi = Transaksi::find($request->transaksi_id);
        $transaksi->update(['status' => $request->status]);
        $pengembalian = Pengembalian::where('transaksi_id', $request->transaksi_id);
        if(count($pengembalian->get()) > 0 ){
            $pengembalian->update([
                'keterangan' => $request->keterangan,
                'admin_id' => $this->authUser()->id,
            ]);
        }
        return redirect()->back()->with('success','Pengembalian berhasil dikonfirmasi');
    }
}
