
const url = window.location.pathname
let dataUrl = url.split('/')
let id = null
if(dataUrl.length == 3) {
    id = dataUrl[2]
}


let detail = []
refreshData()
clearFrom()


function clearFrom() {
    $('#no').val(null)
    $('#obat').val(null).trigger("change");
    $('#ap').val(null)
    $('#ket').val(null)
}

function editData(e) {
    let dataget = detail.filter((x) => x.no == e)[0]
    $('#no').val(e)
    $('#obat').val(dataget.obatid).trigger("change");
    $('#ap').val(dataget.aturanpakai)
    $('#ket').val(dataget.keterangan)
}

function hapusData(e) {
    Swal.fire({
        title: 'Hapus Data !',
        text: "Yakin akan menghapus detail barang masuk untuk obat ini ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Batal!',
        confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
        if(result.value) {
            detail.forEach((elm, i) => {
                if(elm.no == e) {
                    detail.splice(i, 1);
                }
            })
            refreshData()
        }
    });
    
}


$("#btnCancel").click(() => {
    clearFrom()
})


$("#btnAdd").click(() => {
    
    if(!$('#obat').val()) {
        toastr.error("Harap pilih obat !");
        return;
    }
    
    if(!$('#ap').val().trim()) {
        toastr.error("Harap input aturan pakai !");
        return;
    }

    if(!$('#ket').val().trim()) {
        toastr.error("Harap input keterangan pakai !");
        return;
    }

    

    let cek = []
    if($('#no').val()) {
        cek = detail.filter((x) => x.no == $('#no').val())
    } else {
        let cek3 = detail.filter((x) => x.obatid == $('#obat').val())

        if(cek3.length >= 1) {
            toastr.error("Obat ini sudah ada ditambahkan, harap input untuk mengubah data !");
            return;
        }
    }

    
    
    if(cek.length >= 1) {
        let cek2 = detail.filter((x) => x.obatid == $('#obat').val() && x.no != $('#no').val())
        if(cek2.length >= 1) {
            toastr.error("Obat ini sudah ada ditambahkan, harap input untuk mengubah data !");
            return;
        }
        cek[0].obatid = $('#obat').val()
        cek[0].namaobat = $('#obat option:selected')[0].innerHTML
        cek[0].aturanpakai = $('#ap').val()
        cek[0].keterangan = $('#ket').val()
    } else {
        let newData = {
            obatid: $('#obat').val(),
            namaobat: $('#obat option:selected')[0].innerHTML,
            aturanpakai: $('#ap').val(),
            keterangan: $('#ket').val(),
        }
        detail.push(newData)
    }

    refreshData()
    clearFrom()
})

function refreshData() {
    subTotal = 0
    detail.forEach((elm, i) => {
        elm.no = i + 1
        elm.action = '<button type="button" onclick="editData('+elm.no+')" id="editData" title="Edit Data" class="btn btn-sm btn-light-warning me-2"><i class="fas fa-pen-nib"></i></button>' +
                    '<button type="button" onclick="hapusData('+elm.no+')" id="hapusData" title="Edit Data" class="btn btn-sm btn-light-danger"><i class="fas fa-trash"></i></button>';
                
        subTotal += parseFloat(elm.total)
    })

    $('#tableData').DataTable({
        processing: false,
        serverSide: false,
        destroy: true,
        data: detail,
        columns: [
            {data: 'no', name: 'no', class: 'text-center'},
            {data: 'namaobat', name: 'namaobat'},
            {data: 'aturanpakai', name: 'aturanpakai'},
            {data: 'keterangan', name: 'keterangan'},
            {
                data: 'action', 
                name: 'action', 
                class: 'text-center',
                orderable: false, 
                searchable: false
            },
        ]
    })
}

$("#btnSave").click(async () => {


    if(detail.length <= 0) {
        toastr.error("Harap input detail resep !");
        return;
    }

    $('#btnSave')[0].disabled = true;
    $('#btnAdd')[0].disabled = true;
    $('#btnCancel')[0].disabled = true;

    const buttons = document.querySelectorAll('#editData');
    const buttons2 = document.querySelectorAll('#hapusData');

    buttons.forEach(button => {
        button.disabled = true;
    });

    buttons2.forEach(button => {
        button.disabled = true;
    });
    console.log(detail)
    let dtSave = {
        id: id,
        detail: detail
    }

    await $.ajax({
        method: 'POST', 
        url: '/save-resep-obat', 
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
                window.location.href = "/detail-kunjungan/" + id;
            } else {
                $('#btnSave')[0].disabled = false;
                $('#btnAdd')[0].disabled = false;
                $('#btnCancel')[0].disabled = false;
                buttons.forEach(button => {
                    button.disabled = true;
                });
                buttons2.forEach(button => {
                    button.disabled = true;
                });
                toastr.error(ress.message);
            }
            
        }, error: function(err){
            $('#btnSave')[0].disabled = false;
            $('#btnAdd')[0].disabled = false;
            $('#btnCancel')[0].disabled = false;
            buttons.forEach(button => {
                button.disabled = true;
            });
            buttons2.forEach(button => {
                button.disabled = true;
            });
            console.log(err);
            toastr.error(err.responseJSON.message);
        }
    });
})
