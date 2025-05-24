@extends("layout")

@section('content')

<div class="d-flex flex-column flex-xl-row">
    <div class="flex-column flex-lg-row-auto w-100 w-xl-300px mb-10">
        @include("pemeriksaan.pasien-info")
    </div>

    <div class="flex-lg-row-fluid ms-lg-15">
        <div class="tab-content">
            <form  method="post" action="/save-pemeriksaan-medis/{{ $data->id }}">
                @csrf
                <div class="card pt-4 mb-6 mb-xl-9">
                    <div class="card-header border-0">
                        
                        <div class="card-title">
                            
                        </div>
                        
                        <div class="card-toolbar">
                            <button type="submit" class="btn btn-sm btn-flex btn-light-primary">
                            <i class="las la-save"></i>
                                Simpan
                            </button>
                        </div>
                    </div>
                    <div class="card-body pt-0 pb-5">
                        <div class="row">

                            <div class="col-12 mb-5">
                                <label for="keluhanutama" class="form-label required fs-7">Keluhan Utama</label>
                                <textarea id="keluhanutama" type="text" name="keluhanutama" 
                                class="form-control form-control-sm form-control-solid @error('keluhanutama') is-invalid @enderror" data-kt-autosize="true">
                                    {{ old('keluhanutama') }}
                                </textarea>
                                @error('keluhanutama')
                                    <div class="fv-plugins-message-container invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-12 mb-5">
                                <label for="riwayatapenyakitsekarang" class="form-label fs-7">Riwayat Penyakit Sekarang</label>
                                <textarea id="riwayatapenyakitsekarang" type="text" name="riwayatapenyakitsekarang" 
                                class="form-control form-control-sm form-control-solid @error('riwayatapenyakitsekarang') is-invalid @enderror" data-kt-autosize="true">
                                    {{ old('riwayatapenyakitsekarang') }}
                                </textarea>
                                @error('riwayatapenyakitsekarang')
                                    <div class="fv-plugins-message-container invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-12 mb-5">
                                <label for="riwayatapenyakitdahulu" class="form-label fs-7">Riwayat Penyakit Dahulu</label>
                                <textarea id="riwayatapenyakitdahulu" type="text" name="riwayatapenyakitdahulu" 
                                class="form-control form-control-sm form-control-solid @error('riwayatapenyakitdahulu') is-invalid @enderror" data-kt-autosize="true">
                                    {{ old('riwayatapenyakitdahulu') }}
                                </textarea>
                                @error('riwayatapenyakitdahulu')
                                    <div class="fv-plugins-message-container invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-12 mb-5">
                                <label for="riwayatalergi" class="form-label fs-7">Riwayat Alergi</label>
                                <textarea id="riwayatalergi" type="text" name="riwayatalergi" 
                                class="form-control form-control-sm form-control-solid @error('riwayatalergi') is-invalid @enderror" data-kt-autosize="true">
                                    {{ old('riwayatalergi') }}
                                </textarea>
                                @error('riwayatalergi')
                                    <div class="fv-plugins-message-container invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-12 mb-5">
                                <label for="riwayatpemakaianobat" class="form-label fs-7">Riwayat Pemakaian Obat</label>
                                <textarea id="riwayatpemakaianobat" type="text" name="riwayatpemakaianobat" 
                                class="form-control form-control-sm form-control-solid @error('riwayatpemakaianobat') is-invalid @enderror" data-kt-autosize="true">
                                    {{ old('riwayatpemakaianobat') }}
                                </textarea>
                                @error('riwayatpemakaianobat')
                                    <div class="fv-plugins-message-container invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-12 mb-5">
                                <label for="diagnosautama" class="form-label required fs-7">Diagnosa Utama</label>
                                <input id="diagnosautama" type="text" name="diagnosautama" value="{{ old('diagnosautama') }}"
                                class="form-control form-control-sm form-control-solid @error('diagnosautama') is-invalid @enderror" autocomplete="off" />
                                @error('diagnosautama')
                                    <div class="fv-plugins-message-container invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-12 mb-5">
                                <label for="diagnosatambahan" class="form-label fs-7">Diagnosa Tambahan</label>
                                <input id="diagnosatambahan" type="text" name="diagnosatambahan" value="{{ old('diagnosatambahan') }}"
                                class="form-control form-control-sm form-control-solid @error('diagnosatambahan') is-invalid @enderror" autocomplete="off" />
                                @error('diagnosatambahan')
                                    <div class="fv-plugins-message-container invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            

                        </div>
                    </div>
                </div>
                
                
                
            </form>
            
        </div>
    </div>
</div>
@endsection