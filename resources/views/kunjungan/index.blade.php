@extends("layout")

@section('content')

<div class="card">
    <div class="card-body pt-5 mt-6">
        <div class="row mb-5">
            <div class="col-md-3 mb-3">
                <label for="periode" class="form-label fs-7">Periode</label>
                <input id="periode" class="form-control form-control-sm form-control-solid" placeholder="Pilih periode" />
            </div>
            <div class="col-md-5">
                <label for="search" class="form-label fs-7">Pasien</label>
                <input type="text" id="search" class="form-control form-control-sm form-control-solid me-2" 
                placeholder="Nama pasien, no rekam medis, no kunjungan ..." 
                autocomplete="off"/>
            </div>
            <div class="col-md-1 mt-3">
                <button class="btn btn-sm btn-success mt-5" id="btnSearch">
                    <i class="bi bi-search"></i>
                </button>
            </div>
            @can('pendaftaran')
                <div class="col-11 col-md-3 mt-3">
                    <button class="btn btn-sm btn-primary mt-5 ml-5" id="btnAdd">
                        <i class="bi bi-clipboard-plus"></i> Kunjungan Baru
                    </button>
                </div>
            @endcan
            
        </div>

        <table id="tableData" class="table table-row-bordered gy-5" >
            <thead>
                <tr class="fw-bold fs-7 text-muted">
                    <th class="text-center" width="50px">No</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Pasien</th>
                    <th class="text-center">No Kunjungan</th>
                    <th class="text-center">Dokter</th>
                    <th class="text-center" width="150px">Action</th>
                    
                </tr>
            </thead>
            
        </table>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="modalForm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"></h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
            </div>

            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12 mb-5">
                        <input type="hidden" name="id" id="id" class="form-control mb-2"  autocomplete="off"/>
                        <label for="pasien" class="required form-label fs-7">Pasien</label>
                        <select id="pasien" class="form-select form-select-sm form-select-solid" data-control="select2" 
                            data-placeholder="Pilih pasien" data-dropdown-parent="#modalForm" data-allow-clear="true">
                            @foreach($pasien as $pasien)
                                <option value="{{ $pasien->id }}">{{ $pasien->namapasien }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-5">
                        <label for="tglkunjungan" class="required form-label fs-7">Tgl Kunjungan</label>
                        <input id="tglkunjungan" type="datetime-local" class="form-control form-control-sm form-control-solid" 
                        placeholder="Tgl Kunjungan" autocomplete="off"/>
                    </div>

                    <div class="col-md-6 mb-5">
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


@endsection