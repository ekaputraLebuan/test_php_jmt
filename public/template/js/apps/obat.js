
findData()
let edit = false

$("#btnSearch").click(async () => {
    findData()
})
let psidset = null

$("#btnAdd").click(() => {
    $('#modalTitle')[0].innerHTML = 'Tambah Data Obat'
    $('#id').val('');
    $('#nama').val(null);
    $('#btnSave').show();
    $('#btnUpdate').hide();
    $('#modalForm').modal('show');
});


$(document).on("click", "#editData", function() {
    
    $('#modalTitle')[0].innerHTML = 'Edit Data Obat'
    $('#btnSave').hide();
    $('#btnUpdate').show();

    let id = $(this).attr("data-id");
    let nama = $(this).attr("data-nama");

    $('#id').val(id);
    $('#nama').val(nama);
    $('#modalForm').modal('show');
});


async function findData() { 

    await $('#tableData').DataTable({
        language: {
            "lengthMenu": "Show _MENU_",
        },
        dom:
        "<'row'" +
        "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
        "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
        ">" +

        "<'table-responsive'tr>" +

        "<'row'" +
        "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
        "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
        ">",
        processing: false,
        serverSide: false,
        destroy: true,
        ajax: ({
            url : "/data-obat"
        }),
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center'},
            {data: 'namaobat', name: 'namaobat'},
            {data: 'status', name: 'status', class: 'text-center'},
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

    

    let dtSave = {
        id: $('#id').val(), 
        nama : $('#nama').val(), 
    }

    
    $('#btnSave')[0].disabled = true;
    $('#btnUpdate')[0].disabled = true;
    $('#btnClose')[0].disabled = true;

    await $.ajax({
        method: "POST", 
        url: '/save-data-obat', 
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

$(document).on("click", "#disableData", function() {
    let id = $(this).attr("data-id");
    
    Swal.fire({
        title: 'Hapus Data !',
        text: "Yakin akan disable data ini ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Batal!',
        confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
        if(result.value) {
            $.ajax({
                method: "PUT", 
                url : "/update-status-obat/" + id ,
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

$(document).on("click", "#enableData", function() {
    let id = $(this).attr("data-id");
    
    Swal.fire({
        title: 'Enable Data !',
        text: "Yakin akan enable data ini ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Batal!',
        confirmButtonText: 'Ya, Enable!'
    }).then((result) => {
        if(result.value) {
            $.ajax({
                method: "PUT", 
                url : "/update-status-obat/" + id ,
                data: {status : true},
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