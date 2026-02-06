<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Produk - Pengelolaan Basis Data</title>
    <link rel="stylesheet" href="/bootstrap-5.3.8/css/bootstrap.min.css">
    <style>
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height:100vh; display:flex; align-items:center; padding:2rem 1rem; }
        .card { border-radius:12px; border:none; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card shadow-lg">
                    <div class="card-body p-5">
                        <h3 class="card-title mb-1">📦 Input Produk</h3>
                        <p class="text-muted mb-4">Tambahkan produk baru ke inventory</p>

                        <?php if(session('sukses')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo e(session('sukses')); ?>

                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php elseif(session('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo e(session('error')); ?>

                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <form action="<?php echo e(route('insert.produk')); ?>" method="post">
                            <?php echo csrf_field(); ?>

                            <div class="mb-3">
                                <label for="NamaProduk" class="form-label">Nama Produk</label>
                                <input type="text" name="NamaProduk" id="NamaProduk" class="form-control" placeholder="Masukkan nama produk" required>
                                <?php $__errorArgs = ['NamaProduk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small mt-2"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="mb-3">
                                <label for="HargaProduk" class="form-label">Harga Produk</label>
                                <input type="number" name="HargaProduk" id="HargaProduk" class="form-control" placeholder="Masukkan harga produk" step="0.01" required>
                                <?php $__errorArgs = ['HargaProduk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small mt-2"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="mb-4">
                                <label for="StokProduk" class="form-label">Stok Produk</label>
                                <input type="number" name="StokProduk" id="StokProduk" class="form-control" placeholder="Masukkan stok produk" required>
                                <?php $__errorArgs = ['StokProduk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger small mt-2"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-success flex-grow-1">Simpan Produk</button>
                                <a href="<?php echo e(route('read.produk')); ?>" class="btn btn-secondary flex-grow-1">Lihat Daftar</a>
                                <a href="/" class="btn btn-outline-primary">Dashboard</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/bootstrap-5.3.8/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\laragon\www\pengelolaan-basisdata\resources\views/produk.blade.php ENDPATH**/ ?>