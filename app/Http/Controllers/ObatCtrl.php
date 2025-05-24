<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Obat;
use Yajra\DataTables\DataTables;

class ObatCtrl extends Controller
{
    public function page()
    {
        return collect([
            "name" => "Obat",
            "icon" => "bi bi-patient",
        ]);
    }

    public function index() 
    {
        $name = $this->page()["name"];
        $slug = Str::slug($this->page()["name"]);
        $icon = $this->page()["icon"];
        $title  = "Data Obat";
        $pageTitle  = "Data Obat";
        $pageSubTitle  = "List Data Obat";

        return view("$slug.index", [
            "name" => $name,
            "slug" => $slug,
            "icon" => $icon,
            "title" => $title,
            "pageTitle" => $pageTitle,
            "pageSubTitle" => $pageSubTitle,
        ]);
    }

    public function data(Request $request) 
    {
        $data = Obat::orderBy('namaobat')->get();

        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function($row) {
                    return $row->status;
                })
                ->addColumn('action', function($row){


                    $actionBtn = '<button type="button" id="editData" title="Edit Data" 
                                data-id="'.$row->id.'" data-nama="'.$row->namaobat.'" 
                                    class="btn btn-sm btn-light-warning me-2" style="padding: 5px 7px 5px 10px">
                                    <i class="fas fa-pen-nib fs-8"></i>
                                </button>';
                    if($row->statusenabled == true) {
                        $actionBtn .= '<button type="button" id="disableData" title="Disabled Data" 
                                data-id="'.$row->id.'" class="btn btn-sm btn-light-danger" 
                                style="padding: 5px 7px 5px 10px">
                                    <i class="far fa-eye-slash fs-8"></i>
                                </button>';
                    } else {
                        $actionBtn .= '<button type="button" id="enableData" title="Enable Data" 
                                data-id="'.$row->id.'" class="btn btn-sm btn-light-success" 
                                style="padding: 5px 7px 5px 10px">
                                    <i class="far fa-eye fs-8"></i>
                                </button>';
                    }
                    
                    
                    return $actionBtn;
                })
                
                ->rawColumns(['action', 'status'])
                ->make(true);
    }

    function save(Request $request)
    {
        $cek = null;
        if($request['id'] != '') {
            $cek = Obat::where("namaobat", $request->nama)
                ->where("id", '!=', $request['id'])
                ->first();
        } else {
            $cek = Obat::where("namaobat", $request->nama)->first();
        }
        
        
        if ($cek) {
            return response()->json([
                'message'    => 'Data kategori produk dengan nama obat ini sudah pernah diinput sebelumnya !!',
                "status"     => false,
            ]);
        }
        DB::beginTransaction();

        try {

            if($request['id'] != '') {
                $data = Obat::find($request['id']);
            } else {
                $data                       = new Obat();
                $data->statusenabled        = true;
            }
            
            $data->namaobat       = $request['nama'];
            $data->save();

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

    function updateStatus(Request $request, $id) 
    {
        DB::beginTransaction();

        try {
            
            Obat::where('id', $id)->update(['statusenabled' => $request['status']]);
            $pesan = '';
            if($request['status'] == true) {
                $pesan = 'Disable ';
            } else {
                $pesan = 'Enable ';
            }
            DB::commit();
            $status = true;
            $transMessage = $pesan . " data berhasil !";
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
            $transMessage = $pesan . " data gagal !";
            $status = false;
        }


        return response()->json([
            'message'   => $transMessage,
            "status"    => $status,
        ]);
    }
}
