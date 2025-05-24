<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Obat;
use App\Models\Kunjungan;
use App\Models\Resep;

class ResepCtrl extends Controller
{
    public function page()
    {
        return collect([
            "name" => "Resep",
            "icon" => "bi bi-patient",
        ]);
    }

    public function tambah($id) 
    {
        $name = $this->page()["name"];
        $slug = Str::slug($this->page()["name"]);
        $icon = $this->page()["icon"];
        $title  = "Resep Obat";
        $pageTitle  = "Resep Obat";
        $pageSubTitle  = "Input Resep Obat";
        $obat =  Obat::list()->get();
        $kunjungan = Kunjungan::find($id);

        return view("$slug.tambah", [
            "name" => $name,
            "slug" => $slug,
            "icon" => $icon,
            "title" => $title,
            "pageTitle" => $pageTitle,
            "pageSubTitle" => $pageSubTitle,
            "obat" => $obat,
            "data" => $kunjungan,
        ]);
    }

    function save(Request $request)
    {
        DB::beginTransaction();

        try {
            

            foreach($request['detail'] as $item) {

                $RS = new Resep();
                $RS->kunjungan_id   = $request['id'];
                $RS->obat_id        = $item['obatid'];
                $RS->aturanpakai    = $item['aturanpakai'];
                $RS->keterangan     = $item['keterangan'];
                $RS->save();

            }

            Kunjungan::where('id', $request['id'])->update(['status' => 4]);

            DB::commit();
            $status = true;
            $transMessage = "Data berhasil disimpan !";
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
            $transMessage = "Data gagal disimpan !";
            $status = false;
        }


        return response()->json([
            'message'    => $transMessage,
            "status"     => $status,
        ]);
    }
}
