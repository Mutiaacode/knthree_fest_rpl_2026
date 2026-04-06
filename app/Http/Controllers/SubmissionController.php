<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SubmissionController extends Controller
{
 
    public function create()
    {
        return view('submit.form');
    }

    // Simpan submission siswa — status default 'pending' (butuh acc admin)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'    => 'required|string|max:255',
            'pembuat'  => 'required|string|max:255',
            'kelas'    => 'required|string|in:X RPL A,X RPL B,XI RPL A,XI RPL B,XII RPL A,XII RPL B',
            'deskripsi' => 'required|string',
            'image'    => 'required|image|max:3072', // maks 3MB
            'link'     => 'required|url',
        ]);

        // Upload gambar thumbnail
        $pathGambar = $request->file('image')->store('projects', 'public');
        $validated['image'] = $pathGambar;

        // Generate QR Code untuk link project
        if (!Storage::disk('public')->exists('qrcodes')) {
            Storage::disk('public')->makeDirectory('qrcodes');
        }

        $namaFileQr = 'qrcodes/' . uniqid() . '.svg';
        QrCode::format('svg')->size(300)->generate(
            $validated['link'],
            storage_path('app/public/' . $namaFileQr)
        );
        $validated['qr_path'] = $namaFileQr;

        // Status selalu 'pending' — menunggu acc admin
        $validated['status'] = 'pending';

        Project::create($validated);

        return redirect()->route('submit.success');
    }

   
    public function success()
    {
        return view('submit.success');
    }
}
