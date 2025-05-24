<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKunjunganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kunjungan', function (Blueprint $table) {
            $table->id();
            $table->string("nokunjungan", 50)->unique();
            $table->foreignId("pasien_id")->unsigned();
            $table->foreignId("user_id")->unsigned(); // Dokter
            $table->timestamp('tglkunjungan')->nullable();
            $table->smallInteger("status");
            $table->boolean("statusenabled");
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
        Schema::dropIfExists('kunjungan');
    }
}
