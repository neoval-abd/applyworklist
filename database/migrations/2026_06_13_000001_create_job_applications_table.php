<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_lamar');
            $table->string('perusahaan');
            $table->string('posisi');
            $table->string('platform');
            $table->string('kota');
            $table->string('tipe_kerja');
            $table->string('status');
            $table->date('tgl_update')->nullable();
            $table->string('gaji')->nullable();
            $table->string('kontak')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_applications');
    }
}
