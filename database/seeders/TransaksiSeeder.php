<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'transaksi_id'      => 1,
                'transaksi_kode'    => 'TS001',
                'user_id'           => 2,
                'denda'             => 1,
                'buku_id'           => 1,
                'tgl_peminjaman'    => '2024-02-20',
                'tgl_pengembalian'  => '2024-02-27',
            ],
            [
                'transaksi_id'      => 2,
                'transaksi_kode'    => 'TS002',
                'user_id'           => 2,
                'denda'             => 2,
                'buku_id'           => 2,
                'tgl_peminjaman'    => '2024-03-20',
                'tgl_pengembalian'  => '2024-03-27',
            ],
        ];

        DB::table('t_transaksi')->insert($data);
    }
}
