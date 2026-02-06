<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pelanggan - Pengelolaan Basis Data</title>
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
                        <h3 class="card-title mb-1">👤 Edit Pelanggan</h3>
                        <p class="text-muted mb-4">Perbarui data pelanggan Anda</p>

                        <form action="{{ route('update_pelanggan', ['id' => $data->id]) }}" method="post">
                            @csrf

                            <div class="mb-3">
                                <label for="NamaPelanggan" class="form-label">Nama Pelanggan</label>
                                <input type="text" id="NamaPelanggan" name="NamaPelanggan" class="form-control" placeholder="Masukkan nama pelanggan" value="{{ $data->NamaPelanggan }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="Alamat" class="form-label">Alamat</label>
                                <textarea id="Alamat" name="Alamat" class="form-control" placeholder="Masukkan alamat pelanggan" rows="4" required>{{ $data->Alamat }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label for="NomorTelepon" class="form-label">Nomor Telepon</label>
                                <input type="text" id="NomorTelepon" name="NomorTelepon" class="form-control" placeholder="Masukkan nomor telepon" value="{{ $data->NomorTelepon }}" required>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-success flex-grow-1">Update Pelanggan</button>
                                <a href="{{ route('read') }}" class="btn btn-secondary flex-grow-1">Lihat Data</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/bootstrap-5.3.8/js/bootstrap.bundle.min.js"></script>
</body>
</html>