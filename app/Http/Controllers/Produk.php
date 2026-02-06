<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukModel;

class Produk extends Controller
{
    public function proses_data_produk(Request $request) {

        try {
            // 1. Validasi
            $validation = $request->validate([
                'NamaProduk' => 'required|string|max:255',
                'HargaProduk' => 'required|numeric',
                'StokProduk' => 'required|numeric',
            ]);

            //2. Insert
            ProdukModel::create($validation);

            //3. Return to insert
            return redirect('/input-produk')->with('sukses', 'Data produk berhasil ditambahkan');

        } catch (\Exception $e) {
            return redirect('/input-produk')->with('error', 'Error: ' . $e->getMessage());
        }
    }

    // read
    public function lihat_data_produk() {
        $data = ProdukModel::get();

        return view('dataproduk', compact('data'));
    }

    //form
    public function form_edit_produk($id) {
        $data = ProdukModel::findOrFail($id);

        return view('form_update_produk', compact('data'));
    }

    // update
    public function update_data_produk(Request $request, $id) {
        try {
            // 1. Validasi
            $request->validate([
                'NamaProduk' => 'required|string',
                'HargaProduk' => 'required|numeric',
                'StokProduk' => 'required|string'
            ]);

            $data_id = ProdukModel::findOrFail($id);
            $data_id->update([
                'NamaProduk' => $request->NamaProduk,
                'HargaProduk' => $request->HargaProduk,
                'StokProduk' => $request->StokProduk
            ]);

            return redirect()->route('read.produk')->with('success', 'berhasil coi');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    //delete 
    public function delete_data_produk($id) {
        try {
            $data_id = ProdukModel::findOrFail($id);
            $data_id->delete();

            return redirect()->route('read.produk')->with('success', 'berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
