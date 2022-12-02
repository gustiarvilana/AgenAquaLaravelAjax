<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Pengeluaran;
use App\Models\Produk;
use App\Models\Retur;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReturController extends Controller
{
    public function data(Request $request)
    {
        $retur = Retur::all();
        return datatables()
            ->of($retur)
            ->addIndexColumn()
            ->addColumn('tgl_buat', function ($retur) {
                return date('Y-m-d H:i:s', strtotime($retur->created_at));
            })
            ->addColumn('aksi', function ($retur) {
                return '
                    <div class="btn-group">
                        <button onClick="deleteData(`' . route('retur.destroy', $retur->id_retur) . '`)" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i> Delete</button>
                    </div>
                ';
            })
            ->rawcolumns(['aksi'])
            ->make(true);
    }
    public function index()
    {
        $pembelian = Pembelian::all();
        return view('retur.index', compact('pembelian'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validatedData = \Validator::make($input, [
            'id_pembelian'      => 'required',
            'id_supplier'       => 'required',
            'kode_produk'         => 'required',
            'tgl_retur'         => 'required',
            'tgl_trs'           => 'required',
            'qty'               => 'required',
            'harga_beli_satuan' => 'required',
            'harga_beli_total'  => 'required',
            'ket'               => 'required',
        ], [
            'required' => 'Kolom :attribute Harus Diisi.',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()->all()]);
        }
        $retur = Retur::create([
            'id_pembelian'      => $input['id_pembelian'],
            'id_supplier'       => $input['id_supplier'],
            'kode_produk'         => $input['kode_produk'],
            'tgl_retur'         => (int)$input['tgl_retur'],
            'tgl_trs'           => $input['tgl_trs'],
            'qty'               => $input['qty'],
            'harga_beli_satuan' => $input['harga_beli_satuan'],
            'harga_beli_total'  => $input['harga_beli_total'],
            'ket'               => $input['ket'],
        ]);
        Pengeluaran::create([
            'id_transaksi'        => $retur->id_retur,
            'nama_pengeluaran'    => 'Retur Produk',
            'tipe_pengeluaran'    => '2102',
            'nominal_pengeluaran' => $input['harga_beli_total'],
            'tgl_pengeluaran'     => $input['tgl_trs'],
        ]);
        $produk = Produk::where('kode_produk', $input['kode_produk'])->first();
        $produk->update([
            'qty' => $produk->qty - $input['qty']
        ]);

        return response()->json('Data Berhasil Disimpan', 200);
    }

    public function show($id)
    {
        $retur = Retur::findOrFail($id);
        return response()->json($retur, 200);
    }

    public function edit($id)
    {
        //
    }

    // public function update(Request $request, $id)
    // {
    //     $update = $request->all();

    //     $validatedData = Validator::make($update, [
    //         'id_pembelian'      => 'required',
    //         'id_supplier'       => 'required',
    //         'kode_produk'         => 'required',
    //         'tgl_retur'         => 'required',
    //         'tgl_trs'           => 'required',
    //         'qty'               => 'required',
    //         'harga_beli_satuan' => 'required',
    //         'harga_beli_total'  => 'required',
    //         'ket'               => 'required',
    //     ], [
    //         'required' => 'Kolom :attribute Harus Diisi.',
    //     ]);
    //     if ($validatedData->fails()) {
    //         return response()->json(['errors' => $validatedData->errors()->all()]);
    //     }

    //     $pengeluaran = Pengeluaran::where('id_transaksi', $id);
    //     $retur = Retur::findOrFail($id);
    //     $produk = Produk::where('kode_produk', $update['kode_produk'])->first();
    //     $produk->update([
    //         'qty' => $produk->qty - $update['qty']
    //     ]);
    //     $pengeluaran->update([
    //         'nominal_pengeluaran' => $update['harga_beli_total'],
    //     ]);
    //     $retur->update($update);
    //     return response()->json('Retur Telah diedit', 200);
    // }

    public function destroy($id)
    {
        $retur = Retur::findOrFail($id);
        $pengeluaran = Pengeluaran::where('id_transaksi', $id);
        $produk = Produk::where('kode_produk', $retur->kode_produk)->first();
        // dd($produk);
        $produk->update([
            'qty' => $produk->qty + $retur->qty
        ]);
        $retur->delete();
        $pengeluaran->delete();
        return response()->json('Retur Telah dihapus', 204);
    }
}
