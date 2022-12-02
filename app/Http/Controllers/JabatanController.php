<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JabatanController extends Controller
{
    public function data(Request $request)
    {
        $jabatan = Jabatan::all();
        return datatables()
            ->of($jabatan)
            ->addIndexColumn()
            ->addColumn('tgl_buat', function ($jabatan) {
                return date('Y-m-d H:i:s', strtotime($jabatan->created_at));
            })
            ->addColumn('aksi', function ($jabatan) {
                return '
                    <div class="btn-group">
                        <button onClick="editForm(`' . route('jabatan.update', $jabatan->id_jabatan) . '`)" class="btn btn-info btn-xs"><i class="fas fa-pen fa-xs"></i> Edit</button>
                        <button onClick="deleteData(`' . route('jabatan.destroy', $jabatan->id_jabatan) . '`)" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i> Delete</button>
                    </div>
                ';
            })
            ->rawcolumns(['aksi'])
            ->make(true);
    }
    public function index()
    {
        return view('jabatan.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validatedData = \Validator::make($input, [
            'kode_jabatan' => 'required',
            'nama_jabatan' => 'required',
        ], [
            'required' => 'Kolom :attribute Harus Diisi.',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()->all()]);
        }
        Jabatan::create($input);

        return response()->json('Data Berhasil Disimpan', 200);
    }

    public function show($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        return response()->json($jabatan, 200);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $update = $request->all();

        $validatedData = Validator::make($update, [
            'kode_jabatan' => 'required',
            'nama_jabatan' => 'required',
        ], [
            'required' => 'Kolom :attribute Harus Diisi.',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()->all()]);
        }

        $jabatan = Jabatan::findOrFail($id);
        $jabatan->update($update);
        return response()->json('Jabatan Telah diedit', 200);
    }

    public function destroy($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        $jabatan->delete();
        return response()->json('Jabatan Telah dihapus', 204);
    }
}
