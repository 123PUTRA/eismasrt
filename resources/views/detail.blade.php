<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Event</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background: linear-gradient(to right, #cdf1cd, #387a38, #004d00);
            background-size: 200% 100%;
            color: white;
            animation: backgroundAnimation 10s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Menetapkan tinggi body sesuai tinggi viewport */
        }

        @keyframes backgroundAnimation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        /* CSS untuk memperpendek kolom input dan menambahkan border */
        .form-control {
            width: 250px;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }

        /* CSS untuk menengahkan select box */
        .select-container {
            text-align: center;
            margin-top: 10px;
        }

        /* CSS untuk menyesuaikan gaya tombol */
        .btn-dark {
            width: 100%;
            margin-bottom: 10px;
            background: linear-gradient(to right, #005500, #011601);
            transition: all 0.3s ease;
        }

        .btn-dark:hover {
            transform: scale(1.1);
        }

        /* CSS untuk menghapus background dan border menu dropdown */
        .dropdown-menu {
            width: 100%;
            background-color: transparent !important;
            border: none !important;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.9); /* Warna background form */
            margin: 50px auto; /* Menengahkan form dengan jarak atas 50px */
            padding: 20px; /* Padding untuk konten dalam card */
            border-radius: 10px; /* Border radius */
            max-width: 400px; /* Maksimum lebar form */
        }

        /* CSS untuk menggeser tombol ke kanan bawah */
        .card-footer {
            display: flex;
            justify-content: flex-end;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detail Event</div>
                <div class="card-body">
                    <div>
                        <h5 class="card-title">{{ $event->nama }}</h5>
                        <p class="card-text">Tanggal: {{ $event->tanggal }}</p>
                        <p class="card-text">Lokasi: {{ $event->lokasi }}</p>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('registrasi.formep') }}" class="btn btn-dark">Daftar</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
