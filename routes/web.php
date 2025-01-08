<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KoperasiController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\koperasi\AdminPameranController;
use App\Http\Controllers\koperasi\AdminKelompokController;
use App\Http\Controllers\koperasi\AdminFasilitasController;
use App\Http\Controllers\koperasi\AdminKecamatanController;
use App\Http\Controllers\koperasi\AdminKesehatanController;
use App\Http\Controllers\koperasi\AdminPengawasanController;
use App\Http\Controllers\koperasi\AdminPenghargaanController;
use App\Http\Controllers\koperasi\CategoryKelompokController;
use App\Http\Controllers\koperasi\CategoryKecamatanController;
use App\Http\Controllers\koperasi\AdminKoperasiKelompokController;
use App\Http\Controllers\koperasi\AdminKoperasiKecamatanController;

Route::middleware(['guest'])->group(function () {
    Route::resource('/', HomeController::class);

    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
    Route::get('forgot', [LoginController::class, 'forgot'])->name('forgot');
    Route::post('/forgot-proses', [LoginController::class, 'forgot_proses'])->name('forgot-proses');
    Route::get('reset/{token}', [LoginController::class, 'reset'])->name('reset');
    Route::post('/reset-proses', [LoginController::class, 'reset_proses'])->name('reset-proses');

    Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
    Route::get('contact/detail', [ContactController::class, 'detail'])->name('contact.detail');
    Route::post('contact/store', [ContactController::class, 'store'])->name('contact.store');

    Route::get('koperasi/kecamatan', [KoperasiController::class, 'kecamatan'])->name('koperasi.kecamatan');
    Route::get('koperasi/categorykecamatan', [KoperasiController::class, 'categorykecamatan'])->name('koperasi.categorykecamatan');
    Route::get('koperasikecamatan/{kecamatan}', [KoperasiController::class, 'kopkecamatan'])->name('koperasi.kopkecamatan');
    Route::get('koperasi/kelompok', [KoperasiController::class, 'kelompok'])->name('koperasi.kelompok');
    Route::get('koperasi/categorykelompok', [KoperasiController::class, 'categorykelompok'])->name('koperasi.categorykelompok');
    Route::get('koperasikelompok/{kelompok}', [KoperasiController::class, 'kopkelompok'])->name('koperasi.kopkelompok');
    Route::get('koperasi/pengawasan', [KoperasiController::class, 'pengawasan'])->name('koperasi.pengawasan');
    Route::get('koperasi/kesehatan', [KoperasiController::class, 'kesehatan'])->name('koperasi.kesehatan');
    Route::get('koperasi/fasilitas', [KoperasiController::class, 'fasilitas'])->name('koperasi.fasilitas');
    Route::get('koperasi/penghargaan', [KoperasiController::class, 'penghargaan'])->name('koperasi.penghargaan');
    Route::get('koperasi/pameran', [KoperasiController::class, 'pameran'])->name('koperasi.pameran');

    Route::get('pengawasan/{pengawasan}', [KoperasiController::class, 'show_pengawasan'])->name('show.pengawasan');
    Route::get('fasilitas/{fasilitas}', [KoperasiController::class, 'show_fasilitas'])->name('show.fasilitas');
    Route::get('kesehatan/{kesehatan}', [KoperasiController::class, 'show_kesehatan'])->name('show.kesehatan');
    Route::get('pameran/{pameran}', [KoperasiController::class, 'show_pameran'])->name('show.pameran');
    Route::get('penghargaan/{penghargaan}', [KoperasiController::class, 'show_penghargaan'])->name('show.penghargaan');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware('userAkses:admin')->group(function () {
        Route::resource('/dashboard', AdminDashboardController::class);

        Route::get('contactadmin', [ContactController::class, 'admin'])->name('contact.admin');
        Route::get('contactadmin/{contact}', [ContactController::class, 'show'])->name('contact.show');
        Route::put('contactadmin/{contact}', [ContactController::class, 'update'])->name('contact.update');
        Route::delete('contactadmin/{contact}', [ContactController::class, 'destroy'])->name('contact.destroy');
        Route::post('contactadmin/{contact}/toggle-visibility', [ContactController::class, 'toggleVisibility'])->name('contact.toggleVisibility');

        Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('profile/password/{user}', [ProfileController::class, 'password'])->name('profile.password');
        Route::put('profile/upload/{user}', [ProfileController::class, 'upload'])->name('profile.upload');
        Route::put('profile/reset/{user}', [ProfileController::class, 'reset'])->name('profile.reset');

        Route::get('adminkoperasikecamatan', [AdminKoperasiKecamatanController::class, 'index'])->name('adminkoperasikecamatan.index');
        Route::post('adminkoperasikecamatan/store', [AdminKoperasiKecamatanController::class, 'store'])->name('adminkoperasikecamatan.store');
        Route::put('adminkoperasikecamatan/{koperasiKecamatan}', [AdminKoperasiKecamatanController::class, 'update'])->name('adminkoperasikecamatan.update');
        Route::delete('adminkoperasikecamatan/{koperasiKecamatan}', [AdminKoperasiKecamatanController::class, 'destroy'])->name('adminkoperasikecamatan.destroy');

        Route::get('categorykecamatan', [CategoryKecamatanController::class, 'index'])->name('categorykecamatan.index');
        Route::post('categorykecamatan/store', [CategoryKecamatanController::class, 'store'])->name('categorykecamatan.store');
        Route::put('categorykecamatan/{categoryKecamatan}', [CategoryKecamatanController::class, 'update'])->name('categorykecamatan.update');
        Route::delete('categorykecamatan/{categoryKecamatan}', [CategoryKecamatanController::class, 'destroy'])->name('categorykecamatan.destroy');

        Route::get('adminkecamatan/{kecamatan}', [AdminKecamatanController::class, 'index'])->name('adminkecamatan.index');
        Route::post('adminkecamatan/store', [AdminKecamatanController::class, 'store'])->name('adminkecamatan.store');
        Route::put('adminkecamatan/{kecamatan}', [AdminKecamatanController::class, 'update'])->name('adminkecamatan.update');
        Route::put('adminkopkecamatan/{kecamatan}', [AdminKecamatanController::class, 'keterangan'])->name('adminkecamatan.keterangan');
        Route::delete('adminkecamatan/{kecamatan}', [AdminKecamatanController::class, 'destroy'])->name('adminkecamatan.destroy');

        Route::get('adminkoperasikelompok', [AdminKoperasiKelompokController::class, 'index'])->name('adminkoperasikelompok.index');
        Route::post('adminkoperasikelompok/store', [AdminKoperasiKelompokController::class, 'store'])->name('adminkoperasikelompok.store');
        Route::put('adminkoperasikelompok/{koperasiKelompok}', [AdminKoperasiKelompokController::class, 'update'])->name('adminkoperasikelompok.update');
        Route::delete('adminkoperasikelompok/{koperasiKelompok}', [AdminKoperasiKelompokController::class, 'destroy'])->name('adminkoperasikelompok.destroy');

        Route::get('categorykelompok', [CategoryKelompokController::class, 'index'])->name('categorykelompok.index');
        Route::post('categorykelompok/store', [CategoryKelompokController::class, 'store'])->name('categorykelompok.store');
        Route::put('categorykelompok/{categoryKelompok}', [CategoryKelompokController::class, 'update'])->name('categorykelompok.update');
        Route::delete('categorykelompok/{categoryKelompok}', [CategoryKelompokController::class, 'destroy'])->name('categorykelompok.destroy');

        Route::get('adminkelompok/{kelompok}', [AdminKelompokController::class, 'index'])->name('adminkelompok.index');
        Route::post('adminkelompok/store', [AdminKelompokController::class, 'store'])->name('adminkelompok.store');
        Route::put('adminkelompok/{kelompok}', [AdminKelompokController::class, 'update'])->name('adminkelompok.update');
        Route::put('adminkopkelompok/{kelompok}', [AdminKelompokController::class, 'keterangan'])->name('adminkelompok.keterangan');
        Route::delete('adminkelompok/{kelompok}', [AdminKelompokController::class, 'destroy'])->name('adminkelompok.destroy');

        Route::get('adminpengawasan', [AdminPengawasanController::class, 'index'])->name('adminpengawasan.index');
        Route::post('adminpengawasan/store', [AdminPengawasanController::class, 'store'])->name('adminpengawasan.store');
        Route::get('adminpengawasan/{pengawasan}', [AdminPengawasanController::class, 'show'])->name('adminpengawasan.show');
        Route::put('adminpengawasan/{pengawasan}', [AdminPengawasanController::class, 'update'])->name('adminpengawasan.update');
        Route::delete('adminpengawasan/{pengawasan}', [AdminPengawasanController::class, 'destroy'])->name('adminpengawasan.destroy');

        Route::get('adminkesehatan', [AdminKesehatanController::class, 'index'])->name('adminkesehatan.index');
        Route::post('adminkesehatan/store', [AdminKesehatanController::class, 'store'])->name('adminkesehatan.store');
        Route::get('adminkesehatan/{kesehatan}', [AdminKesehatanController::class, 'show'])->name('adminkesehatan.show');
        Route::put('adminkesehatan/{kesehatan}', [AdminKesehatanController::class, 'update'])->name('adminkesehatan.update');
        Route::delete('adminkesehatan/{kesehatan}', [AdminKesehatanController::class, 'destroy'])->name('adminkesehatan.destroy');

        Route::get('adminfasilitas', [AdminFasilitasController::class, 'index'])->name('adminfasilitas.index');
        Route::post('adminfasilitas/store', [AdminFasilitasController::class, 'store'])->name('adminfasilitas.store');
        Route::get('adminfasilitas/{fasilitas}', [AdminFasilitasController::class, 'show'])->name('adminfasilitas.show');
        Route::put('adminfasilitas/{fasilitas}', [AdminFasilitasController::class, 'update'])->name('adminfasilitas.update');
        Route::delete('adminfasilitas/{fasilitas}', [AdminFasilitasController::class, 'destroy'])->name('adminfasilitas.destroy');

        Route::get('adminpenghargaan', [AdminPenghargaanController::class, 'index'])->name('adminpenghargaan.index');
        Route::post('adminpenghargaan/store', [AdminPenghargaanController::class, 'store'])->name('adminpenghargaan.store');
        Route::get('adminpenghargaan/{penghargaan}', [AdminPenghargaanController::class, 'show'])->name('adminpenghargaan.show');
        Route::put('adminpenghargaan/{penghargaan}', [AdminPenghargaanController::class, 'update'])->name('adminpenghargaan.update');
        Route::delete('adminpenghargaan/{penghargaan}', [AdminPenghargaanController::class, 'destroy'])->name('adminpenghargaan.destroy');

        Route::get('adminpameran', [AdminPameranController::class, 'index'])->name('adminpameran.index');
        Route::post('adminpameran/store', [AdminPameranController::class, 'store'])->name('adminpameran.store');
        Route::get('adminpameran/{pameran}', [AdminPameranController::class, 'show'])->name('adminpameran.show');
        Route::put('adminpameran/{pameran}', [AdminPameranController::class, 'update'])->name('adminpameran.update');
        Route::delete('adminpameran/{pameran}', [AdminPameranController::class, 'destroy'])->name('adminpameran.destroy');
    });
});

Route::get('/home', function () {
    return redirect('/dashboard');
});
