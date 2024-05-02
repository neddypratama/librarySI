<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'buku_id'       => 1,
                'buku_kode'     => 'BK001',
                'judul'         => 'PHP 5',
                'pengarang'     => 'Bangkit',
                'penerbit'      => 'Gramedia',
            ],
            [
                'buku_id'       => 2,
                'buku_kode'     => 'BK002',
                'judul'         => 'Laravel 10',
                'pengarang'     => 'Bongkat',
                'penerbit'      => 'Gramedia',
            ],
        ];
        DB::table('m_buku')->insert($data);
    }
}
