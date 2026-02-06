<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penjualan - Pengelolaan Basis Data</title>
    <link rel="stylesheet" href="/bootstrap-5.3.8/css/bootstrap.min.css">
    <style>
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height:100vh; color:#222; }
        .page-header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 2rem 0; margin-bottom: 2rem; border-radius: 0 0 12px 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); }
        .page-header h1 { margin: 0; font-weight: 700; }
        .page-header p { margin: 0.5rem 0 0 0; font-size: 0.95rem; opacity: 0.9; }
        .price-total { font-weight: 700; color: #00f2fe; }
        .product-list { list-style: none; padding: 0; margin: 0; }
        .product-list li { padding: 4px 0; color: #555; font-size: 0.9em; }
        .product-list li::before { content: "• "; color: #667eea; font-weight: bold; margin-right: 6px; }
    </style>
</head>
<body>
    <div class="page-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1>⁶🤷‍♂️⁷ Data Penjualan</h1>
                    <p>Semoga ngga rugi</p>
                </div>
                <a href="/" class="btn btn-light btn-sm">← Kembali ke Dashboard</a>
            </div>
        </div>
    </div>

    <div class="container py-4">
        @if (session('sukses'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('sukses') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @forelse ($data as $penjualan)
            @if ($loop->first)
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">ID</th>
                                        <th>Nama Pelanggan</th>
                                        <th class="text-center">Tanggal</th>
                                        <th>Skin</th>
                                        <th class="text-end">Total Harga</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
            @endif

                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center"><small class="text-muted">#{{ $penjualan->id }}</small></td>
                        <td>{{ $penjualan->pelanggan->NamaPelanggan ?? 'N/A' }}</td>
                        <td class="text-center"><small>{{ \Carbon\Carbon::parse($penjualan->TanggalPenjualan)->format('d M Y') }}</small></td>
                        <td>
                            @php
                                $details = \DB::table('detail_penjualan')->where('PenjualanID', $penjualan->id)->get();
                            @endphp
                            @if ($details->count() > 0)
                                <ul class="product-list">
                                    @foreach ($details as $detail)
                                        @php
                                            $produk = \App\Models\ProdukModel::find($detail->ProdukID);
                                        @endphp
                                        <li>{{ $produk->NamaProduk ?? 'N/A' }} <strong>({{ $detail->JumlahProduk }}x)</strong></li>
                                    @endforeach
                                </ul>
                            @else
                                <em class="text-muted">Tidak ada produk</em>
                            @endif
                        </td>
                        <td class="text-end price-total">Rp {{ number_format($penjualan->TotalHarga, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <a href="{{ route('form_edit_penjualan', $penjualan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <a href="{{ route('delete_penjualan', $penjualan->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>

            @if ($loop->last)
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <div class="card shadow-sm">
                <div class="card-body text-center py-5">
                    <div style="font-size:3em; margin-bottom:1rem;">📭</div>
                    <p class="text-muted mb-3">Tidak ada data penjualan</p>
                    <a href="{{ route('form_penjualan') }}" class="btn btn-sm btn-primary">+ Tambah Penjualan Pertama</a>
                </div>
            </div>
        @endforelse

        <div class="text-center">
            <a href="{{ route('form_penjualan') }}" class="btn btn-success">+ Tambah Penjualan</a>
        </div>
    </div>

    <script src="/bootstrap-5.3.8/js/bootstrap.bundle.min.js"></script>
</body>
</html>
