<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\PembelianDetail;
use App\Models\Supplier;
use App\Repositories\PembelianRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PembelianController extends Controller
{
    private $pembelianRepository;
    public function __construct(PembelianRepository $pembelianRepository)
    {
        $this->pembelianRepository = $pembelianRepository;
    }

    public function data(Request $request)
    {
        $pembelian = Pembelian::all();
        return datatables()
            ->of($pembelian)
            ->addIndexColumn()
            ->addColumn('tgl_buat', function ($pembelian) {
                return date('Y-m-d H:i:s', strtotime($pembelian->created_at));
            })
            ->addColumn('total_harga', function ($pembelian) {
                return 'Rp ' . format_uang($pembelian->total_harga);
            })
            ->addColumn('bayar', function ($pembelian) {
                return 'Rp ' . format_uang($pembelian->bayar);
            })
            ->addColumn('nominal', function ($pembelian) {
                return 'Rp ' . format_uang($pembelian->nominal);
            })
            ->addColumn('aksi', function ($pembelian) {
                return '
                    <div class="btn-group">
                        <button onClick="deleteData(`' . route('pembelian.destroy', $pembelian->id_pembelian) . '`)" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i> Delete</button>
                    </div>
                ';
            })
            ->rawcolumns(['aksi', 'bayar', 'nominal', 'total_harga'])
            ->make(true);
    }
    public function index()
    {
        if (session('id_pembelian')) {
            return redirect()->route('pembeliandetail.index');
        }
        $supplier = Supplier::orderBy('nama')->get();
        return view('pembelian.index', compact('supplier'));
    }

    public function create($id)
    {
        $data = [
            'id_supplier'   => $id,
            'total_item'    => '0',
            'total_harga'   => '0',
            'diskon'        => '0',
            'bayar'         => '0',
            'nominal'       => '0',
            'tgl_pembelian' => '0',
        ];
        $pembelian = Pembelian::create($data);

        session(['id_pembelian' => $pembelian->id_pembelian]);
        session(['id_supplier' => $pembelian->id_supplier]);

        return redirect()->route('pembeliandetail.index');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validatedData = Validator::make($input, [
            'id_supplier'   => 'required',
            'total_item'    => 'required',
            'total_harga'   => 'required',
            'diskon'        => 'required',
            'bayar'         => 'required',
            'nominal'       => 'required',
            'tgl_pembelian' => 'required',
        ], [
            'required' => 'Kolom :attribute Harus Diisi.',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()->all()]);
        }

        Pembelian::create($input);
        return response()->json('Pembelian Telah Ditambah');
    }

    public function show($id)
    {
        $pembelian = Pembelian::leftJoin('tbl_supplier', 'tbl_pembelian.id_supplier', 'tbl_supplier.id_supplier')
            ->leftJoin('tbl_pembelian_detail', 'tbl_pembelian.id_pembelian', 'tbl_pembelian_detail.id_pembelian')
            ->leftJoin('tbl_produk', 'tbl_pembelian_detail.kode_produk', 'tbl_produk.kode_produk')
            ->where('tbl_pembelian.id_pembelian', $id)->first();
        $pembelian['tgl_trs'] = date('Ymd', strtotime($pembelian->created_at));
        $pembelian['harga_satuan'] =  $pembelian->bayar / $pembelian->total_item;
        // dd(date('Ymd', strtotime($pembelian->created_at)));
        return response()->json($pembelian, 200);
    }

    public function detail($id)
    {
        $detail = PembelianDetail::leftJoin('tbl_produk as b', 'tbl_pembelian_detail.id_produk', 'b.id_produk')->where('id_pembelian', $id)->get();
        return view('pembelian.detail', compact('detail'));
    }

    public function update(Request $request, $id)
    {
        $this->pembelianRepository->update_pembelian($request->all(), $id) ??
            $this->pembelianRepository->backWithErrors('Gagal Update Penjualan Master!');

        return redirect()->route('pembelian.index')->with('success_message', 'Pembelian Berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $pembalian_detail = PembelianDetail::where('id_pembelian', $id);
        if ($pembalian_detail) {
            $this->pembelianRepository->destroy_pembelian($id) ??
                $this->pembelianRepository->backWithErrors('Gagal menghapus penjualan Master');;
            return redirect()->route('pembelian.index')->with('success_message', 'Pembelian Berhasil Dihapus.');
        } else {
            return abort(404);
        }
    }
}
