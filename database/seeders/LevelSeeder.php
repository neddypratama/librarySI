<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'level_id'      => 1,
                'level_kode'    => 'LV001',
                'level_nama'    => 'Admin',
            ],
            [
                'level_id'      => 2,
                'level_kode'    => 'LV002',
                'level_nama'    => 'User',
            ],
        ];

        DB::table('m_level')->insert($data);
    }
}
