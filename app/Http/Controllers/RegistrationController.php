<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\autendenci;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Picqer\Barcode\BarcodeGeneratorHTML;

class RegistrationController extends Controller
{
    public function registerasi(Request $request)
    {
        try {
            // Validasi input form
            $validatedData = $request->validate([
                'nama' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'prodi' => 'required|string|max:255',
                'semester' => 'required|integer|max:255',
                'event_id' => 'required|exists:events,id'
            ]);


            // Simpan data ke dalam database
            $registration = Registration::create($validatedData);

            // Generate barcode dari ID pendaftaran
            $barcodeGenerator = new BarcodeGeneratorHTML();
            $barcode = $barcodeGenerator->getBarcode($registration->id, $barcodeGenerator::TYPE_CODE_128);

            // Redirect dengan pesan sukses dan tampilkan barcode
            return view('barcode')->with(['barcode' => $barcode]);
        } catch (\Exception $e) {
            // Tangani exception
            Log::error('Gagal menyimpan data pendaftaran: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Gagal menyimpan data pendaftaran.']);
        }
    }

    public function peserta($id)
    {
        // Mengambil informasi event berdasarkan ID
        $event = Event::findOrFail($id);

        // Mengambil daftar pendaftar untuk event tersebut
        $registrations = $event->registrations;

        // Menampilkan halaman detail event dengan mengirimkan data event dan daftar pendaftar
        return view('info', compact('event', 'registrations'));

    }



    public function createForm()
    {
        return view('registerevent');
    }

    public function register(Request $request)
    {
        try {
            // Validasi input form
            $validatedData = $request->validate([
                'eventName' => 'required|string|max:255',
                'eventDate' => 'required|date',
                'eventLocation' => 'required|string|max:255',
            ]);

            // Simpan data ke dalam database
            $event = Event::create([
                'nama' => $validatedData['eventName'],
                'tanggal' => $validatedData['eventDate'],
                'lokasi' => $validatedData['eventLocation'],
            ]);

            // Redirect ke halaman detail event dengan menyertakan ID event
            return redirect()->route('events.show', ['id' => $event->id]);
        } catch (\Exception $e) {
            // Tangani exception
            Log::error('Gagal menyimpan data event: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Gagal menyimpan data event.']);
        }
    }

    public function show(Request $request, $id)
    {
        // Mengambil informasi event berdasarkan ID
        $event = Event::findOrFail($id);

        // Mengambil daftar pendaftar untuk event tersebut
        $registrations = $event->registrations;

        // Menampilkan halaman info.blade.php dengan mengirimkan data event dan daftar pendaftar
        return view('info', compact('event', 'registrations'));
    }

    public function index()
    {
        $events = Event::paginate(10); // Menggunakan paginasi untuk membatasi jumlah event yang dimuat per halaman
        return view('index', compact('events'));
    }

    public function createFormep()
    {
        $events = Event::all();
        return view('registrasi', compact('events'));
    }

    public function validateAttendance(Request $request)
    {
    $barcode = $request->input('barcode');

    // Cari pendaftaran berdasarkan barcode
    $registration = Registration::where('barcode', $barcode)->first();

    if ($registration) {
        // Kirim permintaan ke ZXing API
        $response = Http::post('https://zxing.org/w/decode', [
            'file' => $barcode // Mengirim nilai barcode ke ZXing API
        ]);

        if ($response->successful()) {
            $zxingData = $response->json();
            // Analisis respons untuk memastikan barcode valid
            if (isset($zxingData['parsed']) && $zxingData['parsed'] === $barcode) {
                // Tandai peserta hadir
                $attendance = new Attendance();
                $attendance->registration_id = $registration->id;
                $attendance->attended = true;
                $attendance->save();

                return response()->json(['success' => true, 'message' => 'Peserta ' . $registration->nama . ' berhasil ditandai hadir']);
            }
        }
    }

    return response()->json(['success' => false, 'message' => 'Barcode tidak valid']);
    }



}