<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #004d00; /* Warna hijau tua untuk latar belakang */
            color: white; /* Warna teks putih */
        }
        .form-control {
            background-color: #294b29;
            color: white;
            border: 1px solid #538d53; 
            border-radius: 7px; 
        }
        .btn-primary {
            background-color: #044b1f; /* Warna tombol sesuai permintaan */
            border-color: #1b631b; /* Warna border tombol */
        }
        .btn-primary:hover {
            background-color: #002200; /* Warna tombol saat dihover */
            border-color: #173a17; /* Warna border tombol saat dihover */
        }
        form {
            padding: 20px;
            border: 2px solid #356e35; /* Border dengan warna sesuai permintaan */
            border-radius: 10px; /* Border radius untuk membuat sudut elemen lebih bulat */
            margin: 0 auto; /* Menempatkan form di tengah */
            max-width: 400px; /* Lebar maksimum form */
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="text-center">Event Registration Form</h1>
    <form action="{{ route('register.form') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="eventName" class="form-label">Event Name</label>
            <input type="text" class="form-control" id="eventName" name="eventName">
        </div>
        <div class="mb-3">
            <label for="eventDate" class="form-label">Event Date</label>
            <input type="date" class="form-control" id="eventDate" name="eventDate">
        </div>
        <div class="mb-3">
            <label for="eventLocation" class="form-label">Event Location</label>
            <input type="text" class="form-control" id="eventLocation" name="eventLocation">
        </div>
        <button type="submit" class="btn btn-primary d-block mx-auto">Register Event</button>
    </form>
</div>
</body>
</html>
