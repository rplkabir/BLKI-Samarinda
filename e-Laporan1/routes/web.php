<?php
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/logout','Auth\LoginController@userLogout')->name('user.logout');

Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/admin/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login','Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('/admin/logout','Auth\AdminLoginController@logout')->name('admin.logout');

Route::get('profile','ProfileController@index')->name('profile');
Route::get('/profile/tambah','ProfileController@create');
Route::post('/profile/simpan','ProfileController@store');
Route::get('/profile/edit/{id}','ProfileController@edit');
Route::post('/profile/update/{id}','ProfileController@update');


Route::get('/admin/profile/', 'AdminController@indexProfile')->name('admin.profile');
Route::get('/admin/profile/detail/{id}', 'AdminController@detailProfile');

//admin kelola user
Route::get('/admin/user','AdminController@indexUser')->name('admin.user');
Route::get('/admin/user/tambah','AdminController@formAddUser')->name('admin.user.add');
Route::post('/admin/user/simpan','AdminController@addUser')->name('admin.user.store');
Route::get('/admin/user/hapus/{id}','AdminController@hapusUser');
Route::get('/admin/user/edit/{id}','AdminController@editUser');
Route::post('/admin/user/update/{id}','AdminController@updateUser');

//admin kelola dokumen
Route::get('/admin/dokumen/','DokumenController@index')->name('dokumen');
Route::get('/admin/dokumen/tambah','DokumenController@create')->name('dokumen.add');
Route::post('/admin/dokumen/simpan','DokumenController@store')->name('dokumen.store');
Route::get('/admin/dokumen/edit/{id}','DokumenController@edit');
Route::get('/admin/dokumen/hapus/{id}','DokumenController@destroy');

//admin renlakgiat
Route::get('/admin/renlakgiat','RenlakgiatController@indexadmin')->name('admin.renlakgiat');
Route::get('/admin/renlakgiat/tambah/{id}','RenlakgiatController@create');
Route::get('/admin/renlakgiat/tambah/excel/{id}','RenlakgiatController@uploadform');
Route::post('/admin/renlakgiat/simpan','RenlakgiatController@store');
Route::get('/admin/renlakgiat/edit/{id}','RenlakgiatController@edit');
Route::post('/admin/renlakgiat/update/{id}','RenlakgiatController@update');
Route::get('/admin/renlakgiat/hapus/{id}','RenlakgiatController@destroy');

Route::get('/admin/renlakgiat/{id}','RenlakgiatController@uptdrenlakgiat');
Route::get('/admin/renlakgiat/detail/{id}','RenlakgiatController@detailrenlakgiat');
Route::get('/admin/renlakgiat/laporan/{id}','RenlakgiatController@detailRenlakgiat');
Route::post('/admin/renlakgiat/upload/{id}', 'RenlakgiatController@upload');
Route::get('/admin/renlakgiat/editTanggal/{id}','RenlakgiatController@editTanggal');
Route::post('/admin/renlakgiat/updateTanggal/{id}', 'RenlakgiatController@updateTanggal');
Route::get('/admin/pktp/{id}','AdminController@indexPktp');

//admin verifikasi
Route::get('admin/renlakgiat/laporan/cover/tambah/{id}','adminController@formCover');
Route::post('admin/renlakgiat/laporan/cover/simpan/{id}','adminController@uploadCover');
Route::get('admin/renlakgiat/laporan/pendahuluan/tambah/{id}','adminController@formPendahuluan');
Route::post('admin/renlakgiat/laporan/pendahuluan/simpan/{id}','adminController@uploadPendahuluan');
Route::get('admin/renlakgiat/laporan/sk/tambah/{id}','AdminController@formSK');
Route::post('admin/renlakgiat/laporan/sk/simpan/{id}','AdminController@uploadSK');
Route::get('admin/renlakgiat/laporan/npp/tambah/{id}','AdminController@formNPP');
Route::post('admin/renlakgiat/laporan/npp/simpan/{id}','AdminController@uploadNPP');
Route::get('admin/renlakgiat/laporan/ni/tambah/{id}','AdminController@formNI');
Route::post('admin/renlakgiat/laporan/ni/simpan/{id}','AdminController@uploadNI');
Route::get('admin/renlakgiat/laporan/kurikulum/tambah/{id}','AdminController@formKurikulum');
Route::post('admin/renlakgiat/laporan/kurikulum/simpan/{id}','AdminController@uploadKurikulum');
Route::get('admin/renlakgiat/laporan/jpm/tambah/{id}','AdminController@formJpm');
Route::post('admin/renlakgiat/laporan/jpm/simpan/{id}','AdminController@uploadJpm');
Route::get('admin/renlakgiat/laporan/dhi/tambah/{id}','AdminController@formDhi');
Route::post('admin/renlakgiat/laporan/dhi/simpan/{id}','AdminController@uploadDhi');
Route::get('admin/renlakgiat/laporan/djmi/tambah/{id}','AdminController@formDjmi');
Route::post('admin/renlakgiat/laporan/djmi/simpan/{id}','AdminController@uploadDjmi');
Route::get('admin/renlakgiat/laporan/dhpp/tambah/{id}','AdminController@formDhpp');
Route::post('admin/renlakgiat/laporan/dhpp/simpan/{id}','AdminController@uploadDhpp');
Route::get('admin/renlakgiat/laporan/dpbl/tambah/{id}','AdminController@formDpbl');
Route::post('admin/renlakgiat/laporan/dpbl/simpan/{id}','AdminController@uploadDpbl');
Route::get('admin/renlakgiat/laporan/bpbl/tambah/{id}','AdminController@formBpbl');
Route::post('admin/renlakgiat/laporan/bpbl/simpan/{id}','AdminController@uploadBpbl');
Route::get('admin/renlakgiat/laporan/lmpbl/tambah/{id}','AdminController@formLmpbl');
Route::post('admin/renlakgiat/laporan/lmpbl/simpan/{id}','AdminController@uploadLmpbl');
Route::get('admin/renlakgiat/laporan/usk/tambah/{id}','AdminController@formUsk');
Route::post('admin/renlakgiat/laporan/usk/simpan/{id}','AdminController@uploadUsk');
Route::get('admin/renlakgiat/laporan/bask/tambah/{id}','AdminController@formBask');
Route::post('admin/renlakgiat/laporan/bask/simpan/{id}','AdminController@uploadBask');
Route::get('admin/renlakgiat/laporan/dhpsk/tambah/{id}','AdminController@formDhpsk');
Route::post('admin/renlakgiat/laporan/dhpsk/simpan/{id}','AdminController@uploadDhpsk');
Route::get('admin/renlakgiat/laporan/dna/tambah/{id}','AdminController@formDna');
Route::post('admin/renlakgiat/laporan/dna/simpan/{id}','AdminController@uploadDna');
Route::get('admin/renlakgiat/laporan/rppbk/tambah/{id}','AdminController@formRppbk');
Route::post('admin/renlakgiat/laporan/rppbk/simpan/{id}','AdminController@uploadRppbk');
Route::get('admin/renlakgiat/laporan/rahp/tambah/{id}','AdminController@formRahp');
Route::post('admin/renlakgiat/laporan/rahp/simpan/{id}','AdminController@uploadRahp');
Route::get('admin/renlakgiat/laporan/tttp/tambah/{id}','AdminController@formTttp');
Route::post('admin/renlakgiat/laporan/tttp/simpan/{id}','AdminController@uploadTttp');
Route::get('admin/renlakgiat/laporan/ttap/tambah/{id}','AdminController@formTtap');
Route::post('admin/renlakgiat/laporan/ttap/simpan/{id}','AdminController@uploadTtap');
Route::get('admin/renlakgiat/laporan/ttpkp/tambah/{id}','AdminController@formTtpkp');
Route::post('admin/renlakgiat/laporan/ttpkp/simpan/{id}','AdminController@uploadTtpkp');
Route::get('admin/renlakgiat/laporan/ttatkp/tambah/{id}','AdminController@formTtatkp');
Route::post('admin/renlakgiat/laporan/ttatkp/simpan/{id}','AdminController@uploadTtatkp');
Route::get('admin/renlakgiat/laporan/ttm/tambah/{id}','AdminController@formTtm');
Route::post('admin/renlakgiat/laporan/ttm/simpan/{id}','AdminController@uploadTtm');
Route::get('admin/renlakgiat/laporan/ttkp/tambah/{id}','AdminController@formTtkp');
Route::post('admin/renlakgiat/laporan/ttkp/simpan/{id}','AdminController@uploadTtkp');
Route::get('admin/renlakgiat/laporan/fdk/tambah/{id}','AdminController@formFdk');
Route::post('admin/renlakgiat/laporan/fdk/simpan/{id}','AdminController@uploadFdk');
Route::get('admin/renlakgiat/laporan/fsp/tambah/{id}','AdminController@formFsp');
Route::post('admin/renlakgiat/laporan/fsp/simpan/{id}','AdminController@uploadFsp');

Route::get('/admin/cetak/{id}','AdminController@mergePdf');
Route::post('/admin/renlakgiat/cari','AdminController@cari');

Route::get('admin/edit-tanggal-laporan/{id}','AdminController@formEditTanggalLaporan');
Route::post('admin/updateTanggalLaporan/{id}','AdminController@updateTanggalLaporan');

Route::get('admin/dokumenuptd','AdminController@dokumenuptd');
Route::get('admin/detailhistori/{id}','RenlakgiatController@histori');

Route::get('/admin/editemail/{id}','AdminController@editemail');
Route::post('/admin/updateemail/{id}', 'AdminController@updateEmail');

Route::get('/admin/editpass/{id}','AdminController@editpass');
Route::post('/admin/updatepass/{id}', 'AdminController@verif');

Route::get('/admin/draf/{id}','AdminController@cetakDraf');

//uptd renlakgiat
Route::get('/uptd/renlakgiat','UptdController@indexRenlakgiat')->name('uptd.renlakgiat');
Route::get('/uptd/laporan/detail/{id}','UptdController@detailRenlakgiat');
Route::get('/uptd/renlakgiat/edit/{id}','UptdController@editRenlakgiat');
Route::post('/uptd/renlakgiat/update/{id}','UptdController@updateRenlakgiat');
Route::get('/uptd/cetak/{id}','UptdController@mergePdf');

//Route Laporan
Route::get('uptd/renlakgiat/laporan/cover/tambah/{id}','UptdController@formCover');
Route::post('uptd/renlakgiat/laporan/cover/simpan/{id}','UptdController@uploadCover');
Route::get('uptd/renlakgiat/laporan/pendahuluan/tambah/{id}','UptdController@formPendahuluan');
Route::post('uptd/renlakgiat/laporan/pendahuluan/simpan/{id}','UptdController@uploadPendahuluan');
Route::get('uptd/renlakgiat/laporan/sk/tambah/{id}','UptdController@formSK');
Route::post('uptd/renlakgiat/laporan/sk/simpan/{id}','UptdController@uploadSK');
Route::get('uptd/renlakgiat/laporan/npp/tambah/{id}','UptdController@formNPP');
Route::post('uptd/renlakgiat/laporan/npp/simpan/{id}','UptdController@uploadNPP');
Route::get('uptd/renlakgiat/laporan/ni/tambah/{id}','UptdController@formNI');
Route::post('uptd/renlakgiat/laporan/ni/simpan/{id}','UptdController@uploadNI');
Route::get('uptd/renlakgiat/laporan/kurikulum/tambah/{id}','UptdController@formKurikulum');
Route::post('uptd/renlakgiat/laporan/kurikulum/simpan/{id}','UptdController@uploadKurikulum');
Route::get('uptd/renlakgiat/laporan/jpm/tambah/{id}','UptdController@formJpm');
Route::post('uptd/renlakgiat/laporan/jpm/simpan/{id}','UptdController@uploadJpm');
Route::get('uptd/renlakgiat/laporan/dhi/tambah/{id}','UptdController@formDhi');
Route::post('uptd/renlakgiat/laporan/dhi/simpan/{id}','UptdController@uploadDhi');
Route::get('uptd/renlakgiat/laporan/djmi/tambah/{id}','UptdController@formDjmi');
Route::post('uptd/renlakgiat/laporan/djmi/simpan/{id}','UptdController@uploadDjmi');
Route::get('uptd/renlakgiat/laporan/dhpp/tambah/{id}','UptdController@formDhpp');
Route::post('uptd/renlakgiat/laporan/dhpp/simpan/{id}','UptdController@uploadDhpp');
Route::get('uptd/renlakgiat/laporan/dpbl/tambah/{id}','UptdController@formDpbl');
Route::post('uptd/renlakgiat/laporan/dpbl/simpan/{id}','UptdController@uploadDpbl');
Route::get('uptd/renlakgiat/laporan/bpbl/tambah/{id}','UptdController@formBpbl');
Route::post('uptd/renlakgiat/laporan/bpbl/simpan/{id}','UptdController@uploadBpbl');
Route::get('uptd/renlakgiat/laporan/lmpbl/tambah/{id}','UptdController@formLmpbl');
Route::post('uptd/renlakgiat/laporan/lmpbl/simpan/{id}','UptdController@uploadLmpbl');
Route::get('uptd/renlakgiat/laporan/usk/tambah/{id}','UptdController@formUsk');
Route::post('uptd/renlakgiat/laporan/usk/simpan/{id}','UptdController@uploadUsk');
Route::get('uptd/renlakgiat/laporan/bask/tambah/{id}','UptdController@formBask');
Route::post('uptd/renlakgiat/laporan/bask/simpan/{id}','UptdController@uploadBask');
Route::get('uptd/renlakgiat/laporan/dhpsk/tambah/{id}','UptdController@formDhpsk');
Route::post('uptd/renlakgiat/laporan/dhpsk/simpan/{id}','UptdController@uploadDhpsk');
Route::get('uptd/renlakgiat/laporan/dna/tambah/{id}','UptdController@formDna');
Route::post('uptd/renlakgiat/laporan/dna/simpan/{id}','UptdController@uploadDna');
Route::get('uptd/renlakgiat/laporan/rppbk/tambah/{id}','UptdController@formRppbk');
Route::post('uptd/renlakgiat/laporan/rppbk/simpan/{id}','UptdController@uploadRppbk');
Route::get('uptd/renlakgiat/laporan/rahp/tambah/{id}','UptdController@formRahp');
Route::post('uptd/renlakgiat/laporan/rahp/simpan/{id}','UptdController@uploadRahp');
Route::get('uptd/renlakgiat/laporan/tttp/tambah/{id}','UptdController@formTttp');
Route::post('uptd/renlakgiat/laporan/tttp/simpan/{id}','UptdController@uploadTttp');
Route::get('uptd/renlakgiat/laporan/ttap/tambah/{id}','UptdController@formTtap');
Route::post('uptd/renlakgiat/laporan/ttap/simpan/{id}','UptdController@uploadTtap');
Route::get('uptd/renlakgiat/laporan/ttpkp/tambah/{id}','UptdController@formTtpkp');
Route::post('uptd/renlakgiat/laporan/ttpkp/simpan/{id}','UptdController@uploadTtpkp');
Route::get('uptd/renlakgiat/laporan/ttatkp/tambah/{id}','UptdController@formTtatkp');
Route::post('uptd/renlakgiat/laporan/ttatkp/simpan/{id}','UptdController@uploadTtatkp');
Route::get('uptd/renlakgiat/laporan/ttm/tambah/{id}','UptdController@formTtm');
Route::post('uptd/renlakgiat/laporan/ttm/simpan/{id}','UptdController@uploadTtm');
Route::get('uptd/renlakgiat/laporan/ttkp/tambah/{id}','UptdController@formTtkp');
Route::post('uptd/renlakgiat/laporan/ttkp/simpan/{id}','UptdController@uploadTtkp');
Route::get('uptd/renlakgiat/laporan/fdk/tambah/{id}','UptdController@formFdk');
Route::post('uptd/renlakgiat/laporan/fdk/simpan/{id}','UptdController@uploadFdk');
Route::get('uptd/renlakgiat/laporan/fsp/tambah/{id}','UptdController@formFsp');
Route::post('uptd/renlakgiat/laporan/fsp/simpan/{id}','UptdController@uploadFsp');

Route::get('/uptd/sendEmail/{id}','UptdController@sendEmail');

//uptd ubah password
Route::get('/uptd/editpass/{id}','UptdController@editpass');
Route::post('/uptd/editpass/update/{id}', 'UptdController@verif');
Route::get('/uptd/editemail/{id}','ProfileController@editemail');
Route::post('/uptd/updateemail/{id}', 'ProfileController@updateEmail');
Route::get('/uptd/renlakgiat/cetak/','UptdController@cetakRenlakgiat');

//uptd kelola pktp
Route::get('uptd/pktp/{id}','PktpController@indexpktp');
Route::get('uptd/pktp/edit/{id}','PktpController@editpktp');
Route::get('uptd/pktp/tambah/{id}','PktpController@create');
Route::post('uptd/pktp/update/{id}','PktpController@update');
Route::post('uptd/pktp/simpan','PktpController@store');
Route::get('uptd/pktp/hapus/{id}','PktpController@destroy');
Route::get('/uptd/dokumen','UptdController@indexDokumen')->name('uptd.dokumen');

Route::get('uptd/dokumen/index','DokumenUptdController@index');
Route::get('uptd/dokumen/upload','DokumenUptdController@create');
Route::post('uptd/dokumen/simpan','DokumenUptdController@store');
Route::get('uptd/dokumen/hapus/{id}','DokumenUptdController@destroy');

Route::get('/markAsRead', function() {
	$user = App\Admin::find(1);

foreach ($user->unreadNotifications as $notification) {
    $notification->markAsRead();
}
});

Route::get('/usermark', function()
{
	Auth::user()->unreadNotifications->markAsRead();
}
);

Route::get('/notifreload', function() {
	return view ('layouts.notif');
});

Route::get('/notifcommentreload', function() {
	return view ('layouts.notifcomment');
});

Route::get('/notifcommentreloaduptd', function() {
	return view ('layouts.notifcommentuptd');
});

Route::get('/admin/laporanuptd', 'DokumenController@laporanuptd');

Route::get('/uptd/commentadmin', function() {
	return view ('dokumenuptd.commentadmin');
});
