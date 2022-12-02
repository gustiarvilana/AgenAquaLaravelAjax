<?php

namespace App\Http\Controllers;

use App\Models\Galon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GalonController extends Controller
{
    public function data(Request $request)
    {
        $galon = Galon::all();
        return datatables()
            ->of($galon)
            ->addIndexColumn()
            ->addColumn('tgl_buat', function ($galon) {
                return date('Y-m-d H:i:s', strtotime($galon->created_at));
            })
            ->addColumn('aksi', function ($galon) {
                return '
                    <div class="btn-group">
                        <button onClick="editForm(`' . route('galon.update', $galon->id_galon) . '`)" class="btn btn-info btn-xs"><i class="fas fa-pen fa-xs"></i> Edit</button>
                        <button onClick="deleteData(`' . route('galon.destroy', $galon->id_galon) . '`)" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i> Delete</button>
                    </div>
                ';
            })
            ->rawcolumns(['aksi'])
            ->make(true);
    }
    public function index()
    {
        $pinjam = Galon::leftjoin('tbl_penjualan', 'tbl_penjualan.id_penjualan', 'tbl_galon.id_penjualan')
            ->leftjoin('tbl_konsumen', 'tbl_penjualan.id_pelanggan', 'tbl_konsumen.id_konsumen')
            ->where('qty_galon_sisa', '>', 0)->get();
        // dd($pinjam);
        return view('galon.index', compact('pinjam'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['tgl_kembali'] = date("Ymd", strtotime($input['tgl_kembali']));
        $validatedData = Validator::make($input, [
            'id_penjualan'      => 'required',
            'qty_galon_pinjam'  => 'required',
            'qty_galon_kembali' => 'required',
            'qty_galon_sisa'    => 'required',
            'tgl_kembali'       => 'required',
            'nama_pengembali'   => 'required',
        ], [
            'required' => 'Kolom :attribute Harus Diisi.',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()->all()]);
        }

        Galon::create($input);

        return response()->json('Data Berhasil Disimpan', 200);
    }

    public function show($id)
    {
        $galon = Galon::findOrFail($id);
        return response()->json($galon, 200);
    }

    public function get_by_pejualan($id)
    {
        $galon = Galon::where('id_penjualan', $id)->first();
        return response()->json($galon, 200);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $update = $request->all();

        $validatedData = Validator::make($update, [
            'id_penjualan'      => 'required',
            'qty_galon_pinjam'  => 'required',
            'qty_galon_kembali' => 'required',
            'qty_galon_sisa'    => 'required',
            'tgl_kembali'       => 'required',
            'nama_pengembali'   => 'required',
        ], [
            'required' => 'Kolom :attribute Harus Diisi.',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()->all()]);
        }

        $galon = Galon::findOrFail($id);
        $galon->update($update);
        return response()->json('Galon Telah diedit', 200);
    }

    public function destroy($id)
    {
        $galon = Galon::findOrFail($id);
        $galon->delete();
        return response()->json('Galon Telah dihapus', 204);
    }
}
