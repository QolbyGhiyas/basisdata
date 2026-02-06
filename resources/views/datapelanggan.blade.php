<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan - Pengelolaan Basis Data</title>
    <link rel="stylesheet" href="/bootstrap-5.3.8/css/bootstrap.min.css">
    <style>
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height:100vh; color:#222; }
        .page-header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 2rem 0; margin-bottom: 2rem; border-radius: 0 0 12px 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); }
        .page-header h1 { margin: 0; font-weight: 700; }
        .page-header p { margin: 0.5rem 0 0 0; font-size: 0.95rem; opacity: 0.9; }
    </style>
</head>
<body>
    <div class="page-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1>ᓚ₍⑅^..^₎♡ Data Akun </h1>
                </div>
                <a href="/" class="btn btn-light btn-sm">← Balik ke Dashboard</a>
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

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Pelanggan</th>
                                <th>Akun</th>
                                <th>Nomor Telepon</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $pe)
                                <tr>
                                    <td class="fw-500">{{ $pe->NamaPelanggan }}</td>
                                    <td>{{ $pe->Alamat }}</td>
                                    <td>{{ $pe->NomorTelepon }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('form_edit_pelanggan', $pe->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="{{ route('delete_pelanggan', $pe->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        <p class="mb-2">Belum ada data pelanggan</p>
                                        <a href="/input-pelanggan" class="btn btn-sm btn-primary">+ Tambah Pelanggan Pertama</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="text-center">
            <a href="/input-pelanggan" class="btn btn-success">+ Tambah Pelanggan</a>
        </div>
    </div>

    <script src="/bootstrap-5.3.8/js/bootstrap.bundle.min.js"></script>
</body>
</html>