<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemeriksaanmedisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemeriksaanmedis', function (Blueprint $table) {
            $table->id();
            $table->foreignId("kunjungan_id")->unsigned();
            $table->text("keluhanutama");
            $table->text("riwayatapenyakitsekarang")->nullable();
            $table->text("riwayatapenyakitdahulu")->nullable();
            $table->text("riwayatalergi")->nullable();
            $table->text("riwayatpemakaianobat")->nullable();
            $table->string("diagnosautama");
            $table->string("diagnosatambahan")->nullable();
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
        Schema::dropIfExists('pemeriksaanmedis');
    }
}
