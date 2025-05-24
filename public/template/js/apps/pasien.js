
findData()
let edit = false

$("#btnSearch").click(async () => {
    findData()
})
let psidset = null

$("#btnAdd").click(() => {
    clearForm()
    $('#modalTitle')[0].innerHTML = 'Tambah Data Pasien'
    $('#fieldTK').show();
    $('#fieldDR').show();
    $('#btnSave').show();
    $('#btnUpdate').hide();
    $('#modalForm').modal('show');
});

$(document).on("click", "#registrasi", function() {
    psidset = $(this).attr("data-id");
    $('#k_tglkunjungan').val(null);
    $('#k_dokter').val(null).trigger("change");
    $('#modalKunjungan').modal('show');
})

$(document).on("click", "#editData", function() {
    clearForm()
    edit = true
    $('#modalTitle')[0].innerHTML = 'Edit Data Pasien'
    $('#btnSave').hide();
    $('#btnUpdate').show();
    $('#fieldTK').hide();
    $('#fieldDR').hide();

    let id = $(this).attr("data-id");
    let nama = $(this).attr("data-nama");
    let tempatlahir = $(this).attr("data-tempatlahir");
    let tgllahir = $(this).attr("data-tgllahir");
    let jeniskelamin = $(this).attr("data-jeniskelamin");
    let alamat = $(this).attr("data-alamat");
    let nohp = $(this).attr("data-nohp");
    let golongandarah = $(this).attr("data-golongandarah");

    $('#id').val(id);
    $('#nama').val(nama);
    $('#tempatlahir').val(tempatlahir);
    $('#tgllahir').val(tgllahir);
    $('#jk').val(jeniskelamin).trigger("change");
    $('#goldar').val(golongandarah).trigger("change");
    $('#alamat').val(alamat);
    $('#nohp').val(nohp);
    
    $('#modalForm').modal('show');
});

function clearForm() {
    edit = false
    $('#id').val('');
    $('#nama').val(null);
    $('#tempatlahir').val(null);
    $('#tgllahir').val(null);
    $('#jk').val(null).trigger("change");
    $('#goldar').val(null).trigger("change");
    $('#nohp').val(null);
    $('#alamat').val(null);
    $('#tglkunjungan').val(null);
    $('#dokter').val(null).trigger("change");
    $('#fieldTK').hide();
    $('#fieldDR').hide();
}

async function findData() { 

    let cari = ''
    if($("#search").val().trim()) {
        cari = 'search=' + $("#search").val()
    }
    
    await $('#tableData').DataTable({
        processing: false,
        serverSide: false,
        destroy: true,
        ajax: ({
            url : "/data-pasien?" + cari
        }),
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center'},
            {data: 'pasien', name: 'pasien'},
            {data: 'born', name: 'born'},
            {data: 'gender', name: 'gender', class: 'text-center'},
            {data: 'nohp', name: 'nohp'},
            {
                data: 'action', 
                name: 'action', 
                class: 'text-center',
                orderable: false, 
                searchable: false
            },
        ]
    });
}

$('#btnSave').click(() => {
    saveData()
})

$('#btnUpdate').click(() => {
    saveData()
})

async function saveData() {

    if(!$('#nama').val().trim()) {
        toastr.error("Nama pasien harus diisi !");
        return;
    }

    if(!$('#tempatlahir').val().trim()) {
        toastr.error("Tempat lahir harus diisi !");
        return;
    }

    if(!$('#tgllahir').val().trim()) {
        toastr.error("Tanggal lahir harus diisi !");
        return;
    }

    if(!$('#jk').val()) {
        toastr.error("Jenis kelamin harus diisi !");
        return;
    }

    if(!$('#goldar').val()) {
        toastr.error("Golongan darah harus diisi !");
        return;
    }

    if(!$('#nohp').val().trim()) {
        toastr.error("No HP harus diisi !");
        return;
    }

    if(!$('#alamat').val().trim()) {
        toastr.error("Alamat pasien harus diisi !");
        return;
    }

    
    if(!edit) {
        if(!$('#tglkunjungan').val().trim()) {
            toastr.error("Tgl kunjungan harus diisi !");
            return;
        }

        if(!$('#dokter').val()) {
            toastr.error("Dokter harus diisi !");
            return;
        }
    }

    let dtSave = {
        id: $('#id').val(), 
        nama : $('#nama').val(), 
        tempatlahir : $('#tempatlahir').val(),
        tgllahir : moment(new Date($('#tgllahir').val())).format('YYYY-MM-DD'),
        jk : $('#jk').val(),
        goldar : $('#goldar').val(),
        nohp : $('#nohp').val(), 
        alamat : $('#alamat').val(),
        tglkunjungan : moment(new Date($('#tglkunjungan').val())).format('YYYY-MM-DD HH:mm:ss'),
        dokter : $('#dokter').val(),
    }

    
    $('#btnSave')[0].disabled = true;
    $('#btnUpdate')[0].disabled = true;
    $('#btnClose')[0].disabled = true;

    await $.ajax({
        method: "POST", 
        url: '/save-data-pasien', 
        data: dtSave,
        dataType: "json",
        beforeSend: function(e) {
            if(e && e.overrideMimeType) {
                e.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        success: function(ress) {
            if(ress.status == true) {
                toastr.success(ress.message);
                $('#btnSave')[0].disabled = false;
                $('#btnUpdate')[0].disabled = false;
                $('#btnClose')[0].disabled = false;
                $('#modalForm').modal('hide');
                findData()
            } else {
                $('#btnSave')[0].disabled = false;
                $('#btnUpdate')[0].disabled = false;
                $('#btnClose')[0].disabled = false;
                toastr.error(ress.message);
            }
            
        }, error: function(err){
            $('#btnSave')[0].disabled = false;
            $('#btnUpdate')[0].disabled = false;
            $('#btnClose')[0].disabled = false;
            console.log(err);
            toastr.error(err.responseJSON.message);
        }
    });
}

$(document).on("click", "#hapusData", function() {
    let id = $(this).attr("data-id");
    
    Swal.fire({
        title: 'Hapus Data !',
        text: "Yakin akan menghapus data ini ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Batal!',
        confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
        if(result.value) {
            $.ajax({
                method: "DELETE", 
                url : "/hapus-data-pasien/" + id ,
                data: {status : false},
                dataType: "json",
                beforeSend: function(e) {
                    if(e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(ress) {
                    if(ress.status == true) {
                        toastr.success(ress.message);
                        findData()
                    } else {
                        toastr.error(ress.message);
                    }
                    
                }, error: function(err){
                    console.log(err);
                    toastr.error(err);
                }
            });
        }
    });

})

$('#btnSave2').click(async() => {
    if(!$('#k_tglkunjungan').val().trim()) {
        toastr.error("Tgl kunjungan harus diisi !");
        return;
    }

    if(!$('#k_dokter').val()) {
        toastr.error("Dokter harus diisi !");
        return;
    }

    let dtSave2 = {
        id: '',
        idpasien: psidset,
        dokter: $('#k_dokter').val(),
        tglkunjungan: moment(new Date($('#k_tglkunjungan').val())).format('YYYY-MM-DD HH:mm:ss')
    }

    $('#btnSave2')[0].disabled = true;
    $('#btnClose2')[0].disabled = true;

    await $.ajax({
        method: "POST", 
        url: '/save-data-kunjungan', 
        data: dtSave2,
        dataType: "json",
        beforeSend: function(e) {
            if(e && e.overrideMimeType) {
                e.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        success: function(ress) {
            if(ress.status == true) {
                toastr.success(ress.message);
                $('#btnSave2')[0].disabled = false;
                $('#btnClose2')[0].disabled = false;
                psidset = null
                $('#modalKunjungan').modal('hide');
            } else {
                $('#btnSave2')[0].disabled = false;
                $('#btnClose2')[0].disabled = false;
                toastr.error(ress.message);
            }
            
        }, error: function(err){
            $('#btnSave2')[0].disabled = false;
            $('#btnClose2')[0].disabled = false;
            console.log(err);
            toastr.error(err.responseJSON.message);
        }
    });
})