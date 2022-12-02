<?php

namespace App\Repositories;

use App\Models\Pembelian;
use App\Models\PembelianDetail;
use App\Models\Pengeluaran;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PembelianRepository
{
    public function store_pembelian_detail($input)
    {
        $detail = PembelianDetail::where('id_pembelian', session('id_pembelian'))
            ->first();

        DB::beginTransaction();
        try {
            if ($detail) {
                $detail->update([
                    'jml_barang' => $detail->jml_barang + $input['jml_barang']
                ]);
            } else {
                PembelianDetail::create($input);
                $this->tambahProduk($input);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }

        return;
    }
    public function delete_pembelian_detail($id_pembelian_detail)
    {
        $pembeliandetail = PembelianDetail::findOrFail($id_pembelian_detail);


        DB::beginTransaction();
        try {
            $this->kurangiProduk($pembeliandetail);
            $pembeliandetail->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::info('gagal hapus pemb.Detail' . $th->getMessage());
        }

        return;
    }

    public function tambahProduk($input)
    {
        // dd($input);
        $produk = Produk::where('kode_produk', $input['id_produk'])->first();
        DB::beginTransaction();
        try {
            $produk->update([
                'qty' => $produk->qty + $input['jml_barang']
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }

        return;
    }

    public function kurangiProduk($pembeliandetail)
    {
        $produk = Produk::where('kode_produk', $pembeliandetail['id_produk'])->first();
        DB::beginTransaction();
        try {
            $produk->update([
                'qty' => $produk->qty - $pembeliandetail['jml_barang']
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }

        return;
    }

    public function update_pembelian($update, $id_pembelian)
    {
        $bayar = $update['bayar'];
        $nominal = $update['nominal'];
        if ($bayar != $nominal) {
            return redirect()->route('pembelian.index')->with('error_message', 'Cek Nominal Pembayaran');
        }
        $update['total_harga'] = str_replace(".", "", $update['total_harga']);
        $update['id_pembelian'] = session('id_pembelian');
        $update['tgl_pembelian'] = date('Ymd', strtotime($update['tgl_pembelian']));
        $validatedData = Validator::make($update, [
            'id_supplier' => '',
            'total_item'  => 'required',
            'total_harga' => 'required',
            'diskon'      => '',
            'bayar'       => 'required',
            'nominal'     => 'required',
            'tgl_pembelian'     => 'required',
        ], [
            'required' => 'Kolom :attribute Harus Diisi.',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()->all()]);
        }

        $pembelian = Pembelian::findOrFail($id_pembelian);
        DB::beginTransaction();
        try {
            $pembelian->update($update);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('pembelian.index')->with('success_message', 'Pembelian Gagal ditambahkan =>' . $th->getMessage());
        }

        session()->forget([
            'id_pembelian',
            'id_supplier',
        ]);

        $this->createPengeluaran($update);

        return $update;
    }

    public function destroy_pembelian($id)
    {
        $pembelian = Pembelian::find($id);
        $pembeliandetail = PembelianDetail::where('id_pembelian', $id)->get();

        DB::beginTransaction();
        try {
            foreach ($pembeliandetail as $value) {
                $value->delete();
                $this->kurangiProduk($value);
            }
            $this->destroy_pengeluaran($id);
            $pembelian->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::info('gagal delete' . $th->getMessage());
        }
    }

    public function createPengeluaran($update)
    {
        // dd($update);

        DB::beginTransaction();
        try {
            Pengeluaran::create([
                'id_transaksi'        => $update['id_pembelian'],
                'nama_pengeluaran'    => 'Pembelian Produk Penjualan',
                'tipe_pengeluaran'    => '6201',
                'nominal_pengeluaran' => (int)$update['total_harga'],
                'tgl_pengeluaran'     => (int)$update['tgl_pembelian'],
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::info('Pembelian Gagal ditambahkan =>' . $th->getMessage());
            return redirect()->route('pembelian.index')->with('success_message', 'Pembelian Gagal ditambahkan =>' . $th->getMessage());
        }

        return;
    }

    public function destroy_pengeluaran($id)
    {
        $pengeluaran = Pengeluaran::where('id_transaksi', $id);
        $pengeluaran->delete();
        // dd($pengeluaran);
    }

    public function backWithErrors($data)
    {
        return Log::info('error_message => ' . $data);
    }
}
