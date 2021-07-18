<?php

namespace Database\Seeders;

use App\Models\Alat;
use Illuminate\Database\Seeder;

class AlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Alat::create([
            'jenis_id'=>'1',
            'kode'=>'001',
            'nama'=>'Kaki Tiga',
            'stok'=>'100',
        ]);
        Alat::create([
            'jenis_id'=>'1',
            'kode'=>'002',
            'nama'=>'Larutan',
            'stok'=>'50',
        ]);
    }
}
