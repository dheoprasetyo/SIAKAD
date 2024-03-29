<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/mahasiswa/login','LoginMahasiswaController@index');
Route::post('/mahasiswa/login','LoginMahasiswaController@submit');
Route::get('/dosen/login','LoginDosenController@index');
Route::post('/dosen/login','LoginDosenController@submit');
Route::get('jadwal_mengajar','DosenController@jadwal_mengajar');
Route::get('jadwal_mengajar/json','DosenController@jadwal_mengajar_json');

Route::get('nilai/{id}','NilaiController@index');
Route::post('/nilai/update_nilai/update','NilaiController@update_nilai');

Route::get('/krs/listmatkulkrs','KrsController@listmatkulkrs');
Route::get('/krs','KrsController@index');
Route::get('/krs/tambahKrs','KrsController@tambahKrs');
Route::get('/krs/tampilKrs','KrsController@tampilKrs');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/matakuliah/json', 'MatakuliahController@json');
Route::get('/dosen/json', 'DosenController@json');
Route::get('/fakultas/json', 'FakultasController@json');
Route::get('/jurusan/json', 'JurusanController@json');
Route::get('/ruangan/json', 'RuanganController@json');
Route::get('/tahunakademik/json', 'TahunakademikController@json');
Route::get('/mahasiswa/json', 'MahasiswaController@json');
// Route::get('/kurikulum/json', 'KurikulumController@json');
Route::resource('/matakuliah','MatakuliahController');
Route::resource('/dosen','DosenController');
Route::resource('/fakultas','FakultasController');
Route::resource('/jurusan','JurusanController');
Route::resource('/ruangan','RuanganController');
Route::resource('/tahunakademik','TahunakademikController');
Route::resource('/kurikulum','KurikulumController');
    Route::get('/setting','SettingController@index');
    Route::put('/setting','SettingController@update');
    Route::resource('/jadwalkuliah','JadwalkuliahController');
Route::resource('/mahasiswa','MahasiswaController');
