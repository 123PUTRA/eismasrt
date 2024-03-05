<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Button Style</title>
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

        .btn-dark {
            width: 100%; 
            margin-bottom: 10px; 
            background: linear-gradient(to right, #005500, #011601);
            transition: all 0.3s ease; /* Efek transisi saat hover */
        }
        .btn-dark:hover {
            transform: scale(1.1); /* Memperbesar tombol saat hover */
        }
        .dropdown-menu {
            width: 100%;
            border: none !important; /* Menghapus border menu dropdown */
            position: absolute; /* Position dropdown absolute */
        }
        .dropdown-item-1 {
            background-color: #607554; /* Warna latar belakang untuk dropdown item 1 */
        }
        .dropdown-item-2 {
            background-color: ##607554; /* Warna latar belakang untuk dropdown item 2 */
        }
        .dropdown-item-3 {
            background-color: ##607554; /* Warna latar belakang untuk dropdown item 3 */
        }
    </style>
</head>
<body>
<div class="container d-flex flex-column align-items-center vh-100">
    <div class="btn-group mb-3">
        <button type="button" class="btn btn-lg btn-dark" id="addEventBtn">
            Add Event
        </button>
    </div>

    <div class="btn-group mb-3" id="dropdown1">
        <button type="button" class="btn btn-lg btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Event
        </button>
         <ul class="dropdown-menu">
            <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a class="dropdown-item dropdown-item-1" href="<?php echo e(route('events.show', $event->id)); ?>"><?php echo e($event->nama); ?></a></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>

    <div class="btn-group" id="dropdown2">
        <button type="button" class="btn btn-lg btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Autendeci
        </button>
        <ul class="dropdown-menu">
          <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><a class="dropdown-item dropdown-item-2" href="<?php echo e(route('events.peserta', $event->id)); ?>"><?php echo e($event->nama); ?></a></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
    document.getElementById("addEventBtn").addEventListener("click", function() {
        window.location.href = "<?php echo e(route('register.form')); ?>";
    });

    // Menyesuaikan posisi tombol saat dropdown dibuka atau ditutup
    document.querySelectorAll('.dropdown-toggle').forEach(function (dropdown) {
        dropdown.addEventListener('click', function () {
            const dropdownMenu = dropdown.nextElementSibling;
            const bounding = dropdown.getBoundingClientRect();
            const dropdownMenuHeight = dropdownMenu.scrollHeight;

            if (!dropdownMenu.classList.contains('show')) {
                dropdownMenu.style.top = bounding.bottom + 'px';
            } else {
                dropdownMenu.style.top = '';
            }
        });
    });
</script>

</body>
</html>
<?php /**PATH C:\laragon\www\eismart\resources\views/index.blade.php ENDPATH**/ ?>