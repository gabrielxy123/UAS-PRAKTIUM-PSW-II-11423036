<!-- resources/views/custom_error.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 403</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Atau gunakan link ke file CSS Bootstrap yang sudah diunduh di proyek Anda -->
    <!-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"> -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .error-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .error-content {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-content">
            <h1 class="display-1">403 - TIDAK DIIZINKAN</h1>
            <p class="lead">Anda tidak ada akses untuk halaman ini.</p>
            <a href="/" class="btn btn-primary">Kembali ke Beranda</a>
        </div>
    </div>
</body>
</html>
