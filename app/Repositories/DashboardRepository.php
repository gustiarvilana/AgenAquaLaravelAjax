<?php

namespace App\Repositories;

use App\Models\Pengeluaran;
use App\Models\Penjualan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardRepository
{
    public function label_bulan()
    {
        $Penjualan_label = ['jan', 'feb', 'mar', 'apr', 'mei', 'jun', 'jul', 'agst', 'sept', 'okt', 'nov', 'des'];
        return $Penjualan_label;
    }

    public function penjualan_tahunan()
    {
        $table = DB::table('tbl_penjualan')->get();

        $Penjualan_nominal = [
            $table->whereBetween('tgl_trs', [date('Y0100'), date('Y0131')])->sum('qty'),
            $table->whereBetween('tgl_trs', [date('Y0200'), date('Y0231')])->sum('qty'),
            $table->whereBetween('tgl_trs', [date('Y0300'), date('Y0331')])->sum('qty'),
            $table->whereBetween('tgl_trs', [date('Y0400'), date('Y0431')])->sum('qty'),
            $table->whereBetween('tgl_trs', [date('Y0500'), date('Y0531')])->sum('qty'),
            $table->whereBetween('tgl_trs', [date('Y0600'), date('Y0631')])->sum('qty'),
            $table->whereBetween('tgl_trs', [date('Y0700'), date('Y0731')])->sum('qty'),
            $table->whereBetween('tgl_trs', [date('Y0800'), date('Y0831')])->sum('qty'),
            $table->whereBetween('tgl_trs', [date('Y0900'), date('Y0931')])->sum('qty'),
            $table->whereBetween('tgl_trs', [date('Y1000'), date('Y1031')])->sum('qty'),
            $table->whereBetween('tgl_trs', [date('Y1100'), date('Y1131')])->sum('qty'),
            $table->whereBetween('tgl_trs', [date('Y1200'), date('Y1231')])->sum('qty'),
        ];
        return $Penjualan_nominal;
    }

    public function pembelian_bulan_ini()
    {
        $bulan_ini = date('Ym');
        $penjualan = Pengeluaran::leftjoin('tbl_master_ops', 'tbl_pengeluaran.tipe_pengeluaran', 'tbl_master_ops.idops')
            ->whereBetween('tgl_pengeluaran', [$bulan_ini . '00', $bulan_ini . '31'])
            ->orWhere('tipe_pengeluaran', 6201)
            ->get();
        $penjualan = $penjualan->sum('nominal_pengeluaran');
        return $penjualan;
    }

    public function pendapatan_bulan_ini()
    {
        $bulan_ini = date('Ym');
        $penjualan = Pengeluaran::leftjoin('tbl_master_ops', 'tbl_pengeluaran.tipe_pengeluaran', 'tbl_master_ops.idops')
            ->whereBetween('tgl_pengeluaran', [$bulan_ini . '00', $bulan_ini . '31'])
            ->where('tipe_ops', 'P')
            // ->orWhere('tipe_pengeluaran', 4201)
            ->get();
        $penjualan = $penjualan->sum('nominal_pengeluaran');
        return $penjualan;
    }

    public function pengeluaran_bulan_ini()
    {
        $bulan_ini = date('Ym');
        $penjualan = Pengeluaran::leftjoin('tbl_master_ops', 'tbl_pengeluaran.tipe_pengeluaran', 'tbl_master_ops.idops')
            ->whereBetween('tgl_pengeluaran', [$bulan_ini . '00', $bulan_ini . '31'])
            ->where('tipe_ops', 'B')
            ->Where('tipe_pengeluaran', '!=', 6201)
            ->get();
        $penjualan = $penjualan->sum('nominal_pengeluaran');
        return $penjualan;
    }

    public function pelanggan_baru_bulan_ini()
    {
        $bulan_ini = date('Ym');
        $konsumen = Penjualan::leftjoin('tbl_konsumen', 'tbl_penjualan.id_pelanggan', 'tbl_konsumen.id_konsumen')
            ->whereBetween('tgl_trs', [$bulan_ini . '00', $bulan_ini . '31'])
            ->distinct('id_pelanggan')
            ->count('id_pelanggan');
        return $konsumen;
    }

    public function galon_dipinjam()
    {
        $galon_dipinjam = '';

        return $galon_dipinjam;
    }

    public function pendapatan_bulanan($data)
    {
        $penjualan = Pengeluaran::leftJoin('tbl_master_ops', 'tbl_master_ops.idops', 'tbl_pengeluaran.tipe_pengeluaran')
            ->whereBetween('tgl_pengeluaran', [$data . '00', $data . '31'])
            ->where('tipe_pengeluaran', 4201)
            ->where('nominal_pengeluaran', '>', 0)
            ->sum('nominal_pengeluaran');

        return $penjualan;
    }

    public function pembelian_bulanan($data)
    {
        $penjualan = Pengeluaran::leftJoin('tbl_master_ops', 'tbl_master_ops.idops', 'tbl_pengeluaran.tipe_pengeluaran')
            ->whereBetween('tgl_pengeluaran', [$data . '00', $data . '31'])
            ->where('tipe_pengeluaran', 6201)
            ->sum('nominal_pengeluaran');

        return $penjualan;
    }

    public function penjualan_bulanan($data)
    {
        $penjualan = Pengeluaran::leftJoin('tbl_master_ops', 'tbl_master_ops.idops', 'tbl_pengeluaran.tipe_pengeluaran')
            ->whereBetween('tgl_pengeluaran', [$data . '00', $data . '31'])
            ->where('tipe_pengeluaran', 4101)
            ->sum('nominal_pengeluaran');

        return $penjualan;
    }

    public function pengeluaran_bulanan($data)
    {
        $penjualan = Pengeluaran::leftJoin('tbl_master_ops', 'tbl_master_ops.idops', 'tbl_pengeluaran.tipe_pengeluaran')
            ->whereBetween('tgl_pengeluaran', [$data . '00', $data . '31'])
            ->where('tipe_ops', 'B')
            ->where('tipe_pengeluaran', '!=', 6201)
            ->get();

        $result = $penjualan->map(function ($penjualan, $index) {
            return [
                'no'                  => $index + 1,
                'tgl_pengeluaran'     => $penjualan->tgl_pengeluaran,
                'nama_pengeluaran'    => $penjualan->nama_pengeluaran,
                'nominal_pengeluaran' => $penjualan->nominal_pengeluaran,
                'jenis'               => trim($penjualan->tipe_ops),
            ];
        });

        return $result;
    }

    public function retur_bulanan($data)
    {
        $penjualan = Pengeluaran::leftJoin('tbl_master_ops', 'tbl_master_ops.idops', 'tbl_pengeluaran.tipe_pengeluaran')
            ->whereBetween('tgl_pengeluaran', [$data . '00', $data . '31'])
            ->where('tipe_pengeluaran', 2102)
            ->sum('nominal_pengeluaran');

        return $penjualan;
    }

    public function total_pendapatan($data)
    {
        $penjualan = Pengeluaran::leftJoin('tbl_master_ops', 'tbl_master_ops.idops', 'tbl_pengeluaran.tipe_pengeluaran')
            ->whereBetween('tgl_pengeluaran', [$data . '00', $data . '31'])
            ->where('tipe_ops', 'P')
            ->sum('nominal_pengeluaran');

        return $penjualan;
    }

    public function total_pengeluaran($data)
    {
        $penjualan = Pengeluaran::leftJoin('tbl_master_ops', 'tbl_master_ops.idops', 'tbl_pengeluaran.tipe_pengeluaran')
            ->whereBetween('tgl_pengeluaran', [$data . '00', $data . '31'])
            ->where('tipe_ops', 'B')
            ->sum('nominal_pengeluaran');

        return $penjualan;
    }
}
