<?php

namespace App\Http\Controllers\User;

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
        $jumlah = !$request->jumlah[0];
        $keterangan = !$request->keterangan[0];
        
        if($jumlah == true && $keterangan == true){
            return redirect()->back()->with('alert','kolom jumlah dan keterangan harus diisi');
        }
        if($jumlah == false && $keterangan == false){
                $buktiBayar = $request->file('bukti_bayar');
                $size = $buktiBayar->getSize();
                $namePhoto = time() . "_" . $buktiBayar->getClientOriginalName();
                $path = 'images/bukti-pembayaran';
                $buktiBayar->move($path, $namePhoto);
            $transaksi = Transaksi::insertGetId([
                'user_id' => $request->user_id,
                'status_pinjam' => 'loan_pending',
                'created_at' => $request->created_at,
                'updated_at' => $request->created_at,
                'bukti_bayar' => $namePhoto,
            ]);
            foreach($request->alat_id as $key => $al)
            {
                if($request->jumlah[$key] != null){
                    Peminjaman::create([
                        'transaksi_id' => $transaksi,
                        'alat_id' => $al,
                        'jumlah' => $request->jumlah[$key],
                        'keterangan' => $request->keterangan[$key],
                    ]);
                }
            }
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
            $laporan = Peminjaman::whereDate('created_at', '>=', $request->dari)->whereDate('created_at', '<=', $request->ke);
        }else{
            $laporan = Pengembalian::whereDate('created_at', '>=', $request->dari)->whereDate('created_at', '<=', $request->ke);
        }
        // return view('user.laporan.index', compact('laporan','dari','ke','tipe'));
    	$pdf = PDF::loadview('user.laporan.index',compact('laporan','dari','ke','tipe'))->setPaper('a4', 'landscape');;
        return $pdf->stream();
    }
}
