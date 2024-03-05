<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background: linear-gradient(to right, #cdf1cd, #387a38, #004d00);
            background-size: 200% 100%; /* Untuk memperluas latar belakang */
            color: white;
            animation: backgroundAnimation 10s ease infinite; /* Menjalankan animasi dengan waktu 10 detik */
            display: flex;
            justify-content: center; /* Menengahkan konten horizontal */
            align-items: center; /* Menengahkan konten vertical */
        }

        /* Animasi latar belakang */
        @keyframes backgroundAnimation {
            0% {
                background-position: 0% 50%; /* Mulai dari posisi awal */
            }
            50% {
                background-position: 100% 50%; /* Pindah ke posisi tengah */
            }
            100% {
                background-position: 0% 50%; /* Kembali ke posisi awal */
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="text-center">Form Pendaftaran Peserta</h1>
    <?php if(session('success')): ?>
        <div class="alert alert-success" role="alert">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    <form action="<?php echo e(route('registrasip.submit')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <div class="mb-3">
        <label for="nama" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control" id="nama" name="nama" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="mb-3">
        <label for="prodi" class="form-label">Prodi</label>
        <input type="text" class="form-control" id="prodi" name="prodi" required>
    </div>
    <div class="mb-3">
        <label for="semester" class="form-label">Semester</label>
        <input type="text" class="form-control" id="semester" name="semester" required>
    </div>
    <div class="mb-3">
        <label for="event_id" class="form-label">Event</label>
        <select class="form-select" id="event_id" name="event_id" required>
            <option value="" selected disabled>Pilih Event</option>
            <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($event->id); ?>"><?php echo e($event->nama); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary d-block mx-auto mt-3">Kirim</button> <!-- Tombol di tengah -->
    </form>

</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<?php /**PATH C:\laragon\www\eismart\resources\views/registrasi.blade.php ENDPATH**/ ?>