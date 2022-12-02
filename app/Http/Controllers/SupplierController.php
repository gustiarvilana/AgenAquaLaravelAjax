<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Laravolt\Indonesia\Models\City;

class SupplierController extends Controller
{
    public function data(Request $request)
    {
        $supplier = Supplier::all();
        return datatables()
            ->of($supplier)
            ->addIndexColumn()
            ->addColumn('tgl_buat', function ($supplier) {
                return date('Y-m-d H:i:s', strtotime($supplier->created_at));
            })
            ->addColumn('aksi', function ($supplier) {
                return '
                    <div class="btn-group">
                        <button onClick="editForm(`' . route('supplier.update', $supplier->id_supplier) . '`)" class="btn btn-info btn-xs"><i class="fas fa-pen fa-xs"></i> Edit</button>
                        <button onClick="deleteData(`' . route('supplier.destroy', $supplier->id_supplier) . '`)" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i> Delete</button>
                    </div>
                ';
            })
            ->rawcolumns(['aksi'])
            ->make(true);
    }
    public function index()
    {
        $cities = City::where('province_code', '32')->pluck('name', 'id');
        return view('supplier.index', compact('cities'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validatedData = \Validator::make($input, [
            'no_supplier'  => 'required|unique:tbl_supplier,no_supplier',
            'nama'         => 'required|unique:tbl_supplier,nama',
            'alamat'       => 'required',
            'telepon'      => 'required',
            'id_kelurahan' => 'required',
            'id_kecamatan' => 'required',
            'id_kota'      => 'required',
        ], [
            'required' => 'Kolom :attribute Harus Diisi.',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()->all()]);
        }
        Supplier::create($input);

        return response()->json('Data Berhasil Disimpan', 200);
    }

    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        return response()->json($supplier, 200);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $update = $request->all();

        $validatedData = FacadesValidator::make($update, [
            'no_supplier'  => 'sometimes',
            'nama'         => 'sometimes',
            'alamat'       => 'sometimes',
            'telepon'      => 'sometimes',
            'id_kelurahan' => 'sometimes',
            'id_kecamatan' => 'sometimes',
            'id_kota'      => 'sometimes',
        ], [
            'required' => 'Kolom :attribute Harus Diisi.',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()->all()]);
        }

        $supplier = Supplier::findOrFail($id);
        $supplier->update($update);
        return response()->json('Supplier Telah diedit', 200);
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return response()->json('Supplier Telah dihapus', 204);
    }
}
