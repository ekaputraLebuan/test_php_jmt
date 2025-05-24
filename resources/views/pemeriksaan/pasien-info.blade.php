<div class="card mb-5 mb-xl-8">
    <div class="card-body pt-15">
        <div class="d-flex flex-center flex-column mb-5">
            <div class="symbol symbol-100px symbol-circle mb-7">
                <img src="{{ $data->pasien->image }}" alt="image" />
            </div>
            <a class="fs-5 text-gray-800 text-hover-primary fw-bolder mb-1">{{ $data->pasien->namapasien }}</a>
            <div class="fs-6 fw-bold text-muted mb-6">{{ $data->nokunjungan }}</div>
        </div>
       
    </div>
</div>