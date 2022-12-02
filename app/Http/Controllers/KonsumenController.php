<?php

namespace App\Http\Controllers;

use App\Models\HargaJenis;
use App\Models\Konsumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravolt\Indonesia\Models\City;

class KonsumenController extends Controller
{
    public function data(Request $request)
    {
        $konsumen = Konsumen::all();
        return datatables()
            ->of($konsumen)
            ->addIndexColumn()
            ->addColumn('tgl_buat', function ($konsumen) {
                return date('Y-m-d H:i:s', strtotime($konsumen->created_at));
            })
            ->addColumn('aksi', function ($konsumen) {
                return '
                    <div class="btn-group">
                        <button onClick="editForm(`' . route('konsumen.update', $konsumen->id_konsumen) . '`)" class="btn btn-info btn-xs"><i class="fas fa-pen fa-xs"></i> Edit</button>
                        <button onClick="deleteData(`' . route('konsumen.destroy', $konsumen->id_konsumen) . '`)" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i> Delete</button>
                    </div>
                ';
            })
            ->rawcolumns(['aksi'])
            ->make(true);
    }
    public function index()
    {
        $cities = City::where('province_code', '32')->pluck('name', 'id');
        $jenis_pelanggan = HargaJenis::all();
        return view('konsumen.index', compact('cities', 'jenis_pelanggan'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validatedData = \Validator::make($input, [
            'kode_konsumen'  => '',
            'nama'           => 'required',
            'alamat'         => 'required',
            'telepon'        => 'required',
            'id_kelurahan'   => 'required',
            'id_kecamatan'   => 'required',
            'id_kota'        => 'required',
            'tipe_pelanggan' => 'required',
        ], [
            'required' => 'Kolom :attribute Harus Diisi.',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()->all()]);
        }

        // auto Number
        $data = Konsumen::latest()->first();
        $kode_baru = date('ym') . '00' . 1;
        if (!$data) {
            $kode = $kode_baru;
        } else {
            $kode_lama = (int)substr($data['kode_konsumen'], 1);
            if ($kode_lama < $kode_baru) {
                $kode = $kode_baru;
            } else {
                $kode = $kode_lama + 1;
            }
        }
        $new_kode = 'K' . $kode;

        $input['kode_konsumen'] = $new_kode;
        Konsumen::create($input);

        return response()->json('Data Berhasil Disimpan', 200);
    }

    public function show($id)
    {
        $konsumen = Konsumen::findOrFail($id);
        return response()->json($konsumen, 200);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $update = $request->all();

        $validatedData = Validator::make($update, [
            'kode_konsumen'  => '',
            'nama'           => 'required',
            'alamat'         => 'required',
            'telepon'        => 'required',
            'id_kelurahan'   => 'required',
            'id_kecamatan'   => 'required',
            'id_kota'        => 'required',
            'tipe_pelanggan' => 'required',
        ], [
            'required' => 'Kolom :attribute Harus Diisi.',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()->all()]);
        }

        $konsumen = Konsumen::findOrFail($id);
        $konsumen->update($update);
        return response()->json('Konsumen Telah diedit', 200);
    }

    public function destroy($id)
    {
        $konsumen = Konsumen::findOrFail($id);
        $konsumen->delete();
        return response()->json('Konsumen Telah dihapus', 204);
    }
}
