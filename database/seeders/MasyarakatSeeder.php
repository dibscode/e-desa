<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MasyarakatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Budi Santoso', 'nik' => '1001', 'username' => 'budi1001', 'password' => Hash::make('password'), 'level' => 'masyarakat', 'gender' => 1, 'status_user' => 1],
            ['name' => 'Siti Aminah', 'nik' => '1002', 'username' => 'siti1002', 'password' => Hash::make('password'), 'level' => 'masyarakat', 'gender' => 2, 'status_user' => 1],
            ['name' => 'Agus Wijaya', 'nik' => '1003', 'username' => 'agus1003', 'password' => Hash::make('password'), 'level' => 'masyarakat', 'gender' => 1, 'status_user' => 1],
        ];

        foreach ($users as $u) {
            User::create($u);
        }
    }
}
