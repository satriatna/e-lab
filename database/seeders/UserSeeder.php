<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nip'=>'1',
            'alamat'=>'Jakarta',
            'username'=>'user',
            'password'=>bcrypt('user'),
            'nama'=>'user',
            'instansi'=>'SM',
            'guru_pembimbing'=>'Edi',
        ]);
    }
}
