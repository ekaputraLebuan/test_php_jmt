<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Pasien;
use App\Models\User;
use App\Models\Kunjungan;
use Yajra\DataTables\DataTables;
use App\Traits\Tools;
use Illuminate\Support\Carbon;

class PasienCtrl extends Controller
{
    use Tools;
    public function page()
    {
        return collect([
            "name" => "Pasien",
            "icon" => "bi bi-patient",
        ]);
    }

    public function index() 
    {
        $name = $this->page()["name"];
        $slug = Str::slug($this->page()["name"]);
        $icon = $this->page()["icon"];
        $title  = "Data Pasien";
        $pageTitle  = "Data Pasien";
        $pageSubTitle  = "List Data Pasien";
        $dokter = User::dokter()->get();

        return view("$slug.index", [
            "name" => $name,
            "slug" => $slug,
            "icon" => $icon,
            "title" => $title,
            "pageTitle" => $pageTitle,
            "pageSubTitle" => $pageSubTitle,
            "dokter" => $dokter,
            "dokter2" => $dokter,
        ]);
    }

    public function data(Request $request) 
    {
        $data = Pasien::list();

        if(isset($request['search'])) {

            $search = '%' . $request['search'] . '%';
            $data = $data->where(function ($query) use ($search) {
                $query->where('namapasien', 'ilike', $search)
                    ->orWhere('norm', 'ilike', $search);
            });
        }

        $data = $data->get();

        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('pasien', function($row) {

                    $imageP = '<div class="d-flex align-items-center">
                                        <div class="symbol symbol-circle symbol-40px overflow-hidden me-3">
                                            <div class="symbol-label">
                                                <img src="'.$row->image.'" class="w-100" />
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <a class="text-gray-800 text-hover-primary mb-1">'.$row->namapasien.'</a>
                                            <span>'.$row->norm.'</span>
                                        </div>
                                    </div>';

                    return $imageP;
                })
                ->addColumn('born', function($row) {
                    return Carbon::createFromFormat('Y-m-d', $row->tgllahir)->format('d/m/Y');
                })
                ->addColumn('gender', function($row) {
                    return $row->gender;
                })
                ->addColumn('action', function($row){

                    $actionBtn = '<button type="button" id="registrasi" title="Input Kunjungan" 
                            data-id="'.$row->id.'" class="btn btn-sm btn-light-success me-2" 
                            style="padding: 5px 7px 5px 10px">
                                <i class="far fa-paper-plane fs-8"></i>
                            </button>';

                    $actionBtn .= '<button type="button" id="editData" title="Edit Data" 
                                data-id="'.$row->id.'" data-nama="'.$row->namapasien.'" 
                                data-tempatlahir="'.$row->tempatlahir.'" data-tgllahir="'.$row->tgllahir.'"  
                                data-jeniskelamin="'.$row->jeniskelamin.'" data-alamat="'.$row->alamat.'" 
                                data-nohp="'.$row->nohp.'" data-golongandarah="'.$row->golongandarah.'"  
                                    class="btn btn-sm btn-light-warning me-2" style="padding: 5px 7px 5px 10px">
                                    <i class="fas fa-pen-nib fs-8"></i>
                                </button>';
                                
                    $actionBtn .= '<button type="button" id="hapusData" title="Hapus Data" 
                            data-id="'.$row->id.'" class="btn btn-sm btn-light-danger" 
                            style="padding: 5px 7px 5px 10px">
                                <i class="fas fa-trash fs-8"></i>
                            </button>';
                    
                    
                    return $actionBtn;
                })
                
                ->rawColumns(['pasien', 'born', 'gender', 'action'])
                ->make(true);
    }

    public function save(Request $request)
    {

        DB::beginTransaction();

        try {

            if($request['id'] != '') {
                $PS = Pasien::find($request['id']);
            } else {
                $PS                       = new Pasien();
                $PS->statusenabled        = true;
                $perfix = 'PS';
                $PS->norm               = $this->GENERATE_KODE('norm', 6, $perfix);
            }
            
            $PS->namapasien         = $request['nama'];
            $PS->tempatlahir        = $request['tempatlahir'];
            $PS->tgllahir           = $request['tgllahir'];
            $PS->jeniskelamin       = $request['jk'];
            $PS->alamat             = $request['alamat'];
            $PS->nohp               = $request['nohp'];
            $PS->golongandarah      = $request['goldar'];

            $PS->save();

            if($request['id'] == '') {
                $perfix2 = 'KP'.date('ym', strtotime($request['tglkunjungan']));
                $DATA_K                     = new Kunjungan();
                $DATA_K->nokunjungan        = $this->GENERATE_KODE('nokunjungan', 12, $perfix2);
                $DATA_K->pasien_id          = $PS->id;
                $DATA_K->user_id            = $request['dokter'];
                $DATA_K->tglkunjungan       = $request['tglkunjungan'];
                $DATA_K->status             = 1;
                $DATA_K->statusenabled      = true;
                $DATA_K->save();
            }


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
        $cek = Kunjungan::where('pasien_id', $id)
                        ->where('statusenabled', true)
                        ->where('status', '!=', 1)
                        ->get();

        if(count($cek) >= 1) {
            return response()->json([
                'message'    => 'Gagal hapus, pasien ini mempunyai pemeriksaan pada kunjungannya !',
                "status"     => false,
            ]);
        }

        DB::beginTransaction();

        try {
            
            Pasien::where('id', $id)->update(['statusenabled' => false]);
            
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
