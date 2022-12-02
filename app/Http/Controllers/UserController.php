<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function data(Request $request)
    {
        $user = User::all();
        return datatables()
            ->of($user)
            ->addIndexColumn()
            ->addColumn('tgl_buat', function ($user) {
                return date('Y-m-d H:i:s', strtotime($user->created_at));
            })
            ->addColumn('aksi', function ($user) {
                return '
                    <div class="btn-group">
                        <button onClick="editForm(`' . route('user.update', $user->id_user) . '`)" class="btn btn-info btn-xs"><i class="fas fa-pen fa-xs"></i> Edit</button>
                        <button onClick="deleteData(`' . route('user.destroy', $user->id_user) . '`)" class="btn btn-danger btn-xs"><i class="fas fa-trash fa-xs"></i> Delete</button>
                    </div>
                ';
            })
            ->rawcolumns(['aksi'])
            ->make(true);
    }
    public function index()
    {
        return view('user.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validatedData = \Validator::make($input, [
            'name' => 'required',
            'nik' => 'required',
            'username' => 'required',
            'jabatan' => 'required',
            'email' => 'required',
            'password' => 'required',
        ], [
            'required' => 'Kolom :attribute Harus Diisi.',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()->all()]);
        }

        $input['password'] = Hash::make($input['password']);

        User::create($input);

        return response()->json('Data Berhasil Disimpan', 200);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user, 200);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $update = $request->all();

        $validatedData = Validator::make($update, [
            'name' => 'required',
            'nik' => 'required',
            'username' => 'required',
            'jabatan' => 'required',
            'email' => 'required',
            'password' => 'required',
        ], [
            'required' => 'Kolom :attribute Harus Diisi.',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()->all()]);
        }

        $input['password'] = Hash::make($update['password']);

        $user = User::findOrFail($id);
        $user->update($update);
        return response()->json('User Telah diedit', 200);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json('User Telah dihapus', 204);
    }
}
