<?php

namespace App\Http\Controllers;

use App\Models\Galon;
use App\Models\Konsumen;
use App\Models\Pengeluaran;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{
    public function data(Request $request)
    {
        $penjualan = Penjualan::all();
        return datatables()
            ->of($penjualan)
            ->addIndexColumn()
            ->addColumn('tgl_buat', function ($penjualan) {
                return date('Y-m-d H:i:s', strtotime($penjualan->created_at));
            })
            ->addColumn('aksi', function ($penjualan) {
                return '
                    <div class="btn-group">
                        <button onClick="deleteData(`' . route('penjualan.destroy', $penjualan->id_penjualan) . '`)" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i> Delete</button>
                    </div>
                ';
            })
            ->rawcolumns(['aksi'])
            ->make(true);
    }
    public function index()
    {
        if (session('id_penjualan')) {
            return redirect()->route('penjualandetail.index');
        }
        $konsumen = Konsumen::all();
        return view('penjualan.index', compact('konsumen'));
    }

    public function create($id)
    {
        // auto Number
        $data = Penjualan::latest()->first();
        $kode_baru = date('ym') . '00' . 1;
        if (!$data) {
            $kode = $kode_baru;
        } else {
            $kode_lama = (int)substr($data['kode_penjualan'], 1);
            if ($kode_lama < $kode_baru) {
                $kode = $kode_baru;
            } else {
                $kode = $kode_lama + 1;
            }
        }
        $new_kode = 'P' . $kode;

        $penjualan = Penjualan::create([
            'kode_penjualan' => $new_kode,
            'id_pelanggan' => $id,
            'tgl_trs' => 0,
            'qty' => 0,
            'harga_total' => 0,
            'bayar' => 0,
            'status_bayar' => '0',
            'sisa_bayar' => 0,
            'cicil_ke' => 0,
        ]);
        session(['id_penjualan' => $penjualan->id_penjualan]);
        session(['kode_penjualan' => $penjualan->kode_penjualan]);
        session(['id_pelanggan' => $penjualan->id_pelanggan]);

        return redirect()->route('penjualandetail.index');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validatedData = Validator::make($input, [
            'id_pelanggan'   => 'required',
            'kode_penjualan' => 'required',
            'tgl_trs'        => 'required',
            'qty'            => 'required',
            'harga_total'    => 'required',
            'bayar'          => 'required',
            'status_bayar'   => 'required',
            'sisa_bayar'     => 'required',
            'cicil_ke'       => 'required',
        ], [
            'required' => 'Kolom :attribute Harus Diisi.',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()->all()]);
        }
        Penjualan::create($input);

        return response()->json('Data Berhasil Disimpan', 200);
    }

    public function show($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        return response()->json($penjualan, 200);
    }

    public function penjualan_by_pelanggan($id)
    {
        $penjualan = Penjualan::where('kode_penjualan', $id)->first();
        return response()->json($penjualan, 200);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $update = $request->all();
        // dd($update);
        $update['tgl_trs'] = date('Ymd', strtotime($update['tgl_trs']));
        $update = [
            'qty'          => $update['total_item'],
            'harga_total'  => $update['total_harga'],
            'bayar'        => $update['nominal'],
            'tgl_trs'      => $update['tgl_trs'],
            'status_bayar' => 1,
            'sisa_bayar'   => 0,
            'cicil_ke'     => 0,
        ];

        if ($update['harga_total'] > $update['bayar']) {
            $update = [
                'qty'          => $update['qty'],
                'harga_total'  => $update['harga_total'],
                'bayar'        => $update['bayar'],
                'tgl_trs'      => $update['tgl_trs'],
                'status_bayar' => 2,
                'sisa_bayar'   => $update['harga_total'] - $update['bayar'],
                'cicil_ke'     => 1,
            ];
        }

        $validatedData = Validator::make($update, [
            'qty'            => 'required',
            'harga_total'    => 'required',
            'bayar'          => 'required',
            'status_bayar'   => 'required',
            'sisa_bayar'     => 'required',
            'cicil_ke'       => 'required',
        ], [
            'required' => 'Kolom :attribute Harus Diisi.',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()->all()]);
        }

        $penjualan = Penjualan::findOrFail($id);
        Galon::create([
            'id_penjualan'      => $penjualan['id_penjualan'],
            'qty_galon_pinjam'  => $request->input('qty_galon_pinjam'),
            'qty_galon_kembali' => 0,
            'qty_galon_sisa'    => $request->input('qty_galon_pinjam'),
            'tgl_kembali'       => 0,
            'nama_pengembali'   => 0,
        ]);
        Pengeluaran::create([ // ini update pengeluaran
            'id_transaksi'        => $penjualan['id_penjualan'],
            'nama_pengeluaran'    => 'Penjualan Produk',
            'tipe_pengeluaran'    => '4101',
            'tgl_pengeluaran'    => date('Ymd', strtotime($request->input('tgl_trs'))),
            'nominal_pengeluaran' => (int)$update['bayar'],
        ]);
        $penjualan->update($update);
        session()->forget('id_penjualan');
        session()->forget('kode_penjualan');
        session()->forget('id_pelanggan');

        return redirect()->route('penjualan.index');
    }

    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualanDetail = PenjualanDetail::where('id_penjualan', $id)->first();
        $pengeluaran = Pengeluaran::where('id_transaksi', $id)->first();
        $galon = Galon::where('id_penjualan', $id)->first();

        if ($penjualanDetail) {
            // return abort(404);
            $produk = Produk::where('kode_produk', $penjualanDetail->kode_produk)->first();
            // dd([$penjualanDetail->kode_produk, $produk]);
            $produk->update([
                'qty' => $produk->qty + $penjualanDetail->jml_barang
            ]);
            $penjualanDetail->delete();
        }

        $galon->delete();
        $pengeluaran->delete();
        $penjualan->delete();
        return response()->json('Penjualan Telah dihapus', 204);
    }
}
