<?php

namespace App\Http\Controllers;

use App\Models\HargaJenis;
use App\Models\Konsumen;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanDetailController extends Controller
{
    public function data($id)
    {
        // dd(session()->all());
        $penjualandetail = PenjualanDetail::where('id_penjualan', $id);
        return datatables()
            ->of($penjualandetail)
            ->addIndexColumn()
            ->addColumn('harga', function ($penjualandetail) {
                return 'Rp ' . format_uang($penjualandetail->harga);
            })
            ->addColumn('total_harga', function ($penjualandetail) {
                return 'Rp ' . format_uang($penjualandetail->total_harga);
            })
            ->addColumn('tgl_buat', function ($penjualandetail) {
                return date('Y-m-d H:i:s', strtotime($penjualandetail->created_at));
            })
            ->addColumn('aksi', function ($penjualandetail) {
                return '
                    <div class="btn-group">
                        <button onClick="editForm(`' . route('penjualandetail.update', $penjualandetail->id_penjualan_detail) . '`)" class="btn btn-info btn-xs"><i class="fas fa-pen fa-xs"></i> Edit</button>
                        <button onClick="deleteData(`' . route('penjualandetail.destroy', $penjualandetail->id_penjualan_detail) . '`)" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i> Delete</button>
                    </div>
                ';
            })
            ->rawcolumns(['aksi', 'tgl_buat', 'total_harga', 'harga'])
            ->make(true);
    }
    public function index()
    {
        if (session('id_penjualan')) {
            $produk = Produk::all();
            $jenis_konsumen = Konsumen::where('id_konsumen', session('id_pelanggan'))->first(['tipe_pelanggan', 'nama']);
            return view('transaksi_penjualan.index', compact('produk', 'jenis_konsumen'));
        } else {
            abort(404);
        }
    }

    public function total_detail($id)
    {
        $rekap = PenjualanDetail::where('id_penjualan', session('id_penjualan'));

        $data = [
            'id_supplier' => '',
            'total_item'  => (int)$rekap->sum('jml_barang'),
            'total_harga' => $rekap->sum('total_harga'),
            'diskon'      => 0,
            'bayar'       => 0,
            'nominal'     => 0,
        ];
        return response()->json($data, 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $penjualan = [
            'id_penjualan' => $input['id_penjualan'],
            'kode_produk'  => $input['kode_produk'],
            'jml_barang'   => $input['jml_barang'],
            'harga'        => $input['harga'],
            'total_harga'  => $input['total_harga'],
        ];
        $is_same = PenjualanDetail::where('kode_produk', $input['kode_produk'])->where('id_penjualan', $input['id_penjualan'])->first();
        if ($is_same) {
            $is_same->update([
                'jml_barang' => $is_same->jml_barang + $input['jml_barang'],
                'total_harga' => $is_same->total_harga + $input['total_harga'],
            ]);
        } else {
            PenjualanDetail::create($penjualan);
        }
        // produk update
        $produk = Produk::where('kode_produk', $input['kode_produk'])->first();
        $produk->update([
            'qty' => $produk->qty - $input['jml_barang']
        ]);

        return response()->json('Data Berhasil Disimpan', 200);
    }

    public function show($id)
    {
        $penjualandetail = PenjualanDetail::findOrFail($id);
        return response()->json($penjualandetail, 200);
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        // dd($input);
        $penjualan = [
            'id_penjualan' => $input['id_penjualan'],
            'kode_produk'  => $input['kode_produk'],
            'jml_barang'   => $input['jml_barang'],
            'harga'        => $input['harga'],
            'total_harga'  => $input['total_harga'],
        ];

        $detail = PenjualanDetail::where('id_penjualan', $input['id_penjualan'])
            ->where('kode_produk', $input['kode_produk'])
            ->first();
        $produk = Produk::where('kode_produk', $detail->kode_produk)->first();

        DB::beginTransaction();
        try {
            $produk->update([
                'qty' => $produk->qty - $detail->jml_barang,
                'qty' => $produk->qty +  $input['jml_barang'],
            ]);
            $detail->update($penjualan);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('penjualandetail.index')->with('error_message', 'Gagal Update Produk!');
        }

        return redirect()->route('penjualandetail.index')->with('success_message', 'Update Produk berhasil!');
    }

    public function destroy($id)
    {
        // dd($id);
        $data = PenjualanDetail::findOrFail($id);
        $produk = Produk::where('kode_produk', $data->kode_produk)->first();
        // produk update
        $produk->update([
            'qty' => $produk->qty +  $data->jml_barang
        ]);
        $data->delete();
        return response()->json('PenjualanDetail Telah dihapus', 204);
    }
}
