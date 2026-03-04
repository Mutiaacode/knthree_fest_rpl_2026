@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
        <h2 class="text-2xl font-bold text-gray-800">Daftar Project</h2>
        <a href="{{ route('projects.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded whitespace-nowrap">
            + Tambah Project
        </a>
    </div>

    <!-- Filter & Search Form -->
    <form method="GET" action="{{ route('dashboard') }}" class="mb-6 bg-gray-50 p-4 rounded-lg flex flex-col md:flex-row gap-4 items-end">
        <div class="flex-1 w-full relative">
            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Nama/Judul</label>
            <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Cari..." 
                   class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 p-2 border">
        </div>
        
        <div class="w-full md:w-48">
            <label for="kelas" class="block text-sm font-medium text-gray-700 mb-1">Filter Kelas</label>
            <select name="kelas" id="kelas" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 p-2 border">
                <option value="">Semua Kelas</option>
                <option value="X RPL A" {{ request('kelas') == 'X RPL A' ? 'selected' : '' }}>X RPL A</option>
                <option value="X RPL B" {{ request('kelas') == 'X RPL B' ? 'selected' : '' }}>X RPL B</option>
                <option value="XI RPL A" {{ request('kelas') == 'XI RPL A' ? 'selected' : '' }}>XI RPL A</option>
                <option value="XI RPL B" {{ request('kelas') == 'XI RPL B' ? 'selected' : '' }}>XI RPL B</option>
                <option value="XII RPL A" {{ request('kelas') == 'XII RPL A' ? 'selected' : '' }}>XII RPL A</option>
                <option value="XII RPL B" {{ request('kelas') == 'XII RPL B' ? 'selected' : '' }}>XII RPL B</option>
            </select>
        </div>

        <div class="flex gap-2 w-full md:w-auto">
            <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white font-semibold py-2 px-4 rounded md:w-auto flex-1">
                Filter
            </button>
            @if(request('search') || request('kelas'))
                <a href="{{ route('dashboard') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded text-center md:w-auto flex-1">
                    Reset
                </a>
            @endif
        </div>
    </form>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="py-3 px-4 border-b">No</th>
                    <th class="py-3 px-4 border-b">Gambar</th>
                    <th class="py-3 px-4 border-b">Judul</th>
                    <th class="py-3 px-4 border-b">Pembuat</th>
                    <th class="py-3 px-4 border-b">Kelas</th>
                    <th class="py-3 px-4 border-b">QR Code</th>
                    <th class="py-3 px-4 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($projects as $key => $project)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4 border-b">{{ $key + 1 }}</td>
                        <td class="py-3 px-4 border-b">
                            <img src="{{ asset('storage/' . $project->image) }}" alt="image" class="w-16 h-16 object-cover rounded">
                        </td>
                        <td class="py-3 px-4 border-b font-semibold">{{ $project->judul }}</td>
                        <td class="py-3 px-4 border-b">{{ $project->pembuat }}</td>
                        <td class="py-3 px-4 border-b p-1">
                            @if($project->kelas)
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded border border-blue-400">
                                    {{ $project->kelas }}
                                </span>
                            @else
                                <span class="text-gray-400 text-sm">-</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 border-b">
                            @if($project->qr_path)
                                <img src="{{ asset('storage/' . $project->qr_path) }}" alt="QR" class="w-16 h-16">
                            @endif
                        </td>
                        <td class="py-3 px-4 border-b text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('projects.edit', $project->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded text-sm">
                                    Edit
                                </a>
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus project ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded text-sm">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-4 px-4 text-center text-gray-500">Belum ada project.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
