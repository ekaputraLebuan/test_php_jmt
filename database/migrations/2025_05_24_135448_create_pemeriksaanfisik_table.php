<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemeriksaanfisikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemeriksaanfisik', function (Blueprint $table) {
            $table->id();
            $table->foreignId("kunjungan_id")->unsigned();
            $table->string("beratbadan", 50);
            $table->string("tinggibadan", 50)->nullable();
            $table->string("tekanandarah", 50);
            $table->string("nadi", 50)->nullable();
            $table->string("suhutubuh", 50)->nullable();
            $table->string("saturasioksigen", 50)->nullable();
            $table->string("imt", 50)->nullable();
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
        Schema::dropIfExists('pemeriksaanfisik');
    }
}
