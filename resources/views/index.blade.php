@php
    $countPelanggan = \App\Models\PelangganModel::count();
    $countProduk = \App\Models\ProdukModel::count();
    $countTransaksi = \App\Models\PenjualanModel::count();
    $totalPenjualan = \App\Models\PenjualanModel::sum('TotalHarga');
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CS.money</title>
    <link rel="stylesheet" href="/bootstrap-5.3.8/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .page-title {
            color: #fff;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.25);
        }

        .stat-card {
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        }

        .stat-top {
            height: 6px;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="text-center mb-4">
            <h1 class="page-title">juwalan skin</h1>
        </div>

        <div class="row g-4">
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card stat-card h-100">
                    <div class="stat-top" style="background: linear-gradient(90deg, #667eea, #764ba2);"></div>
                    <div class="card-body">
                        <div class="fs-3">ᓚ₍⑅^..^₎♡</div>
                        <h6 class="text-uppercase text-muted">Account</h6>
                        <div class="display-6 fw-bold">{{ $countPelanggan }}</div>
                        <a href="{{ route('read') }}" class="btn btn-sm btn-primary mt-3">Lihat Detail</a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card stat-card h-100">
                    <div class="stat-top" style="background: linear-gradient(90deg, #f093fb, #f5576c);"></div>
                    <div class="card-body">
                        <div class="fs-3">▄︻╦芫≡══--  ⌯⁍</div>
                        <h6 class="text-uppercase text-muted">Skin</h6>
                        <div class="display-6 fw-bold text-danger">{{ $countProduk }}</div>
                        <a href="{{ route('read.produk') }}" class="btn btn-sm btn-danger mt-3">Lihat Detail</a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card stat-card h-100">
                    <div class="stat-top" style="background: linear-gradient(90deg, #4facfe, #00f2fe);"></div>
                    <div class="card-body">
                        <div class="fs-3">⁶🤷‍♂️⁷</div>
                        <h6 class="text-uppercase text-muted">Transaksi</h6>
                        <div class="display-6 fw-bold text-info">{{ $countTransaksi }}</div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card stat-card h-100">
                    <div class="stat-top" style="background: linear-gradient(90deg, #43e97b, #38f9d7);"></div>
                    <div class="card-body">
                        <div class="fs-3">📈📉💹🤔🤑</div>
                        <h6 class="text-uppercase text-muted">Total Penjualan</h6>
                        <div class="display-6 fw-bold text-success">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('form_penjualan') }}" class="btn btn-light me-2">+ Input Penjualan</a>
            <a href="{{ route('lihat_penjualan') }}" class="btn btn-outline-light">🛒💯 Data Penjualan</a>
        </div>
    </div>

    <script src="/bootstrap-5.3.8/js/bootstrap.bundle.min.js"></script>
</body>
</html>