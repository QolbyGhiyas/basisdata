<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Pengelolaan Basis Data</title>
    <link rel="stylesheet" href="/bootstrap-5.3.8/css/bootstrap.min.css">
    <style>
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height:100vh; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center py-4">
    <div class="w-100" style="max-width: 600px;">
        <div class="container-fluid px-3">
            <a href="/" class="btn btn-sm btn-light mb-3">← Kembali ke Dashboard</a>

            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h1 class="h3 mb-2">📦 Edit Produk</h1>
                    <p class="text-muted mb-4">Perbarui data produk</p>

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

                    <form action="<?php echo e(route('update_produk', ['id' => $data->id])); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        
                        <div class="mb-3">
                            <label for="NamaProduk" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['NamaProduk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="NamaProduk" name="NamaProduk" placeholder="Masukkan nama produk" value="<?php echo e($data->NamaProduk); ?>" required>
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
                            <input type="number" class="form-control <?php $__errorArgs = ['HargaProduk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="HargaProduk" name="HargaProduk" placeholder="Masukkan harga produk" value="<?php echo e($data->HargaProduk); ?>" step="0.01" required>
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
                            <input type="number" class="form-control <?php $__errorArgs = ['StokProduk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="StokProduk" name="StokProduk" placeholder="Masukkan stok produk" value="<?php echo e($data->StokProduk); ?>" required>
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
                            <button type="submit" class="btn btn-success flex-grow-1">✓ Update Produk</button>
                            <a href="<?php echo e(route('read.produk')); ?>" class="btn btn-primary flex-grow-1">📦 Lihat Daftar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="/bootstrap-5.3.8/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\laragon\www\pengelolaan-basisdata\resources\views/form_update_produk.blade.php ENDPATH**/ ?>