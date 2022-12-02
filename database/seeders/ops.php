<?php

namespace Database\Seeders;

use App\Models\MasterOPS;
use Illuminate\Database\Seeder;

class ops extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ops = new MasterOPS();
        $data = [
            [
                'idops'    => '4101',
                'nama_ops' => 'Pendapatan Penjualan',
                'tipe_ops' => 'P',
            ],
            [
                'idops'    => '4101',
                'nama_ops' => 'Pendapatan Angsuran',
                'tipe_ops' => 'P',
            ],
            [
                'idops'    => '6201',
                'nama_ops' => 'Pembelian Produk',
                'tipe_ops' => 'B',
            ],
            [
                'idops'    => '2102',
                'nama_ops' => 'Retur Produk',
                'tipe_ops' => 'P',
            ]
        ];
        foreach ($data as  $value) {
            $ops->create($value);
        }
    }
}
