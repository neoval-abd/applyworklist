@extends('layouts.app')

@section('title', 'Dashboard - Rekap Lamaran Kerja')

@section('content')
<!-- Dashboard Stats -->
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 sm:gap-4 mb-6 sm:mb-8">
    <!-- Total Lamaran -->
    <div class="col-span-2 sm:col-span-1 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl p-4 sm:p-5 shadow-lg text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-blue-100 text-[10px] sm:text-xs font-medium uppercase tracking-wide">Total Lamaran</p>
                <p class="text-2xl sm:text-3xl font-bold mt-1">{{ $totalLamaran }}</p>
            </div>
            <div class="bg-white/20 rounded-xl p-2 sm:p-3">
                <i class="fas fa-paper-plane text-lg sm:text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Applied -->
    <div class="bg-white rounded-2xl p-4 sm:p-5 shadow border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-[10px] sm:text-xs font-medium uppercase tracking-wide">Applied</p>
                <p class="text-xl sm:text-2xl font-bold text-blue-600 mt-1">{{ $statusCounts['Applied'] ?? 0 }}</p>
            </div>
            <div class="bg-blue-50 rounded-xl p-2 sm:p-3">
                <i class="fas fa-clock text-blue-500"></i>
            </div>
        </div>
    </div>

    <!-- Interview -->
    <div class="bg-white rounded-2xl p-4 sm:p-5 shadow border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-[10px] sm:text-xs font-medium uppercase tracking-wide">Interview</p>
                <p class="text-xl sm:text-2xl font-bold text-yellow-600 mt-1">{{ $statusCounts['Interview'] ?? 0 }}</p>
            </div>
            <div class="bg-yellow-50 rounded-xl p-2 sm:p-3">
                <i class="fas fa-comments text-yellow-500"></i>
            </div>
        </div>
    </div>

    <!-- Diterima -->
    <div class="bg-white rounded-2xl p-4 sm:p-5 shadow border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-[10px] sm:text-xs font-medium uppercase tracking-wide">Diterima</p>
                <p class="text-xl sm:text-2xl font-bold text-green-600 mt-1">{{ $statusCounts['Diterima'] ?? 0 }}</p>
            </div>
            <div class="bg-green-50 rounded-xl p-2 sm:p-3">
                <i class="fas fa-check-circle text-green-500"></i>
            </div>
        </div>
    </div>

    <!-- Ditolak -->
    <div class="bg-white rounded-2xl p-4 sm:p-5 shadow border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-[10px] sm:text-xs font-medium uppercase tracking-wide">Ditolak</p>
                <p class="text-xl sm:text-2xl font-bold text-red-600 mt-1">{{ $statusCounts['Ditolak'] ?? 0 }}</p>
            </div>
            <div class="bg-red-50 rounded-xl p-2 sm:p-3">
                <i class="fas fa-times-circle text-red-500"></i>
            </div>
        </div>
    </div>

    <!-- Tidak Ada Respon -->
    <div class="col-span-2 sm:col-span-1 bg-white rounded-2xl p-4 sm:p-5 shadow border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-[10px] sm:text-xs font-medium uppercase tracking-wide">No Respon</p>
                <p class="text-xl sm:text-2xl font-bold text-gray-600 mt-1">{{ $statusCounts['Tidak Ada Respon'] ?? 0 }}</p>
            </div>
            <div class="bg-gray-100 rounded-xl p-2 sm:p-3">
                <i class="fas fa-ghost text-gray-500"></i>
            </div>
        </div>
    </div>
</div>

<!-- Platform & Kota Stats -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6 mb-6 sm:mb-8">
    <!-- Platform Stats -->
    <div class="bg-white rounded-2xl shadow border border-gray-100 p-4 sm:p-6">
        <h3 class="text-gray-800 font-semibold text-xs sm:text-sm uppercase tracking-wide mb-4">
            <i class="fas fa-globe mr-2 text-blue-500"></i>Lamaran per Platform
        </h3>
        <div class="space-y-3">
            @forelse($platformCounts as $platform => $count)
            <div class="flex items-center justify-between">
                <span class="text-gray-600 text-xs sm:text-sm">{{ $platform }}</span>
                <div class="flex items-center space-x-2 sm:space-x-3">
                    <div class="w-20 sm:w-32 bg-gray-100 rounded-full h-2 overflow-hidden">
                        <div class="bg-blue-500 h-2 rounded-full transition-all" style="width: {{ $totalLamaran > 0 ? ($count / $totalLamaran * 100) : 0 }}%"></div>
                    </div>
                    <span class="text-gray-800 font-semibold text-xs sm:text-sm w-6 sm:w-8 text-right">{{ $count }}</span>
                </div>
            </div>
            @empty
            <p class="text-gray-400 text-sm">Belum ada data</p>
            @endforelse
        </div>
    </div>

    <!-- Kota Stats -->
    <div class="bg-white rounded-2xl shadow border border-gray-100 p-4 sm:p-6">
        <h3 class="text-gray-800 font-semibold text-xs sm:text-sm uppercase tracking-wide mb-4">
            <i class="fas fa-map-marker-alt mr-2 text-red-500"></i>Top 5 Kota
        </h3>
        <div class="space-y-3">
            @forelse($kotaCounts as $kota => $count)
            <div class="flex items-center justify-between">
                <span class="text-gray-600 text-xs sm:text-sm truncate max-w-[120px] sm:max-w-none">{{ $kota }}</span>
                <div class="flex items-center space-x-2 sm:space-x-3">
                    <div class="w-20 sm:w-32 bg-gray-100 rounded-full h-2 overflow-hidden">
                        <div class="bg-red-400 h-2 rounded-full transition-all" style="width: {{ $totalLamaran > 0 ? ($count / $totalLamaran * 100) : 0 }}%"></div>
                    </div>
                    <span class="text-gray-800 font-semibold text-xs sm:text-sm w-6 sm:w-8 text-right">{{ $count }}</span>
                </div>
            </div>
            @empty
            <p class="text-gray-400 text-sm">Belum ada data</p>
            @endforelse
        </div>
    </div>
</div>

<!-- Filter & Search -->
<div class="bg-white rounded-2xl shadow border border-gray-100 p-4 sm:p-6 mb-4 sm:mb-6" x-data="{ showFilters: window.innerWidth >= 640 }">
    <form method="GET" action="{{ route('job-applications.index') }}">
        <!-- Search + toggle/buttons row -->
        <div class="flex gap-2">
            <div class="flex-1 relative">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari perusahaan / posisi..."
                       class="w-full pl-9 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <!-- Mobile: toggle filters -->
            <button type="button" @click="showFilters = !showFilters"
                    class="sm:hidden bg-gray-100 text-gray-600 px-3 py-2.5 rounded-xl text-sm transition flex items-center">
                <i class="fas fa-sliders-h"></i>
            </button>
            <!-- Desktop: filter/reset buttons -->
            <div class="hidden sm:flex gap-2">
                <button type="submit" class="bg-blue-600 text-white px-5 py-2.5 rounded-xl text-sm font-medium hover:bg-blue-700 transition shadow-sm">
                    <i class="fas fa-filter mr-1"></i> Filter
                </button>
                <a href="{{ route('job-applications.index') }}" class="bg-gray-100 text-gray-600 px-4 py-2.5 rounded-xl text-sm font-medium hover:bg-gray-200 transition">
                    <i class="fas fa-undo"></i>
                </a>
            </div>
        </div>

        <!-- Filter dropdowns (toggleable on mobile, always visible on desktop) -->
        <div x-show="showFilters" x-transition class="mt-3 sm:mt-4">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4">
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1 uppercase tracking-wide">Status</label>
                    <select name="filter_status" class="w-full py-2.5 px-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                        <option value="">Semua Status</option>
                        @foreach(\App\Models\JobApplication::$statuses as $status)
                            <option value="{{ $status }}" {{ request('filter_status') == $status ? 'selected' : '' }}>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1 uppercase tracking-wide">Platform</label>
                    <select name="filter_platform" class="w-full py-2.5 px-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                        <option value="">Semua Platform</option>
                        @foreach(\App\Models\JobApplication::$platforms as $platform)
                            <option value="{{ $platform }}" {{ request('filter_platform') == $platform ? 'selected' : '' }}>{{ $platform }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1 uppercase tracking-wide">Kota</label>
                    <select name="filter_kota" class="w-full py-2.5 px-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                        <option value="">Semua Kota</option>
                        @foreach(\App\Models\JobApplication::$kotas as $kota)
                            <option value="{{ $kota }}" {{ request('filter_kota') == $kota ? 'selected' : '' }}>{{ $kota }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Mobile: apply/reset buttons -->
            <div class="flex sm:hidden gap-2 mt-3">
                <button type="submit" class="flex-1 bg-blue-600 text-white px-5 py-2.5 rounded-xl text-sm font-medium hover:bg-blue-700 transition shadow-sm">
                    <i class="fas fa-filter mr-1"></i> Terapkan Filter
                </button>
                <a href="{{ route('job-applications.index') }}" class="bg-gray-100 text-gray-600 px-4 py-2.5 rounded-xl text-sm font-medium hover:bg-gray-200 transition">
                    <i class="fas fa-undo"></i>
                </a>
            </div>
        </div>
    </form>
</div>

<!-- Data List -->
<div class="bg-white rounded-2xl shadow border border-gray-100 overflow-hidden">
    <div class="flex items-center justify-between px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-100">
        <h3 class="text-gray-800 font-semibold text-sm sm:text-base">
            <i class="fas fa-list mr-2 text-gray-400"></i>Daftar Lamaran
            <span class="text-gray-400 font-normal text-xs sm:text-sm ml-1 sm:ml-2">({{ $applications->total() }} data)</span>
        </h3>
        <a href="{{ route('job-applications.create') }}" class="content-center bg-blue-600 text-white px-3 sm:px-4 py-2 rounded-xl text-xs sm:text-sm font-medium hover:bg-blue-700 transition shadow-sm">
            <i class="fas fa-plus"></i><span class="hidden sm:inline"> Tambah</span>
        </a>
    </div>

    <!-- Desktop Table (hidden on mobile) -->
    <div class="hidden md:block overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gradient-to-r from-blue-800 to-indigo-900 text-white">
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider">No</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider">Tanggal</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider">Perusahaan</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider">Posisi</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider">Platform</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider">Kota</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider">Tipe</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider">Gaji</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider">Kontak</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($applications as $index => $app)
                <tr class="hover:bg-blue-50/50 transition {{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50/50' }}">
                    <td class="px-4 py-3 text-gray-500 font-mono text-xs">{{ $applications->firstItem() + $index }}</td>
                    <td class="px-4 py-3 text-gray-700 whitespace-nowrap">{{ \Carbon\Carbon::parse($app->tanggal_lamar)->format('d/m/Y') }}</td>
                    <td class="px-4 py-3">
                        <span class="font-semibold text-gray-800">{{ $app->perusahaan }}</span>
                        @if($app->catatan)
                        <br><span class="text-xs text-gray-400">{{ $app->catatan }}</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-gray-700">{{ $app->posisi }}</td>
                    <td class="px-4 py-3">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-medium bg-indigo-50 text-indigo-700">{{ $app->platform }}</span>
                    </td>
                    <td class="px-4 py-3 text-gray-600">{{ $app->kota }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $app->tipe_kerja }}</td>
                    <td class="px-4 py-3">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold {{ $app->status_color }}">{{ $app->status }}</span>
                    </td>
                    <td class="px-4 py-3 text-gray-700 whitespace-nowrap">
                        @if($app->gaji && $app->gaji != '0')
                            <span class="font-medium">{{ $app->gaji }}</span>
                        @else
                            <span class="text-gray-300">-</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        @if($app->kontak && filter_var($app->kontak, FILTER_VALIDATE_EMAIL))
                            <a href="mailto:{{ $app->kontak }}" class="text-blue-600 hover:underline text-xs">{{ $app->kontak }}</a>
                        @else
                            <span class="text-gray-500 text-xs">{{ $app->kontak ?? '-' }}</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-center whitespace-nowrap">
                        <div class="flex items-center justify-center space-x-1">
                            <a href="{{ route('job-applications.edit', $app) }}"
                               class="text-blue-500 hover:text-blue-700 hover:bg-blue-50 p-2 rounded-lg transition" title="Edit">
                                <i class="fas fa-pen text-xs"></i>
                            </a>
                            <form action="{{ route('job-applications.destroy', $app) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus lamaran ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-600 hover:bg-red-50 p-2 rounded-lg transition" title="Hapus">
                                    <i class="fas fa-trash text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="11" class="px-4 py-16 text-center">
                        <div class="text-gray-300 mb-4"><i class="fas fa-inbox text-5xl"></i></div>
                        <p class="text-gray-400 text-sm">Belum ada data lamaran kerja.</p>
                        <a href="{{ route('job-applications.create') }}" class="inline-block mt-4 bg-blue-600 text-white px-5 py-2 rounded-xl text-sm font-medium hover:bg-blue-700 transition">
                            <i class="fas fa-plus mr-1"></i> Tambah Lamaran Pertama
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Mobile Card List (shown on mobile, hidden on md+) -->
    <div class="md:hidden divide-y divide-gray-100">
        @forelse($applications as $index => $app)
        <div class="p-4 hover:bg-blue-50/30 transition">
            <!-- Header: Company + Status -->
            <div class="flex items-start justify-between mb-3">
                <div class="flex-1 min-w-0 mr-2">
                    <h4 class="font-bold text-gray-800 text-sm leading-tight">{{ $app->perusahaan }}</h4>
                    <p class="text-blue-600 text-xs font-medium mt-0.5">{{ $app->posisi }}</p>
                </div>
                <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-[11px] font-semibold whitespace-nowrap flex-shrink-0 {{ $app->status_color }}">
                    {{ $app->status }}
                </span>
            </div>

            <!-- Details -->
            <div class="space-y-2 mb-3">
                <!-- Row 1: Date + Platform -->
                <div class="flex items-center gap-4 text-xs text-gray-500">
                    <span class="flex items-center">
                        <i class="fas fa-calendar-alt w-4 text-gray-400 text-[10px]"></i>
                        <span class="ml-1">{{ \Carbon\Carbon::parse($app->tanggal_lamar)->format('d/m/Y') }}</span>
                    </span>
                    <span class="flex items-center">
                        <i class="fas fa-globe w-4 text-gray-400 text-[10px]"></i>
                        <span class="ml-1">{{ $app->platform }}</span>
                    </span>
                </div>
                <!-- Row 2: City + Type -->
                <div class="flex items-center gap-4 text-xs text-gray-500">
                    <span class="flex items-center">
                        <i class="fas fa-map-marker-alt w-4 text-gray-400 text-[10px]"></i>
                        <span class="ml-1">{{ $app->kota }}</span>
                    </span>
                    <span class="flex items-center">
                        <i class="fas fa-clock w-4 text-gray-400 text-[10px]"></i>
                        <span class="ml-1">{{ $app->tipe_kerja }}</span>
                    </span>
                </div>
                <!-- Row 3: Salary (if exists) -->
                @if($app->gaji && $app->gaji != '0')
                <div class="flex items-center text-xs text-gray-500">
                    <i class="fas fa-money-bill-wave w-4 text-gray-400 text-[10px]"></i>
                    <span class="ml-1 font-semibold text-gray-700">{{ $app->gaji }}</span>
                </div>
                @endif
                <!-- Row 4: Contact (full width, proper wrapping) -->
                @if($app->kontak)
                <div class="flex items-center text-xs text-gray-500">
                    <i class="fas fa-envelope w-4 text-gray-400 text-[10px] flex-shrink-0"></i>
                    @if(filter_var($app->kontak, FILTER_VALIDATE_EMAIL))
                        <a href="mailto:{{ $app->kontak }}" class="flex items-center ml-1 text-blue-600 break-all hover:underline leading-snug">{{ $app->kontak }}</a>
                    @else
                        <span class="ml-1 break-all leading-snug">{{ $app->kontak }}</span>
                    @endif
                </div>
                @endif
            </div>

            @if($app->catatan)
            <p class="text-xs text-gray-400 mb-3 mt-2 italic leading-relaxed"><i class="fas fa-sticky-note mr-1"></i>{{ $app->catatan }}</p>
            @endif

            <!-- Actions: full-width buttons side by side -->
            <div class="flex gap-2 pt-3 border-t border-gray-100">
                <a href="{{ route('job-applications.edit', $app) }}"
                   class="flex-1 flex items-center justify-center text-blue-600 bg-blue-50 py-2.5 rounded-xl text-xs font-semibold transition active:bg-blue-100 hover:bg-blue-100">
                    <i class="fas fa-pen mr-1.5"></i> Edit
                </a>
                <form action="{{ route('job-applications.destroy', $app) }}" method="POST" class="flex-1"
                      onsubmit="return confirm('Yakin ingin menghapus lamaran ini?')">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="w-full flex items-center justify-center text-red-600 bg-red-50 py-2.5 rounded-xl text-xs font-semibold transition active:bg-red-100 hover:bg-red-100">
                        <i class="fas fa-trash mr-1.5"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="px-4 py-16 text-center">
            <div class="text-gray-300 mb-4"><i class="fas fa-inbox text-5xl"></i></div>
            <p class="text-gray-400 text-sm">Belum ada data lamaran kerja.</p>
            <a href="{{ route('job-applications.create') }}" class="inline-block mt-4 bg-blue-600 text-white px-5 py-2 rounded-xl text-sm font-medium hover:bg-blue-700 transition">
                <i class="fas fa-plus mr-1"></i> Tambah Lamaran Pertama
            </a>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($applications->hasPages())
    <div class="px-4 sm:px-6 py-3 sm:py-4 border-t border-gray-100">
        {{ $applications->withQueryString()->links() }}
    </div>
    @endif
</div>

<!-- Mobile Floating Action Button -->
<a href="{{ route('job-applications.create') }}"
   class="md:hidden fixed bottom-6 right-6 bg-gradient-to-r from-blue-600 to-indigo-600 text-white w-14 h-14 rounded-full shadow-lg shadow-blue-300/50 flex items-center justify-center text-xl hover:from-blue-700 hover:to-indigo-700 transition z-40">
    <i class="fas fa-plus"></i>
</a>
@endsection
