<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Detail</title>
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

        /* CSS untuk memperpendek kolom input dan menambahkan border */
        .form-control {
            width: 100%;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }

        /* CSS untuk menengahkan select box */
        .select-container {
            text-align: center;
            margin-top: 10px;
        }

        /* CSS untuk menyesuaikan gaya tombol */
        .btn-primary {
            width: 100%;
            margin-bottom: 10px;
            background: linear-gradient(to right, #005500, #011601);
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: scale(1.1);
        }

        /* CSS untuk menghapus background dan border menu dropdown */
        .dropdown-menu {
            width: 100%;
            background-color: transparent !important;
            border: none !important;
        }

        .dropdown-item {
            background-color: transparent !important;
            border: none !important;
        }

        /* CSS untuk warna dan penempatan form */
        .container {
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
        }

        /* CSS untuk tombol centang */
        .custom-checkbox {
            width: 20px;
            height: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>{{ $event->nama }}</h2>
            <p>Tanggal : {{ $event->tanggal }}</p>
            <p>Lokasi : {{ $event->lokasi }}</p>
        </div>
        <div class="col-md-6">
            <!-- Tambahkan tombol untuk memicu pemindaian barcode di sini -->
            <button id="start-scanner" class="btn btn-primary">Scan Barcode</button>
        </div>
    </div>
    <hr>
    <h2>Daftar Pendaftar</h2>
    <div class="table-responsive">
        <table class="table" id="registration-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Prodi</th>
                    <th>Semester</th>
                    <th>Centang</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registrations as $registration)
                <tr id="registration-{{ $registration->id }}">
                    <td>{{ $registration->nama }}</td>
                    <td>{{ $registration->email }}</td>
                    <td>{{ $registration->prodi }}</td>
                    <td>{{ $registration->semester }}</td>
                    <td><input type="checkbox" class="custom-checkbox" id="checkbox-{{ $registration->id }}"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <button id="download-pdf" class="btn btn-primary">Download PDF</button>
</div>
<div id="video-container"></div>

<!-- Library jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Library Quagga.js untuk pemindaian barcode -->
<script src="https://cdn.jsdelivr.net/npm/quagga/dist/quagga.min.js"></script>
<!-- Library jsPDF untuk membuat PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>

<script>
    document.getElementById('start-scanner').addEventListener('click', startScanner);
    document.getElementById('download-pdf').addEventListener('click', downloadPDF);

    function startScanner() {
        if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
            alert('Browser tidak mendukung akses kamera!');
            return;
        }

        navigator.mediaDevices.getUserMedia({ video: true })
            .then(function(stream) {
                var videoContainer = document.getElementById('video-container');
                var video = document.createElement('video');
                video.autoplay = true;
                video.srcObject = stream;
                videoContainer.appendChild(video);

                Quagga.init({
                    inputStream : {
                        video: video,
                    },
                    decoder : {
                        readers : ['ean_reader']
                    }
                }, function(err) {
                    if (err) {
                        console.error('Error starting Quagga:', err);
                        return;
                    }
                    Quagga.start();
                });

                Quagga.onDetected(handleBarcodeDetection);
            })
            .catch(function(err) {
                console.error('Error accessing camera:', err);
            });
    }

    function handleBarcodeDetection(result) {
        var barcode = result.codeResult.code;
        console.log('Barcode terdeteksi:', barcode);
        Quagga.stop();

        fetch('/scan-barcode', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ barcode: barcode })
        })
        .then(response => response.json())
        .then(data => {
            console.log('Respon dari backend:', data);
            var registrationId = data.registration_id;
            var registrationRow = document.getElementById('registration-' + registrationId);
            if (registrationRow) {
                registrationRow.classList.add('table-success');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function downloadPDF() {
        var doc = new jsPDF();
        var checkboxIds = document.querySelectorAll('input[type="checkbox"]');
        var checkedRows = [];

        checkboxIds.forEach(function(checkbox) {
            var registrationId = checkbox.id.split('-')[1];
            if (checkbox.checked) {
                checkedRows.push(registrationId);
            }
        });

        // Generate PDF content
        var tableRows = document.querySelectorAll('tbody tr');
        var rowIndex = 0;
        tableRows.forEach(function(row) {
            if (checkedRows.includes(row.id.split('-')[1])) {
                var rowData = [];
                row.childNodes.forEach(function(cell) {
                    if (cell.nodeName === 'TD') {
                        rowData.push(cell.innerText);
                    }
                });
                doc.text(10, 10 + (rowIndex * 10), rowData.join(', '));
                rowIndex++;
            }
        });

        // Save PDF
        doc.save('registrations.pdf');
    }
</script>

</body>
</html>
