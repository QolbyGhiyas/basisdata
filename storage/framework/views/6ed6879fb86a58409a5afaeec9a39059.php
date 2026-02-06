<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Penjualan - Pengelolaan Basis Data</title>
    <link rel="stylesheet" href="/bootstrap-5.3.8/css/bootstrap.min.css">
    <style>
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height:100vh; color:#222; }
        .card { border-radius:12px; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title mb-4">Input Penjualan</h3>

                        <form method="POST" action="<?php echo e(route('insert.penjualan')); ?>">
                            <?php echo csrf_field(); ?>

                            <div class="mb-3">
                                <label for="PelangganID" class="form-label">Pelanggan</label>
                                <select id="PelangganID" name="PelangganID" class="form-select" required>
                                    <option value="">-- Pilih Pelanggan --</option>
                                    <?php $__currentLoopData = $pelanggan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($p->id); ?>"><?php echo e($p->NamaPelanggan); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="TanggalPenjualan" class="form-label">Tanggal Penjualan</label>
                                <input type="date" id="TanggalPenjualan" name="TanggalPenjualan" class="form-control" value="<?php echo e(date('Y-m-d')); ?>" required>
                            </div>

                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Detail Skin</h5>
                                    <div class="table-responsive">
                                        <table class="table align-middle" id="produkTable">
                                            <thead>
                                                <tr>
                                                    <th>Skin</th>
                                                    <th>Harga</th>
                                                    <th>Jumlah</th>
                                                    <th>Subtotal</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="produkBody">
                                                <tr class="produk-row">
                                                    <td>
                                                        <select name="ProdukID[]" class="form-select produk-select" required>
                                                            <option value="">-- Pilih Skin --</option>
                                                            <?php $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($p->id); ?>" data-harga="<?php echo e($p->HargaProduk); ?>"><?php echo e($p->NamaProduk); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control harga-input" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="JumlahProduk[]" class="form-control jumlah-input" min="1" value="1" required>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control subtotal-input" readonly>
                                                        <input type="hidden" name="SubTotal[]" class="subtotal-hidden">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-danger" onclick="hapusRow(this)">Hapus</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <button type="button" class="btn btn-sm btn-info" onclick="tambahRow()">+ Tambah Produk</button>

                                    <div class="mt-3 text-end">
                                        <div class="fw-bold">Total Harga: Rp <span id="totalHargaDisplay">0</span></div>
                                        <input type="hidden" id="TotalHarga" name="TotalHarga" value="0">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-success">Simpan Penjualan</button>
                                <a href="<?php echo e(route('lihat_penjualan')); ?>" class="btn btn-secondary">Lihat Daftar</a>
                                <a href="<?php echo e(url('/')); ?>" class="btn btn-outline-primary">Kembali ke Dashboard</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Data produk dari server
    const produkData = {
        <?php $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo e($p->id); ?>: { nama: "<?php echo e(addslashes($p->NamaProduk)); ?>", harga: <?php echo e($p->HargaProduk); ?> },
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php /**PATH C:\laragon\www\pengelolaan-basisdata\resources\views/penjualan.blade.php ENDPATH**/ ?>