<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdministratorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('administrators')->truncate();

        $num = 5;

        $administrators = [];
        for ($i = 1; $i <= $num; $i++) {
            $administrators[] = [
                'name' => '管理者' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'role' => $i % 5 === 0 ? \App\Administrator::ROLE_USER : \App\Administrator::ROLE_ADMIN,
                'email' => 'admin' . str_pad($i, 3, '0', STR_PAD_LEFT) . '@example.com',
                'email_verified_at' => '2021-01-01 00:00:00',
                'password' => Hash::make('password'),
                'created_at' => '2021-01-01 00:00:00',
                'updated_at' => '2021-01-01 00:00:00',
            ];
        }

        DB::table('administrators')->insert($administrators);
    }
}
