<?php

namespace App\Http\Controllers;

use App\Models\MasterOPS;
use App\Models\Pengeluaran;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengeluaranController extends Controller
{
    public function data(Request $request)
    {
        $pengeluaran = Pengeluaran::all();
        return datatables()
            ->of($pengeluaran)
            ->addIndexColumn()
            ->addColumn('tgl_buat', function ($pengeluaran) {
                return date('Y-m-d H:i:s', strtotime($pengeluaran->created_at));
            })
            ->addColumn('aksi', function ($pengeluaran) {
                return '
                    <div class="btn-group">
                        <button onClick="editForm(`' . route('pengeluaran.update', $pengeluaran->id_pengeluaran) . '`)" class="btn btn-info btn-xs"><i class="fas fa-pen fa-xs"></i> Edit</button>
                        <button onClick="deleteData(`' . route('pengeluaran.destroy', $pengeluaran->id_pengeluaran) . '`)" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i> Delete</button>
                    </div>
                ';
            })
            ->rawcolumns(['aksi'])
            ->make(true);
    }
    public function index()
    {
        // auto Number
        $data = Pengeluaran::where('id_pengeluaran', '>', 202201)->latest()->first();
        $kode_baru = date('ym') . '00' . 1;
        if (!$data) {
            $kode = $kode_baru;
        } else {
            $kode_lama = $data['id_pengeluaran'];
            if ($kode_lama < $kode_baru) {
                $kode = $kode_baru;
            } else {
                $kode = $kode_lama + 1;
            }
        }

        $master_ops = MasterOPS::all();
        $data = [
            'id_transaksi' => $kode,
            'ops' => $master_ops,
        ];

        return view('pengeluaran.index', compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['tgl_pengeluaran'] = date('Ymd', strtotime($input['tgl_pengeluaran']));
        $validatedData = \Validator::make($input, [
            'id_transaksi' => 'required',
            'nama_pengeluaran'  => 'required',
            'tipe_pengeluaran'  => 'required',
            'tgl_pengeluaran'  => 'required',
        ], [
            'required' => 'Kolom :attribute Harus Diisi.',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()->all()]);
        }
        Pengeluaran::create($input);

        return response()->json('Data Berhasil Disimpan', 200);
    }

    public function show($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        return response()->json($pengeluaran, 200);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $update = $request->all();

        $validatedData = Validator::make($update, [
            'id_transaksi' => 'required',
            'nama_pengeluaran'  => 'required',
            'tipe_pengeluaran'  => 'required',
        ], [
            'required' => 'Kolom :attribute Harus Diisi.',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()->all()]);
        }

        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->update($update);
        return response()->json('Pengeluaran Telah diedit', 200);
    }

    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->delete();
        return response()->json('Pengeluaran Telah dihapus', 204);
    }
}
