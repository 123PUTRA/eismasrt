<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class BarcodeController extends Controller
{
    public function decode(Request $request)
    {
        // Ambil nilai kode barcode dari permintaan POST
        $barcodeValue = $request->input('barcode');

        // Kirim permintaan ke ZXing API
        $response = Http::post('https://zxing.org/w/decode', [
            'file' => $barcodeValue
        ]);

        // Kembalikan respons dari ZXing API ke klien
        return $response->json();
    }
}