<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Attendance;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Transaksi;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $transaksi = Transaksi::where('user_id', $this->authUser()->id)->orderBy('id', 'DESC')->get();
        $alat = Alat::all();
        return view('user.peminjaman.index', compact('transaksi', 'alat'));
    }
    public function create(Request $request)
    {
        $from = Carbon::parse($request->dari_tanggal);
        $to = Carbon::parse($request->sampai_tanggal);

        $selisihTanggal = $from->diffInDays($to);
        if ($selisihTanggal > 7) {
            return redirect()->back()->with('alert', 'Peminjaman tidak boleh lebih dari 7 hari')->withInput();
        }
        $alat = Alat::whereIn('id', $request->alat_id)->get();
        foreach ($alat as $a) {
            foreach ($request->jumlah as $key => $jumlah) {
                if ($a->stok < $jumlah) {
                    return redirect()->back()->with('alert', 'stok alat ' . $a->nama . ' tidak mencukupi');
                }
            }
        }
        $jumlah = !$request->jumlah[0];
        $keterangan = !$request->keterangan[0];

        if ($jumlah == true && $keterangan == true) {
            return redirect()->back()->with('alert', 'kolom jumlah dan keterangan harus diisi');
        }
        if ($jumlah == false && $keterangan == false) {
            $transaksi = Transaksi::insertGetId([
                'user_id' => $request->user_id,
                'status_pinjam' => 'loan_pending',
                'dari_tanggal' => $request->dari_tanggal,
                'sampai_tanggal' => $request->sampai_tanggal,
            ]);
            foreach ($request->alat_id as $key => $al) {
                if ($request->jumlah[$key] != null) {
                    Peminjaman::create([
                        'transaksi_id' => $transaksi,
                        'alat_id' => $al,
                        'jumlah' => $request->jumlah[$key],
                        'keterangan' => $request->keterangan[$key],
                        'created_at' => $request->dari_tanggal,
                    ]);
                }
            }
        }
        return redirect()->back()->with('success', 'Berhasil meminjam alat');
    }
    public function show($transaksId)
    {
        $transaksi = Transaksi::find($transaksId);

        $pinjamDari = Carbon::parse($transaksi->dari_tanggal);
        $pinjamSampai = Carbon::parse($transaksi->sampai_tanggal);

        $lamaPinjam = $pinjamDari->diffInDays($pinjamSampai);

        $from = Carbon::parse($transaksi->sampai_tanggal);
        $to = Carbon::now();
        if ($to > $from == false) {
            $selisihTanggal = 0;
        } else {
            $selisihTanggal = $from->diffInDays($to);
        }
        $peminjaman = Peminjaman::where('transaksi_id', $transaksId);
        $adminPinjam = Peminjaman::where('transaksi_id', $transaksId)->first();
        $pengembalian = Pengembalian::where('transaksi_id', $transaksId);
        $adminKembali = Pengembalian::where('transaksi_id', $transaksId)->first();
        return view('user.peminjaman.show', compact('transaksi', 'peminjaman', 'pengembalian', 'adminPinjam', 'adminKembali', 'selisihTanggal', 'lamaPinjam'));
    }
    public function delete($id)
    {
        Transaksi::find($id)->delete();
        return redirect()->back()->with('success', 'Transaksi berhasi dihapus');
    }
    public function pdf(Request $request)
    {
        $dari = $request->dari;
        $ke = $request->ke;
        $tipe = $request->tipe;
        $role = session()->get('role');
        $guard = Auth::guard(session()->get('role'))->user();
        if ($request->tipe == 'pinjam') {
            if ($role == 'admin') {
                $laporan = Peminjaman::whereDate('created_at', '>=', $request->dari)->whereDate('created_at', '<=', $request->ke)->get();
            } else {
                $laporan = Peminjaman::whereDate('created_at', '>=', $request->dari)->whereDate('created_at', '<=', $request->ke)
                    ->whereHas('transaksi', function ($q) use ($guard) {
                        $q->where('user_id', $guard->id);
                    })->get();
            }
        } else {
            if ($role == 'admin') {
                $laporan = Pengembalian::whereDate('created_at', '>=', $request->dari)->whereDate('created_at', '<=', $request->ke)->get();
            } else {
                $laporan = Pengembalian::whereDate('created_at', '>=', $request->dari)->whereDate('created_at', '<=', $request->ke)
                    ->whereHas('transaksi', function ($q) use ($guard) {
                        $q->where('user_id', $guard->id);
                    })->get();
            }
        }
        // return view('user.laporan.index', compact('laporan','dari','ke','tipe'));
        $pdf = PDF::loadview('user.laporan.index', compact('laporan', 'dari', 'ke', 'tipe'));
        return $pdf->stream();
        return view('user.laporan.index', compact('laporan', 'dari', 'ke', 'tipe'));
    }

    public function upload(Request $request)
    {
        $transaksi = Transaksi::find($request->id);
        $peminjaman = Peminjaman::where('transaksi_id', $transaksi->id)->get();

        $buktiBayar = $request->file('bukti_bayar');
        $size = $buktiBayar->getSize();
        $namePhoto = time() . "_" . $buktiBayar->getClientOriginalName();
        $path = 'images/bukti-pembayaran';
        $buktiBayar->move($path, $namePhoto);

        $transaksi->update(['bukti_bayar' => $namePhoto]);
        if ($transaksi->keterangan_pembayaran == null) {
            $alatID = Peminjaman::where('transaksi_id', $transaksi->id)->select('alat_id')->get()->toArray();
            $cekStok = Alat::whereIn('id', array_column($alatID, 'alat_id'))->get();
            foreach ($cekStok as $a) {
                foreach ($peminjaman as $pem) {
                    if ($a->stok < $pem->jumlah) {
                        return redirect()->back()->with('alert', 'stok alat ' . $a->nama . ' tidak mencukupi');
                    }
                }
            }
        }
        foreach ($peminjaman as $pem) {
            $alat = Alat::find($pem->alat_id);
            $stokAkhir = $alat->stok - $pem->jumlah;
            $alat->update(['stok' => $stokAkhir]);
        }

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil dikirim');
    }
    public function print_individu(Request $request)
    {
        $transaksi = Transaksi::find($request->id);
        $peminjaman = Peminjaman::where('transaksi_id', $request->id)->get();
        $pengembalian = Pengembalian::where('transaksi_id', $request->id)->get();
        $tipe = $request->tipe;
        $pdf = PDF::loadview('user.transaksi.cetak', compact('transaksi', 'peminjaman', 'pengembalian', 'tipe'));
        return $pdf->stream();
    }
}
