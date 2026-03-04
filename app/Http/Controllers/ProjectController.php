<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProjectController extends Controller
{
    // nampilin semua project di dashboard
    public function index(Request $request)
    {
        $pencarian = $request->query('search');
        $kelas = $request->query('kelas');

        $proyek = Project::latest()
            ->when($pencarian, fn($q) => $q->where('pembuat', 'like', "%$pencarian%")
        ->orWhere('judul', 'like', "%$pencarian%"))
            ->when($kelas, fn($q) => $q->where('kelas', $kelas))
            ->get();

        return view('dashboard', [
            'projects' => $proyek,
            'search' => $pencarian,
            'studentClass' => $kelas,
        ]);
    }

    // form tambah project baru
    public function create()
    {
        return view('projects.create');
    }

    // simpan project baru ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'pembuat' => 'required|string|max:255',
            'kelas' => 'required|string|in:X RPL A,X RPL B,XI RPL A,XI RPL B,XII RPL A,XII RPL B',
            'deskripsi' => 'required|string',
            'image' => 'required|image|max:2048',
            'link' => 'required|url',
        ]);

        // upload gambar
        $pathGambar = $request->file('image')->store('projects', 'public');
        $validated['image'] = $pathGambar;

        // generate QR code berdasarkan link project
        if (!Storage::disk('public')->exists('qrcodes')) {
            Storage::disk('public')->makeDirectory('qrcodes');
        }

        $namaFileQr = 'qrcodes/' . uniqid() . '.svg';
        QrCode::format('svg')->size(300)->generate(
            $validated['link'],
            storage_path('app/public/' . $namaFileQr)
        );
        $validated['qr_path'] = $namaFileQr;

        Project::create($validated);

        return redirect()->route('dashboard')->with('success', 'Project berhasil ditambahkan!');
    }

    // form edit project
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    // update data project
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'pembuat' => 'required|string|max:255',
            'kelas' => 'required|string|in:X RPL A,X RPL B,XI RPL A,XI RPL B,XII RPL A,XII RPL B',
            'deskripsi' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'link' => 'required|url',
        ]);

        // kalau ada gambar baru, hapus yang lama dulu
        if ($request->hasFile('image')) {
            if ($project->image && Storage::disk('public')->exists($project->image)) {
                Storage::disk('public')->delete($project->image);
            }
            $pathGambar = $request->file('image')->store('projects', 'public');
            $validated['image'] = $pathGambar;
        }
        else {
            $validated['image'] = $project->image;
        }

        // kalau link berubah, generate ulang QR code-nya
        if ($project->link !== $validated['link']) {
            if ($project->qr_path && Storage::disk('public')->exists($project->qr_path)) {
                Storage::disk('public')->delete($project->qr_path);
            }

            if (!Storage::disk('public')->exists('qrcodes')) {
                Storage::disk('public')->makeDirectory('qrcodes');
            }

            $namaFileQr = 'qrcodes/' . uniqid() . '.svg';
            QrCode::format('svg')->size(300)->generate(
                $validated['link'],
                storage_path('app/public/' . $namaFileQr)
            );
            $validated['qr_path'] = $namaFileQr;
        }

        $project->update($validated);

        return redirect()->route('dashboard')->with('success', 'Project berhasil diupdate!');
    }

    // hapus project beserta file-file terkait
    public function destroy(Project $project)
    {
        if ($project->image && Storage::disk('public')->exists($project->image)) {
            Storage::disk('public')->delete($project->image);
        }

        if ($project->qr_path && Storage::disk('public')->exists($project->qr_path)) {
            Storage::disk('public')->delete($project->qr_path);
        }

        $project->delete();

        return redirect()->route('dashboard')->with('success', 'Project berhasil dihapus!');
    }
}
