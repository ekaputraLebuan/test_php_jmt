let now = moment(new Date())
let day1 = moment(new Date()).format('01/MM/YYYY')

let data2 = []

$("#periode").daterangepicker({
    "locale": {
        "format": "DD/MM/YYYY",
        "separator": " - "
    },
     "startDate": now,
    "endDate": now
});

findData()

async function findData() { 

    if(!$("#periode").val()) {
        toastr.error("Harap pilih periode !");
        return;
    }
    
    let pr1= $('#periode').data('daterangepicker').startDate;
    let pr2= $('#periode').data('daterangepicker').endDate;

    if(!pr1 || !pr2) {
        toastr.error("Harap input tanggal periode dengan benar !");
        return;
    }
    
    let date1 = moment(new Date(pr1)).format('YYYY-MM-DD 00:00:00')
    let date2 = moment(new Date(pr2)).format('YYYY-MM-DD 23:59:59')
    
    

    let tgl1 = 'tglAwal=' + date1
    let tgl2 = '&tglAkhir=' + date2
    

    let cari = ''
    if($("#search").val().trim()) {
        cari = '&search=' + $("#search").val()
    }
    
    await $('#tableData').DataTable({
        processing: false,
        serverSide: false,
        destroy: true,
        ajax: ({
            url : "/data-kunjungan-pasien?" + tgl1 + tgl2 + cari 
        }),
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center'},
            {data: 'tgl', name: 'tgl'},
            {data: 'pasiendata', name: 'pasiendata'},
            {data: 'nokunjungan', name: 'nokunjungan',},
            {data: 'user.nama', name: 'user'},
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

$(document).on("click", "#editData", function() {
    
    $('#modalTitle')[0].innerHTML = 'Edit Data Kunjungan'
    $('#btnSave').hide();
    $('#btnUpdate').show();

    let id = $(this).attr("data-id");
    let tgl = $(this).attr("data-tgl");
    let pasien = $(this).attr("data-pasien");
    let dokter = $(this).attr("data-dokter");

    $('#id').val(id);
    $('#pasien').val(pasien).trigger("change");
    $('#tglkunjungan').val(tgl);
    $('#dokter').val(dokter).trigger("change");
    
    $('#modalForm').modal('show');
});

$("#btnAdd").click(() => {
    $('#modalTitle')[0].innerHTML = 'Tambah Data Kunjungan'
    $('#id').val('');
    $('#pasien').val(null).trigger("change");
    $('#tglkunjungan').val(null);
    $('#dokter').val(null).trigger("change");
    $('#btnSave').show();
    $('#btnUpdate').hide();
    $('#modalForm').modal('show');
});

$("#btnSearch").click(async () => {
    findData()
})

$('#btnSave').click(() => {
    saveData()
})

$('#btnUpdate').click(() => {
    saveData()
})

async function saveData() {

    if(!$('#pasien').val()) {
        toastr.error("Pasien harus diisi !");
        return;
    }

    if(!$('#tglkunjungan').val().trim()) {
        toastr.error("Tgl kunjungan harus diisi !");
        return;
    }

    if(!$('#dokter').val()) {
        toastr.error("Dokter harus diisi !");
        return;
    }

    let dtSave = {
        id: $('#id').val(), 
        idpasien : $('#pasien').val(), 
        tglkunjungan : moment(new Date($('#tglkunjungan').val())).format('YYYY-MM-DD HH:mm:ss'),
        dokter : $('#dokter').val(),
    }

    
    $('#btnSave')[0].disabled = true;
    $('#btnUpdate')[0].disabled = true;
    $('#btnClose')[0].disabled = true;

    await $.ajax({
        method: "POST", 
        url: '/save-data-kunjungan', 
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
                url : "/hapus-data-kunjungan/" + id ,
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
