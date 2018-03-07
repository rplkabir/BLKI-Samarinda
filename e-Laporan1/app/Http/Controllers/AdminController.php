<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Profile;
use App\User;
use App\Renlakgiat;
use App\Pktp;
use App\Admin;
use App\Dokumen;
use App\DokumenUptd;
use Lava;
use Charts;
use Notification;
use Session;
use PDFMerger;

use iio\libmergepdf\Merger;
use iio\libmergepdf\Pages;
use Symfony\Component\Finder\Finder;
use setasign\Fpdi;
use Storage;
use Zipper;
use App\Notifications\Catatan;
use Auth;
use Hash;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Profile::all();
            return view('admin', compact('user'));
    }

    public function Renlakgiatdata(){
        $renlakgiat = Renlakgiat::all();
        return view(compact('renlakgiat'));
    }

    public function indexProfile(){
        $profile = Profile::paginate(5);
        return view('admin.indexProfile', compact('profile','notif','renlakgiat'));
    }

    public function detailProfile($id){

        $profile = Profile::where('users_id',$id)->get();
        return view('admin.detailProfile', compact('profile','notif'));
    }

    public function indexUser(){

        $user = User::all();
        return view('admin.indexUser', compact('user','notif','passEncrypt'));
    }

    public function formAddUser(){

        return view('admin.add-user', compact('notif'));
    }

    public function addUser(Request $request){
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        Session::flash('message', 'Berhasil menambah data user');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('admin.user');
    }

    public function hapusUser($id){
        $user = User::find($id);
        $user->delete();
        Session::flash('message', 'Berhasil hapus data renlakgiat');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('admin.user');
    }

    public function editUser($id){

        $user = User::where('id','=',$id)->get();
        return view('admin.editUser', compact('user','notif'));
    }

    public function updateUser($id, Request $request){
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        Session::flash('message', 'Berhasil update data user');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('admin.user');
    }

    public function indexPktp($id){
        $pktp = Pktp::where('users_id',$id)->orderBy('nama','asc')->paginate(5);
        return view('admin.indexpktp', compact('pktp'), compact('renlakgiat'));
    }

    public function formCover($id){
        $renlakgiat = Renlakgiat::find($id);
        return view('admin.formCover', compact('renlakgiat'));
    }


    public function uploadCover(Request $request, $id){
        $this->validate($request, [
            'status_cover' => 'required',
            'catatan_cover' => 'required',
        ]);
            $renlakgiat = Renlakgiat::find($id);
            $renlakgiat->status_cover = $request->status_cover;
            $renlakgiat->catatan_cover = $request->catatan_cover;
            $renlakgiat->save();
            Session::flash('message', 'Berhasil Update Data Status dan Catatan Cover');
            Session::flash('alert-class', 'alert-success');

            $renlakgiatz = Renlakgiat::where('id', $id)->get();
            foreach ($renlakgiatz as $key => $valuer) {
            $nama = $valuer->kejuruan;
            $usrid = $valuer->users_id;
            }
            $jenis = "Cover";
            $aidi = $id;
            $status = $request->status_cover;
            $user = User::where('id', $usrid)->get();
            foreach ($user as $key => $pengguna) {
               $pengguna->notify(new Catatan($jenis, $nama, $aidi, $status));
            }

            return redirect('admin/renlakgiat/laporan/'.$request->id);
    }

    public function formPendahuluan($id){
        $renlakgiat = Renlakgiat::find($id);
        return view('admin.formPendahuluan', compact('renlakgiat'));
    }


    public function uploadPendahuluan($id, Request $request ){
        $this->validate($request, [
            'status_pendahuluan' => 'required',
            'catatan_pendahuluan' => 'required',
        ]);
            $renlakgiat = Renlakgiat::find($id);
            $renlakgiat->status_pendahuluan = $request->status_pendahuluan;
            $renlakgiat->catatan_pendahuluan = $request->catatan_pendahuluan;
            $renlakgiat->save();
            Session::flash('message', 'Berhasil Update Data Status dan Catatan Pendahuluan');
            Session::flash('alert-class', 'alert-success');

            $renlakgiatz = Renlakgiat::where('id', $id)->get();
            foreach ($renlakgiatz as $key => $valuer) {
            $nama = $valuer->kejuruan;
            $usrid = $valuer->users_id;
            }
            $jenis = "Pendahuluan";
            $aidi = $id;
            $status = $request->status_pendahuluan;
            $user = User::where('id', $usrid)->get();
            foreach ($user as $key => $pengguna) {
               $pengguna->notify(new Catatan($jenis, $nama, $aidi, $status));
            }

            return redirect('admin/renlakgiat/laporan/'.$request->id);
    }
    public function formSK($id){
        $renlakgiat = Renlakgiat::find($id);
        return view('admin.formSK', compact('renlakgiat'));
    }


    public function uploadSK($id, Request $request ){
        $this->validate($request,[
            'status_surat_keputusan' => 'required',
            'catatan_surat_keputusan' => 'required',
        ]);

                $renlakgiat = Renlakgiat::find($id);
                $renlakgiat->status_surat_keputusan = $request->status_surat_keputusan;
                $renlakgiat->catatan_surat_keputusan = $request->catatan_surat_keputusan;
                $renlakgiat->save();
                Session::flash('message', 'Berhasil Update Data Status dan Catatan Surat Keputusan');
                Session::flash('alert-class', 'alert-success');

                $renlakgiatz = Renlakgiat::where('id', $id)->get();
                foreach ($renlakgiatz as $key => $valuer) {
                $nama = $valuer->kejuruan;
                $usrid = $valuer->users_id;
                }
                $jenis = "Surat Keputusan";
                $aidi = $id;
                $status = $request->status_surat_keputusan;
                $user = User::where('id', $usrid)->get();
                foreach ($user as $key => $pengguna) {
                   $pengguna->notify(new Catatan($jenis, $nama, $aidi, $status));
                }

                return redirect('admin/renlakgiat/laporan/'.$request->id);
    }

    public function formNPP($id){
        $renlakgiat = Renlakgiat::find($id);
        return view('admin.formNPP', compact('renlakgiat'));
    }


    public function uploadNPP($id, Request $request ){
        $this->validate($request,[
            'status_nominatif_peserta_pelatihan' => 'required',
            'catatan_nominatif_peserta_pelatihan' => 'required',
        ]);



            $renlakgiat = Renlakgiat::find($id);
            $renlakgiat->status_nominatif_peserta_pelatihan = $request->status_nominatif_peserta_pelatihan;
            $renlakgiat->catatan_nominatif_peserta_pelatihan = $request->catatan_nominatif_peserta_pelatihan;

            $renlakgiat->save();
            Session::flash('message', 'Berhasil Update Data Status dan Catatan Nominatif Peserta Pelatihan');
            Session::flash('alert-class', 'alert-success');

            $renlakgiatz = Renlakgiat::where('id', $id)->get();
                foreach ($renlakgiatz as $key => $valuer) {
                $nama = $valuer->kejuruan;
                $usrid = $valuer->users_id;
                }
                $jenis = "Nominatif Peserta Pelatihan";
                $aidi = $id;
                $status = $request->status_nominatif_peserta_pelatihan;
                $user = User::where('id', $usrid)->get();
                foreach ($user as $key => $pengguna) {
                   $pengguna->notify(new Catatan($jenis, $nama, $aidi, $status));
                }


            return redirect('admin/renlakgiat/laporan/'.$request->id);
    }

    public function formNI($id){
        $renlakgiat = Renlakgiat::find($id);
        return view('admin.formNI', compact('renlakgiat'));
    }


    public function uploadNI($id, Request $request ){
        $this->validate($request,[
            'status_nominatif_instruktur' => 'required',
            'catatan_nominatif_instruktur' => 'required',
        ]);


            $renlakgiat = Renlakgiat::find($id);
            $renlakgiat->status_nominatif_instruktur = $request->status_nominatif_instruktur;
            $renlakgiat->catatan_nominatif_instruktur = $request->catatan_nominatif_instruktur;

            $renlakgiat->save();
            Session::flash('message', 'Berhasil Update Status dan Catatan Nominatif Instruktur');
            Session::flash('alert-class', 'alert-success');

            $renlakgiatz = Renlakgiat::where('id', $id)->get();
                foreach ($renlakgiatz as $key => $valuer) {
                $nama = $valuer->kejuruan;
                $usrid = $valuer->users_id;
                }
                $jenis = "Nominatif Instruktur";
                $aidi = $id;
                $status = $request->status_nominatif_instruktur;
                $user = User::where('id', $usrid)->get();
                foreach ($user as $key => $pengguna) {
                   $pengguna->notify(new Catatan($jenis, $nama, $aidi, $status));
                }

            return redirect('admin/renlakgiat/laporan/'.$request->id);
    }

    public function formKurikulum($id){
        $renlakgiat = Renlakgiat::find($id);
        return view('admin.formKurikulum', compact('renlakgiat'));
    }


    public function uploadKurikulum($id, Request $request ){
        $this->validate($request,[
            'status_kurikulum' => 'required',
            'catatan_kurikulum' => 'required',
        ]);

            $renlakgiat = Renlakgiat::find($id);
            $renlakgiat->status_kurikulum = $request->status_kurikulum;
            $renlakgiat->catatan_kurikulum = $request->catatan_kurikulum;

            $renlakgiat->save();
            Session::flash('message', 'Berhasil Update Status dan Catatan Kurikulum');
            Session::flash('alert-class', 'alert-success');

              $renlakgiatz = Renlakgiat::where('id', $id)->get();
                foreach ($renlakgiatz as $key => $valuer) {
                $nama = $valuer->kejuruan;
                $usrid = $valuer->users_id;
                }
                $jenis = "Kurikulum";
                $aidi = $id;
                $status = $request->status_kurikulum;
                $user = User::where('id', $usrid)->get();
                foreach ($user as $key => $pengguna) {
                   $pengguna->notify(new Catatan($jenis, $nama, $aidi, $status));
                }

            return redirect('admin/renlakgiat/laporan/'.$request->id);
    }

    public function formJpm($id){
        $renlakgiat = Renlakgiat::find($id);
        return view('admin.formJpm', compact('renlakgiat'));
    }


    public function uploadJpm($id, Request $request ){
         $this->validate($request,[
            'status_jadwal_pelatihan_mingguan' => 'required',
            'catatan_jadwal_pelatihan_mingguan' => 'required',
        ]);

            $renlakgiat = Renlakgiat::find($id);
            $renlakgiat->status_jadwal_pelatihan_mingguan = $request->status_jadwal_pelatihan_mingguan;
            $renlakgiat->catatan_jadwal_pelatihan_mingguan = $request->catatan_jadwal_pelatihan_mingguan;

            $renlakgiat->save();
            Session::flash('message', 'Berhasil Update Status dan Catatan Jadwal Pelatihan Mingguan');
            Session::flash('alert-class', 'alert-success');

            $renlakgiatz = Renlakgiat::where('id', $id)->get();
                foreach ($renlakgiatz as $key => $valuer) {
                $nama = $valuer->kejuruan;
                $usrid = $valuer->users_id;
                }
                $jenis = "Jadwal Pelatihan Mingguan";
                $aidi = $id;
                $status = $request->status_jadwal_pelatihan_mingguan;
                $user = User::where('id', $usrid)->get();
                foreach ($user as $key => $pengguna) {
                   $pengguna->notify(new Catatan($jenis, $nama, $aidi, $status));
                }

            return redirect('admin/renlakgiat/laporan/'.$request->id);
    }

    public function formDhi($id){
        $renlakgiat = Renlakgiat::find($id);
        return view('admin.formDhi', compact('renlakgiat'));
    }


    public function uploadDhi($id, Request $request ){
        $this->validate($request,[
            'status_daftar_hadir_instruktur' => 'required',
            'catatan_daftar_hadir_instruktur' => 'required',
        ]);

            $renlakgiat = Renlakgiat::find($id);
            $renlakgiat->status_daftar_hadir_instruktur = $request->status_daftar_hadir_instruktur;
            $renlakgiat->catatan_daftar_hadir_instruktur = $request->catatan_daftar_hadir_instruktur;

            $renlakgiat->save();
            Session::flash('message', 'Berhasil Update Status dan Catatan Daftar Hadir Instruktur');
            Session::flash('alert-class', 'alert-success');

            $renlakgiatz = Renlakgiat::where('id', $id)->get();
                foreach ($renlakgiatz as $key => $valuer) {
                $nama = $valuer->kejuruan;
                $usrid = $valuer->users_id;
                }
                $jenis = "Daftar Hadir Instruktur";
                $aidi = $id;
                $status = $request->status_daftar_hadir_instruktur;
                $user = User::where('id', $usrid)->get();
                foreach ($user as $key => $pengguna) {
                   $pengguna->notify(new Catatan($jenis, $nama, $aidi, $status));
                }


            return redirect('admin/renlakgiat/laporan/'.$request->id);
    }

    public function formDjmi($id){
        $renlakgiat = Renlakgiat::find($id);
        return view('admin.formDjmi', compact('renlakgiat'));
    }


    public function uploadDjmi($id, Request $request ){
        $this->validate($request,[
            'status_daftar_jam_mengajar_instruktur' => 'required',
            'catatan_daftar_jam_mengajar_instruktur' => 'required',
        ]);

            $renlakgiat = Renlakgiat::find($id);
            $renlakgiat->status_daftar_jam_mengajar_instruktur = $request->status_daftar_jam_mengajar_instruktur;
            $renlakgiat->catatan_daftar_jam_mengajar_instruktur = $request->catatan_daftar_jam_mengajar_instruktur;

            $renlakgiat->save();
            Session::flash('message', 'Berhasil Update Status dan Catatan Daftar Jam Mengajar Instruktur');
            Session::flash('alert-class', 'alert-success');

            $renlakgiatz = Renlakgiat::where('id', $id)->get();
                foreach ($renlakgiatz as $key => $valuer) {
                $nama = $valuer->kejuruan;
                $usrid = $valuer->users_id;
                }
                $jenis = "Daftar Jam Mengajar Instruktur";
                $aidi = $id;
                $status = $request->status_daftar_jam_mengajar_instruktur;
                $user = User::where('id', $usrid)->get();
                foreach ($user as $key => $pengguna) {
                   $pengguna->notify(new Catatan($jenis, $nama, $aidi, $status));
                }

            return redirect('admin/renlakgiat/laporan/'.$request->id);
    }

    public function formDhpp($id){
        $renlakgiat = Renlakgiat::find($id);
        return view('admin.formDhpp', compact('renlakgiat'));
    }


    public function uploadDhpp($id, Request $request ){
        $this->validate($request,[
            'status_daftar_hadir_peserta_pelatihan' => 'required',
            'catatan_daftar_hadir_peserta_pelatihan' => 'required',
        ]);


            $renlakgiat = Renlakgiat::find($id);

            $renlakgiat->status_daftar_hadir_peserta_pelatihan = $request->status_daftar_hadir_peserta_pelatihan;
            $renlakgiat->catatan_daftar_hadir_peserta_pelatihan = $request->catatan_daftar_hadir_peserta_pelatihan;

            $renlakgiat->save();
            Session::flash('message', 'Berhasil update status dan catatan Daftar Hadir Peserta Pelatihan');
            Session::flash('alert-class', 'alert-success');

            $renlakgiatz = Renlakgiat::where('id', $id)->get();
                foreach ($renlakgiatz as $key => $valuer) {
                $nama = $valuer->kejuruan;
                $usrid = $valuer->users_id;
                }
                $jenis = "Daftar Hadir Peserta Pelatihan";
                $aidi = $id;
                $status = $request->status_daftar_hadir_peserta_pelatihan;
                $user = User::where('id', $usrid)->get();
                foreach ($user as $key => $pengguna) {
                   $pengguna->notify(new Catatan($jenis, $nama, $aidi, $status));
                }

            return redirect('admin/renlakgiat/laporan/'.$request->id);
    }

    public function formDpbl($id){
        $renlakgiat = Renlakgiat::find($id);
        return view('admin.formDpbl', compact('renlakgiat'));
    }


    public function uploadDpbl($id, Request $request ){
        $this->validate($request,[
            'status_daftar_permintaan_bahan_pelatihan' => 'required',
            'catatan_daftar_permintaan_bahan_pelatihan' => 'required',
        ]);

            $renlakgiat = Renlakgiat::find($id);
            $renlakgiat->status_daftar_permintaan_bahan_pelatihan = $request->status_daftar_permintaan_bahan_pelatihan;
            $renlakgiat->catatan_daftar_permintaan_bahan_pelatihan = $request->catatan_daftar_permintaan_bahan_pelatihan;
            $renlakgiat->save();
            Session::flash('message', 'Berhasil update status dan catatan Daftar Permintaan Bahan Latihan');
            Session::flash('alert-class', 'alert-success');

             $renlakgiatz = Renlakgiat::where('id', $id)->get();
                foreach ($renlakgiatz as $key => $valuer) {
                $nama = $valuer->kejuruan;
                $usrid = $valuer->users_id;
                }
                $jenis = "Daftar Permintaan Bahan Pelatihan";
                $aidi = $id;
                $status = $request->status_daftar_permintaan_bahan_pelatihan;
                $user = User::where('id', $usrid)->get();
                foreach ($user as $key => $pengguna) {
                   $pengguna->notify(new Catatan($jenis, $nama, $aidi, $status));
                }

            return redirect('admin/renlakgiat/laporan/'.$request->id);
    }

    public function formBpbl($id){
        $renlakgiat = Renlakgiat::find($id);
        return view('admin.formBpbl', compact('renlakgiat'));
    }


    public function uploadBpbl($id, Request $request ){
        $this->validate($request,[
            'status_bukti_penerimaan_bahan_pelatihan' => 'required',
            'catatan_bukti_penerimaan_bahan_pelatihan' => 'required',
        ]);
            $renlakgiat = Renlakgiat::find($id);
            $renlakgiat->status_bukti_penerimaan_bahan_pelatihan = $request->status_bukti_penerimaan_bahan_pelatihan;
            $renlakgiat->catatan_bukti_penerimaan_bahan_pelatihan = $request->catatan_bukti_penerimaan_bahan_pelatihan;

            $renlakgiat->save();
            Session::flash('message', 'Berhasil update status dan catatan Bukti Penerimaan Bahan Pelatihan');
            Session::flash('alert-class', 'alert-success');

            $renlakgiatz = Renlakgiat::where('id', $id)->get();
                foreach ($renlakgiatz as $key => $valuer) {
                $nama = $valuer->kejuruan;
                $usrid = $valuer->users_id;
                }
                $jenis = "Daftar Penerimaan Bahan Pelatihan";
                $aidi = $id;
                $status = $request->status_bukti_penerimaan_bahan_pelatihan;
                $user = User::where('id', $usrid)->get();
                foreach ($user as $key => $pengguna) {
                   $pengguna->notify(new Catatan($jenis, $nama, $aidi, $status));
                }

            return redirect('admin/renlakgiat/laporan/'.$request->id);
    }

    public function formLmpbl($id){
        $renlakgiat = Renlakgiat::find($id);
        return view('admin.formLmpbl', compact('renlakgiat'));
    }


    public function uploadLmpbl($id, Request $request ){
        $this->validate($request,[
            'status_laporan_mingguan_penggunaan_bahan_pelatihan' => 'required',
            'catatan_laporan_mingguan_penggunaan_bahan_pelatihan' => 'required',
        ]);

            $renlakgiat = Renlakgiat::find($id);
            $renlakgiat->status_laporan_mingguan_penggunaan_bahan_pelatihan = $request->status_laporan_mingguan_penggunaan_bahan_pelatihan;
            $renlakgiat->catatan_laporan_mingguan_penggunaan_bahan_pelatihan = $request->catatan_laporan_mingguan_penggunaan_bahan_pelatihan;
            $renlakgiat->save();
            Session::flash('message', 'Berhasil update status dan catatan Laporan Mingguan Penggunaan Bahan Latihan');
            Session::flash('alert-class', 'alert-success');

            $renlakgiatz = Renlakgiat::where('id', $id)->get();
                foreach ($renlakgiatz as $key => $valuer) {
                $nama = $valuer->kejuruan;
                $usrid = $valuer->users_id;
                }
                $jenis = "Laporan Mingguan Penggunaan Bahan Pelatihan";
                $aidi = $id;
                $status = $request->status_laporan_mingguan_penggunaan_bahan_pelatihan;
                $user = User::where('id', $usrid)->get();
                foreach ($user as $key => $pengguna) {
                   $pengguna->notify(new Catatan($jenis, $nama, $aidi, $status));
                }

            return redirect('admin/renlakgiat/laporan/'.$request->id);
    }

    public function formUsk($id){
        $renlakgiat = Renlakgiat::find($id);
        return view('admin.formUsk', compact('renlakgiat'));
    }


    public function uploadUsk($id, Request $request ){
        $this->validate($request,[
            'status_undangan_sidang_kelulusan' => 'required',
            'catatan_undangan_sidang_kelulusan' => 'required',
        ]);
            $renlakgiat = Renlakgiat::find($id);
            $renlakgiat->status_undangan_sidang_kelulusan = $request->status_undangan_sidang_kelulusan;
            $renlakgiat->catatan_undangan_sidang_kelulusan = $request->catatan_undangan_sidang_kelulusan;
            $renlakgiat->save();
            Session::flash('message', 'Berhasil update status dan catatan Undangan Sidang Kelulusan');
            Session::flash('alert-class', 'alert-success');

            $renlakgiatz = Renlakgiat::where('id', $id)->get();
                foreach ($renlakgiatz as $key => $valuer) {
                $nama = $valuer->kejuruan;
                $usrid = $valuer->users_id;
                }
                $jenis = "Undangan Sidang Kelulusan";
                $aidi = $id;
                $status = $request->status_undangan_sidang_kelulusan;
                $user = User::where('id', $usrid)->get();
                foreach ($user as $key => $pengguna) {
                   $pengguna->notify(new Catatan($jenis, $nama, $aidi, $status));
                }

            return redirect('admin/renlakgiat/laporan/'.$request->id);
    }

    public function formBask($id){
        $renlakgiat = Renlakgiat::find($id);
        return view('admin.formBask', compact('renlakgiat'));
    }


    public function uploadBask($id, Request $request ){
        $this->validate($request,[
            'status_berita_acara_sidang_kelulusan' => 'required',
            'catatan_berita_acara_sidang_kelulusan' => 'required',
        ]);


            $renlakgiat = Renlakgiat::find($id);
            $renlakgiat->status_berita_acara_sidang_kelulusan = $request->status_berita_acara_sidang_kelulusan;
            $renlakgiat->catatan_berita_acara_sidang_kelulusan = $request->catatan_berita_acara_sidang_kelulusan;

            $renlakgiat->save();
            Session::flash('message', 'Berhasil update status dan catatan Berita Acara Sidang Kelulusan');
            Session::flash('alert-class', 'alert-success');

            $renlakgiatz = Renlakgiat::where('id', $id)->get();
                foreach ($renlakgiatz as $key => $valuer) {
                $nama = $valuer->kejuruan;
                $usrid = $valuer->users_id;
                }
                $jenis = "Berita Acara Sidang Kelulusan";
                $aidi = $id;
                $status = $request->status_berita_acara_sidang_kelulusan;
                $user = User::where('id', $usrid)->get();
                foreach ($user as $key => $pengguna) {
                   $pengguna->notify(new Catatan($jenis, $nama, $aidi, $status));
                }

            return redirect('admin/renlakgiat/laporan/'.$request->id);
    }

    public function formDhpsk($id){
        $renlakgiat = Renlakgiat::find($id);
        return view('admin.formDhpsk', compact('renlakgiat'));
    }


    public function uploadDhpsk($id, Request $request ){
        $this->validate($request,[
            'status_daftar_hadir_pertemuan_sidang_kelulusan' => 'required',
            'catatan_daftar_hadir_pertemuan_sidang_kelulusan' => 'required',
        ]);

            $renlakgiat = Renlakgiat::find($id);
            $renlakgiat->status_daftar_hadir_pertemuan_sidang_kelulusan = $request->status_daftar_hadir_pertemuan_sidang_kelulusan;
            $renlakgiat->catatan_daftar_hadir_pertemuan_sidang_kelulusan = $request->catatan_daftar_hadir_pertemuan_sidang_kelulusan;
            $renlakgiat->save();
            Session::flash('message', 'Berhasil update status dan catatan Daftar Hadir Pertemuan Sidang Kelulusan');
            Session::flash('alert-class', 'alert-success');

            $renlakgiatz = Renlakgiat::where('id', $id)->get();
                foreach ($renlakgiatz as $key => $valuer) {
                $nama = $valuer->kejuruan;
                $usrid = $valuer->users_id;
                }
                $jenis = "Daftar Hadir Sidang Kelulusan";
                $aidi = $id;
                $status = $request->status_daftar_hadir_pertemuan_sidang_kelulusan;
                $user = User::where('id', $usrid)->get();
                foreach ($user as $key => $pengguna) {
                   $pengguna->notify(new Catatan($jenis, $nama, $aidi, $status));
                }

            return redirect('admin/renlakgiat/laporan/'.$request->id);
    }

    public function formDna($id){
        $renlakgiat = Renlakgiat::find($id);
        return view('admin.formDna', compact('renlakgiat'));
    }


    public function uploadDna($id, Request $request ){
            $this->validate($request,[
                'status_daftar_nilai_akhir' => 'required',
                'catatan_daftar_nilai_akhir' => 'required',
            ]);

            $renlakgiat = Renlakgiat::find($id);
            $renlakgiat->status_daftar_nilai_akhir = $request->status_daftar_nilai_akhir;
            $renlakgiat->catatan_daftar_nilai_akhir = $request->catatan_daftar_nilai_akhir;

            $renlakgiat->save();
            Session::flash('message', 'Berhasil update status dan catatan Daftar Nilai Akhir');
            Session::flash('alert-class', 'alert-success');

            $renlakgiatz = Renlakgiat::where('id', $id)->get();
                foreach ($renlakgiatz as $key => $valuer) {
                $nama = $valuer->kejuruan;
                $usrid = $valuer->users_id;
                }
                $jenis = "Daftar Nilai Akhir";
                $aidi = $id;
                $status = $request->status_daftar_nilai_akhir;
                $user = User::where('id', $usrid)->get();
                foreach ($user as $key => $pengguna) {
                   $pengguna->notify(new Catatan($jenis, $nama, $aidi, $status));
                }

            return redirect('admin/renlakgiat/laporan/'.$request->id);
    }

    public function formRppbk($id){
        $renlakgiat = Renlakgiat::find($id);
        return view('admin.formRppbk', compact('renlakgiat'));
    }


    public function uploadRppbk($id, Request $request ){
            $this->validate($request,[
                'status_rekap_penilaian_pelatihan_berbasis_kompetensi' => 'required',
                'catatan_rekap_penilaian_pelatihan_berbasis_kompetensi' => 'required',
            ]);

            $renlakgiat = Renlakgiat::find($id);
            $renlakgiat->status_rekap_penilaian_pelatihan_berbasis_kompetensi = $request->status_rekap_penilaian_pelatihan_berbasis_kompetensi;
            $renlakgiat->catatan_rekap_penilaian_pelatihan_berbasis_kompetensi = $request->catatan_rekap_penilaian_pelatihan_berbasis_kompetensi;

            $renlakgiat->save();
            Session::flash('message', 'Berhasil Update status dan catatan Rekap Penilaian Pelatihan Berbasis Kompetensi');
            Session::flash('alert-class', 'alert-success');

            $renlakgiatz = Renlakgiat::where('id', $id)->get();
                foreach ($renlakgiatz as $key => $valuer) {
                $nama = $valuer->kejuruan;
                $usrid = $valuer->users_id;
                }
                $jenis = "Rekap Penilaian Berbasis Kompetensi";
                $aidi = $id;
                $status = $request->status_rekap_penilaian_pelatihan_berbasis_kompetensi;
                $user = User::where('id', $usrid)->get();
                foreach ($user as $key => $pengguna) {
                   $pengguna->notify(new Catatan($jenis, $nama, $aidi, $status));
                }

            return redirect('admin/renlakgiat/laporan/'.$request->id);
    }

    public function formRahp($id){
        $renlakgiat = Renlakgiat::find($id);
        return view('admin.formRahp', compact('renlakgiat'));
    }


    public function uploadRahp($id, Request $request ){
            $this->validate($request,[
                'status_rekapitulasi_akhir_hasil_pelatihan' => 'required',
                'catatan_rekapitulasi_akhir_hasil_pelatihan' => 'required',
            ]);
            $renlakgiat = Renlakgiat::find($id);
            $renlakgiat->status_rekapitulasi_akhir_hasil_pelatihan = $request->status_rekapitulasi_akhir_hasil_pelatihan;
            $renlakgiat->catatan_rekapitulasi_akhir_hasil_pelatihan = $request->catatan_rekapitulasi_akhir_hasil_pelatihan;

            $renlakgiat->save();
            Session::flash('message', 'Berhasil update status dan catatan Rekapitulasi Akhir hasil Pelatihan');
            Session::flash('alert-class', 'alert-success');

            $renlakgiatz = Renlakgiat::where('id', $id)->get();
                foreach ($renlakgiatz as $key => $valuer) {
                $nama = $valuer->kejuruan;
                $usrid = $valuer->users_id;
                }
                $jenis = "Rekap Akhir Hasil Pelatihan";
                $aidi = $id;
                $status = $request->status_rekapitulasi_akhir_hasil_pelatihan;
                $user = User::where('id', $usrid)->get();
                foreach ($user as $key => $pengguna) {
                   $pengguna->notify(new Catatan($jenis, $nama, $aidi, $status));
                }

            return redirect('admin/renlakgiat/laporan/'.$request->id);
    }

    public function formTttp($id){
        $renlakgiat = Renlakgiat::find($id);
        return view('admin.formTttp', compact('renlakgiat'));
    }


    public function uploadTttp($id, Request $request ){
            $this->validate($request,[
                'status_tanda_terima_transport_peserta' => 'required',
                'catatan_tanda_terima_transport_peserta' => 'required',
            ]);

            $renlakgiat = Renlakgiat::find($id);
            $renlakgiat->status_tanda_terima_transport_peserta = $request->status_tanda_terima_transport_peserta;
            $renlakgiat->catatan_tanda_terima_transport_peserta = $request->catatan_tanda_terima_transport_peserta;

            $renlakgiat->save();
            Session::flash('message', 'Berhasil update status dan catatan Tanda Terima Transport Peserta');
            Session::flash('alert-class', 'alert-success');

            $renlakgiatz = Renlakgiat::where('id', $id)->get();
                foreach ($renlakgiatz as $key => $valuer) {
                $nama = $valuer->kejuruan;
                $usrid = $valuer->users_id;
                }
                $jenis = "Tanda Terima Transport Peserta";
                $aidi = $id;
                $status = $request->status_tanda_terima_transport_peserta;
                $user = User::where('id', $usrid)->get();
                foreach ($user as $key => $pengguna) {
                   $pengguna->notify(new Catatan($jenis, $nama, $aidi, $status));
                }

            return redirect('admin/renlakgiat/laporan/'.$request->id);
    }

    public function formTtap($id){
        $renlakgiat = Renlakgiat::find($id);
        return view('admin.formTtap', compact('renlakgiat'));
    }


    public function uploadTtap($id, Request $request ){
            $this->validate($request,[
                'status_tanda_terima_asuransi_peserta' => 'required',
                'catatan_tanda_terima_asuransi_peserta' => 'required',
            ]);
            $renlakgiat = Renlakgiat::find($id);
            $renlakgiat->status_tanda_terima_asuransi_peserta = $request->status_tanda_terima_asuransi_peserta;
            $renlakgiat->catatan_tanda_terima_asuransi_peserta = $request->catatan_tanda_terima_asuransi_peserta;

            $renlakgiat->save();
            Session::flash('message', 'Berhasil update status dan catatan Tanda Terima kartu Asuransi Peserta');
            Session::flash('alert-class', 'alert-success');

            $renlakgiatz = Renlakgiat::where('id', $id)->get();
                foreach ($renlakgiatz as $key => $valuer) {
                $nama = $valuer->kejuruan;
                $usrid = $valuer->users_id;
                }
                $jenis = "Tanda Terima Asuransi Peserta";
                $aidi = $id;
                $status = $request->status_tanda_terima_asuransi_peserta;
                $user = User::where('id', $usrid)->get();
                foreach ($user as $key => $pengguna) {
                   $pengguna->notify(new Catatan($jenis, $nama, $aidi, $status));
                }

            return redirect('admin/renlakgiat/laporan/'.$request->id);
    }

    public function formTtpkp($id){
        $renlakgiat = Renlakgiat::find($id);
        return view('admin.formTtpkp', compact('renlakgiat'));
    }


    public function uploadTtpkp($id, Request $request ){
            $this->validate($request,[
                'status_tanda_terima_pakaian_kerja_peserta' => 'required',
                'catatan_tanda_terima_pakaian_kerja_peserta' => 'required',
            ]);
            $renlakgiat = Renlakgiat::find($id);
            $renlakgiat->status_tanda_terima_pakaian_kerja_peserta = $request->status_tanda_terima_pakaian_kerja_peserta;
            $renlakgiat->catatan_tanda_terima_pakaian_kerja_peserta = $request->catatan_tanda_terima_pakaian_kerja_peserta;

            $renlakgiat->save();
            Session::flash('message', 'Berhasil update status dan catatan Tanda Terima Pakaian Kerja Peserta');
            Session::flash('alert-class', 'alert-success');

            $renlakgiatz = Renlakgiat::where('id', $id)->get();
                foreach ($renlakgiatz as $key => $valuer) {
                $nama = $valuer->kejuruan;
                $usrid = $valuer->users_id;
                }
                $jenis = "Tanda Terima Pakaian Kerja";
                $aidi = $id;
                $status = $request->status_tanda_terima_pakaian_kerja_peserta;
                $user = User::where('id', $usrid)->get();
                foreach ($user as $key => $pengguna) {
                   $pengguna->notify(new Catatan($jenis, $nama, $aidi, $status));
                }

            return redirect('admin/renlakgiat/laporan/'.$request->id);
    }

    public function formTtatkp($id){
        $renlakgiat = Renlakgiat::find($id);
        return view('admin.formTtatkp', compact('renlakgiat'));
    }


    public function uploadTtatkp($id, Request $request ){
            $this->validate($request,[
                'status_tanda_terima_atk_peserta' => 'required',
                'catatan_tanda_terima_atk_peserta' => 'required',
            ]);
            $renlakgiat = Renlakgiat::find($id);
            $renlakgiat->status_tanda_terima_atk_peserta = $request->status_tanda_terima_atk_peserta;
            $renlakgiat->catatan_tanda_terima_atk_peserta = $request->catatan_tanda_terima_atk_peserta;

            $renlakgiat->save();
            Session::flash('message', 'Berhasil update status dan catatan Tanda Terima ATK Peserta');
            Session::flash('alert-class', 'alert-success');

            $renlakgiatz = Renlakgiat::where('id', $id)->get();
                foreach ($renlakgiatz as $key => $valuer) {
                $nama = $valuer->kejuruan;
                $usrid = $valuer->users_id;
                }
                $jenis = "Tanda Terima ATK Kerja";
                $aidi = $id;
                $status = $request->status_tanda_terima_atk_peserta;
                $user = User::where('id', $usrid)->get();
                foreach ($user as $key => $pengguna) {
                   $pengguna->notify(new Catatan($jenis, $nama, $aidi, $status));
                }

            return redirect('admin/renlakgiat/laporan/'.$request->id);
    }

    public function formTtm($id){
        $renlakgiat = Renlakgiat::find($id);
        return view('admin.formTtm', compact('renlakgiat'));
    }


    public function uploadTtm($id, Request $request ){
            $this->validate($request,[
                'status_tanda_terima_modul' => 'required',
                'catatan_tanda_terima_modul' => 'required',
            ]);
            $renlakgiat = Renlakgiat::find($id);
            $renlakgiat->status_tanda_terima_modul = $request->status_tanda_terima_modul;
            $renlakgiat->catatan_tanda_terima_modul = $request->catatan_tanda_terima_modul;
            $renlakgiat->save();
            Session::flash('message', 'Berhasil update status dan catatan Tanda Terima Modul');
            Session::flash('alert-class', 'alert-success');

            $renlakgiatz = Renlakgiat::where('id', $id)->get();
                foreach ($renlakgiatz as $key => $valuer) {
                $nama = $valuer->kejuruan;
                $usrid = $valuer->users_id;
                }
                $jenis = "Tanda Terima Modul";
                $aidi = $id;
                $status = $request->status_tanda_terima_modul;
                $user = User::where('id', $usrid)->get();
                foreach ($user as $key => $pengguna) {
                   $pengguna->notify(new Catatan($jenis, $nama, $aidi, $status));
                }

            return redirect('admin/renlakgiat/laporan/'.$request->id);
    }

    public function formTtkp($id){
        $renlakgiat = Renlakgiat::find($id);
        return view('admin.formTtkp', compact('renlakgiat'));
    }


    public function uploadTtkp($id, Request $request ){
            $this->validate($request,[
                'status_tanda_terima_konsumsi_peserta' => 'required',
                'catatan_tanda_terima_konsumsi_peserta' => 'required',
            ]);
            $renlakgiat = Renlakgiat::find($id);
            $renlakgiat->status_tanda_terima_konsumsi_peserta = $request->status_tanda_terima_konsumsi_peserta;
            $renlakgiat->catatan_tanda_terima_konsumsi_peserta = $request->catatan_tanda_terima_konsumsi_peserta;

            $renlakgiat->save();
            Session::flash('message', 'Berhasil update status dan catatan Tanda Terima Konsumsi Peserta');
            Session::flash('alert-class', 'alert-success');

            $renlakgiatz = Renlakgiat::where('id', $id)->get();
                foreach ($renlakgiatz as $key => $valuer) {
                $nama = $valuer->kejuruan;
                $usrid = $valuer->users_id;
                }
                $jenis = "Tanda Terima Konsumsi Peserta";
                $aidi = $id;
                $status = $request->status_tanda_terima_konsumsi_peserta;
                $user = User::where('id', $usrid)->get();
                foreach ($user as $key => $pengguna) {
                   $pengguna->notify(new Catatan($jenis, $nama, $aidi, $status));
                }

            return redirect('admin/renlakgiat/laporan/'.$request->id);
    }

    public function formFdk($id){
        $renlakgiat = Renlakgiat::find($id);
        return view('admin.formFdk', compact('renlakgiat'));
    }


    public function uploadFdk($id, Request $request ){
            $this->validate($request,[
                'status_foto_dokumentasi_kegiatan' => 'required',
                'catatan_foto_dokumentasi_kegiatan' => 'required',
            ]);
            $renlakgiat = Renlakgiat::find($id);
            $renlakgiat->status_foto_dokumentasi_kegiatan = $request->status_foto_dokumentasi_kegiatan;
            $renlakgiat->catatan_foto_dokumentasi_kegiatan = $request->catatan_foto_dokumentasi_kegiatan;

            $renlakgiat->save();
            Session::flash('message', 'Berhasil update status dan catatan Foto Dokumentasi Kegiatan');
            Session::flash('alert-class', 'alert-success');

            $renlakgiatz = Renlakgiat::where('id', $id)->get();
                foreach ($renlakgiatz as $key => $valuer) {
                $nama = $valuer->kejuruan;
                $usrid = $valuer->users_id;
                }
                $jenis = "Foto Dokumentasi Kegiatan";
                $aidi = $id;
                $status = $request->status_foto_dokumentasi_kegiatan;
                $user = User::where('id', $usrid)->get();
                foreach ($user as $key => $pengguna) {
                   $pengguna->notify(new Catatan($jenis, $nama, $aidi, $status));
                }

            return redirect('admin/renlakgiat/laporan/'.$request->id);
    }

     public function formFsp($id){
        $renlakgiat = Renlakgiat::find($id);
        return view('admin.formFsp', compact('renlakgiat'));
    }


    public function uploadFsp($id, Request $request ){
            $this->validate($request,[
                'status_fotocopy_sertifikasi_peserta' => 'required',
                'catatan_fotocopy_sertifikasi_peserta' => 'required',
            ]);
            $renlakgiat = Renlakgiat::find($id);
            $renlakgiat->status_fotocopy_sertifikasi_peserta = $request->status_fotocopy_sertifikasi_peserta;
            $renlakgiat->catatan_fotocopy_sertifikasi_peserta = $request->catatan_fotocopy_sertifikasi_peserta;

            $renlakgiat->save();
            Session::flash('message', 'Berhasil update status dan catatan Fotocopy Sertifikasi Peserta');
            Session::flash('alert-class', 'alert-success');

            $renlakgiatz = Renlakgiat::where('id', $id)->get();
                foreach ($renlakgiatz as $key => $valuer) {
                $nama = $valuer->kejuruan;
                $usrid = $valuer->users_id;
                }
                $jenis = "Fotocopy Sertifikasi Peserta";
                $aidi = $id;
                $status = $request->status_fotocopy_sertifikasi_peserta;
                $user = User::where('id', $usrid)->get();
                foreach ($user as $key => $pengguna) {
                   $pengguna->notify(new Catatan($jenis, $nama, $aidi, $status));
                }

            return redirect('admin/renlakgiat/laporan/'.$request->id);
    }
    public function mergePdf($id){
			$renlakgiat = Renlakgiat::where('id',$id)->get();
			foreach ($renlakgiat as $key) {
                $id = $key->id;
  				$cover = $key->cover;
  				$pendahuluan = $key->pendahuluan;
  				$surat_keputusan = $key->surat_keputusan;
                $nominatif_peserta_pelatihan = $key->nominatif_peserta_pelatihan;
                $nominatif_instruktur = $key->nominatif_instruktur;
                $kurikulum = $key->kurikulum;
                $jadwal_pelatihan_mingguan = $key->jadwal_pelatihan_mingguan;
                $daftar_hadir_instruktur = $key->daftar_hadir_instruktur;
                $daftar_jam_mengajar_instruktur = $key->daftar_jam_mengajar_instruktur;
                $daftar_hadir_peserta_pelatihan = $key->daftar_hadir_peserta_pelatihan;
                $daftar_permintaan_bahan_latihan = $key->daftar_permintaan_bahan_latihan;
                $bukti_penerimaan_bahan_pelatihan = $key->bukti_penerimaan_bahan_pelatihan;
                $laporan_mingguan_penggunaan_bahan_latihan = $key->laporan_mingguan_penggunaan_bahan_latihan;
                $undangan_sidang_kelulusan = $key->undangan_sidang_kelulusan;
                $berita_acara_sidang_kelulusan = $key->berita_acara_sidang_kelulusan;
                $daftar_hadir_pertemuan_sidang_kelulusan = $key->daftar_hadir_pertemuan_sidang_kelulusan;
                $daftar_nilai_akhir = $key->daftar_nilai_akhir;
                $rekap_penilaian_pelatihan_berbasis_kompetensi = $key->rekap_penilaian_pelatihan_berbasis_kompetensi;
                $rekapitulasi_akhir_hasil_pelatihan = $key->rekapitulasi_akhir_hasil_pelatihan;
                $tanda_terima_transport_peserta = $key->tanda_terima_transport_peserta;
                $tanda_terima_asuransi_peserta = $key->tanda_terima_asuransi_peserta;
                $tanda_terima_pakaian_kerja_peserta = $key->tanda_terima_pakaian_kerja_peserta;
                $tanda_terima_atk_peserta = $key->tanda_terima_atk_peserta;
                $tanda_terima_modul = $key->tanda_terima_modul;
                $tanda_terima_konsumsi_peserta = $key->tanda_terima_konsumsi_peserta;
                $foto_dokumentasi_kegiatan = $key->foto_dokumentasi_kegiatan;
                $fotocopy_sertifikasi_peserta = $key->fotocopy_sertifikasi_peserta;
			}

            $pdf = new \LynX39\LaraPdfMerger\PdfManage;

            $pdf->addPDF('upload/'.$cover, 'all');
            $pdf->addPDF('upload/'.$pendahuluan, 'all');
            $pdf->addPDF('upload/'.$surat_keputusan, 'all');
            $pdf->addPDF('upload/'.$nominatif_peserta_pelatihan, 'all');
            $pdf->addPDF('upload/'.$nominatif_instruktur, 'all');
            $pdf->addPDF('upload/'.$kurikulum, 'all');
            $pdf->addPDF('upload/'.$jadwal_pelatihan_mingguan, 'all');
            $pdf->addPDF('upload/'.$daftar_hadir_instruktur, 'all');
            $pdf->addPDF('upload/'.$daftar_jam_mengajar_instruktur, 'all');
            $pdf->addPDF('upload/'.$daftar_hadir_peserta_pelatihan, 'all');
            $pdf->addPDF('upload/'.$daftar_permintaan_bahan_latihan, 'all');
            $pdf->addPDF('upload/'.$bukti_penerimaan_bahan_pelatihan, 'all');
            $pdf->addPDF('upload/'.$laporan_mingguan_penggunaan_bahan_latihan, 'all');
            $pdf->addPDF('upload/'.$undangan_sidang_kelulusan, 'all');
            $pdf->addPDF('upload/'.$berita_acara_sidang_kelulusan, 'all');
            $pdf->addPDF('upload/'.$daftar_hadir_pertemuan_sidang_kelulusan, 'all');
            $pdf->addPDF('upload/'.$daftar_nilai_akhir, 'all');
            $pdf->addPDF('upload/'.$rekap_penilaian_pelatihan_berbasis_kompetensi, 'all');
            $pdf->addPDF('upload/'.$rekapitulasi_akhir_hasil_pelatihan, 'all');
            $pdf->addPDF('upload/'.$tanda_terima_transport_peserta, 'all');
            $pdf->addPDF('upload/'.$tanda_terima_asuransi_peserta, 'all');
            $pdf->addPDF('upload/'.$tanda_terima_pakaian_kerja_peserta, 'all');
            $pdf->addPDF('upload/'.$tanda_terima_atk_peserta, 'all');
            $pdf->addPDF('upload/'.$tanda_terima_modul, 'all');
            $pdf->addPDF('upload/'.$tanda_terima_konsumsi_peserta, 'all');
            $pdf->addPDF('upload/'.$foto_dokumentasi_kegiatan, 'all');
            $pdf->addPDF('upload/'.$fotocopy_sertifikasi_peserta, 'all');

            //You can optionally specify a different orientation for each PDF


            $pdf->merge('browser','Laporan Renlakgiat Id-'.$id.'.pdf');


            // Zipper::make('upload/Laporan'.$id.'.zip')->add(['upload/'.$cover,'upload/'.$pendahuluan,'upload/'.$surat_keputusan,'upload/'.$nominatif_peserta_pelatihan,'upload/'.$nominatif_instruktur]);
            // return response()->download('upload/Laporan'.$id.'.zip');
		}
        public function cari(Request $request){

            if ($request->cariK AND $request->cariP != "") {
                $renlakgiat = Renlakgiat::where('kejuruan','LIKE','%'.$request->cariK.'%')->where('program_pelatihan','LIKE','%'.$request->cariP.'%')->paginate(10);
            }elseif ($request->cariK != "" AND $request->cariP == "") {
                $renlakgiat = Renlakgiat::where('kejuruan','LIKE','%'.$request->cariK.'%')->paginate(10);
            }elseif ($request->cariK == "" AND $request->cariP != "") {
                $renlakgiat = Renlakgiat::where('program_pelatihan','LIKE','%'.$request->cariP.'%')->paginate(10);
            }

            return view('admin.indexRenlakgiat', compact('renlakgiat'));
        }

        public function formEditTanggalLaporan($id){
            $renlakgiat = Renlakgiat::find($id);
            return view('renlakgiat.editTanggalLaporan', compact('renlakgiat'));
        }

        public function updateTanggalLaporan($id, Request $request){
            $renlakgiat = Renlakgiat::find($id);
            $renlakgiat->tgl_kumpul_laporan = $request->new_tgl_kumpul_laporan;

            $renlakgiat->save();
            Session::flash('message','Berhasil Ubah Batas Pengumpulan Laporan');
            return redirect('admin/renlakgiat/laporan/'.$id);

        }

        public function dokumenuptd(){
            $dokumenuptd = DokumenUptd::orderBy('created_at','desc')->get();
            return view('dokumen.dokumenuptd', compact('dokumenuptd'));
        }

        public function editemail(){
          $admin = Admin::where('id',Auth::user()->id)->get();
          return view('profile.admineditemail', compact('admin'));
        }

        public function updateEmail($id, Request $request){

          $this->validate($request, [
              'newemail' => 'required|email',
              'password' => 'required|min:6',
          ]);
          $admin = Auth::user();
          $id = Auth::user()->id;
          $password = Hash::check($request->password, $admin->password);
          $check = Admin::where('password', $password)->where('id', $id)->get();

          if (Hash::check($request->password, $admin->password)) {
              $admin->email = $request->newemail;
              $admin->save();

              Session::flash('message', 'Berhasil Ubah Email');
              Session::flash('alert-class', 'alert-success');
              return redirect('profile');

          }
          else
          {
              Session::flash('message', 'Password salah!');
              Session::flash('alert-class', 'alert-danger');

              return redirect('/admin');
          }
        }
        public function editpass($id){
            $admin = Admin::where('id', $id)->get();
            return view('admin.editpass', compact('admin'));


        }
        public function verif(Request $request, $id){
            $this->validate($request, [
              'old' => 'required|min:6',
              'new' => 'required|min:6',
            ]);

            $admin = Auth::user();

            $old = $request->old;
            $new = $request->new;
            $confirm = $request->confirm;

            $admin = User::find($id);
            $check = User::where('password', $old)->where('id', $id)->get();
            $cek = count($check);




            if (Hash::check($old, $admin->password)) {
                $admin->password = bcrypt($new);
                $admin->save();

                Session::flash('message', 'Berhasil Ubah Password');
                Session::flash('alert-class', 'alert-success');
                return redirect('admin');

            }
            else
            {
                Session::flash('message', 'Password lama salah!');
                Session::flash('alert-class', 'alert-danger');

                return redirect()->back();
            }

        }
}
