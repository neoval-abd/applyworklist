<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobApplicationController extends Controller
{
    /**
     * Display dashboard with statistics and list.
     */
    public function index(Request $request)
    {
        $query = JobApplication::query();

        // Filter by status
        if ($request->filled('filter_status')) {
            $query->where('status', $request->filter_status);
        }

        // Filter by platform
        if ($request->filled('filter_platform')) {
            $query->where('platform', $request->filter_platform);
        }

        // Filter by kota
        if ($request->filled('filter_kota')) {
            $query->where('kota', $request->filter_kota);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('perusahaan', 'like', "%{$search}%")
                  ->orWhere('posisi', 'like', "%{$search}%")
                  ->orWhere('kontak', 'like', "%{$search}%");
            });
        }

        $applications = $query->orderBy('tanggal_lamar', 'desc')->paginate(15);

        // Dashboard statistics
        $totalLamaran = JobApplication::count();
        $statusCounts = JobApplication::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        $platformCounts = JobApplication::select('platform', DB::raw('count(*) as total'))
            ->groupBy('platform')
            ->pluck('total', 'platform');

        $kotaCounts = JobApplication::select('kota', DB::raw('count(*) as total'))
            ->groupBy('kota')
            ->orderByDesc('total')
            ->limit(5)
            ->pluck('total', 'kota');

        return view('job-applications.index', compact(
            'applications',
            'totalLamaran',
            'statusCounts',
            'platformCounts',
            'kotaCounts'
        ));
    }

    /**
     * Show the form for creating a new job application.
     */
    public function create()
    {
        $application = new JobApplication();
        $application->tanggal_lamar = now()->format('Y-m-d');
        $application->status = 'Applied';
        $application->tipe_kerja = 'Full-time';
        $application->platform = 'LinkedIn';
        $application->kota = 'Jakarta Pusat';

        return view('job-applications.form', compact('application'));
    }

    /**
     * Store a newly created job application.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_lamar' => 'required|date',
            'perusahaan' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'platform' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'tipe_kerja' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'tgl_update' => 'nullable|date',
            'gaji' => 'nullable|string|max:255',
            'kontak' => 'nullable|string|max:255',
            'catatan' => 'nullable|string',
        ]);

        JobApplication::create($validated);

        return redirect()->route('job-applications.index')
            ->with('success', 'Lamaran kerja berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified job application.
     */
    public function edit(JobApplication $jobApplication)
    {
        $application = $jobApplication;
        return view('job-applications.form', compact('application'));
    }

    /**
     * Update the specified job application.
     */
    public function update(Request $request, JobApplication $jobApplication)
    {
        $validated = $request->validate([
            'tanggal_lamar' => 'required|date',
            'perusahaan' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'platform' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'tipe_kerja' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'tgl_update' => 'nullable|date',
            'gaji' => 'nullable|string|max:255',
            'kontak' => 'nullable|string|max:255',
            'catatan' => 'nullable|string',
        ]);

        $jobApplication->update($validated);

        return redirect()->route('job-applications.index')
            ->with('success', 'Lamaran kerja berhasil diupdate!');
    }

    /**
     * Remove the specified job application.
     */
    public function destroy(JobApplication $jobApplication)
    {
        $jobApplication->delete();

        return redirect()->route('job-applications.index')
            ->with('success', 'Lamaran kerja berhasil dihapus!');
    }
}
