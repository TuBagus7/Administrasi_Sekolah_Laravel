<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AbsensiSiswaController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/clear-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    return 'DONE';
});

Auth::routes();

// Auth tambahan
Route::get('/login/cek_email/json', 'UserController@cek_email');
Route::get('/login/cek_password/json', 'UserController@cek_password');
Route::post('/cek-email', 'UserController@email')->name('cek-email')->middleware('guest');
Route::get('/reset/password/{id}', 'UserController@password')->name('reset.password')->middleware('guest');
Route::patch('/reset/password/update/{id}', 'UserController@update_password')->name('reset.password.update')->middleware('guest');

// 🔐 Route untuk user yang sudah login
Route::middleware(['auth'])->group(function () {

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');

    // 🔧 Pengaturan Profil
    Route::get('/profile', 'UserController@profile')->name('profile');
    Route::get('/pengaturan/profile', 'UserController@edit_profile')->name('pengaturan.profile');
    Route::post('/pengaturan/ubah-profile', 'UserController@ubah_profile')->name('pengaturan.ubah-profile');
    Route::get('/pengaturan/edit-foto', 'UserController@edit_foto')->name('pengaturan.edit-foto');
    Route::post('/pengaturan/ubah-foto', 'UserController@ubah_foto')->name('pengaturan.ubah-foto');
    Route::get('/pengaturan/email', 'UserController@edit_email')->name('pengaturan.email');
    Route::post('/pengaturan/ubah-email', 'UserController@ubah_email')->name('pengaturan.ubah-email');
    Route::get('/pengaturan/password', 'UserController@edit_password')->name('pengaturan.password');
    Route::post('/pengaturan/ubah-password', 'UserController@ubah_password')->name('pengaturan.ubah-password');

    // 📆 Jadwal Umum
    Route::get('/jadwal/sekarang', 'JadwalController@jadwalSekarang');

    // ============================
    // 👨‍🎓 ROUTE SISWA
    // ============================
    Route::middleware(['siswa'])->group(function () {
        // Dashboard Siswa
    Route::get('/siswa/dashboard', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
    Route::get('/siswa/jadwal', 'JadwalController@siswa')->name('jadwal.siswa');
    Route::get('/siswa/ulangan', 'UlanganController@siswa')->name('ulangan.siswa');
    Route::get('/siswa/sikap', 'SikapController@siswa')->name('sikap.siswa');
    Route::get('/siswa/rapot', 'RapotController@siswa')->name('rapot.siswa');

    // Absensi Siswa
    Route::get('/siswa/absensi', [AbsensiSiswaController::class, 'index'])->name('absensi.siswa');
    Route::post('/siswa/absensi', [AbsensiSiswaController::class, 'store'])->name('absensi.siswa.store');

    
});
    // ============================
    // 👨‍🏫 ROUTE GURU
    // ============================
    Route::middleware(['guru'])->group(function () {
        // ✅ FIX: Menambahkan dashboard guru agar error hilang
        Route::get('/dashboard', [GuruController::class, 'dashboard'])->name('guru.dashboard');
        Route::get('/absen/harian', 'GuruController@absen')->name('absen.harian');
        Route::post('/absen/simpan', 'GuruController@simpan')->name('absen.simpan');
        Route::get('/jadwal/guru', 'JadwalController@guru')->name('jadwal.guru');
        Route::resource('/nilai', 'NilaiController');
        Route::resource('/ulangan', 'UlanganController');
        Route::resource('/sikap', 'SikapController');
        Route::get('/rapot/predikat', 'RapotController@predikat');
        Route::resource('/rapot', 'RapotController');
        Route::get('/guru/absensiswa', [GuruController::class, 'riwayatAbsenSiswa'])->name('guru.riwayat.absensiswa');
    });

    // ============================
    // 👨‍💼 ROUTE ADMIN
    // ============================
    Route::middleware(['admin'])->group(function () {

        // ♻️ Trash
        Route::middleware(['trash'])->group(function () {
            Route::get('/jadwal/trash', 'JadwalController@trash')->name('jadwal.trash');
            Route::get('/jadwal/restore/{id}', 'JadwalController@restore')->name('jadwal.restore');
            Route::delete('/jadwal/kill/{id}', 'JadwalController@kill')->name('jadwal.kill');

            Route::get('/guru/trash', 'GuruController@trash')->name('guru.trash');
            Route::get('/guru/restore/{id}', 'GuruController@restore')->name('guru.restore');
            Route::delete('/guru/kill/{id}', 'GuruController@kill')->name('guru.kill');

            Route::get('/kelas/trash', 'KelasController@trash')->name('kelas.trash');
            Route::get('/kelas/restore/{id}', 'KelasController@restore')->name('kelas.restore');
            Route::delete('/kelas/kill/{id}', 'KelasController@kill')->name('kelas.kill');

            Route::get('/siswa/trash', 'SiswaController@trash')->name('siswa.trash');
            Route::get('/siswa/restore/{id}', 'SiswaController@restore')->name('siswa.restore');
            Route::delete('/siswa/kill/{id}', 'SiswaController@kill')->name('siswa.kill');

            Route::get('/mapel/trash', 'MapelController@trash')->name('mapel.trash');
            Route::get('/mapel/restore/{id}', 'MapelController@restore')->name('mapel.restore');
            Route::delete('/mapel/kill/{id}', 'MapelController@kill')->name('mapel.kill');

            Route::get('/user/trash', 'UserController@trash')->name('user.trash');
            Route::get('/user/restore/{id}', 'UserController@restore')->name('user.restore');
            Route::delete('/user/kill/{id}', 'UserController@kill')->name('user.kill');
        });

        // 🧑‍💼 Admin lainnya
        Route::get('/admin/home', 'HomeController@admin')->name('admin.home');
        Route::get('/admin/pengumuman', 'PengumumanController@index')->name('admin.pengumuman');
        Route::post('/admin/pengumuman/simpan', 'PengumumanController@simpan')->name('admin.pengumuman.simpan');

        // 📋 Guru
        Route::prefix('guru')->group(function() {
        Route::get('dashboard', [GuruController::class, 'dashboard']);});

        Route::get('/guru/absensi', 'GuruController@absensi')->name('guru.absensi');
        Route::get('/guru/kehadiran/{id}', 'GuruController@kehadiran')->name('guru.kehadiran');
        Route::get('/absen/json', 'GuruController@json');
        Route::get('/guru/mapel/{id}', 'GuruController@mapel')->name('guru.mapel');
        Route::get('/guru/ubah-foto/{id}', 'GuruController@ubah_foto')->name('guru.ubah-foto');
        Route::post('/guru/update-foto/{id}', 'GuruController@update_foto')->name('guru.update-foto');
        Route::post('/guru/upload', 'GuruController@upload')->name('guru.upload');
        Route::get('/guru/export_excel', 'GuruController@export_excel')->name('guru.export_excel');
        Route::post('/guru/import_excel', 'GuruController@import_excel')->name('guru.import_excel');
        Route::delete('/guru/deleteAll', 'GuruController@deleteAll')->name('guru.deleteAll');
        Route::resource('/guru', 'GuruController');

        // 🏫 Kelas
        Route::get('/kelas/edit/json', 'KelasController@getEdit');
        Route::resource('/kelas', 'KelasController');

        // 👨‍🎓 Siswa
        Route::get('/siswa/kelas/{id}', 'SiswaController@kelas')->name('siswa.kelas');
        Route::get('/siswa/view/json', 'SiswaController@view');
        Route::get('/listsiswapdf/{id}', 'SiswaController@cetak_pdf');
        Route::get('/siswa/ubah-foto/{id}', 'SiswaController@ubah_foto')->name('siswa.ubah-foto');
        Route::post('/siswa/update-foto/{id}', 'SiswaController@update_foto')->name('siswa.update-foto');
        Route::get('/siswa/export_excel', 'SiswaController@export_excel')->name('siswa.export_excel');
        Route::post('/siswa/import_excel', 'SiswaController@import_excel')->name('siswa.import_excel');
        Route::delete('/siswa/deleteAll', 'SiswaController@deleteAll')->name('siswa.deleteAll');
        Route::resource('/siswa', 'SiswaController');

        // 📚 Mapel
        Route::get('/mapel/getMapelJson', 'MapelController@getMapelJson');
        Route::resource('/mapel', 'MapelController');

        // 📅 Jadwal
        Route::get('/jadwal/view/json', 'JadwalController@view');
        Route::get('/jadwalkelaspdf/{id}', 'JadwalController@cetak_pdf');
        Route::get('/jadwal/export_excel', 'JadwalController@export_excel')->name('jadwal.export_excel');
        Route::post('/jadwal/import_excel', 'JadwalController@import_excel')->name('jadwal.import_excel');
        Route::delete('/jadwal/deleteAll', 'JadwalController@deleteAll')->name('jadwal.deleteAll');
        Route::resource('/jadwal', 'JadwalController');

        // 📈 Penilaian
        Route::get('/ulangan-kelas', 'UlanganController@create')->name('ulangan-kelas');
        Route::get('/ulangan-siswa/{id}', 'UlanganController@edit')->name('ulangan-siswa');
        Route::get('/ulangan-show/{id}', 'UlanganController@ulangan')->name('ulangan-show');

        Route::get('/sikap-kelas', 'SikapController@create')->name('sikap-kelas');
        Route::get('/sikap-siswa/{id}', 'SikapController@edit')->name('sikap-siswa');
        Route::get('/sikap-show/{id}', 'SikapController@sikap')->name('sikap-show');

        Route::get('/rapot-kelas', 'RapotController@create')->name('rapot-kelas');
        Route::get('/rapot-siswa/{id}', 'RapotController@edit')->name('rapot-siswa');
        Route::get('/rapot-show/{id}', 'RapotController@rapot')->name('rapot-show');

        Route::get('/predikat', 'NilaiController@create')->name('predikat');

        Route::resource('/user', 'UserController');
    });
});

// Duplicate Auth route (bisa dihapus)
Auth::routes();

// Duplikat Home (bisa dihapus juga)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');