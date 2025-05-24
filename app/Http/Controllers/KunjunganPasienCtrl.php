<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Pasien;
use App\Models\User;
use App\Models\Kunjungan;
use App\Models\Resep;
use Yajra\DataTables\DataTables;
use App\Traits\Tools;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class KunjunganPasienCtrl extends Controller
{
    use Tools;
    public function page()
    {
        return collect([
            "name" => "Kunjungan",
            "icon" => "bi bi-patient",
        ]);
    }

    public function index() 
    {
        $name = $this->page()["name"];
        $slug = Str::slug($this->page()["name"]);
        $icon = $this->page()["icon"];
        $title  = "Data Kunjungan Pasien";
        $pageTitle  = "Kunjungan Pasien";
        $pageSubTitle  = "Data Kunjungan Pasien";
        $dokter = User::dokter()->get();
        $pasien = Pasien::list()->get();

        return view("$slug.index", [
            "name" => $name,
            "slug" => $slug,
            "icon" => $icon,
            "title" => $title,
            "pageTitle" => $pageTitle,
            "pageSubTitle" => $pageSubTitle,
            "dokter" => $dokter,
            "pasien" => $pasien,
        ]);
    }

    public function data(Request $request) 
    {
        $data = Kunjungan::with(['pasien', 'user'])
                        ->where('statusenabled', true)
                        ->where('tglkunjungan', '>=', $request['tglAwal'])
                        ->where('tglkunjungan', '<=', $request['tglAkhir']);

        if(isset($request['search'])) {

            $search = '%' . $request['search'] . '%';
            $data = $data->where(function ($query) use ($search) {
                $query->where('nokunjungan', 'ILIKE', $search)
                        ->orWhere(function ($q) use ($search) {
                            $q->whereHas('pasien', function ($q) use ($search) {
                                $q->where('namapasien', 'ILIKE', $search)
                                    ->orWhere('norm', 'ilike', $search);
                            });
                        });
            });
        }

        $data = $data->get();

        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('pasiendata', function($row) {

                    $ps = '<div class="d-flex align-items-center">
                                    <div class="d-flex flex-column">
                                        <a class="text-gray-800 text-hover-primary mb-1">'.$row->pasien->namapasien.'</a>
                                        <span>'.$row->pasien->norm.' ('.$row->pasien->gender.')</span>
                                    </div>
                                </div>';

                    return $ps;
                })
                ->addColumn('tgl', function($row) {
                    return $row->tanggal;
                })
                ->addColumn('action', function($row){

                    $actionBtn = '<a href="/detail-kunjungan/'.$row->id.'" 
                            type="button" id="registrasi" title="Input Kunjungan" 
                            class="btn btn-sm btn-light-success me-2" 
                            style="padding: 5px 7px 5px 10px">
                                <i class="fas fa-notes-medical fs-8"></i>
                            </a>';

                    if(Auth()->user()->level_id == 2) {
                        $actionBtn = '<button type="button" id="editData" title="Edit Data" 
                                data-id="'.$row->id.'" data-pasien="'.$row->pasien_id.'" 
                                data-tgl="'.$row->tglkunjungan.'" 
                                data-dokter="'.$row->user_id.'"  
                                    class="btn btn-sm btn-light-warning me-2" style="padding: 5px 7px 5px 10px">
                                    <i class="fas fa-pen-nib fs-8"></i>
                                </button>';
                                
                        $actionBtn .= '<button type="button" id="hapusData" title="Hapus Data" 
                                data-id="'.$row->id.'" class="btn btn-sm btn-light-danger" 
                                style="padding: 5px 7px 5px 10px">
                                    <i class="fas fa-trash fs-8"></i>
                                </button>';
                    } else if(Auth()->user()->level_id != 2 && Auth()->user()->level_id != 1  ) {
                        $actionBtn = '<a href="/detail-kunjungan/'.$row->id.'" 
                            type="button" id="registrasi" title="Input Kunjungan" 
                            class="btn btn-sm btn-light-success me-2" 
                            style="padding: 5px 7px 5px 10px">
                                <i class="fas fa-notes-medical fs-8"></i>
                            </a>';
                    } else if(Auth()->user()->level_id == 2) {
                        $actionBtn = '<a href="/detail-kunjungan/'.$row->id.'" 
                            type="button" id="registrasi" title="Input Kunjungan" 
                            class="btn btn-sm btn-light-success me-2" 
                            style="padding: 5px 7px 5px 10px">
                                <i class="fas fa-notes-medical fs-8"></i>
                            </a>';

                            $actionBtn = '<button type="button" id="editData" title="Edit Data" 
                                data-id="'.$row->id.'" data-pasien="'.$row->pasien_id.'" 
                                data-tgl="'.$row->tglkunjungan.'" 
                                data-dokter="'.$row->user_id.'"  
                                    class="btn btn-sm btn-light-warning me-2" style="padding: 5px 7px 5px 10px">
                                    <i class="fas fa-pen-nib fs-8"></i>
                                </button>';
                                
                            $actionBtn .= '<button type="button" id="hapusData" title="Hapus Data" 
                                    data-id="'.$row->id.'" class="btn btn-sm btn-light-danger" 
                                    style="padding: 5px 7px 5px 10px">
                                        <i class="fas fa-trash fs-8"></i>
                                    </button>';
                    }
                    
                    
                    
                    return $actionBtn;
                })
                
                ->rawColumns(['pasiendata', 'tgl', 'action'])
                ->make(true);
    }

    public function detail($id)
    {
        $data = Kunjungan::with(['pasien', 'user'])->find($id);
        $pemfis = $data->pemeriksaanfisik;
        $pemdis = $data->pemeriksaanmedis;
        $resep = Resep::with('obat')->where('kunjungan_id', $id)->get();
        $name = 'Detail Kunjungan';
        $slug = Str::slug($this->page()["name"]);
        $icon = $this->page()["icon"];
        $title  = "Detail Kunjungan Pasien";
        $pageTitle  = $data->nokunjungan;
        $pageSubTitle  = "Detail Kunjungan Pasien";
        
        return view("$slug.detail", [
            "name" => $name,
            "slug" => $slug,
            "icon" => $icon,
            "title" => $title,
            "pageTitle" => $pageTitle,
            "pageSubTitle" => $pageSubTitle,
            "data" =>$data,
            "pemfis" =>$pemfis,
            "pemdis" =>$pemdis,
            "resep" =>$resep
        ]);

        
    }

    public function save(Request $request)
    {
        $cek = [];
        if($request['id'] != '') {

            $cek2 = Kunjungan::find($request['id']);
            if($cek2 && ($cek2->status != 1 && (date('Y-m-d', strtotime($cek2->tglkunjungan)) == date('Y-m-d', strtotime($request['tglkunjungan']))))) {
                return response()->json([
                    'message'    => 'Gagal edit, Pasien ini sudah mendapatkan pelayanan !',
                    "status"     => false,
                ]);
            }

            $cek = Kunjungan::where('pasien_id', $request['idpasien'])
                        ->whereDate('tglkunjungan', date('Y-m-d', strtotime($request['tglkunjungan'])))
                        ->where('id', '!=', $request['id'])
                        ->where('statusenabled', true)
                        ->get();
            
        } else {

            $cek = Kunjungan::where('pasien_id', $request['idpasien'])
                        ->whereDate('tglkunjungan', date('Y-m-d', strtotime($request['tglkunjungan'])))
                        ->where('statusenabled', true)
                        ->get();
            
        }
        

        if(count($cek) >= 1) {
            return response()->json([
                'message'    => 'Pasien ini sudah ada data kunjungan untuk tanggal ini ',
                "status"     => false,
            ]);
        }

        DB::beginTransaction();

        try {

            if($request['id'] != '') {
                $KP = Kunjungan::find($request['id']);
            } else {
                $KP                       = new Kunjungan();
                $KP->statusenabled        = true;
                $KP->status             = 1;
                $perfix = 'KP'.date('ym', strtotime($request['tglkunjungan']));
                $KP->nokunjungan           = $this->GENERATE_KODE('nokunjungan', 12, $perfix);
            }

            $KP->pasien_id          = $request['idpasien'];
            $KP->user_id            = $request['dokter'];
            $KP->tglkunjungan       = $request['tglkunjungan'];
            $KP->save();

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

    function hapus($id) 
    {
        $cek = Kunjungan::find($id);

        if($cek->status != 1) {
            return response()->json([
                'message'    => 'Gagal hapus, Kunjungan ini sudah mendaptkan pelayanan !',
                "status"     => false,
            ]);
        }

        DB::beginTransaction();

        try {
            
            Kunjungan::where('id', $id)->update(['statusenabled' => false]);
            
            DB::commit();
            $status = true;
            $transMessage = "Data berhasil dihapus !";
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
            $transMessage = "Data gagal dihapus !";
            $status = false;
        }


        return response()->json([
            'message'   => $transMessage,
            "status"    => $status,
        ]);
    }
}
