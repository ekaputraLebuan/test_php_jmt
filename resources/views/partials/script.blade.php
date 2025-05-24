<script>var hostUrl = "{{ asset('template/') }}";</script>
<script src="{{ asset('template/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('template/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('template/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('template/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
<script src="{{ asset('template/plugins/custom/tinymce/tinymce.bundle.js') }}"></script>
<script>
    tinymce.init({
        selector: ".tinymce",
        menubar: false,
            toolbar: ["styleselect fontselect fontsizeselect",
            "undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify",
            "bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code"],
        plugins : "advlist autolink link image lists charmap print preview code",
        image_title: true,
        automatic_uploads: true,
        file_picker_types: 'image',
        file_picker_callback: function (cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');

        input.onchange = function () {
        var file = this.files[0];

        var reader = new FileReader();
        reader.onload = function () {
            
            var id = 'blobid' + (new Date()).getTime();
            var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
            var base64 = reader.result.split(',')[1];
            var blobInfo = blobCache.create(id, file, base64);
            blobCache.add(blobInfo);

            cb(blobInfo.blobUri(), { title: file.name });
        };
        reader.readAsDataURL(file);
        };

        input.click();
    },
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });
    $("#kt_datatable_vertical_scroll").DataTable({
        "scrollY": "500px",
        "scrollCollapse": true,
        "paging": false,
        "dom": "<'table-responsive'tr>"
    });

    $("#kt_datatable_dom_positioning").DataTable({
        "ordering": false,
        "language": {
            "lengthMenu": "Show _MENU_",
        },
        "dom":
            "<'row mb-2'" +
            "<'col-sm-6 d-flex align-items-center justify-conten-start dt-toolbar'l>" +
            "<'col-sm-6 d-flex align-items-center justify-content-end dt-toolbar'f>" +
            ">" +

            "<'table-responsive'tr>" +

            "<'row'" +
            "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
            "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
            ">"
    });

    $("#kt_datatable_zero_configuration").DataTable();

    $("#timepicker").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i:ss",
    });

    $("#timepicker2").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i:ss",
    });
    
</script>
