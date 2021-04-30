<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;
    protected $table = 'pengembalian';
    protected $guarded = [];
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
    public function alat()
    {
        return $this->belongsTo(Alat::class);
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
