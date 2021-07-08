<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Attendance;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class AdminPeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $transaksi = Transaksi::where('bukti_bayar','!=',null)->get();
        $alat = Alat::all();
        return view('admin.peminjaman.index',compact('transaksi','alat'));
    }
    public function show($transaksId)
    {
        $transaksi = Transaksi::find($transaksId);
        $peminjaman = Peminjaman::where('transaksi_id',$transaksId);
        $adminPinjam = Peminjaman::where('transaksi_id',$transaksId)->first();
        $pengembalian = Pengembalian::where('transaksi_id',$transaksId);
        $adminKembali = Pengembalian::where('transaksi_id',$transaksId)->first();
        return view('admin.peminjaman.show',compact('transaksi','peminjaman','pengembalian','adminPinjam','adminKembali'));
    }
    public function konfirmasi(Request $request)
    {   
        $transaksi = Transaksi::find($request->transaksi_id);
        $transaksi->update(['status_pinjam' => $request->status]);
        $peminjaman = Peminjaman::where('transaksi_id', $request->transaksi_id);
        if(count($peminjaman->get()) > 0 ){
            $peminjaman->update([
                'keterangan' => $request->keterangan,
                'admin_id' => $this->authUser()->id,
            ]);
        }
        return redirect()->back()->with('success','Peminjaman berhasil dikonfirmasi');
    }
    public function delete($id)
    {
        Transaksi::find($id)->delete();
        return redirect()->back()->with('success','Transaksi berhasi dihapus');
    }
}
