<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProjectController extends Controller
{
    // nampilin semua project di dashboard admin
    public function index(Request $request)
    {
        $pencarian = $request->query('search');
        $kelas = $request->query('kelas');
        $tab = $request->query('tab', 'accepted'); // default tab: accepted

        $query = Project::latest()
            ->when($pencarian, fn($q) => $q->where('pembuat', 'like', "%$pencarian%")
                ->orWhere('judul', 'like', "%$pencarian%"))
            ->when($kelas, fn($q) => $q->where('kelas', $kelas));

        if ($tab === 'pending') {
            $proyek = (clone $query)->where('status', 'pending')->get();
        } elseif ($tab === 'rejected') {
            $proyek = (clone $query)->where('status', 'rejected')->get();
        } else {
            $proyek = (clone $query)->where('status', 'accepted')->get();
        }

        $pendingCount = Project::where('status', 'pending')->count();

        return view('dashboard', [
            'projects'     => $proyek,
            'search'       => $pencarian,
            'studentClass' => $kelas,
            'tab'          => $tab,
            'pendingCount' => $pendingCount,
        ]);
    }

    // form tambah project baru (dari admin, langsung accepted)
    public function create()
    {
        return view('projects.create');
    }

    // simpan project baru ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'    => 'required|string|max:255',
            'pembuat'  => 'required|string|max:255',
            'kelas'    => 'required|string|in:X RPL A,X RPL B,XI RPL A,XI RPL B,XII RPL A,XII RPL B',
            'deskripsi' => 'required|string',
            'image'    => 'required|image|max:2048',
            'link'     => 'required|url',
        ]);

        $pathGambar = $request->file('image')->store('projects', 'public');
        $validated['image'] = $pathGambar;

        if (!Storage::disk('public')->exists('qrcodes')) {
            Storage::disk('public')->makeDirectory('qrcodes');
        }

        $namaFileQr = 'qrcodes/' . uniqid() . '.svg';
        QrCode::format('svg')->size(300)->generate(
            $validated['link'],
            storage_path('app/public/' . $namaFileQr)
        );
        $validated['qr_path'] = $namaFileQr;

        // langsung accepted
        $validated['status'] = 'accepted';

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
            'judul'    => 'required|string|max:255',
            'pembuat'  => 'required|string|max:255',
            'kelas'    => 'required|string|in:X RPL A,X RPL B,XI RPL A,XI RPL B,XII RPL A,XII RPL B',
            'deskripsi' => 'required|string',
            'image'    => 'nullable|image|max:2048',
            'link'     => 'required|url',
        ]);

        if ($request->hasFile('image')) {
            if ($project->image && Storage::disk('public')->exists($project->image)) {
                Storage::disk('public')->delete($project->image);
            }
            $pathGambar = $request->file('image')->store('projects', 'public');
            $validated['image'] = $pathGambar;
        } else {
            $validated['image'] = $project->image;
        }

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

    // Admin: Accept submission siswa → tampil di showcase
    public function accept(Project $project)
    {
        $project->update(['status' => 'accepted']);
        return back()->with('success', "✅ Project \"{$project->judul}\" berhasil di-accept dan akan tampil di showcase!");
    }

    // Admin: Reject submission siswa
    public function reject(Project $project)
    {
        $project->update(['status' => 'rejected']);
        return back()->with('success', "❌ Project \"{$project->judul}\" ditolak.");
    }
}
