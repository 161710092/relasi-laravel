<?php
use App\mahasiswa;
use App\wali;
use App\dosen;
use App\hobi;

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

Route::get('relasi-1', function() {

		# Temukan mahasiswa dengan NIM 1015015072
		$mahasiswa = Mahasiswa::where('nim', '=', '1015015072')->first();

		# Tampilkan nama wali mahasiswa
		return $mahasiswa->wali->nama;

});

Route::get('relasi-2', function() {

		# Temukan mahasiswa dengan NIM 1015015072
		$mahasiswa = Mahasiswa::where('nim', '=', '1015015072')->first();

		# Tampilkan nama dosen pembimbing
		return $mahasiswa->dosen->nama;

});

Route::get('relasi-3', function() {

		# Temukan dosen dengan yang bernama Yulianto
		$dosen = Dosen::where('nama', '=', 'Yulianto')->first();

		# Tampilkan seluruh data mahasiswa didikannya
		foreach ($dosen->mahasiswa as $temp)
			echo '<li> Nama : ' . $temp->nama .'<br>&nbsp;&nbsp;&nbsp;&nbsp;NIM' .' <strong>' . $temp->nim . '</strong></li>'.'<br>';
});

Route::get('relasi-4', function() {

		# Bila kita ingin melihat hobi saya
		$novay = Mahasiswa::where('nama', '=', 'Noviyanto Rachmadi')->first();

		# Tampilkan seluruh hobi si novay
		foreach ($novay->hobi as $temp) 
			echo '<li>' . $temp->hobi . '</li>';
});

Route::get('relasi-5', function() {

		# Temukan hobi Mandi Hujan
		$mandi_hujan = Hobi::where('hobi', '=', 'Mandi Hujan')->first();

		# Tampilkan semua mahasiswa yang punya hobi mandi hujan
		foreach ($mandi_hujan->mahasiswa as $temp)
			echo '<li> Nama : ' . $temp->nama . ' <strong>' . $temp->nim . '</strong></li>';
});

Route::get('eloquent', function() {

		# Ambil semua data mahasiswa (lengkap dengan semua relasi yang ada)
		$mahasiswa = Mahasiswa::with('wali', 'dosen', 'hobi')->get();

		# Kirim variabel ke View
		return View::make('eloquent', compact('mahasiswa'));
	});

