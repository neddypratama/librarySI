<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id'   => 1,
                'nim'       => '21212121',
                'nama'      => 'Administrator',
                'password'  => Hash::make('12345'),
                'tgl_lahir' => '2000-01-01',
                'level_id'  => 1,
            ],
            [
                'user_id'   => 2,
                'nim'       => '31313131',
                'nama'      => 'User',
                'password'  => Hash::make('12345'),
                'tgl_lahir' => '2000-02-01',
                'level_id'  => 2,
            ],
        ];
        DB::table('m_user')->insert($data);
    }
}
