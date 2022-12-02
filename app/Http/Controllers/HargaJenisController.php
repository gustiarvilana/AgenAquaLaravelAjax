<?php

namespace App\Http\Controllers;

use App\Models\HargaJenis;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HargaJenisController extends Controller
{
    public function data(Request $request)
    {
        $hargajenis = HargaJenis::all();
        return datatables()
            ->of($hargajenis)
            ->addIndexColumn()
            ->addColumn('tgl_buat', function ($hargajenis) {
                return date('Y-m-d H:i:s', strtotime($hargajenis->created_at));
            })
            ->addColumn('aksi', function ($hargajenis) {
                return '
                    <div class="btn-group">
                        <button onClick="editForm(`' . route('hargajenis.update', $hargajenis->id_harga_jenis) . '`)" class="btn btn-info btn-xs"><i class="fas fa-pen fa-xs"></i> Edit</button>
                        <button onClick="deleteData(`' . route('hargajenis.destroy', $hargajenis->id_harga_jenis) . '`)" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i> Delete</button>
                    </div>
                ';
            })
            ->rawcolumns(['aksi'])
            ->make(true);
    }
    public function index()
    {
        $produk = Produk::all();
        return view('hargajenis.index', compact('produk'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $input = $request->all();
        // dd($input);
        $validatedData = Validator::make($input, [
            'id_tipe' => '',
            'nama' => '',
            'kode_produk' => 'required',
            'harga' => 'required',
        ], [
            'required' => 'Kolom :attribute Harus Diisi.',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()->all()]);
        }

        $cek = HargaJenis::where('kode_produk', $input['kode_produk'])->first() ?? null;
        if ($cek) {
            return redirect()->route('hargajenis.index')->with('error_message', 'Harga Produk sudah ada.');
        }
        for ($i = 1; $i <= 15; $i++) {
            HargaJenis::create([
                'id_tipe' => $i,
                'nama' => "Tipe " . $i,
                'kode_produk' => $input['kode_produk'],
                'harga' => $input['harga'],
            ]);
        }

        return response()->json('Data Berhasil Disimpan', 200);
    }

    public function show($id)
    {
        $hargajenis = HargaJenis::findOrFail($id);
        return response()->json($hargajenis, 200);
    }

    public function get_harga(Request $request)
    {
        $input = $request->all();
        // dd($input);
        $hargajenis = HargaJenis::where('id_tipe', $input['id_tipe'])->where('kode_produk', $input['kode_produk'])->first();

        return response()->json($hargajenis, 200);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $update = $request->all();

        $validatedData = Validator::make($update, [
            'harga' => 'required',
        ], [
            'required' => 'Kolom :attribute Harus Diisi.',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()->all()]);
        }

        $hargajenis = HargaJenis::findOrFail($id);
        $hargajenis->update($update);
        return response()->json('HargaJenis Telah diedit', 200);
    }

    public function destroy($id)
    {
        $produk = HargaJenis::findOrFail($id);
        $hargajenis = HargaJenis::where('kode_produk', $produk->kode_produk)->get();
        // dd($hargajenis);
        foreach ($hargajenis as $value) {
            $value->delete();
        }
        return response()->json('HargaJenis Telah dihapus', 204);
    }
}
