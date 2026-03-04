@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-6 max-w-2xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Tambah Project</h2>
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

    <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Judul Project</label>
            <input type="text" name="judul" value="{{ old('judul') }}" required
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 p-2 border">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Pembuat (Author)</label>
            <input type="text" name="pembuat" value="{{ old('pembuat') }}" required
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 p-2 border">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Kelas</label>
            <select name="kelas" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 p-2 border">
                <option value="" disabled selected>Pilih Kelas</option>
                <option value="X RPL A" {{ old('kelas') == 'X RPL A' ? 'selected' : '' }}>X RPL A</option>
                <option value="X RPL B" {{ old('kelas') == 'X RPL B' ? 'selected' : '' }}>X RPL B</option>
                <option value="XI RPL A" {{ old('kelas') == 'XI RPL A' ? 'selected' : '' }}>XI RPL A</option>
                <option value="XI RPL B" {{ old('kelas') == 'XI RPL B' ? 'selected' : '' }}>XI RPL B</option>
                <option value="XII RPL A" {{ old('kelas') == 'XII RPL A' ? 'selected' : '' }}>XII RPL A</option>
                <option value="XII RPL B" {{ old('kelas') == 'XII RPL B' ? 'selected' : '' }}>XII RPL B</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Singkat</label>
            <textarea name="deskripsi" rows="3" required
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 p-2 border">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Link Website / Demo</label>
            <input type="url" name="link" value="{{ old('link') }}" required
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 p-2 border" placeholder="https://example.com">
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Gambar / Thumbnail</label>
            <input type="file" name="image" accept="image/*" required
                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring p-1 border">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                Simpan Project
            </button>
        </div>
    </form>
</div>
@endsection
