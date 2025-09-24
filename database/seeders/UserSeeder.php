<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Administrator', 
                'nik' => '001', 
                'username' => 'admin', 
                'password' => Hash::make('admin'), 
                'level' => 'admin',
                'gender' => 1,
                'status_user' => 1
            ],
            [
                'name' => 'WAYAN HENDRIYONO', 
                'nik' => '002', 
                'username' => 'lurah', 
                'password' => Hash::make('tarum'), 
                'level' => 'lurah',
                'gender' => 1,
                'status_user' => 1
            ],
            [
                'name' => 'INDAH YULIANA', 
                'nik' => '003', 
                'username' => '19800414 200901 2 001', 
                'password' => Hash::make('tarum'), 
                'level' => 'sekretaris',
                'gender' => 2,
                'status_user' => 1
            ],
        ]);
    }
}
