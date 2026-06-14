<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal_lamar',
        'perusahaan',
        'posisi',
        'platform',
        'kota',
        'tipe_kerja',
        'status',
        'tgl_update',
        'gaji',
        'kontak',
        'catatan',
    ];

    protected $casts = [
        'tanggal_lamar' => 'date',
        'tgl_update' => 'date',
    ];

    // Dropdown options as static arrays
    public static $platforms = [
        'LinkedIn',
        'Glints',
        'JobStreet',
        'Kalibrr',
        'Website',
        'Referral',
        'Lainnya',
    ];

    public static $kotas = [
        'Jakarta Pusat',
        'Jakarta Utara',
        'Jakarta Selatan',
        'Jakarta Barat',
        'Jakarta Timur',
        'Bogor',
        'Depok',
        'Tangerang',
        'Tangerang Selatan',
        'Bekasi',
        'Lainnya',
    ];

    public static $tipeKerjas = [
        'Full-time',
        'Part-time',
        'Contract',
        'Internship',
        'Freelance',
        'Remote',
        'Hybrid',
    ];

    public static $statuses = [
        'Applied',
        'Interview',
        'Tes/Seleksi',
        'Offering',
        'Diterima',
        'Ditolak',
        'Tidak Ada Respon',
    ];

    public static $gajiRanges = [
        '0' => 'Tidak disebutkan',
        '< 3 Jt' => '< 3 Juta',
        '3 - 4 Jt' => '3 - 4 Juta',
        '4 - 5 Jt' => '4 - 5 Juta',
        '5 - 6 Jt' => '5 - 6 Juta',
        '6 - 8 Jt' => '6 - 8 Juta',
        '8 - 10 Jt' => '8 - 10 Juta',
        '10 - 15 Jt' => '10 - 15 Juta',
        '> 15 Jt' => '> 15 Juta',
    ];

    public function getStatusColorAttribute()
    {
        $colors = [
            'Applied' => 'bg-blue-100 text-blue-800',
            'Interview' => 'bg-yellow-100 text-yellow-800',
            'Tes/Seleksi' => 'bg-orange-100 text-orange-800',
            'Offering' => 'bg-purple-100 text-purple-800',
            'Diterima' => 'bg-green-100 text-green-800',
            'Ditolak' => 'bg-red-100 text-red-800',
            'Tidak Ada Respon' => 'bg-gray-100 text-gray-800',
        ];

        return $colors[$this->status] ?? 'bg-gray-100 text-gray-800';
    }
}
