<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobApplication;

class JobApplicationSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['tanggal_lamar' => '2026-06-07', 'perusahaan' => 'RS Assalam', 'posisi' => 'IT Support', 'platform' => 'Lainnya', 'kota' => 'Bogor', 'tipe_kerja' => 'Full-time', 'status' => 'Applied', 'tgl_update' => '2026-06-07', 'gaji' => '6 - 8 Jt', 'kontak' => 'hrd.assalam@gmail.com', 'catatan' => 'Applied'],
            ['tanggal_lamar' => '2026-06-07', 'perusahaan' => 'PT VALDO SUMBER DAYA', 'posisi' => 'QA Engineer', 'platform' => 'Website', 'kota' => 'Jakarta Utara', 'tipe_kerja' => 'Full-time', 'status' => 'Ditolak', 'tgl_update' => '2026-06-07', 'gaji' => '0', 'kontak' => 'Glits.com', 'catatan' => 'Applied'],
            ['tanggal_lamar' => '2026-06-07', 'perusahaan' => 'RS Satya Negara', 'posisi' => 'Staff IT', 'platform' => 'LinkedIn', 'kota' => 'Tangerang', 'tipe_kerja' => 'Full-time', 'status' => 'Applied', 'tgl_update' => '2026-06-07', 'gaji' => '3.5 - 4.5 Jt', 'kontak' => 'recruitment@rssatyanegara.com', 'catatan' => 'Applied'],
            ['tanggal_lamar' => '2026-06-07', 'perusahaan' => 'RSU MC', 'posisi' => 'IT Support', 'platform' => 'Glints', 'kota' => 'Menteng, Jakarta', 'tipe_kerja' => 'Full-time', 'status' => 'Applied', 'tgl_update' => '2026-06-07', 'gaji' => '3.9 - 5.9 Jt', 'kontak' => 'sdm.rsusmc@gmail.com', 'catatan' => 'Applied'],
            ['tanggal_lamar' => '2026-06-08', 'perusahaan' => 'PT Solusi Digital', 'posisi' => 'Network Engineer', 'platform' => 'JobStreet', 'kota' => 'Jakarta Selatan', 'tipe_kerja' => 'Full-time', 'status' => 'Interview', 'tgl_update' => '2026-06-10', 'gaji' => '4 - 5 Jt', 'kontak' => 'hr@solusidigital.com', 'catatan' => 'Interview dijadwalkan 12 Juni'],
            ['tanggal_lamar' => '2026-06-08', 'perusahaan' => 'PT Mitra Teknologi', 'posisi' => 'System Administrator', 'platform' => 'LinkedIn', 'kota' => 'Depok', 'tipe_kerja' => 'Full-time', 'status' => 'Tes/Seleksi', 'tgl_update' => '2026-06-11', 'gaji' => '5.5 - 6.5 Jt', 'kontak' => 'career@mitratek.com', 'catatan' => 'Sedang proses seleksi'],
            ['tanggal_lamar' => '2026-06-08', 'perusahaan' => 'StartUp Nusantara', 'posisi' => 'DevOps Engineer', 'platform' => 'Glints', 'kota' => 'Jakarta Pusat', 'tipe_kerja' => 'Full-time', 'status' => 'Applied', 'tgl_update' => '2026-06-08', 'gaji' => '6 - 8 Jt', 'kontak' => 'jobs@startupnusantara.id', 'catatan' => 'Applied'],
            ['tanggal_lamar' => '2026-06-09', 'perusahaan' => 'PT Cloud Indonesia', 'posisi' => 'Cloud Engineer', 'platform' => 'Kalibrr', 'kota' => 'Jakarta Barat', 'tipe_kerja' => 'Full-time', 'status' => 'Ditolak', 'tgl_update' => '2026-06-12', 'gaji' => '8 - 10 Jt', 'kontak' => 'recruitment@cloudindo.com', 'catatan' => 'Tidak sesuai kualifikasi'],
            ['tanggal_lamar' => '2026-06-09', 'perusahaan' => 'RS Harapan Bunda', 'posisi' => 'IT Staff', 'platform' => 'Website', 'kota' => 'Bekasi', 'tipe_kerja' => 'Full-time', 'status' => 'Tidak Ada Respon', 'tgl_update' => '2026-06-09', 'gaji' => '3 - 4 Jt', 'kontak' => 'hrd@rsharapanbunda.com', 'catatan' => 'Belum ada kabar'],
            ['tanggal_lamar' => '2026-06-09', 'perusahaan' => 'PT Data Prima', 'posisi' => 'Database Admin', 'platform' => 'JobStreet', 'kota' => 'Tangerang Selatan', 'tipe_kerja' => 'Full-time', 'status' => 'Offering', 'tgl_update' => '2026-06-13', 'gaji' => '6.900.000', 'kontak' => 'hr@dataprima.co.id', 'catatan' => 'Offering letter diterima'],
            ['tanggal_lamar' => '2026-06-10', 'perusahaan' => 'PT Inovasi Tech', 'posisi' => 'Software Developer', 'platform' => 'LinkedIn', 'kota' => 'Jakarta Selatan', 'tipe_kerja' => 'Full-time', 'status' => 'Applied', 'tgl_update' => '2026-06-10', 'gaji' => '4 - 6 Jt', 'kontak' => '', 'catatan' => 'Applied'],
            ['tanggal_lamar' => '2026-06-10', 'perusahaan' => 'Klinik Sehat', 'posisi' => 'IT Support', 'platform' => 'Referral', 'kota' => 'Bogor', 'tipe_kerja' => 'Full-time', 'status' => 'Diterima', 'tgl_update' => '2026-06-13', 'gaji' => '3.000.000', 'kontak' => 'admin@kliniksehat.com', 'catatan' => 'Diterima! Mulai kerja 1 Juli'],
            ['tanggal_lamar' => '2026-06-10', 'perusahaan' => 'PT Jaringan Nusantara', 'posisi' => 'Network Admin', 'platform' => 'Glints', 'kota' => 'Jakarta Timur', 'tipe_kerja' => 'Full-time', 'status' => 'Applied', 'tgl_update' => '2026-06-10', 'gaji' => '5 - 7 Jt', 'kontak' => 'hr@jaringannusantara.com', 'catatan' => 'Applied'],
            ['tanggal_lamar' => '2026-06-11', 'perusahaan' => 'EduTech Indonesia', 'posisi' => 'Full Stack Developer', 'platform' => 'Kalibrr', 'kota' => 'Jakarta Pusat', 'tipe_kerja' => 'Remote', 'status' => 'Interview', 'tgl_update' => '2026-06-12', 'gaji' => '8 - 10 Jt', 'kontak' => 'career@edutech.id', 'catatan' => 'Technical interview'],
            ['tanggal_lamar' => '2026-06-11', 'perusahaan' => 'PT Amanah Cyber', 'posisi' => 'Security Analyst', 'platform' => 'LinkedIn', 'kota' => 'Tangerang', 'tipe_kerja' => 'Full-time', 'status' => 'Applied', 'tgl_update' => '2026-06-11', 'gaji' => '6 - 8 Jt', 'kontak' => 'recruitment@amanahcyber.com', 'catatan' => 'Applied'],
            ['tanggal_lamar' => '2026-06-12', 'perusahaan' => 'RS Medika', 'posisi' => 'IT Officer', 'platform' => 'Website', 'kota' => 'Depok', 'tipe_kerja' => 'Full-time', 'status' => 'Ditolak', 'tgl_update' => '2026-06-13', 'gaji' => '4 - 5 Jt', 'kontak' => 'hrd@rsmedika.com', 'catatan' => 'Posisi sudah terisi'],
            ['tanggal_lamar' => '2026-06-12', 'perusahaan' => 'PT Fintech Maju', 'posisi' => 'Backend Developer', 'platform' => 'JobStreet', 'kota' => 'Jakarta Selatan', 'tipe_kerja' => 'Hybrid', 'status' => 'Applied', 'tgl_update' => '2026-06-12', 'gaji' => '10 - 15 Jt', 'kontak' => 'jobs@fintechmaju.com', 'catatan' => 'Applied'],
            ['tanggal_lamar' => '2026-06-12', 'perusahaan' => 'Telkom Indonesia', 'posisi' => 'IT Infrastructure', 'platform' => 'Referral', 'kota' => 'Jakarta Pusat', 'tipe_kerja' => 'Full-time', 'status' => 'Tes/Seleksi', 'tgl_update' => '2026-06-13', 'gaji' => '> 15 Jt', 'kontak' => '', 'catatan' => 'Tes online besok'],
            ['tanggal_lamar' => '2026-06-13', 'perusahaan' => 'PT Smart Solutions', 'posisi' => 'Helpdesk', 'platform' => 'Glints', 'kota' => 'Bekasi', 'tipe_kerja' => 'Contract', 'status' => 'Applied', 'tgl_update' => '2026-06-13', 'gaji' => '3.5 - 4.5 Jt', 'kontak' => 'hr@smartsolutions.co.id', 'catatan' => 'Kontrak 6 bulan'],
            ['tanggal_lamar' => '2026-06-13', 'perusahaan' => 'Gojek', 'posisi' => 'SRE Engineer', 'platform' => 'LinkedIn', 'kota' => 'Jakarta Selatan', 'tipe_kerja' => 'Full-time', 'status' => 'Applied', 'tgl_update' => '2026-06-13', 'gaji' => '> 15 Jt', 'kontak' => 'careers@gojek.com', 'catatan' => 'Applied via referral'],
        ];

        foreach ($data as $item) {
            JobApplication::create($item);
        }

        $this->command->info('Sample data seeded successfully!');
    }
}
