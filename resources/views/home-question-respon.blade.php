<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respon Pertanyaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .thank-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }
        .quote-box {
            background-color: #f8f9fa;
            border-left: 4px solid #0d6efd;
            border-radius: 6px;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 p-3">

    <div class="card thank-card p-4 p-md-5 text-center col-12 col-md-8 col-lg-6">
        <h2 class="fw-bold text-primary mb-2">
            Terima Kasih, {{ strtoupper($nama) }}! 🎉
        </h2>
        <p class="text-muted mb-4">Pertanyaan Anda telah berhasil dikirim.</p>

        <div class="quote-box p-4 mb-4">
            <h6 class="fw-bold text-dark mb-2">Pertanyaan Anda:</h6>
            <p class="fst-italic text-secondary fs-5 mb-0">"{{ $pertanyaan }}"</p>
        </div>

        <p class="fst-italic text-muted small mb-2">
            Pertanyaan Anda akan segera kami tanggapi dan balas melalui email <strong>{{ $email }}</strong>.
        </p>
        <p class="fst-italic text-muted small mb-4">
            Mohon cek kotak masuk atau folder spam Anda secara berkala.
        </p>

        <div>
            <a href="{{ url('/home') }}" class="btn btn-primary px-4 py-2">Kembali ke Beranda</a>
        </div>
    </div>

</body>
</html>