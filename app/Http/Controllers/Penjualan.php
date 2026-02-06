<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenjualanModel;
use App\Models\PelangganModel;
use App\Models\ProdukModel;

class Penjualan extends Controller
{
    public function form_penjualan()
    {
        $pelanggan = PelangganModel::all();
        $produk = ProdukModel::all();
        return view('penjualan', ['pelanggan' => $pelanggan, 'produk' => $produk]);
    }

    public function proses_data_penjualan(Request $request)
    {
        try {
            // Simpan penjualan
            $penjualan = PenjualanModel::create([
                'PelangganID' => $request->PelangganID,
                'TanggalPenjualan' => $request->TanggalPenjualan,
                'TotalHarga' => $request->TotalHarga
            ]);
            
            // Simpan detail penjualan
            $produkIds = $request->ProdukID ?? [];
            $jumlahProduk = $request->JumlahProduk ?? [];
            $subTotals = $request->SubTotal ?? [];
            
            for ($i = 0; $i < count($produkIds); $i++) {
                if (!empty($produkIds[$i])) {
                    \DB::table('detail_penjualan')->insert([
                        'PenjualanID' => $penjualan->id,
                        'ProdukID' => $produkIds[$i],
                        'JumlahProduk' => $jumlahProduk[$i] ?? 1,
                        'SubTotal' => $subTotals[$i] ?? 0
                    ]);
                }
            }
            
            return redirect('/input-penjualan')->with('sukses', 'data nambah');
        } catch (\Exception $e) {
            return redirect('/input-penjualan')->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function lihat_data_penjualan()
    {
        $data = PenjualanModel::with('pelanggan')->get();
        return view('datapenjualan', ['data' => $data]);
    }

    public function form_edit_penjualan($id)
    {
        $penjualan = PenjualanModel::findOrFail($id);
        $pelanggan = PelangganModel::all();
        $produk = ProdukModel::all();
        $detail_penjualan = \DB::table('detail_penjualan')
            ->where('PenjualanID', $id)
            ->get();
        
        // Load produk data untuk detail penjualan
        foreach ($detail_penjualan as $detail) {
            $detail->produk = ProdukModel::find($detail->ProdukID);
        }
        
        return view('form_edit_penjualan', [
            'penjualan' => $penjualan,
            'pelanggan' => $pelanggan,
            'produk' => $produk,
            'detail_penjualan' => $detail_penjualan
        ]);
    }

    public function update_data_penjualan(Request $request, $id)
    {
        try {
            $penjualan = PenjualanModel::findOrFail($id);
            
            // Update penjualan
            $penjualan->update([
                'PelangganID' => $request->PelangganID,
                'TanggalPenjualan' => $request->TanggalPenjualan,
                'TotalHarga' => $request->TotalHarga
            ]);
            
            // Hapus detail penjualan lama
            \DB::table('detail_penjualan')->where('PenjualanID', $id)->delete();
            
            // Simpan detail penjualan baru
            $produkIds = $request->ProdukID ?? [];
            $jumlahProduk = $request->JumlahProduk ?? [];
            $subTotals = $request->SubTotal ?? [];
            
            for ($i = 0; $i < count($produkIds); $i++) {
                if (!empty($produkIds[$i])) {
                    \DB::table('detail_penjualan')->insert([
                        'PenjualanID' => $id,
                        'ProdukID' => $produkIds[$i],
                        'JumlahProduk' => $jumlahProduk[$i] ?? 1,
                        'SubTotal' => $subTotals[$i] ?? 0
                    ]);
                }
            }
            
            return redirect('/datapenjualan')->with('sukses', 'udah diupdate yach');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function delete_data_penjualan($id)
    {
        try {
            $penjualan = PenjualanModel::findOrFail($id);
            
            // Hapus detail penjualan
            \DB::table('detail_penjualan')->where('PenjualanID', $id)->delete();
            
            // Hapus penjualan
            $penjualan->delete();
            
            return redirect('/datapenjualan')->with('sukses', 'dah keapus nih');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
