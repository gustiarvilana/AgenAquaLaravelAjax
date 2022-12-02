<?php

namespace App\Http\Controllers;

use App\Models\HargaJenis;
use App\Models\PembelianDetail;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    public function data(Request $request)
    {
        $produk = Produk::all();
        return datatables()
            ->of($produk)
            ->addIndexColumn()
            ->addColumn('tgl_buat', function ($produk) {
                return date('Y-m-d H:i:s', strtotime($produk->created_at));
            })
            ->addColumn('aksi', function ($produk) {
                return '
                    <div class="btn-group">
                        <button onClick="editForm(`' . route('produk.update', $produk->id_produk) . '`)" class="btn btn-info btn-xs"><i class="fas fa-pen fa-xs"></i> Edit</button>
                        <button onClick="deleteData(`' . route('produk.destroy', $produk->id_produk) . '`)" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i> Delete</button>
                    </div>
                ';
            })
            ->rawcolumns(['aksi'])
            ->make(true);
    }
    public function index()
    {
        return view('produk.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validatedData = Validator::make($input, [
            'nama_produk' => 'required',
            'kode_produk' => 'required|unique:tbl_produk,kode_produk',
            'harga_beli'  => 'required',
            'harga_jual'  => 'required',
            'qty'         => '',
        ], [
            'required' => 'Kolom :attribute Harus Diisi.',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()->all()]);
        }
        $input['qty'] = 0;
        Produk::create($input);

        return response()->json('Data Berhasil Disimpan', 200);
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return response()->json($produk, 200);
    }

    public function produk_by_kode($id)
    {
        $produk = Produk::where('kode_produk', $id)->first();
        return response()->json($produk, 200);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $update = $request->all();

        $validatedData = Validator::make($update, [
            'nama_produk' => 'sometimes',
            'kode_produk' => 'sometimes',
            'harga_beli'  => 'sometimes',
            'harga_jual'  => 'sometimes',
            'qty'         => 'sometimes',
        ], [
            'required' => 'Kolom :attribute Harus Diisi.',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()->all()]);
        }

        $produk = Produk::findOrFail($id);
        $produk->update($update);
        return response()->json('Produk Telah diedit', 200);
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk_detail = PembelianDetail::where('id_produk', $id)->first();
        if (!$produk_detail) {
            if ($produk->qty > 0) {
                return abort(404);
            }
            $produk->delete();
            HargaJenis::where('kode_produk', $produk->kode_produk)->delete();
            return response()->json('Produk Telah dihapus', 204);
        } else {
            return response()->json('Produk Gagal sdfA dihapus', 204);
        }
    }
}
