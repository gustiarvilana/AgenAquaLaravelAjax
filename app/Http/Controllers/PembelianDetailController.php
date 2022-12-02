<?php

namespace App\Http\Controllers;

use App\Models\PembelianDetail;
use App\Models\Produk;
use App\Repositories\PembelianRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianDetailController extends Controller
{
    private $pembelianRepository;
    public function __construct(PembelianRepository $pembelianRepository)
    {
        $this->pembelianRepository = $pembelianRepository;
    }

    public function data($id)
    {
        $pembeliandetail = PembelianDetail::where('id_pembelian', $id);
        return datatables()
            ->of($pembeliandetail)
            ->addIndexColumn()
            ->addColumn('harga', function ($pembeliandetail) {
                return 'Rp ' . format_uang($pembeliandetail->harga);
            })
            ->addColumn('total_harga', function ($pembeliandetail) {
                return 'Rp ' . format_uang($pembeliandetail->total_harga);
            })
            ->addColumn('tgl_buat', function ($pembeliandetail) {
                return date('Y-m-d H:i:s', strtotime($pembeliandetail->created_at));
            })
            ->addColumn('aksi', function ($pembeliandetail) {
                return '
                    <div class="btn-group">
                        <button onClick="editForm(`' . route('pembeliandetail.update', $pembeliandetail->id_pembelian_detail) . '`)" class="btn btn-info btn-xs"><i class="fas fa-pen fa-xs"></i> Edit</button>
                        <button onClick="deleteData(`' . route('pembeliandetail.destroy', $pembeliandetail->id_pembelian_detail) . '`)" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i> Delete</button>
                    </div>
                ';
            })
            ->rawcolumns(['aksi', 'tgl_buat', 'total_harga', 'harga'])
            ->make(true);
    }
    public function index()
    {
        // dd(session()->all());
        $produk = Produk::all();
        // dd($produk);
        return view('transaksi_pembelian.index', compact('produk'));
    }

    public function total_detail($id)
    {
        $rekap = PembelianDetail::where('id_pembelian', session('id_pembelian'));

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
        $this->pembelianRepository->store_pembelian_detail($request->all()) ??
            $this->pembelianRepository->backWithErrors('Gagal menyimpan pembelian detail!');

        return response()->json('Data Berhasil Disimpan', 200);
    }

    public function show($id)
    {
        $pembeliandetail = PembelianDetail::findOrFail($id);
        return response()->json($pembeliandetail, 200);
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $detail = PembelianDetail::where('id_pembelian', $input['id_pembelian'])
            ->where('id_produk', $input['id_produk'])
            ->first();

        DB::beginTransaction();
        try {
            $detail->update($input);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('pembeliandetail.index')->with('error_message', 'Gagal Update Produk!');
        }

        return response()->json('Data Berhasil Disimpan', 200);
        // dd($input);
    }

    public function destroy($id)
    {
        $this->pembelianRepository->delete_pembelian_detail($id) ??
            $this->pembelianRepository->backWithErrors('Gagal Menghapus data');;
        return response()->json('PembelianDetail Telah dihapus', 204);
    }
}
