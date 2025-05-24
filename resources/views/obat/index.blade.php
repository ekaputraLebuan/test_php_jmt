@extends("layout")

@section('content')

<div class="card">
    <div class="card-body pt-5 mt-6">
        <div class="row mb-5">
            <div class="col-3">
                <button class="btn btn-sm btn-primary" id="btnAdd">
                    <i class="bi bi-node-plus"></i> Tambah Data
                </button>
            </div>
        </div>

        <table id="tableData" class="table table-row-bordered gy-5" >
            <thead>
                <tr class="fw-bold fs-7 text-muted">
                    <th class="text-center" width="50px">No</th>
                    <th class="text-center">Nama Obat</th>
                    <th class="text-center">Status</th>
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
                    <div class="mb-5">
                        <label for="nama" class="required form-label fs-7">Nama Pasien</label>
                        <input id="nama" type="text" class="form-control form-control-sm form-control-solid" 
                            placeholder="Input nama obat" autocomplete="off"/>
                        <input type="hidden" name="id" id="id" class="form-control mb-2"  autocomplete="off"/>
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