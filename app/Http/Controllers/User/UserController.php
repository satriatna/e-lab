<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Jenis;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $alat = Alat::count();
        $jenis = Jenis::count();
        return view('user.dashboard.index',compact('alat','jenis',));
    }
}
