<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* CSS untuk mengatur tata letak */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .barcode-container {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="barcode-container">
        <h1 class="mb-4">Barcode Pendaftaran</h1>
        <div class="card p-4" style="max-width: 400px;">
            <div class="card-body">
                <?php echo $barcode; ?>

            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\laragon\www\eismart\resources\views/barcode.blade.php ENDPATH**/ ?>