<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Level;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new Level;
        $data->level = "Superadmin";
        $data->save();

        $data = new Level;
        $data->level = "Registrasi";
        $data->save();

        $data = new Level;
        $data->level = "Perawat";
        $data->save();

        $data = new Level;
        $data->level = "Dokter";
        $data->save();

        $data = new Level;
        $data->level = "Apoteker";
        $data->save();
    }
}
