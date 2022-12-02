<?php

namespace App\Http\Controllers;

use App\Repositories\DashboardRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private $dashboard;
    public function __construct(DashboardRepository $dashboardRepository)
    {
        $this->dashboard = $dashboardRepository;
    }

    public function index()
    {
        return view('dashboard.home');
    }

    public function get_penjualan()
    {
        $penjualan = [
            'Penjualan_label'   => $this->dashboard->label_bulan(),
            'Penjualan_nominal' => $this->dashboard->penjualan_tahunan(),

            'pembelian_bulan_ini'   => $this->dashboard->pembelian_bulan_ini(),
            'pendapatan_bulan_ini'  => $this->dashboard->pendapatan_bulan_ini(),
            'pengeluaran_bulan_ini' => $this->dashboard->pengeluaran_bulan_ini(),
            'pelanggan_bulan_ini'   => $this->dashboard->pelanggan_baru_bulan_ini(),

            'galon_dipinjam' => $this->dashboard->galon_dipinjam(),
        ];

        return response()->json($penjualan);
    }

    public function laporan_bulanan(Request $request)
    {
        $input = $request->all();
        $input['date'] = date('Ym', strtotime($input['date']));

        $date = Carbon::createFromFormat('Ym', $input['date']);
        $laporan = [
            'periode'             => $date->format('F Y'),
            'header' => [
                'B-Pembelian Bulanan'           => 'Rp. ' . format_uang($this->dashboard->pembelian_bulanan($input['date'])),
                'P-Pendapatan Tunai Bulanan'    => 'Rp. ' . format_uang($this->dashboard->penjualan_bulanan($input['date'])),
                'P-Pendapatan Angsuran Bulanan' => 'Rp. ' . format_uang($this->dashboard->pendapatan_bulanan($input['date'])),
                'P-Retur Bulanan'               => 'Rp. ' . format_uang($this->dashboard->retur_bulanan($input['date'])),
            ],
            'pengeluaran_bulanan' => $this->dashboard->pengeluaran_bulanan($input['date']),
            'total_pendapatan' => $this->dashboard->total_pendapatan($input['date']),
            'total_pengeluaran' => $this->dashboard->total_pengeluaran($input['date']),
        ];
        // dd($laporan['pengeluaran_bulanan']);
        return view('dashboard.laporan_penjualan', compact('laporan'));

        // $pdf = \PDF::loadview('dashboard.laporan_penjualan', compact('laporan'));
        // return $pdf->stream('laporan-penjualan.pdf');
    }
}
