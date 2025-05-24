@if(session()->has("success"))
    <script>toastr.success("{{ session()->get("success") }}");</script>
@endif

@if(session()->has("danger"))
    <script>
        toastr.error("{{ session()->get("danger") }}");
    </script>
@endif

@if(session()->has("errors"))
    @foreach ($errors->all() as $error)
        <script>
            toastr.error("{{ $error }}");
        </script>
    @endforeach
@endif

<script>
    $.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

</script>

@if ($name == 'Pasien')
    <script src="{{ asset('template/js/apps/pasien.js') }}"></script>
@elseif ($name == 'Kunjungan')
    <script src="{{ asset('template/js/apps/kunjungan.js') }}"></script>
@elseif ($name == 'Obat')
    <script src="{{ asset('template/js/apps/obat.js') }}"></script>
@elseif ($name == 'Resep')
    <script src="{{ asset('template/js/apps/resep.js') }}"></script>
@endif