<?php

use App\Http\Controllers\DashboardCtrl;
use App\Http\Controllers\KunjunganPasienCtrl;
use App\Http\Controllers\LoginCtrl;
use App\Http\Controllers\ObatCtrl;
use App\Http\Controllers\PasienCtrl;
use App\Http\Controllers\PemeriksaanCtrl;
use App\Http\Controllers\ResepCtrl;
use App\Http\Middleware\isPerawat;
use App\Http\Middleware\isSuperAdmin;
use Illuminate\Support\Facades\Route;


Route::controller(LoginCtrl::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login/authenticate', 'authenticate');
});


Route::group(["middleware" => "auth"], function () {
    Route::get('/logout', [LoginCtrl::class, 'logout']);
    
    // Dashboard
    Route::controller(DashboardCtrl::class)->group(function () {
        Route::get('/', 'index')->name('dashboard');
    });

    Route::group(["middleware" => "isPendaftaran"], function () {
        Route::controller(PasienCtrl::class)->group(function () {
            Route::get('/pasien', 'index')->name('pasien');
            Route::get('/data-pasien', 'data');
            Route::post('/save-data-pasien', 'save');
            Route::delete('/hapus-data-pasien/{id}', 'hapus');
        });

        Route::controller(KunjunganPasienCtrl::class)->group(function () {
            Route::post('/save-data-kunjungan', 'save');
            Route::delete('/hapus-data-kunjungan/{id}', 'hapus');
        });
    });

    Route::controller(KunjunganPasienCtrl::class)->group(function () {
        Route::get('/kunjungan-pasien', 'index')->name('kunjunganPasien');
        Route::get('/data-kunjungan-pasien', 'data');
        Route::get('/detail-kunjungan/{id}', 'detail');
    });

    Route::group(["middleware" => "isPerawat"], function () {
        Route::controller(PemeriksaanCtrl::class)->group(function () {
            Route::get('/tambah-pemeriksaan-fisik/{id}', 'tambahPemfis');
            Route::post('/save-pemeriksaan-fisik/{id}', 'savePemfis');
            Route::get('/edit-pemeriksaan-fisik/{id}', 'editPemfis');
            Route::put('/update-pemeriksaan-fisik/{id}', 'updatePemfis');
        });
    });

    Route::group(["middleware" => "isDokter"], function () {
        Route::controller(PemeriksaanCtrl::class)->group(function () {
            Route::get('/tambah-pemeriksaan-medis/{id}', 'tambahPemdis');
            Route::post('/save-pemeriksaan-medis/{id}', 'savePemdis');
            Route::get('/edit-pemeriksaan-medis/{id}', 'editPemdis');
            Route::put('/update-pemeriksaan-medis/{id}', 'updatePemdis');
        });
    });
   

    Route::controller(ObatCtrl::class)->group(function () {
        Route::get('/obat', 'index')->name('obat');
        Route::get('/data-obat', 'data');
        Route::post('/save-data-obat', 'save');
        Route::put('/update-status-obat/{id}', 'updateStatus');
    });
    Route::group(["middleware" => "isApoteker"], function () {
        Route::controller(ResepCtrl::class)->group(function () {
            Route::get('/tambah-resep/{id}', 'tambah');
            Route::post('/save-resep-obat', 'save');
        });
    });
    

});

