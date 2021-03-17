<?php

Route::get('/', 'HomeController@index')->name("main");
Route::get('/home', 'HomeController@index')->name("mainHome");
/**
 * Auth
 */
Route::get('/login', 'AdminAuth\LoginController@showLoginForm');
Route::post('/login', 'AdminAuth\LoginController@login')->name("postLogin");
Route::get('/logout', 'AdminAuth\LoginController@logout')->name("logout");
/**
* Route Users
*/
Route::get('/users', 'UserController@index')->name("user.index");
Route::post('/users/create', 'UserController@create')->name("user.create");
Route::get('/users/{id}/edit', 'UserController@edit')->name("user.edit");
Route::put('/users/{id}/update', 'UserController@update')->name("user.update");
Route::delete('/users/{id}/delete', 'UserController@destroy')->name("user.delete");
Route::post('/users/datatables', 'UserController@tableUsers')->name('tableUsers');


/**
 * Route Jenis
 */
Route::get('/inventaris', 'InventarisController@index')->name('inventaris.index');
Route::post('/inventaris/create', 'InventarisController@create')->name('inventaris.create');
Route::post('/inventaris/store', 'InventarisController@store')->name("inventaris.store");
Route::post('/inventaris/datatables', 'InventarisController@tableinventaris')->name('tableinventaris');
Route::get('/inventaris/{id}/edit', 'InventarisController@edit')->name('inventaris.edit');
Route::put('/inventaris/{id}/update', 'InventarisController@update')->name('inventaris.update');
Route::delete('/inventaris/{id}/delete', 'InventarisController@deleteInventaris')->name('deleteInventaris');

/**
 * Route Jenis
 */
Route::get('/jenis', 'jenisController@index')->name('jenis.index');
Route::post('/jenis/create', 'jenisController@create')->name('jenis.create');
Route::post('/jenis/store', 'jenisController@store')->name("jenis.store");
Route::post('/jenis/datatables', 'jenisController@tablejenis')->name('tablejenis');
Route::get('/jenis/{id}/edit', 'jenisController@edit')->name('jenis.edit');
Route::put('/jenis/{id}/update', 'jenisController@update')->name('jenis.update');
Route::delete('/jenis/{id}/delete', 'jenisController@deleteJenis')->name('deleteJenis');

/**
 * Route ruang
 */
Route::get('/ruang', 'RuangController@index')->name('ruang.index');
Route::post('/ruang/create', 'RuangController@create')->name('ruang.create');
Route::post('/ruang/store', 'RuangController@store')->name("ruang.store");
Route::post('/ruang/datatables', 'RuangController@tableruang')->name('tableruang');
Route::get('/ruang/{id}/edit', 'RuangController@edit')->name('ruang.edit');
Route::put('/ruang/{id}/update', 'RuangController@update')->name('ruang.update');
Route::delete('/ruang/{id}/delete', 'RuangController@deleteRuang')->name('deleteRuang');

/**
 * Route Peminjaman
 */
Route::get('/peminjaman', 'PeminjamanController@index')->name('peminjaman.index');
Route::post('/peminjaman/create', 'PeminjamanController@create')->name('peminjaman.create');
Route::post('/peminjaman/store', 'PeminjamanController@store')->name("peminjaman.store");
Route::post('/peminjaman/datatables', 'PeminjamanController@tablepeminjaman')->name('tablepeminjaman');
Route::get('/peminjaman/{id}/edit', 'PeminjamanController@edit')->name('peminjaman.edit');
Route::put('/peminjaman/{id}/update', 'PeminjamanController@update')->name('peminjaman.update');
Route::delete('/peminjaman/{id}/delete', 'PeminjamanController@deletePeminjaman')->name('deletePeminjaman');

/**
 * Route DetailPinjam
 */
Route::get('/detailpinjam', 'DetailpinjamController@index')->name('detailpinjam.index');
Route::post('/detailpinjam/create', 'DetailpinjamController@create')->name('detailpinjam.create');
Route::post('/detailpinjam/store', 'DetailpinjamController@store')->name("detailpinjam.store");
Route::post('/detailpinjam/datatables', 'DetailpinjamController@tabledetailpinjam')->name('tabledetailpinjam');
Route::get('/detailpinjam/{id}/edit', 'DetailpinjamController@edit')->name('detailpinjam.edit');
Route::put('/detailpinjam/{id}/update', 'DetailpinjamController@update')->name('detailpinjam.update');
Route::delete('/detailpinjam/{id}/delete', 'DetailpinjamController@deleteDetailpinjam')->name('deleteDetailpinjam');

/**
 * Route Level
 */
Route::get('/level', 'LevelController@index')->name('level.index');
Route::post('/level/create', 'LevelController@create')->name('level.create');
Route::post('/level/store', 'LevelController@store')->name("level.store");
Route::post('/level/datatables', 'LevelController@tablelevel')->name('tablelevel');
Route::get('/level/{id}/edit', 'LevelController@edit')->name('level.edit');
Route::put('/level/{id}/update', 'LevelController@update')->name('level.update');
Route::delete('/level/{id}/delete', 'LevelController@deleteLevel')->name('deleteLevel');

/**
 * Route Pegawai
 */
Route::get('/pegawai', 'PegawaiController@index')->name('pegawai.index');
Route::post('/pegawai/create', 'PegawaiController@create')->name('pegawai.create');
Route::post('/pegawai/store', 'PegawaiController@store')->name("pegawai.store");
Route::post('/pegawai/datatables', 'PegawaiController@tablepegawai')->name('tablepegawai');
Route::get('/pegawai/{id}/edit', 'PegawaiController@edit')->name('pegawai.edit');
Route::put('/pegawai/{id}/update', 'PegawaiController@update')->name('pegawai.update');
Route::delete('/pegawai/{id}/delete', 'PegawaiController@deletePegawai')->name('deletePegawai');



/**
 * Route Jabatan
 */
// Route::get('/jabatan', 'jabatanController@index')->name('jabatan.index');
// Route::post('/jabatan/create', 'jabatanController@create')->name('jabatan.create');
// Route::post('/jabatan/store', 'jabatanController@store')->name("jabatan.store");
// Route::post('/jabatan/datatables', 'jabatanController@tablejabatan')->name('tablejabatan');
// Route::get('/jabatan/{id}/edit', 'jabatanController@edit')->name('jabatan.edit');
// Route::put('/jabatan/{id}/update', 'jabatanController@update')->name('jabatan.update');
// Route::delete('/jabatan/{id}/delete', 'jabatanController@deleteJabatan')->name('deleteJabatan');
/**
 * Route Karyawan
 */
Route::get('/karyawan', 'karyawanController@index')->name('karyawan.index');
Route::post('/karyawan/create', 'karyawanController@create')->name('karyawan.create');
Route::post('/karyawan/store', 'karyawanController@store')->name("karyawan.store");
Route::post('/karyawan/datatables', 'karyawanController@tablekaryawan')->name('tablekaryawan');
Route::get('/karyawan/{id}/edit', 'karyawanController@edit')->name('karyawan.edit');
Route::put('/karyawan/{id}/update', 'karyawanController@update')->name('karyawan.update');
Route::delete('/karyawan/{id}/delete', 'karyawanController@deleteKaryawan')->name('deleteKaryawan');
/**
 * Route Gaji
 */
Route::get('/gaji', 'GajiController@index')->name('gaji.index');
Route::post('/gaji/create', 'GajiController@create')->name('gaji.create');
Route::post('/gaji/store', 'GajiController@store')->name("gaji.store");
Route::post('/gaji/datatables', 'GajiController@tablegaji')->name('tablegaji');
Route::get('/gaji/{id}/edit', 'GajiController@edit')->name('gaji.edit');
Route::put('/gaji/{id}/update', 'GajiController@update')->name('gaji.update');
Route::delete('/gaji/{id}/delete', 'GajiController@deleteGaji')->name('deleteGaji');
Route::get('/gaji/Printpreview', 'GajiController@Printpreview')->name('Printpreview');
