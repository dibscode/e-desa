<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PajakController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Master\SuratController;
use App\Http\Controllers\Surat\PengantarNikahController;
use App\Http\Controllers\Surat\PengajuanSkckController;
use App\Http\Controllers\Surat\KeteranganMiskinController;
use App\Http\Controllers\Surat\KeteranganMeninggalController;
use App\Http\Controllers\Surat\TanahController;
use App\Http\Controllers\Surat\UsahaController;
use App\Http\Controllers\Surat\AhliWarisController;
use App\Http\Controllers\Surat\BedaNamaController;
use App\Http\Controllers\Surat\DomisiliController;
use App\Http\Controllers\Surat\KehilanganController;
use App\Http\Controllers\Surat\KeramaianController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporController;
use App\Http\Controllers\WebController;

Route::middleware(['auth', 'level'])->group(
    function () {
        Route::get('/home', [HomeController::class, 'show'])->name('home');

        Route::get('/user/autocomplete', [UserController::class, 'autocomplete'])->name('user.autocomplete');
        Route::get('user/profil', [UserController::class, 'profil'])->name('user.profil');
        Route::get('user/password', [UserController::class, 'password'])->name('user.password');
        Route::get('user/logout', [UserController::class, 'logout'])->name('user.logout');
        Route::post('user/profil', [UserController::class, 'profilUpdate'])->name('user.profil.update');
        Route::post('user/password', [UserController::class, 'passwordUpdate'])->name('user.password.update');
        Route::post('user/import', [UserController::class, 'import'])->name('user.import');

        Route::resource('user', UserController::class);
    // Keuangan Desa management
    Route::resource('keuangan', \App\Http\Controllers\KeuanganDesaController::class);
        Route::resource('surat', SuratController::class);
        Route::resource('pajak', PajakController::class);
        // Admin management for Lapor (protected by auth+level middleware).
        // Use a prefix so public /lapor routes don't conflict with admin resource routes.
        Route::resource('admin/lapor', LaporController::class, [
            'as' => 'admin'
        ]);
        Route::resource('profile', ProfileController::class);

        Route::get('surat_pengantar_nikah/cetak/{id}', [PengantarNikahController::class, 'cetak'])->name('surat_pengantar_nikah.cetak');
        Route::get('surat_pengantar_nikah/signature/{id}', [PengantarNikahController::class, 'signature'])->name('surat_keterangan_miskin.signature');
        Route::resource('surat_pengantar_nikah', PengantarNikahController::class);

        Route::get('surat_keterangan_miskin/cetak/{id}', [KeteranganMiskinController::class, 'cetak'])->name('surat_keterangan_miskin.cetak');
        Route::get('surat_keterangan_miskin/signature/{id}', [KeteranganMiskinController::class, 'signature'])->name('surat_keterangan_miskin.signature');
        Route::resource('surat_keterangan_miskin', KeteranganMiskinController::class);

        Route::get('surat_pengajuan_skck/cetak/{id}', [PengajuanSkckController::class, 'cetak'])->name('surat_pengajuan_skck.cetak');
        Route::get('surat_pengajuan_skck/signature/{id}', [PengajuanSkckController::class, 'signature'])->name('surat_pengajuan_skck.signature');
        Route::resource('surat_pengajuan_skck', PengajuanSkckController::class);

        Route::get('surat_keterangan_meninggal/cetak/{id}', [KeteranganMeninggalController::class, 'cetak'])->name('surat_keterangan_meninggal.cetak');
        Route::get('surat_keterangan_meninggal/signature/{id}', [KeteranganMeninggalController::class, 'signature'])->name('surat_keterangan_meninggal.signature');
        Route::resource('surat_keterangan_meninggal', KeteranganMeninggalController::class);

        Route::get('surat_tanah/cetak/{id}', [TanahController::class, 'cetak'])->name('surat_tanah.cetak');
        Route::get('surat_tanah/signature/{id}', [TanahController::class, 'signature'])->name('surat_tanah.signature');
        Route::resource('surat_tanah', TanahController::class);

        Route::get('surat_keterangan_usaha/cetak/{id}', [UsahaController::class, 'cetak'])->name('surat_keterangan_usaha.cetak');
        Route::get('surat_keterangan_usaha/signature/{id}', [UsahaController::class, 'signature'])->name('surat_keterangan_usaha.signature');
        Route::resource('surat_keterangan_usaha', UsahaController::class);

        Route::get('surat_ahliwaris/cetak/{id}', [AhliWarisController::class, 'cetak'])->name('surat_ahliwaris.cetak');
        Route::get('surat_ahliwaris/signature/{id}', [AhliWarisController::class, 'signature'])->name('surat_ahliwaris.signature');
        Route::resource('surat_ahliwaris', AhliWarisController::class);

        Route::get('surat_bedanama/cetak/{id}', [BedaNamaController::class, 'cetak'])->name('surat_bedanama.cetak');
        Route::get('surat_bedanama/signature/{id}', [BedaNamaController::class, 'signature'])->name('surat_bedanama.signature');
        Route::resource('surat_bedanama', BedaNamaController::class);

        Route::get('surat_domisili/cetak/{id}', [DomisiliController::class, 'cetak'])->name('surat_domisili.cetak');
        Route::get('surat_domisili/signature/{id}', [DomisiliController::class, 'signature'])->name('surat_domisili.signature');
        Route::resource('surat_domisili', DomisiliController::class);

        Route::get('surat_kehilangan/cetak/{id}', [KehilanganController::class, 'cetak'])->name('surat_kehilangan.cetak');
        Route::get('surat_kehilangan/signature/{id}', [KehilanganController::class, 'signature'])->name('surat_kehilangan.signature');
        Route::resource('surat_kehilangan', KehilanganController::class);

        Route::get('surat_keramaian/cetak/{id}', [KeramaianController::class, 'cetak'])->name('surat_keramaian.cetak');
        Route::get('surat_keramaian/signature/{id}', [KeramaianController::class, 'signature'])->name('surat_keramaian.signature');
        Route::resource('surat_keramaian', KeramaianController::class);
    }
);


Route::middleware(['auth'])->group(
    function () {
        Route::resource('master/produk', ProdukController::class, [
            'as' => 'master'
        ]);
        Route::resource('master/berita', \App\Http\Controllers\BeritaController::class, [
            'as' => 'master'
        ]);
    }
);
 

Route::get('login', [UserController::class, 'loginForm'])->name('login');
Route::post('login', [UserController::class, 'loginAction'])->name('login.action');
Route::get('message', [HomeController::class, 'message'])->name('message');
Route::get('/', [WebController::class,'index'])->name('index');
Route::post('/ai-chat', [WebController::class, 'handleRequest'])->name('ai.chat');
// Route::get('/', function () {
//     return view('index');
// })->name('index');
// Frontend produk (public)
use App\Models\Produk;
Route::get('/produk', function() {
    $produks = Produk::all();
    return view('produk', compact('produks'));
})->name('produk.frontend');

// Frontend berita (public)
Route::get('berita', [\App\Http\Controllers\BeritaFrontendController::class, 'index'])->name('berita.frontend');
Route::get('berita/{slug}', [\App\Http\Controllers\BeritaFrontendController::class, 'show'])->name('berita.detail');

// Frontend lapor (public)
Route::get('lapor', [LaporController::class, 'publicIndex'])->name('lapor.frontend');
// Public create/store so guests can submit (create before show to avoid conflict)
Route::get('lapor/create', [LaporController::class, 'create'])->name('lapor.create');
Route::post('lapor', [LaporController::class, 'store'])->name('lapor.store');
// Public show (after create)
Route::get('lapor/{lapor}', [LaporController::class, 'show'])->name('lapor.show');

// Admin lapor routes (only for authenticated admins) are registered in the auth+level group below.