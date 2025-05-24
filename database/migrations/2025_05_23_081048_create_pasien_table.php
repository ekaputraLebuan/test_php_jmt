<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasien', function (Blueprint $table) {
            $table->id();
            $table->string("norm", 50)->unique();
            $table->string("namapasien", 250);
            $table->string("tempatlahir", 200)->nullable();
            $table->date('tgllahir')->nullable();
            $table->enum('jeniskelamin', ['Laki-Laki', 'Perempuan']);
            $table->string("alamat")->nullable();
            $table->string("nohp", 50);
            $table->enum('golongandarah', ['A', 'B', 'AB', 'O'])->nullable();
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
        Schema::dropIfExists('pasien');
    }
}
