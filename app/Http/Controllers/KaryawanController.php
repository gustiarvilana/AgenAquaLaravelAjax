<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    public function data(Request $request)
    {
        $karyawan = Karyawan::all();
        return datatables()
            ->of($karyawan)
            ->addIndexColumn()
            ->addColumn('tgl_buat', function ($karyawan) {
                return date('Y-m-d H:i:s', strtotime($karyawan->created_at));
            })
            ->addColumn('aksi', function ($karyawan) {
                return '
                    <div class="btn-group">
                        <button onClick="editForm(`' . route('karyawan.update', $karyawan->id_karyawan) . '`)" class="btn btn-info btn-xs"><i class="fas fa-pen fa-xs"></i> Edit</button>
                        <button onClick="deleteData(`' . route('karyawan.destroy', $karyawan->id_karyawan) . '`)" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i> Delete</button>
                    </div>
                ';
            })
            ->rawcolumns(['aksi'])
            ->make(true);
    }
    public function index()
    {
        $jabatan = Jabatan::all();
        return view('karyawan.index', compact('jabatan'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validatedData = \Validator::make($input, [
            'nama' => 'required',
            'nik' => 'required',
            'no_ktp' => 'required',
            'jabatan' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ], [
            'required' => 'Kolom :attribute Harus Diisi.',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()->all()]);
        }
        Karyawan::create($input);

        return response()->json('Data Berhasil Disimpan', 200);
    }

    public function show($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return response()->json($karyawan, 200);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $update = $request->all();

        $validatedData = Validator::make($update, [
            'nama' => 'required',
            'nik' => 'required',
            'no_ktp' => 'required',
            'jabatan' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ], [
            'required' => 'Kolom :attribute Harus Diisi.',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()->all()]);
        }

        $karyawan = Karyawan::findOrFail($id);
        $karyawan->update($update);
        return response()->json('Karyawan Telah diedit', 200);
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();
        return response()->json('Karyawan Telah dihapus', 204);
    }
}
