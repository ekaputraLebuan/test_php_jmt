@extends("layout")

@section('content')

<div class="card">
    <div class="card-body pt-5 mt-6">
        <div class="row mb-5">
            <div class="col-8">
                <input type="text" id="search" class="form-control form-control-sm form-control-solid me-2" 
                placeholder="Nama pasien, nomor rekam medis ..." 
                autocomplete="off"/>
            </div>
            <div class="col-1">
                <button class="btn btn-sm btn-success" id="btnSearch">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <div class="col-3">
                <button class="btn btn-sm btn-primary" id="btnAdd">
                    <i class="bi bi-person-plus"></i> Pasien Baru
                </button>
            </div>
        </div>

        <table id="tableData" class="table table-row-bordered gy-5" >
            <thead>
                <tr class="fw-bold fs-7 text-muted">
                    <th class="text-center" width="50px">No</th>
                    <th class="text-center">Pasien</th>
                    <th class="text-center">Tgl Lahir</th>
                    <th class="text-center">Jk</th>
                    <th class="text-center">No. HP</th>
                    <th class="text-center" width="150px">Action</th>
                    
                </tr>
            </thead>
            
        </table>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="modalForm">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"></h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>

            <div class="modal-body">

                <div class="row">
                    <div class="col-md-5 mb-5">
                        <label for="nama" class="required form-label fs-7">Nama Pasien</label>
                        <input id="nama" type="text" class="form-control form-control-sm form-control-solid" 
                            placeholder="Input nama pasien" autocomplete="off"/>
                        <input type="hidden" name="id" id="id" class="form-control mb-2"  autocomplete="off"/>
                    </div>
                    <div class="col-md-4 mb-5">
                        <label for="tempatlahir" class="required form-label fs-7">Tempat Lahir</label>
                        <input id="tempatlahir" type="text" class="form-control form-control-sm form-control-solid" 
                        placeholder="Tempat lahir" autocomplete="off"/>
                    </div>
                    <div class="col-md-3 mb-5">
                        <label for="tgllahir" class="required form-label fs-7">Tgl Lahir</label>
                        <input id="tgllahir" type="date" class="form-control form-control-sm form-control-solid" 
                        placeholder="Tgl lahir" autocomplete="off" />
                    </div>

                    <div class="col-md-4 mb-5">
                        <label for="jk" class="required form-label fs-7">Jenis Kelamin</label>
                        <select id="jk" class="form-select form-select-sm form-select-solid" data-control="select2" 
                            data-placeholder="Pilih jenis kelamin" data-dropdown-parent="#modalForm" data-allow-clear="true">
                             <option value="Laki-Laki">Laki-Laki</option>
                             <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-5">
                        <label for="goldar" class="required form-label fs-7">Gol. Darah</label>
                        <select id="goldar" class="form-select form-select-sm form-select-solid" data-control="select2" 
                            data-placeholder="Golongan Darah" data-dropdown-parent="#modalForm" data-allow-clear="true">
                             <option value="A">A</option>
                             <option value="B">B</option>
                             <option value="AB">AB</option>
                             <option value="O">O</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-5">
                        <label for="nohp" class="required form-label fs-7">No. HP</label>
                        <input id="nohp" type="text" class="form-control form-control-sm form-control-solid" 
                        placeholder="No. Handphone" autocomplete="off"/>
                    </div>

                    <div class="col-md-12 mb-5">
                        <label for="alamat" class="required form-label fs-7">Alamat</label>
                        <input id="alamat" type="text" class="form-control form-control-sm form-control-solid" 
                        placeholder="Alamat tinggal" autocomplete="off"/>
                    </div>

                    <div class="col-md-6 mb-5" id="fieldTK">
                        <label for="tglkunjungan" class="required form-label fs-7">Tgl Kunjungan</label>
                        <input id="tglkunjungan" type="datetime-local" class="form-control form-control-sm form-control-solid" 
                        placeholder="Tgl Kunjungan" autocomplete="off"/>
                    </div>

                    <div class="col-md-6 mb-5" id="fieldDR">
                        <label for="dokter" class="required form-label fs-7">Dokter</label>
                        <select id="dokter" class="form-select form-select-sm form-select-solid" data-control="select2" 
                            data-placeholder="Pilih dokter" data-dropdown-parent="#modalForm" data-allow-clear="true">
                            @foreach($dokter as $dokter)
                                <option value="{{ $dokter->id }}">{{ $dokter->nama }}</option>
                            @endforeach
                        </select>
                    </div>


                </div>
                
            </div>

            <div class="modal-footer">
                <button id="btnClose" type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Batal</button>
                <button id="btnSave" type="button" class="btn btn-sm btn-primary">Simpan</button>
                <button id="btnUpdate" type="button" class="btn btn-sm btn-warning">Update</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="modalKunjungan">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Input Kunjungan Pasien</h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>

            <div class="modal-body">

                    <div class="mb-5">
                        <label for="k_tglkunjungan" class="required form-label fs-7">Tgl Kunjungan</label>
                        <input id="k_tglkunjungan" type="datetime-local" class="form-control form-control-sm form-control-solid" 
                        placeholder="Tgl Kunjungan" autocomplete="off"/>
                    </div>

                    <div class="mb-5">
                        <label for="k_dokter" class="required form-label fs-7">Dokter</label>
                        <select id="k_dokter" class="form-select form-select-sm form-select-solid" data-control="select2" 
                            data-placeholder="Pilih dokter" data-dropdown-parent="#modalKunjungan" data-allow-clear="true">
                            @foreach($dokter2 as $dokter2)
                                <option value="{{ $dokter2->id }}">{{ $dokter2->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                
            </div>

            <div class="modal-footer">
                <button id="btnClose2" type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Batal</button>
                <button id="btnSave2" type="button" class="btn btn-sm btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection