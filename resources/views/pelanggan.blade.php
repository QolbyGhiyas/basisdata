<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Pelanggan - Pengelolaan Basis Data</title>
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
                        <h3 class="card-title mb-1">👤 Input Pelanggan</h3>
                        <p class="text-muted mb-4">Tambahkan pelanggan baru ke sistem</p>

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

                        <form action="{{ route('insert') }}" method="post">
                            @csrf

                            <div class="mb-3">
                                <label for="NamaPelanggan" class="form-label">Nama Pelanggan</label>
                                <input type="text" id="NamaPelanggan" name="NamaPelanggan" class="form-control" placeholder="Namanya siapa?" required>
                            </div>

                            <div class="mb-3">
                                <label for="Alamat" class="form-label">Alamat</label>
                                <textarea id="Alamat" name="Alamat" class="form-control" placeholder="Alamatnya bos" rows="4" required></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="NomorTelepon" class="form-label">Nomor Telepon</label>
                                <input type="text" id="NomorTelepon" name="NomorTelepon" class="form-control" placeholder="Nomor telepon juga" required>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-success flex-grow-1">Simpan Pelanggan</button>
                                <a href="{{ route('read') }}" class="btn btn-secondary flex-grow-1">Lihat Data</a>
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
</html>