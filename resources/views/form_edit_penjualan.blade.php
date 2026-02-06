<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Penjualan - Pengelolaan Basis Data</title>
    <link rel="stylesheet" href="/bootstrap-5.3.8/css/bootstrap.min.css">
    <style>
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height:100vh; color:#222; }
        .card { border-radius:12px; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="card shadow-lg">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h3 class="card-title mb-1">📝 Edit Penjualan</h3>
                                <p class="text-muted mb-0">Perbarui data transaksi penjualan</p>
                            </div>
                            <a href="/" class="btn btn-sm btn-outline-primary">← Dashboard</a>
                        </div>

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

                        <form method="POST" action="{{ route('update_penjualan', $penjualan->id) }}">
                            @csrf

                            <div class="mb-3">
                                <label for="PelangganID" class="form-label">Pelanggan</label>
                                <select id="PelangganID" name="PelangganID" class="form-select" required>
                                    <option value="">-- Pilih Pelanggan --</option>
                                    @foreach ($pelanggan as $p)
                                        <option value="{{ $p->id }}" {{ $penjualan->PelangganID == $p->id ? 'selected' : '' }}>{{ $p->NamaPelanggan }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="TanggalPenjualan" class="form-label">Tanggal Penjualan</label>
                                <input type="date" id="TanggalPenjualan" name="TanggalPenjualan" class="form-control" value="{{ $penjualan->TanggalPenjualan }}" required>
                            </div>

                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">📦 Detail Produk</h5>
                                    <div class="table-responsive">
                                        <table class="table align-middle" id="produkTable">
                                            <thead>
                                                <tr>
                                                    <th>Produk</th>
                                                    <th>Harga</th>
                                                    <th>Jumlah</th>
                                                    <th>Subtotal</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="produkBody">
                                                @forelse ($detail_penjualan as $detail)
                                                    <tr class="produk-row">
                                                        <td>
                                                            <select name="ProdukID[]" class="form-select form-select-sm produk-select" required>
                                                                <option value="">-- Pilih Produk --</option>
                                                                @foreach ($produk as $p)
                                                                    <option value="{{ $p->id }}" data-harga="{{ $p->HargaProduk }}" {{ $detail->ProdukID == $p->id ? 'selected' : '' }}>{{ $p->NamaProduk }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control form-control-sm harga-input" value="{{ $detail->produk->HargaProduk ?? 0 }}" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="number" name="JumlahProduk[]" class="form-control form-control-sm jumlah-input" min="1" value="{{ $detail->JumlahProduk }}" required>
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control form-control-sm subtotal-input" value="{{ $detail->SubTotal }}" readonly>
                                                            <input type="hidden" name="SubTotal[]" class="subtotal-hidden" value="{{ $detail->SubTotal }}">
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-sm btn-danger" onclick="hapusRow(this)">Hapus</button>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr class="produk-row">
                                                        <td>
                                                            <select name="ProdukID[]" class="form-select form-select-sm produk-select" required>
                                                                <option value="">-- Pilih Produk --</option>
                                                                @foreach ($produk as $p)
                                                                    <option value="{{ $p->id }}" data-harga="{{ $p->HargaProduk }}">{{ $p->NamaProduk }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control form-control-sm harga-input" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="number" name="JumlahProduk[]" class="form-control form-control-sm jumlah-input" min="1" value="1" required>
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control form-control-sm subtotal-input" readonly>
                                                            <input type="hidden" name="SubTotal[]" class="subtotal-hidden">
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-sm btn-danger" onclick="hapusRow(this)">Hapus</button>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                    <button type="button" class="btn btn-sm btn-info" onclick="tambahRow()">+ Tambah Produk</button>

                                    <div class="mt-3 text-end">
                                        <div class="fw-bold" style="font-size: 1.1em; color: #667eea;">
                                            Total Harga: Rp <span id="totalHargaDisplay">{{ number_format($penjualan->TotalHarga, 0, ',', '.') }}</span>
                                        </div>
                                        <input type="hidden" id="TotalHarga" name="TotalHarga" value="{{ $penjualan->TotalHarga }}">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-success flex-grow-1">Update Penjualan</button>
                                <a href="{{ route('lihat_penjualan') }}" class="btn btn-secondary flex-grow-1">Lihat Daftar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    const produkData = {
        @foreach ($produk as $p)
            {{ $p->id }}: { nama: "{{ addslashes($p->NamaProduk) }}", harga: {{ $p->HargaProduk }} },
        @endforeach
    };

    function tambahRow() {
        const tbody = document.getElementById('produkBody');
        const newRow = document.querySelector('.produk-row').cloneNode(true);

        newRow.querySelector('.produk-select').value = '';
        newRow.querySelector('.harga-input').value = '';
        newRow.querySelector('.jumlah-input').value = '1';
        newRow.querySelector('.subtotal-input').value = '';
        newRow.querySelector('.subtotal-hidden').value = '';

        newRow.querySelector('.produk-select').addEventListener('change', updateHarga);
        newRow.querySelector('.jumlah-input').addEventListener('input', hitungSubtotal);

        tbody.appendChild(newRow);
    }

    function hapusRow(btn) {
        const tbody = document.getElementById('produkBody');
        if (tbody.querySelectorAll('.produk-row').length > 1) {
            btn.closest('tr').remove();
            hitungTotal();
        } else {
            alert('Minimal harus ada 1 produk');
        }
    }

    function updateHarga(e) {
        const row = e.target.closest('.produk-row');
        const produkId = e.target.value;
        const hargaInput = row.querySelector('.harga-input');

        if (produkId && produkData[produkId]) {
            hargaInput.value = produkData[produkId].harga;
        } else {
            hargaInput.value = '';
        }

        hitungSubtotal(e);
    }

    function hitungSubtotal(e) {
        const row = e.target.closest('.produk-row');
        const harga = parseFloat(row.querySelector('.harga-input').value) || 0;
        const jumlah = parseInt(row.querySelector('.jumlah-input').value) || 0;
        const subtotal = harga * jumlah;

        row.querySelector('.subtotal-input').value = subtotal;
        row.querySelector('.subtotal-hidden').value = subtotal;

        hitungTotal();
    }

    function hitungTotal() {
        const subtotals = Array.from(document.querySelectorAll('.subtotal-input'))
            .map(input => parseFloat(input.value) || 0)
            .reduce((a, b) => a + b, 0);

        document.getElementById('TotalHarga').value = subtotals;
        document.getElementById('totalHargaDisplay').textContent = subtotals.toLocaleString('id-ID');
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.produk-select').forEach(select => {
            select.addEventListener('change', updateHarga);
        });

        document.querySelectorAll('.jumlah-input').forEach(input => {
            input.addEventListener('input', hitungSubtotal);
        });

        hitungTotal();
    });
    </script>

    <script src="/bootstrap-5.3.8/js/bootstrap.bundle.min.js"></script>
</body>
</html>
