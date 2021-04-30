<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Attendance;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use PDF;
class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $transaksi = Transaksi::where('user_id',$this->authUser()->id)->get();
        $alat = Alat::all();
        return view('user.peminjaman.index',compact('transaksi','alat'));
    }
    public function create(Request $request)
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

        $transaksi = Transaksi::insertGetId([
            'user_id' => $request->user_id,
            'status' => 'loan_pending',
            'created_at' => $request->created_at,
            'updated_at' => $request->created_at,
        ]);
        foreach($alat as $key => $al)
        {
            Peminjaman::create([
                'transaksi_id' => $transaksi,
                'alat_id' => $al->id,
                'jumlah' => $request->jumlah[$key],
                'keterangan' => $request->keterangan[$key],
            ]);
        }
        return redirect()->back()->with('success','Berhasil meminjam alat');
    }
    public function show($transaksId)
    {
        $transaksi = Transaksi::find($transaksId);
        $peminjaman = Peminjaman::where('transaksi_id',$transaksId);
        $adminPinjam = Peminjaman::where('transaksi_id',$transaksId)->first();
        $pengembalian = Pengembalian::where('transaksi_id',$transaksId);
        $adminKembali = Pengembalian::where('transaksi_id',$transaksId)->first();
        return view('user.peminjaman.show',compact('transaksi','peminjaman','pengembalian','adminPinjam','adminKembali'));
    }
    public function delete($id)
    {
        Transaksi::find($id)->delete();
        return redirect()->back()->with('success','Transaksi berhasi dihapus');
    }
    public function pdf(Request $request)
    {
        $dari = $request->dari;
        $ke = $request->ke;
        $tipe = $request->tipe;
        if($request->tipe == 'pinjam'){
            $laporan = Peminjaman::whereDate('created_at', '>=', $request->dari)->whereDate('created_at', '<=', $request->ke)->get();
        }else{
            $laporan = Pengembalian::whereDate('created_at', '>=', $request->dari)->whereDate('created_at', '<=', $request->ke)->get();
        }
        // return view('user.laporan.index', compact('laporan','dari','ke','tipe'));
    	$pdf = PDF::loadview('user.laporan.index',compact('laporan','dari','ke','tipe'));
        return $pdf->stream();
    }
}
