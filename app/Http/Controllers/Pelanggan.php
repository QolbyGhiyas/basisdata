<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PelangganModel;

class Pelanggan extends Controller
{
    public function proses_data_pelanggan(Request $request) {

        try {
            // 1. Validasi
        $validation = $request->validate([
            'NamaPelanggan' => 'required|string',
            'Alamat' => 'required|string',
            'NomorTelepon' => 'required|min_digits:10|max_digits:12',
        ]);
        
        //2. Insert
        PelangganModel::create($validation);

        //3. Return to insert
        return redirect()->back()->with('anjay success', 'kasih paham bos bos');

        } catch (\Exception $e) {
            return redirect()->back()->with('eror kocak', $e->getMessage());
        }
    }

    // read
    public function lihat_data_pelanggan() {
        $data = PelangganModel::get();

        return view('datapelanggan', compact('data'));
    }

    //form
    public function form_edit_pelanggan($id) {
        $data = PelangganModel::findOrFail($id);

        return view('form_update_pelanggan', compact('data'));
    }

    // update
    public function update_data_pelanggan(Request $request, $id) {

        try {
            // 1. Validasi
            $request->validate([
                'NamaPelanggan' => 'required|string',
                'Alamat' => 'required|string',
                'NomorTelepon' => 'required|min_digits:10|max_digits:12',
            ]);

            $data_id = PelangganModel::findOrFail($id);
            $data_id->update([
                'NamaPelanggan' => $request->NamaPelanggan,
                'Alamat' => $request->Alamat,
                'NomorTelepon' => $request->NomorTelepon
            ]);

            return redirect()->route('read')->with('success', 'berhasil coi');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    //delete 
    public function delete_data_pelanggan($id) {
        try {
            $data_id = PelangganModel::findOrFail($id);
            $data_id->delete();

            return redirect()->route('read')->with('success', 'berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
