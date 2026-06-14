@extends('layouts.app')

@section('title', isset($application->id) ? 'Edit Lamaran' : 'Tambah Lamaran')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Header -->
    <div class="flex items-start justify-between mb-4 sm:mb-8">
        <div class="min-w-0 flex-1 mr-3">
            <div class="flex items-center gap-3">
                <a href="{{ route('job-applications.index') }}"
                   class="inline-flex items-center text-gray-500 hover:text-gray-700 text-sm font-medium transition">
                    <i class="fas fa-times mr-1"></i> Batal
                </a>
                <span class="text-gray-300">|</span>
                <a href="{{ route('job-applications.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium transition inline-flex items-center">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800 mt-2 truncate">
                {{ isset($application->id) ? 'Edit Lamaran Kerja' : 'Tambah Lamaran Kerja' }}
            </h1>
            <p class="text-gray-400 text-xs sm:text-sm mt-1 hidden sm:block">
                {{ isset($application->id) ? 'Perbarui informasi lamaran kerja Anda' : 'Isi informasi lamaran kerja baru Anda' }}
            </p>
        </div>
        <div class="bg-blue-50 rounded-2xl p-3 sm:p-4 flex-shrink-0">
            <i class="fas fa-file-alt text-blue-500 text-2xl sm:text-3xl"></i>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ isset($application->id) ? route('job-applications.update', $application) : route('job-applications.store') }}"
          method="POST"
          class="bg-white rounded-2xl shadow border border-gray-100 overflow-hidden">
        @csrf
        @if(isset($application->id))
            @method('PUT')
        @endif

        <div class="p-4 sm:p-6 md:p-8 space-y-4 sm:space-y-6">
            <!-- Row 1: Tanggal & Perusahaan -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-calendar-alt mr-1 text-blue-500"></i> Tanggal Lamar <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="tanggal_lamar"
                           value="{{ old('tanggal_lamar', isset($application->tanggal_lamar) ? \Carbon\Carbon::parse($application->tanggal_lamar)->format('Y-m-d') : '') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tanggal_lamar') border-red-400 @enderror"
                           required>
                    @error('tanggal_lamar')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-building mr-1 text-blue-500"></i> Perusahaan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="perusahaan"
                           value="{{ old('perusahaan', $application->perusahaan ?? '') }}"
                           placeholder="Contoh: PT Maju Jaya"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('perusahaan') border-red-400 @enderror"
                           required>
                    @error('perusahaan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Row 2: Posisi & Platform -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-user-tie mr-1 text-blue-500"></i> Posisi <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="posisi"
                           value="{{ old('posisi', $application->posisi ?? '') }}"
                           placeholder="Contoh: IT Support"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('posisi') border-red-400 @enderror"
                           required>
                    @error('posisi')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-globe mr-1 text-blue-500"></i> Platform <span class="text-red-500">*</span>
                    </label>
                    <select name="platform"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white @error('platform') border-red-400 @enderror"
                            required>
                        <option value="">-- Pilih Platform --</option>
                        @foreach(\App\Models\JobApplication::$platforms as $platform)
                            <option value="{{ $platform }}" {{ old('platform', $application->platform ?? '') == $platform ? 'selected' : '' }}>{{ $platform }}</option>
                        @endforeach
                    </select>
                    @error('platform')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Row 3: Kota & Tipe Kerja -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-map-marker-alt mr-1 text-blue-500"></i> Kota (Jabodetabek) <span class="text-red-500">*</span>
                    </label>
                    <select name="kota"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white @error('kota') border-red-400 @enderror"
                            required>
                        <option value="">-- Pilih Kota --</option>
                        @foreach(\App\Models\JobApplication::$kotas as $kota)
                            <option value="{{ $kota }}" {{ old('kota', $application->kota ?? '') == $kota ? 'selected' : '' }}>{{ $kota }}</option>
                        @endforeach
                    </select>
                    @error('kota')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-clock mr-1 text-blue-500"></i> Tipe Kerja <span class="text-red-500">*</span>
                    </label>
                    <select name="tipe_kerja"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white @error('tipe_kerja') border-red-400 @enderror"
                            required>
                        <option value="">-- Pilih Tipe Kerja --</option>
                        @foreach(\App\Models\JobApplication::$tipeKerjas as $tipe)
                            <option value="{{ $tipe }}" {{ old('tipe_kerja', $application->tipe_kerja ?? '') == $tipe ? 'selected' : '' }}>{{ $tipe }}</option>
                        @endforeach
                    </select>
                    @error('tipe_kerja')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Row 4: Status & Range Gaji -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-info-circle mr-1 text-blue-500"></i> Status <span class="text-red-500">*</span>
                    </label>
                    <select name="status"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white @error('status') border-red-400 @enderror"
                            required>
                        <option value="">-- Pilih Status --</option>
                        @foreach(\App\Models\JobApplication::$statuses as $status)
                            <option value="{{ $status }}" {{ old('status', $application->status ?? '') == $status ? 'selected' : '' }}>{{ $status }}</option>
                        @endforeach
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-money-bill-wave mr-1 text-blue-500"></i> Range Gaji
                    </label>
                    <select name="gaji"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white @error('gaji') border-red-400 @enderror">
                        <option value="">-- Pilih Range Gaji --</option>
                        @foreach(\App\Models\JobApplication::$gajiRanges as $value => $label)
                            <option value="{{ $value }}" {{ old('gaji', $application->gaji ?? '') == $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('gaji')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Row 5: Tgl Update & Kontak -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-calendar-check mr-1 text-blue-500"></i> Tanggal Update
                    </label>
                    <input type="date" name="tgl_update"
                           value="{{ old('tgl_update', isset($application->tgl_update) && $application->tgl_update ? \Carbon\Carbon::parse($application->tgl_update)->format('Y-m-d') : '') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tgl_update') border-red-400 @enderror">
                    @error('tgl_update')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-envelope mr-1 text-blue-500"></i> Kontak
                    </label>
                    <input type="text" name="kontak"
                           value="{{ old('kontak', $application->kontak ?? '') }}"
                           placeholder="Contoh: hrd@perusahaan.com"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('kontak') border-red-400 @enderror">
                    @error('kontak')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Row 6: Catatan -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-sticky-note mr-1 text-blue-500"></i> Catatan
                </label>
                <textarea name="catatan" rows="3"
                          placeholder="Tambahkan catatan (opsional)..."
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none @error('catatan') border-red-400 @enderror">{{ old('catatan', $application->catatan ?? '') }}</textarea>
                @error('catatan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Form Footer -->
        <div class="bg-gray-50 px-4 sm:px-6 md:px-8 py-4 sm:py-5 border-t border-gray-100 flex justify-end">
            <button type="submit"
                    class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-5 sm:px-8 py-3 rounded-xl text-sm font-semibold hover:from-blue-700 hover:to-indigo-700 transition shadow-lg shadow-blue-200">
                <i class="fas fa-save mr-1 sm:mr-2"></i>
                <span class="hidden sm:inline">{{ isset($application->id) ? 'Update Lamaran' : 'Simpan Lamaran' }}</span>
                <span class="sm:hidden">{{ isset($application->id) ? 'Update' : 'Simpan' }}</span>
            </button>
        </div>
    </form>
</div>
@endsection
