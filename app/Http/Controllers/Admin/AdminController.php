<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Jenis;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Product;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $user = User::count();
        $alat = Alat::count();
        $jenis = Jenis::count();
        $peminjaman = Peminjaman::count();
        $pengembalian = Pengembalian::count();
        $transaksi = Transaksi::count();
        return view('admin.dashboard.index',compact('user','alat','jenis','peminjaman','pengembalian','transaksi'));
    }
}
