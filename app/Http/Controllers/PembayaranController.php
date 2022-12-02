<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PembayaranController extends Controller
{
    public function data(Request $request)
    {
        $pembayaran = Pembayaran::all();
        return datatables()
            ->of($pembayaran)
            ->addIndexColumn()
            ->addColumn('tgl_buat', function ($pembayaran) {
                return date('Y-m-d H:i:s', strtotime($pembayaran->created_at));
            })
            ->addColumn('aksi', function ($pembayaran) {
                return '
                    <div class="btn-group">
                        <button onClick="editForm(`' . route('pembayaran.update', $pembayaran->id_pembayaran) . '`)" class="btn btn-info btn-xs"><i class="fas fa-pen fa-xs"></i> Edit</button>
                        <button onClick="deleteData(`' . route('pembayaran.destroy', $pembayaran->id_pembayaran) . '`)" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i> Delete</button>
                    </div>
                ';
            })
            ->rawcolumns(['aksi'])
            ->make(true);
    }
    public function index()
    {
        $tempo = DB::table('tbl_penjualan')->leftJoin('tbl_konsumen', 'tbl_konsumen.id_konsumen', 'tbl_penjualan.id_pelanggan')
            ->where('status_bayar', 2)->get();

        return view('pembayaran.index', compact('tempo'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['tgl_bayar'] = date('Ymd', strtotime($input['tgl_bayar']));
        $input['sisa'] = $input['sisa'] - $input['nominal'];
        $validatedData = \Validator::make($input, [
            'no_sp'          => 'required',
            'tgl_bayar'      => 'required',
            'angsuran_ke'    => 'required',
            'nominal'        => 'required',
            'sisa'           => 'required',
        ], [
            'required' => 'Kolom :attribute Harus Diisi.',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()->all()]);
        }

        $pembayaran = Pembayaran::create($input);
        Pengeluaran::create([ // ini update pengeluaran
            'id_transaksi'        => $pembayaran['id_pembayaran'],
            'nama_pengeluaran'    => 'Pembayaran angsuran Tempo id => ' . $input['no_sp'],
            'tipe_pengeluaran'    => '4201',
            'tgl_pengeluaran'    => date('Ymd', strtotime($request->input('tgl_bayar    '))),
            'nominal_pengeluaran' => (int)$input['nominal'],
        ]);

        $Penjualan = Penjualan::where('kode_penjualan', $input['no_sp'])->first();
        $Penjualan->update([
            'sisa_bayar' => $input['sisa'],
            'cicil_ke' => $input['angsuran_ke'] + 1,
            'status_bayar' => $input['sisa'] != '0' ? '2' : '9',
        ]);

        return response()->json('Data Berhasil Disimpan', 200);
    }

    public function show($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        return response()->json($pembayaran, 200);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $update = $request->all();

        $validatedData = Validator::make($update, [
            'no_sp'       => 'required',
            'tgl_bayar'   => 'required',
            'angsuran_ke' => 'required',
            'nominal'     => 'required',
            'sisa'        => 'required',
        ], [
            'required' => 'Kolom :attribute Harus Diisi.',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()->all()]);
        }

        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update($update);
        return response()->json('Pembayaran Telah diedit', 200);
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pengeluaran = Pengeluaran::where('id_transaksi', $id);

        $penjualan = Penjualan::where('kode_penjualan', $pembayaran->no_sp)->first();
        // dd($pembayaran);
        $penjualan->update([
            'sisa_bayar' => $penjualan->sisa_bayar + $pembayaran->nominal,
            'cicil_ke' => $penjualan->cicil_ke - 1,
            'status_bayar' => 2,
        ]);
        $pembayaran->delete();
        $pengeluaran->delete();
        return response()->json('Pembayaran Telah dihapus', 204);
    }
}
