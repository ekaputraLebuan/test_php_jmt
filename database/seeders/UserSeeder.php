<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new User;
        $data->nama = "Eka Putra";
        $data->username = "superadmin";
        $data->password = bcrypt("123456");
        $data->level_id = 1;
        $data->save();

        $data = new User;
        $data->nama = "Alexandria S";
        $data->username = "registrasi";
        $data->password = bcrypt("123456");
        $data->level_id = 2;
        $data->save();

        $data = new User;
        $data->nama = "Amerius Jr";
        $data->username = "perawat";
        $data->password = bcrypt("123456");
        $data->level_id = 3;
        $data->save();

        $data = new User;
        $data->nama = "Dr. Nathanael";
        $data->username = "dokter";
        $data->password = bcrypt("123456");
        $data->level_id = 4;
        $data->save();

        $data = new User;
        $data->nama = "Apt. Jhon Paul";
        $data->username = "apoteker";
        $data->password = bcrypt("123456");
        $data->level_id = 5;
        $data->save();
    }
}
