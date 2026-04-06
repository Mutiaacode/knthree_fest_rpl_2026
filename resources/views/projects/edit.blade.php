@extends('layouts.app')

@section('content')
    <div class="bg-white shadow rounded-lg p-6 max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Edit Project</h2>
            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:underline">&larr; Kembali</a>
        </div>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-600 p-3 rounded text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Judul Project</label>
                <input type="text" name="judul" value="{{ old('judul', $project->judul) }}" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 p-2 border">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Pembuat (Author)</label>
                <input type="text" name="pembuat" value="{{ old('pembuat', $project->pembuat) }}" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 p-2 border">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Kelas</label>
                <select name="kelas" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 p-2 border">
                    <option value="" disabled>Pilih Kelas</option>
                    <option value="X RPL A" {{ old('kelas', $project->kelas) == 'X RPL A' ? 'selected' : '' }}>X RPL A
                    </option>
                    <option value="X RPL B" {{ old('kelas', $project->kelas) == 'X RPL B' ? 'selected' : '' }}>X RPL B
                    </option>
                    <option value="XI RPL A" {{ old('kelas', $project->kelas) == 'XI RPL A' ? 'selected' : '' }}>XI RPL A
                    </option>
                    <option value="XI RPL B" {{ old('kelas', $project->kelas) == 'XI RPL B' ? 'selected' : '' }}>XI RPL B
                    </option>
                    <option value="XII RPL A" {{ old('kelas', $project->kelas) == 'XII RPL A' ? 'selected' : '' }}>XII RPL A
                    </option>
                    <option value="XII RPL B" {{ old('kelas', $project->kelas) == 'XII RPL B' ? 'selected' : '' }}>XII RPL
                        B</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Singkat</label>
                <textarea name="deskripsi" rows="3" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 p-2 border">{{ old('deskripsi', $project->deskripsi) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Link Website / Demo</label>
                <input type="url" name="link" value="{{ old('link', $project->link) }}" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 p-2 border"
                    placeholder="https://example.com">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Gambar / Thumbnail (Opsional)</label>
                @if ($project->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $project->image) }}" class="w-32 rounded">
                    </div>
                @endif
                <input type="file" name="image" accept="image/*"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring p-1 border">
                <p class="text-xs text-gray-500 mt-1">Abaikan jika tidak ingin mengubah gambar.</p>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                    Update Project
                </button>
            </div>
        </form>
    </div>
@endsection
