<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Kunjungan;
use App\Models\PemeriksaanFisik;
use App\Models\PemeriksaanMedis;

class PemeriksaanCtrl extends Controller
{
    public function page()
    {
        return collect([
            "name" => "Pemeriksaan",
            "icon" => "bi bi-patient",
        ]);
    }

    public function tambahPemfis($id) 
    {
        $kunjungan = Kunjungan::find($id);
        $name = $this->page()["name"];
        $slug = Str::slug($this->page()["name"]);
        $icon = $this->page()["icon"];
        $title  = "Pemriksaan Fisik " . $kunjungan->nokunjungan;
        $pageTitle  = "Pemeriksaan Fisik";
        $pageSubTitle  = "Input Pemeriksaan Fisik";
        

        return view("$slug.tambah-pemfis", [
            "name" => $name,
            "slug" => $slug,
            "icon" => $icon,
            "title" => $title,
            "pageTitle" => $pageTitle,
            "pageSubTitle" => $pageSubTitle,
            "data" => $kunjungan,
        ]);
    }

    public function savePemfis(Request $request, $id) 
    {
        $validatedData  = $request->validate([
            'beratbadan'        => 'required',
            'tinggibadan'       => 'required',
            'tekanandarah'      => 'required',
            'nadi'              => 'nullable',
            'saturasioksigen'   => 'nullable',
            'suhutubuh'         => 'nullable',
            'imt'               => 'nullable',
        ]);
        
        
        $validatedData['kunjungan_id'] = $id;

        

        PemeriksaanFisik::create($validatedData);
        Kunjungan::where('id', $id)->update(['status' => 2]);
        return redirect('/detail-kunjungan/'.$id)->with("success", "Data berhasil simpan !");
    }

    public function editPemfis($id) 
    {
        $pemfis = PemeriksaanFisik::find($id);
        $kunjungan = Kunjungan::find($pemfis->kunjungan_id);
        $name = $this->page()["name"];
        $slug = Str::slug($this->page()["name"]);
        $icon = $this->page()["icon"];
        $title  = "Pemriksaan Fisik " . $kunjungan->nokunjungan;
        $pageTitle  = "Pemeriksaan Fisik";
        $pageSubTitle  = "Ubah Pemeriksaan Fisik";
        

        return view("$slug.edit-pemfis", [
            "name" => $name,
            "slug" => $slug,
            "icon" => $icon,
            "title" => $title,
            "pageTitle" => $pageTitle,
            "pageSubTitle" => $pageSubTitle,
            "data" => $kunjungan,
            "pemfis" => $pemfis,
        ]);
    }

    public function updatePemfis(Request $request, $id) 
    {
        $validatedData  = $request->validate([
            'beratbadan'        => 'required',
            'tinggibadan'       => 'required',
            'tekanandarah'      => 'required',
            'nadi'              => 'nullable',
            'saturasioksigen'   => 'nullable',
            'suhutubuh'         => 'nullable',
            'imt'               => 'nullable',
        ]);
        
        
        PemeriksaanFisik::where('id', $id)->update($validatedData);
        return redirect('/detail-kunjungan/'.PemeriksaanFisik::find($id)->kunjungan->id)->with("success", "Data berhasil simpan !");
    }

    public function tambahPemdis($id) 
    {
        $kunjungan = Kunjungan::find($id);
        $name = $this->page()["name"];
        $slug = Str::slug($this->page()["name"]);
        $icon = $this->page()["icon"];
        $title  = "Pemriksaan Medis " . $kunjungan->nokunjungan;
        $pageTitle  = "Pemeriksaan Medis";
        $pageSubTitle  = "Input Pemeriksaan Medis";
        

        return view("$slug.tambah-pemdis", [
            "name" => $name,
            "slug" => $slug,
            "icon" => $icon,
            "title" => $title,
            "pageTitle" => $pageTitle,
            "pageSubTitle" => $pageSubTitle,
            "data" => $kunjungan,
        ]);
    }

    public function savePemdis(Request $request, $id) 
    {
        $validatedData  = $request->validate([
            'keluhanutama'                  => 'required',
            'riwayatapenyakitsekarang'      => 'nullable',
            'riwayatapenyakitdahulu'        => 'nullable',
            'riwayatalergi'                 => 'nullable',
            'riwayatpemakaianobat'          => 'nullable',
            'diagnosautama'                 => 'required',
            'diagnosatambahan'              => 'nullable',
        ]);
        
        $validatedData['kunjungan_id'] = $id;

        

        PemeriksaanMedis::create($validatedData);
        Kunjungan::where('id', $id)->update(['status' => 3]);
        return redirect('/detail-kunjungan/'.$id)->with("success", "Data berhasil simpan !");
    }

    public function editPemdis($id) 
    {
        $pemdis = PemeriksaanMedis::find($id);
        $kunjungan = Kunjungan::find($pemdis->kunjungan_id);
        $name = $this->page()["name"];
        $slug = Str::slug($this->page()["name"]);
        $icon = $this->page()["icon"];
        $title  = "Pemriksaan Medis " . $kunjungan->nokunjungan;
        $pageTitle  = "Pemeriksaan Medis";
        $pageSubTitle  = "Ubah Pemeriksaan Medis";
        

        return view("$slug.edit-pemdis", [
            "name" => $name,
            "slug" => $slug,
            "icon" => $icon,
            "title" => $title,
            "pageTitle" => $pageTitle,
            "pageSubTitle" => $pageSubTitle,
            "data" => $kunjungan,
            "pemdis" => $pemdis,
        ]);
    }

    public function updatePemdis(Request $request, $id) 
    {
        $validatedData  = $request->validate([
            'keluhanutama'                  => 'required',
            'riwayatapenyakitsekarang'      => 'nullable',
            'riwayatapenyakitdahulu'        => 'nullable',
            'riwayatalergi'                 => 'nullable',
            'riwayatpemakaianobat'          => 'nullable',
            'diagnosautama'                 => 'required',
            'diagnosatambahan'              => 'nullable',
        ]);
        
        
        PemeriksaanMedis::where('id', $id)->update($validatedData);
        return redirect('/detail-kunjungan/'.PemeriksaanMedis::find($id)->kunjungan->id)->with("success", "Data berhasil simpan !");
    }
}
