@extends('layouts.app')

@section('content')
    <div class="bg-white shadow rounded-lg p-6">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
            <div class="flex items-center gap-4">
                <h2 class="text-2xl font-bold text-gray-800">Daftar Project</h2>
                @if ($pendingCount > 0)
                    <span class="bg-yellow-400 text-yellow-900 text-xs font-bold px-2.5 py-1 rounded-full animate-pulse">
                        {{ $pendingCount }} Pending
                    </span>
                @endif
            </div>
            <a href="{{ route('projects.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded whitespace-nowrap">
                + Tambah Project
            </a>
        </div>

        {{-- TABS: Accepted / Pending / Rejected --}}
        <div class="flex gap-2 mb-6 border-b border-gray-200">
            <a href="{{ route('dashboard', array_merge(request()->query(), ['tab' => 'accepted'])) }}"
                class="pb-3 px-4 text-sm font-semibold border-b-2 transition-colors
               {{ $tab === 'accepted' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-800' }}">
                ✅ Accepted
            </a>
            <a href="{{ route('dashboard', array_merge(request()->query(), ['tab' => 'pending'])) }}"
                class="pb-3 px-4 text-sm font-semibold border-b-2 transition-colors flex items-center gap-2
               {{ $tab === 'pending' ? 'border-yellow-500 text-yellow-600' : 'border-transparent text-gray-500 hover:text-gray-800' }}">
                ⏳ Pending
                @if ($pendingCount > 0)
                    <span
                        class="bg-yellow-400 text-yellow-900 text-xs font-bold px-1.5 py-0.5 rounded-full">{{ $pendingCount }}</span>
                @endif
            </a>
            <a href="{{ route('dashboard', array_merge(request()->query(), ['tab' => 'rejected'])) }}"
                class="pb-3 px-4 text-sm font-semibold border-b-2 transition-colors
               {{ $tab === 'rejected' ? 'border-red-500 text-red-600' : 'border-transparent text-gray-500 hover:text-gray-800' }}">
                ❌ Rejected
            </a>
        </div>

        {{-- Filter & Search --}}
        <form method="GET" action="{{ route('dashboard') }}"
            class="mb-6 bg-gray-50 p-4 rounded-lg flex flex-col md:flex-row gap-4 items-end">
            <input type="hidden" name="tab" value="{{ $tab }}">

            <div class="flex-1 w-full">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Nama/Judul</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Cari..."
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 p-2 border">
            </div>

            <div class="w-full md:w-48">
                <label for="kelas" class="block text-sm font-medium text-gray-700 mb-1">Filter Kelas</label>
                <select name="kelas" id="kelas"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 p-2 border">
                    <option value="">Semua Kelas</option>
                    @foreach (['X RPL A', 'X RPL B', 'XI RPL A', 'XI RPL B', 'XII RPL A', 'XII RPL B'] as $k)
                        <option value="{{ $k }}" {{ request('kelas') == $k ? 'selected' : '' }}>
                            {{ $k }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-2 w-full md:w-auto">
                <button type="submit"
                    class="bg-gray-800 hover:bg-gray-900 text-white font-semibold py-2 px-4 rounded md:w-auto flex-1">
                    Filter
                </button>
                @if (request('search') || request('kelas'))
                    <a href="{{ route('dashboard', ['tab' => $tab]) }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded text-center md:w-auto flex-1">
                        Reset
                    </a>
                @endif
            </div>
        </form>

        {{-- Table --}}
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
                        <tr class="hover:bg-gray-50 {{ $tab === 'pending' ? 'bg-yellow-50' : '' }}">
                            <td class="py-3 px-4 border-b text-gray-500 text-sm">{{ $key + 1 }}</td>
                            <td class="py-3 px-4 border-b">
                                <img src="{{ asset('storage/' . $project->image) }}" alt="image"
                                    class="w-16 h-16 object-cover rounded">
                            </td>
                            <td class="py-3 px-4 border-b font-semibold">{{ $project->judul }}</td>
                            <td class="py-3 px-4 border-b">{{ $project->pembuat }}</td>
                            <td class="py-3 px-4 border-b">
                                @if ($project->kelas)
                                    <span
                                        class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded border border-blue-400">
                                        {{ $project->kelas }}
                                    </span>
                                @else
                                    <span class="text-gray-400 text-sm">-</span>
                                @endif
                            </td>
                            <td class="py-3 px-4 border-b">
                                @if ($project->qr_path)
                                    <img src="{{ asset('storage/' . $project->qr_path) }}" alt="QR"
                                        class="w-14 h-14">
                                @endif
                            </td>
                            <td class="py-3 px-4 border-b">
                                <div class="flex flex-wrap justify-center gap-2">

                                    {{-- Tombol Accept/Reject hanya muncul di tab pending --}}
                                    @if ($tab === 'pending')
                                        <form action="{{ route('projects.accept', $project->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button type="submit"
                                                class="bg-green-500 hover:bg-green-600 text-white py-1 px-3 rounded text-sm font-semibold">
                                                ✅ Accept
                                            </button>
                                        </form>
                                        <form action="{{ route('projects.reject', $project->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button type="submit"
                                                class="bg-red-400 hover:bg-red-500 text-white py-1 px-3 rounded text-sm font-semibold">
                                                ❌ Reject
                                            </button>
                                        </form>
                                    @endif

                                    {{-- Tombol Accept di tab Rejected (undo) --}}
                                    @if ($tab === 'rejected')
                                        <form action="{{ route('projects.accept', $project->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button type="submit"
                                                class="bg-green-500 hover:bg-green-600 text-white py-1 px-3 rounded text-sm font-semibold">
                                                ✅ Accept
                                            </button>
                                        </form>
                                    @endif

                                    <a href="{{ route('projects.edit', $project->id) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded text-sm">
                                        Edit
                                    </a>
                                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus project ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded text-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-10 px-4 text-center text-gray-400">
                                @if ($tab === 'pending')
                                    🎉 Tidak ada submission yang menunggu review.
                                @elseif($tab === 'rejected')
                                    Belum ada project yang ditolak.
                                @else
                                    Belum ada project yang di-accept.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Info link untuk siswa --}}
        <div
            class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
            <div>
                <p class="text-sm font-semibold text-blue-800">📤 Link Upload untuk Siswa</p>
                <p class="text-xs text-blue-600 mt-0.5">Bagikan link ini kepada siswa untuk upload project tanpa perlu
                    login.</p>
            </div>
            <div class="flex items-center gap-2">
                <code class="bg-white border border-blue-300 rounded px-3 py-1.5 text-sm text-blue-700 font-mono">
                    {{ url('/upload') }}
                </code>
                <button
                    onclick="navigator.clipboard.writeText('{{ url('/upload') }}'); this.textContent='✅ Copied!'; setTimeout(()=>this.textContent='Copy',2000)"
                    class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-3 py-1.5 rounded transition-colors">
                    Copy
                </button>
            </div>
        </div>

    </div>
@endsection
