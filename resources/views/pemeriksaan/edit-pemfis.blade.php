@extends("layout")

@section('content')

<div class="d-flex flex-column flex-xl-row">
    <div class="flex-column flex-lg-row-auto w-100 w-xl-300px mb-10">
        @include("pemeriksaan.pasien-info")
    </div>

    <div class="flex-lg-row-fluid ms-lg-15">
        <div class="tab-content">
            <form  method="post" action="/update-pemeriksaan-fisik/{{ $pemfis->id }}">
                @method('put')
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

                            <div class="col-6 mb-5">
                                <label for="beratbadan" class="form-label required fs-7">Berat Badan</label>
                                <input id="beratbadan" type="text" name="beratbadan" value="{{ old('beratbadan', $pemfis->beratbadan) }}" 
                                class="form-control form-control-sm form-control-solid @error('beratbadan') is-invalid @enderror" autocomplete="off" />
                                @error('beratbadan')
                                    <div class="fv-plugins-message-container invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-6 mb-5">
                                <label for="tinggibadan" class="form-label required fs-7">Tinggi Badan</label>
                                <input id="tinggibadan" type="text" name="tinggibadan" value="{{ old('tinggibadan', $pemfis->tinggibadan) }}"
                                class="form-control form-control-sm form-control-solid @error('tinggibadan') is-invalid @enderror" autocomplete="off" />
                                @error('tinggibadan')
                                    <div class="fv-plugins-message-container invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-6 mb-5">
                                <label for="tekanandarah" class="form-label required fs-7">Tekanan Darah</label>
                                <input id="tekanandarah" type="text" name="tekanandarah" value="{{ old('tekanandarah', $pemfis->tekanandarah) }}"
                                class="form-control form-control-sm form-control-solid @error('tekanandarah') is-invalid @enderror" autocomplete="off" />
                                @error('tekanandarah')
                                    <div class="fv-plugins-message-container invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-6 mb-5">
                                <label for="nadi" class="form-label fs-7">Nadi</label>
                                <input id="nadi" type="text" name="nadi" value="{{ old('nadi', $pemfis->nadi) }}"
                                class="form-control form-control-sm form-control-solid @error('nadi') is-invalid @enderror" autocomplete="off" />
                                @error('nadi')
                                    <div class="fv-plugins-message-container invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-6 mb-5">
                                <label for="suhutubuh" class="form-label fs-7">Suhu</label>
                                <input id="suhutubuh" type="text" name="suhutubuh" value="{{ old('suhutubuh', $pemfis->suhutubuh) }}"
                                class="form-control form-control-sm form-control-solid @error('suhutubuh') is-invalid @enderror" autocomplete="off" />
                                @error('suhutubuh')
                                    <div class="fv-plugins-message-container invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-6 mb-5">
                                <label for="imt" class="form-label fs-7">IMT</label>
                                <input id="imt" type="text" name="imt" value="{{ old('imt', $pemfis->imt) }}"
                                class="form-control form-control-sm form-control-solid @error('imt') is-invalid @enderror" autocomplete="off" />
                                @error('imt')
                                    <div class="fv-plugins-message-container invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-6 mb-5">
                                <label for="saturasioksigen" class="form-label fs-7">Saturasi Oksigen</label>
                                <input id="saturasioksigen" type="text" name="saturasioksigen" value="{{ old('saturasioksigen', $pemfis->saturasioksigen) }}"
                                class="form-control form-control-sm form-control-solid @error('saturasioksigen') is-invalid @enderror" autocomplete="off" />
                                @error('saturasioksigen')
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