<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Renlakgiat;
use App\Laporan;
use Auth;
use Carbon\Carbon;
use Hash;
use Session;
use App\User;
use App\Dokumen;
use App\Admin;
use App\Profile;
use PDF;
use Mail;
use App\Notifications;
use App\Notifications\Newlaporan;
use App\Mail\LaporanMail;

class UptdController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function indexRenlakgiat(){
    	$renlakgiat = Renlakgiat::where('users_id','=',Auth::user()->id)->sortable()->paginate(5);
    	return view('user.indexRenlakgiat', compact('renlakgiat','current'));
    }

    public function detailRenlakgiat($id){

    	$renlakgiat = Renlakgiat::where('id','=',$id)->get();
    	return view('user.detailRenlakgiat', compact('renlakgiat'));
    }

    public function editRenlakgiat($id){
    	$renlakgiat = Renlakgiat::where('id','=',$id)->get();
    	return view('user.editRenlakgiat', compact('renlakgiat'));
    }

    public function updateRenlakgiat(Request $request, $id)
    {
        $renlakgiat = Renlakgiat::find($id);
        $renlakgiat->tgl_mulai = $request->tgl_mulai;
        $renlakgiat->tgl_selesai = $request->tgl_selesai;
        $renlakgiat->status = $request->status;
        $renlakgiat->tgl_kumpul_laporan = date('Y-m-d', strtotime($request->tgl_selesai. "+7 day"));
        $renlakgiat->save();

        return redirect()->route('uptd.renlakgiat');
    }

    public function cetakRenlakgiat(){
        $renlakgiat = Renlakgiat::where('users_id', Auth::user()->id)->get();
        $datenow = Carbon::now()->formatLocalized('%d %B %Y');
        $ketua = Profile::where('users_id', Auth::user()->id)->get();
        $pdf = PDF::loadView('user.cetakRenlakgiat',compact('renlakgiat','ketua', 'datenow'));

        return $pdf->stream('Renlakgiat.pdf');
    }

    public function editpass($id){
        $user = user::where('id', $id)->get();
        return view('user.editpass', compact('user'));


    }
    public function verif(Request $request, $id){
				$this->validate($request, [
					'old' => 'required|min:6',
					'new' => 'required|min:6'
				]);
        $user = Auth::user();

        $old = $request->old;
        $new = $request->new;
        $confirm = $request->confirm;

        $user = User::find($id);
        $check = User::where('password', $old)->where('id', $id)->get();
        $cek = count($check);




        if (Hash::check($old, $user->password)) {
            $user->password = bcrypt($new);
            $user->save();

            Session::flash('message', 'Berhasil Ubah Password');
            Session::flash('alert-class', 'alert-success');
            return redirect('profile');

        }
        else
        {
            Session::flash('message', 'Password lama salah!');
            Session::flash('alert-class', 'alert-danger');

            return redirect()->back();
        }

    }
    Public function indexDokumen(){
        $dokumen = Dokumen::orderBy('updated_at','desc')->get();
        return view('user.indexDokumen', compact('dokumen'));
    }

    public function formCover($id){
        $renlakgiat = Renlakgiat::where('id',$id)->get();
        return view('user.formCover', compact('renlakgiat'));
    }


    public function uploadCover(Request $request, $id){
        $this->validate($request, [
            'file' => 'required|mimetypes:application/pdf|max:500',
        ]);
            if ($request->hasFile('file')) {
                $file = $request->file;
                $extension = $file->getClientOriginalExtension();
                $fileName = "Cover" . ' ' . $request->renlakgiat_id . '.' . $extension;
                $request->file('file')->move('upload', $fileName);
                $renlakgiat = Renlakgiat::find($id);
                $renlakgiat->cover = $fileName;
                $renlakgiat->status_cover = "Belum Terverifikasi";

            }
            $renlakgiat->save();
            Session::flash('message', 'Berhasil Upload Cover');
            Session::flash('alert-class', 'alert-success');

            $uptdh = Profile::where('users_id', Auth::user()->id)->get();
            foreach ($uptdh as $key => $valued) {
               $namauptd = $valued->nama_lembaga;
            }
            $renlakgiatz = Renlakgiat::where('id', $id)->get();
            foreach ($renlakgiatz as $key => $valuer) {
            $nama = $valuer->kejuruan;
            }
            $aidi = $id;
            $jenis = $renlakgiat->cover;
            $admen = Admin::all();
            foreach ($admen as $key => $asu) {
               $asu->notify(new Newlaporan($jenis, $nama, $namauptd, $aidi));
            }


            return redirect('uptd/laporan/detail/'.$request->renlakgiat_id);
    }

    public function formPendahuluan($id){
        $renlakgiat = Renlakgiat::where('id',$id)->get();
        return view('user.formPendahuluan', compact('renlakgiat'));
    }


    public function uploadPendahuluan($id, Request $request ){
        $this->validate($request,[
            'file' => 'required|mimetypes:application/pdf|max:500',
        ]);
        if ($request->hasFile('file')) {
                $file = $request->file;
                $extension = $file->getClientOriginalExtension();
                $fileName = "pendahuluan" . ' ' . $request->renlakgiat_id . '.' . $extension;
                $request->file('file')->move('upload', $fileName);
                $renlakgiat = Renlakgiat::find($id);
                $renlakgiat->pendahuluan = $fileName;
                $renlakgiat->status_pendahuluan = "Belum Terverifikasi";

            }
            $renlakgiat->save();
            Session::flash('message', 'Berhasil Upload pendahuluan');
            Session::flash('alert-class', 'alert-success');

            $uptdh = Profile::where('users_id', Auth::user()->id)->get();
            foreach ($uptdh as $key => $valued) {
               $namauptd = $valued->nama_lembaga;
            }
            $renlakgiatz = Renlakgiat::where('id', $id)->get();
            foreach ($renlakgiatz as $key => $valuer) {
            $nama = $valuer->kejuruan;
            }
            $jenis = $renlakgiat->pendahuluan;
            $aidi = $id;
            $admen = Admin::all();
            foreach ($admen as $key => $asu) {
               $asu->notify(new Newlaporan($jenis, $nama, $namauptd, $aidi));
            }
            return redirect('uptd/laporan/detail/'.$request->renlakgiat_id);
    }
    public function formSK($id){
        $renlakgiat = Renlakgiat::where('id',$id)->get();
        return view('user.formSK', compact('renlakgiat'));
    }


    public function uploadSK($id, Request $request ){
        $this->validate($request,[
            'file' => 'required|mimetypes:application/pdf|max:500',
        ]);
        if ($request->hasFile('file')) {
                $file = $request->file;
                $extension = $file->getClientOriginalExtension();
                $fileName = "SK" . ' ' . $request->renlakgiat_id . '.' . $extension;
                $request->file('file')->move('upload', $fileName);
                $renlakgiat = Renlakgiat::find($id);
                $renlakgiat->surat_keputusan = $fileName;
                $renlakgiat->status_surat_keputusan = "Belum Terverifikasi";

            }
            $renlakgiat->save();
            Session::flash('message', 'Berhasil Upload surat keputusan');
            Session::flash('alert-class', 'alert-success');

            $uptdh = Profile::where('users_id', Auth::user()->id)->get();
            foreach ($uptdh as $key => $valued) {
               $namauptd = $valued->nama_lembaga;
            }
            $renlakgiatz = Renlakgiat::where('id', $id)->get();
            foreach ($renlakgiatz as $key => $valuer) {
            $nama = $valuer->kejuruan;
            }
            $jenis = $renlakgiat->surat_keputusan;
            $aidi = $id;
            $admen = Admin::all();
            foreach ($admen as $key => $asu) {
               $asu->notify(new Newlaporan($jenis, $nama, $namauptd, $aidi));
            }


            return redirect('uptd/laporan/detail/'.$request->renlakgiat_id);
    }

    public function formNPP($id){
        $renlakgiat = Renlakgiat::where('id',$id)->get();
        return view('user.formNPP', compact('renlakgiat'));
    }


    public function uploadNPP($id, Request $request ){
        $this->validate($request,[
            'file' => 'required|mimetypes:application/pdf|max:500',
        ]);

        if ($request->hasFile('file')) {
                $file = $request->file;
                $extension = $file->getClientOriginalExtension();
                $fileName = "Nominatif Peserta Pelatihan" . ' ' . $request->renlakgiat_id . '.' . $extension;
                $request->file('file')->move('upload', $fileName);
                $renlakgiat = Renlakgiat::find($id);
                $renlakgiat->nominatif_peserta_pelatihan = $fileName;
                $renlakgiat->status_nominatif_peserta_pelatihan = "Belum Terverifikasi";

            }
            $renlakgiat->save();
            Session::flash('message', 'Berhasil Upload Nominatif Peserta Pelatihan');
            Session::flash('alert-class', 'alert-success');

            $uptdh = Profile::where('users_id', Auth::user()->id)->get();
            foreach ($uptdh as $key => $valued) {
               $namauptd = $valued->nama_lembaga;
            }
            $renlakgiatz = Renlakgiat::where('id', $id)->get();
            foreach ($renlakgiatz as $key => $valuer) {
            $nama = $valuer->kejuruan;
            }
            $jenis = $renlakgiat->nominatif_peserta_pelatihan;
            $aidi = $id;
            $admen = Admin::all();
            foreach ($admen as $key => $asu) {
               $asu->notify(new Newlaporan($jenis, $nama, $namauptd, $aidi));
            }


            return redirect('uptd/laporan/detail/'.$request->renlakgiat_id);
    }

    public function formNI($id){
        $renlakgiat = Renlakgiat::where('id',$id)->get();
        return view('user.formNI', compact('renlakgiat'));
    }


    public function uploadNI($id, Request $request ){
        $this->validate($request,[
            'file' => 'required|mimetypes:application/pdf|max:500',
        ]);

        if ($request->hasFile('file')) {
                $file = $request->file;
                $extension = $file->getClientOriginalExtension();
                $fileName = "Nominatif Instruktur" . ' ' . $request->renlakgiat_id . '.' . $extension;
                $request->file('file')->move('upload', $fileName);
                $renlakgiat = Renlakgiat::find($id);
                $renlakgiat->nominatif_instruktur = $fileName;
                $renlakgiat->status_nominatif_instruktur = "Belum Terverifikasi";

            }
            $renlakgiat->save();
            Session::flash('message', 'Berhasil Upload Nominatif Instruktur');
            Session::flash('alert-class', 'alert-success');

            $uptdh = Profile::where('users_id', Auth::user()->id)->get();
            foreach ($uptdh as $key => $valued) {
               $namauptd = $valued->nama_lembaga;
            }
            $renlakgiatz = Renlakgiat::where('id', $id)->get();
            foreach ($renlakgiatz as $key => $valuer) {
            $nama = $valuer->kejuruan;
            }
            $jenis = $renlakgiat->nominatif_instruktur;
            $aidi = $id;
            $admen = Admin::all();
            foreach ($admen as $key => $asu) {
               $asu->notify(new Newlaporan($jenis, $nama, $namauptd, $aidi));
            }


            return redirect('uptd/laporan/detail/'.$request->renlakgiat_id);
    }

    public function formKurikulum($id){
        $renlakgiat = Renlakgiat::where('id',$id)->get();
        return view('user.formKurikulum', compact('renlakgiat'));
    }


    public function uploadKurikulum($id, Request $request ){
        $this->validate($request,[
            'file' => 'required|mimetypes:application/pdf|max:500',
        ]);

        if ($request->hasFile('file')) {
                $file = $request->file;
                $extension = $file->getClientOriginalExtension();
                $fileName = "Kurikulum" . ' ' . $request->renlakgiat_id . '.' . $extension;
                $request->file('file')->move('upload', $fileName);
                $renlakgiat = Renlakgiat::find($id);
                $renlakgiat->kurikulum = $fileName;
                $renlakgiat->status_kurikulum = "Belum Terverifikasi";

            }
            $renlakgiat->save();
            Session::flash('message', 'Berhasil Upload Kurikulum');
            Session::flash('alert-class', 'alert-success');

            $uptdh = Profile::where('users_id', Auth::user()->id)->get();
            foreach ($uptdh as $key => $valued) {
               $namauptd = $valued->nama_lembaga;
            }
            $renlakgiatz = Renlakgiat::where('id', $id)->get();
            foreach ($renlakgiatz as $key => $valuer) {
            $nama = $valuer->kejuruan;
            }
            $jenis = $renlakgiat->kurikulum;
            $aidi = $id;
            $admen = Admin::all();
            foreach ($admen as $key => $asu) {
               $asu->notify(new Newlaporan($jenis, $nama, $namauptd, $aidi));
            }

            return redirect('uptd/laporan/detail/'.$request->renlakgiat_id);
    }

    public function formJpm($id){
        $renlakgiat = Renlakgiat::where('id',$id)->get();
        return view('user.formJpm', compact('renlakgiat'));
    }


    public function uploadJpm($id, Request $request ){
        $this->validate($request,[
            'file' => 'required|mimetypes:application/pdf|max:500',
        ]);

        if ($request->hasFile('file')) {
                $file = $request->file;
                $extension = $file->getClientOriginalExtension();
                $fileName = "Jadwal Pelatihan Mingguan" . ' ' . $request->renlakgiat_id . '.' . $extension;
                $request->file('file')->move('upload', $fileName);
                $renlakgiat = Renlakgiat::find($id);
                $renlakgiat->jadwal_pelatihan_mingguan = $fileName;
                $renlakgiat->status_jadwal_pelatihan_mingguan = "Belum Terverifikasi";

            }
            $renlakgiat->save();
            Session::flash('message', 'Berhasil Upload Jadwal Pelatihan Mingguan');
            Session::flash('alert-class', 'alert-success');

            $uptdh = Profile::where('users_id', Auth::user()->id)->get();
            foreach ($uptdh as $key => $valued) {
               $namauptd = $valued->nama_lembaga;
            }
            $renlakgiatz = Renlakgiat::where('id', $id)->get();
            foreach ($renlakgiatz as $key => $valuer) {
            $nama = $valuer->kejuruan;
            }
            $jenis = $renlakgiat->jadwal_pelatihan_mingguan;
            $aidi = $id;
            $admen = Admin::all();
            foreach ($admen as $key => $asu) {
               $asu->notify(new Newlaporan($jenis, $nama, $namauptd, $aidi));
            }

            return redirect('uptd/laporan/detail/'.$request->renlakgiat_id);
    }

    public function formDhi($id){
        $renlakgiat = Renlakgiat::where('id',$id)->get();
        return view('user.formDhi', compact('renlakgiat'));
    }


    public function uploadDhi($id, Request $request ){
        $this->validate($request,[
            'file' => 'required|mimetypes:application/pdf|max:500',
        ]);

        if ($request->hasFile('file')) {
                $file = $request->file;
                $extension = $file->getClientOriginalExtension();
                $fileName = "Daftar Hadir Instruktur" . ' ' . $request->renlakgiat_id . '.' . $extension;
                $request->file('file')->move('upload', $fileName);
                $renlakgiat = Renlakgiat::find($id);
                $renlakgiat->daftar_hadir_instruktur = $fileName;
                $renlakgiat->status_daftar_hadir_instruktur = "Belum Terverifikasi";

            }
            $renlakgiat->save();
            Session::flash('message', 'Berhasil Upload Daftar Hadir Instruktur');
            Session::flash('alert-class', 'alert-success');

            $uptdh = Profile::where('users_id', Auth::user()->id)->get();
            foreach ($uptdh as $key => $valued) {
               $namauptd = $valued->nama_lembaga;
            }
            $renlakgiatz = Renlakgiat::where('id', $id)->get();
            foreach ($renlakgiatz as $key => $valuer) {
            $nama = $valuer->kejuruan;
            }
            $jenis = $renlakgiat->daftar_hadir_instrukturn;
            $aidi = $id;
            $admen = Admin::all();
            foreach ($admen as $key => $asu) {
               $asu->notify(new Newlaporan($jenis, $nama, $namauptd, $aidi));
            }

            return redirect('uptd/laporan/detail/'.$request->renlakgiat_id);
    }

    public function formDjmi($id){
        $renlakgiat = Renlakgiat::where('id',$id)->get();
        return view('user.formDjmi', compact('renlakgiat'));
    }


    public function uploadDjmi($id, Request $request ){
        $this->validate($request,[
            'file' => 'required|mimetypes:application/pdf|max:500',
        ]);

        if ($request->hasFile('file')) {
                $file = $request->file;
                $extension = $file->getClientOriginalExtension();
                $fileName = "Daftar Jam Mengajar Instruktur" . ' ' . $request->renlakgiat_id . '.' . $extension;
                $request->file('file')->move('upload', $fileName);
                $renlakgiat = Renlakgiat::find($id);
                $renlakgiat->daftar_jam_mengajar_instruktur = $fileName;
                $renlakgiat->status_daftar_jam_mengajar_instruktur = "Belum Terverifikasi";

            }
            $renlakgiat->save();
            Session::flash('message', 'Berhasil Upload Jam Mengajar Instruktur');
            Session::flash('alert-class', 'alert-success');

            $uptdh = Profile::where('users_id', Auth::user()->id)->get();
            foreach ($uptdh as $key => $valued) {
               $namauptd = $valued->nama_lembaga;
            }
            $renlakgiatz = Renlakgiat::where('id', $id)->get();
            foreach ($renlakgiatz as $key => $valuer) {
            $nama = $valuer->kejuruan;
            }
            $jenis = $renlakgiat->daftar_jam_mengajar_instruktur;
            $aidi = $id;
            $admen = Admin::all();
            foreach ($admen as $key => $asu) {
               $asu->notify(new Newlaporan($jenis, $nama, $namauptd, $aidi));
            }

            return redirect('uptd/laporan/detail/'.$request->renlakgiat_id);
    }

    public function formDhpp($id){
        $renlakgiat = Renlakgiat::where('id',$id)->get();
        return view('user.formDhpp', compact('renlakgiat'));
    }


    public function uploadDhpp($id, Request $request ){
        $this->validate($request,[
            'file' => 'required|mimetypes:application/pdf|max:500',
        ]);

        if ($request->hasFile('file')) {
                $file = $request->file;
                $extension = $file->getClientOriginalExtension();
                $fileName = "Daftar Hadir Peserta Pelatihan" . ' ' . $request->renlakgiat_id . '.' . $extension;
                $request->file('file')->move('upload', $fileName);
                $renlakgiat = Renlakgiat::find($id);
                $renlakgiat->daftar_hadir_peserta_pelatihan = $fileName;
                $renlakgiat->status_daftar_hadir_peserta_pelatihan = "Belum Terverifikasi";

            }
            $renlakgiat->save();
            Session::flash('message', 'Berhasil Upload Daftar Hadir Peserta Pelatihan');
            Session::flash('alert-class', 'alert-success');

            $uptdh = Profile::where('users_id', Auth::user()->id)->get();
            foreach ($uptdh as $key => $valued) {
               $namauptd = $valued->nama_lembaga;
            }
            $renlakgiatz = Renlakgiat::where('id', $id)->get();
            foreach ($renlakgiatz as $key => $valuer) {
            $nama = $valuer->kejuruan;
            }
            $jenis = $renlakgiat->daftar_hadir_peserta_pelatihan;
            $aidi = $id;
            $admen = Admin::all();
            foreach ($admen as $key => $asu) {
               $asu->notify(new Newlaporan($jenis, $nama, $namauptd, $aidi));
            }

            return redirect('uptd/laporan/detail/'.$request->renlakgiat_id);
    }

    public function formDpbl($id){
        $renlakgiat = Renlakgiat::where('id',$id)->get();
        return view('user.formDpbl', compact('renlakgiat'));
    }


    public function uploadDpbl($id, Request $request ){
        $this->validate($request,[
            'file' => 'required|mimetypes:application/pdf|max:500',
        ]);

        if ($request->hasFile('file')) {
                $file = $request->file;
                $extension = $file->getClientOriginalExtension();
                $fileName = "Daftar Permintaan Bahan latihan" . ' ' . $request->renlakgiat_id . '.' . $extension;
                $request->file('file')->move('upload', $fileName);
                $renlakgiat = Renlakgiat::find($id);
                $renlakgiat->daftar_permintaan_bahan_pelatihan = $fileName;
                $renlakgiat->status_daftar_permintaan_bahan_pelatihan = "Belum Terverifikasi";

            }
            $renlakgiat->save();
            Session::flash('message', 'Berhasil Upload Daftar Permintaan Bahan Latihan');
            Session::flash('alert-class', 'alert-success');

            $uptdh = Profile::where('users_id', Auth::user()->id)->get();
            foreach ($uptdh as $key => $valued) {
               $namauptd = $valued->nama_lembaga;
            }
            $renlakgiatz = Renlakgiat::where('id', $id)->get();
            foreach ($renlakgiatz as $key => $valuer) {
            $nama = $valuer->kejuruan;
            }
            $jenis = $renlakgiat->daftar_permintaan_bahan_pelatihan;
            $aidi = $id;
            $admen = Admin::all();
            foreach ($admen as $key => $asu) {
               $asu->notify(new Newlaporan($jenis, $nama, $namauptd, $aidi));
            }

            return redirect('uptd/laporan/detail/'.$request->renlakgiat_id);
    }

    public function formBpbl($id){
        $renlakgiat = Renlakgiat::where('id',$id)->get();
        return view('user.formBpbl', compact('renlakgiat'));
    }


    public function uploadBpbl($id, Request $request ){
        $this->validate($request,[
            'file' => 'required|mimetypes:application/pdf|max:500',
        ]);

        if ($request->hasFile('file')) {
                $file = $request->file;
                $extension = $file->getClientOriginalExtension();
                $fileName = "Bukti Penerimaan Bahan Latihan" . ' ' . $request->renlakgiat_id . '.' . $extension;
                $request->file('file')->move('upload', $fileName);
                $renlakgiat = Renlakgiat::find($id);
                $renlakgiat->bukti_penerimaan_bahan_pelatihan = $fileName;
                $renlakgiat->status_bukti_penerimaan_bahan_pelatihan = "Belum Terverifikasi";

            }
            $renlakgiat->save();
            Session::flash('message', 'Berhasil Upload Bukti Penerimaan Bahan Pelatihan');
            Session::flash('alert-class', 'alert-success');

            $uptdh = Profile::where('users_id', Auth::user()->id)->get();
            foreach ($uptdh as $key => $valued) {
               $namauptd = $valued->nama_lembaga;
            }
            $renlakgiatz = Renlakgiat::where('id', $id)->get();
            foreach ($renlakgiatz as $key => $valuer) {
            $nama = $valuer->kejuruan;
            }
            $jenis = $renlakgiat->bukti_penerimaan_bahan_pelatihan;
            $aidi = $id;
            $admen = Admin::all();
            foreach ($admen as $key => $asu) {
               $asu->notify(new Newlaporan($jenis, $nama, $namauptd, $aidi));
            }

            return redirect('uptd/laporan/detail/'.$request->renlakgiat_id);
    }

    public function formLmpbl($id){
        $renlakgiat = Renlakgiat::where('id',$id)->get();
        return view('user.formLmpbl', compact('renlakgiat'));
    }


    public function uploadLmpbl($id, Request $request ){
        $this->validate($request,[
            'file' => 'required|mimetypes:application/pdf|max:500',
        ]);

        if ($request->hasFile('file')) {
                $file = $request->file;
                $extension = $file->getClientOriginalExtension();
                $fileName = "Laporan Mingguan Penggunaan Bahan Latihan" . ' ' . $request->renlakgiat_id . '.' . $extension;
                $request->file('file')->move('upload', $fileName);
                $renlakgiat = Renlakgiat::find($id);
                $renlakgiat->laporan_mingguan_penggunaan_bahan_pelatihan = $fileName;
                $renlakgiat->status_laporan_mingguan_penggunaan_bahan_pelatihan = "Belum Terverifikasi";

            }
            $renlakgiat->save();
            Session::flash('message', 'Berhasil Upload Laporan Mingguan Penggunaan Bahan Latihan');
            Session::flash('alert-class', 'alert-success');

            $uptdh = Profile::where('users_id', Auth::user()->id)->get();
            foreach ($uptdh as $key => $valued) {
               $namauptd = $valued->nama_lembaga;
            }
            $renlakgiatz = Renlakgiat::where('id', $id)->get();
            foreach ($renlakgiatz as $key => $valuer) {
            $nama = $valuer->kejuruan;
            }
            $jenis = $renlakgiat->laporan_mingguan_penggunaan_bahan_pelatihan;
            $aidi = $id;
            $admen = Admin::all();
            foreach ($admen as $key => $asu) {
               $asu->notify(new Newlaporan($jenis, $nama, $namauptd, $aidi));
            }

            return redirect('uptd/laporan/detail/'.$request->renlakgiat_id);
    }

    public function formUsk($id){
        $renlakgiat = Renlakgiat::where('id',$id)->get();
        return view('user.formUsk', compact('renlakgiat'));
    }


    public function uploadUsk($id, Request $request ){
        $this->validate($request,[
            'file' => 'required|mimetypes:application/pdf|max:500',
        ]);

        if ($request->hasFile('file')) {
                $file = $request->file;
                $extension = $file->getClientOriginalExtension();
                $fileName = "Undangan Sidang Kelulusan" . ' ' . $request->renlakgiat_id . '.' . $extension;
                $request->file('file')->move('upload', $fileName);
                $renlakgiat = Renlakgiat::find($id);
                $renlakgiat->undangan_sidang_kelulusan = $fileName;
                $renlakgiat->status_undangan_sidang_kelulusan = "Belum Terverifikasi";

            }
            $renlakgiat->save();
            Session::flash('message', 'Berhasil Upload Undangan Sidang Kelulusan');
            Session::flash('alert-class', 'alert-success');

            $uptdh = Profile::where('users_id', Auth::user()->id)->get();
            foreach ($uptdh as $key => $valued) {
               $namauptd = $valued->nama_lembaga;
            }
            $renlakgiatz = Renlakgiat::where('id', $id)->get();
            foreach ($renlakgiatz as $key => $valuer) {
            $nama = $valuer->kejuruan;
            }
            $jenis = $renlakgiat->undangan_sidang_kelulusan;
            $aidi = $id;
            $admen = Admin::all();
            foreach ($admen as $key => $asu) {
               $asu->notify(new Newlaporan($jenis, $nama, $namauptd, $aidi));
            }

            return redirect('uptd/laporan/detail/'.$request->renlakgiat_id);
    }

    public function formBask($id){
        $renlakgiat = Renlakgiat::where('id',$id)->get();
        return view('user.formBask', compact('renlakgiat'));
    }


    public function uploadBask($id, Request $request ){
        $this->validate($request,[
            'file' => 'required|mimetypes:application/pdf|max:500',
        ]);

        if ($request->hasFile('file')) {
                $file = $request->file;
                $extension = $file->getClientOriginalExtension();
                $fileName = "Berita Acara Sidang Kelulusan" . ' ' . $request->renlakgiat_id . '.' . $extension;
                $request->file('file')->move('upload', $fileName);
                $renlakgiat = Renlakgiat::find($id);
                $renlakgiat->berita_acara_sidang_kelulusan = $fileName;
                $renlakgiat->status_berita_acara_sidang_kelulusan = "Belum Terverifikasi";

            }
            $renlakgiat->save();
            Session::flash('message', 'Berhasil Upload Berita Acara Sidang Kelulusan');
            Session::flash('alert-class', 'alert-success');

            $uptdh = Profile::where('users_id', Auth::user()->id)->get();
            foreach ($uptdh as $key => $valued) {
               $namauptd = $valued->nama_lembaga;
            }
            $renlakgiatz = Renlakgiat::where('id', $id)->get();
            foreach ($renlakgiatz as $key => $valuer) {
            $nama = $valuer->kejuruan;
            }
            $jenis = $renlakgiat->berita_acara_sidang_kelulusan;
            $aidi = $id;
            $admen = Admin::all();
            foreach ($admen as $key => $asu) {
               $asu->notify(new Newlaporan($jenis, $nama, $namauptd, $aidi));
            }

            return redirect('uptd/laporan/detail/'.$request->renlakgiat_id);
    }

    public function formDhpsk($id){
        $renlakgiat = Renlakgiat::where('id',$id)->get();
        return view('user.formDhpsk', compact('renlakgiat'));
    }


    public function uploadDhpsk($id, Request $request ){
        $this->validate($request,[
            'file' => 'required|mimetypes:application/pdf|max:500',
        ]);

        if ($request->hasFile('file')) {
                $file = $request->file;
                $extension = $file->getClientOriginalExtension();
                $fileName = "Daftar Hadis Pertemuan Sidang Kelulusan" . ' ' . $request->renlakgiat_id . '.' . $extension;
                $request->file('file')->move('upload', $fileName);
                $renlakgiat = Renlakgiat::find($id);
                $renlakgiat->daftar_hadir_pertemuan_sidang_kelulusan = $fileName;
                $renlakgiat->status_daftar_hadir_pertemuan_sidang_kelulusan = "Belum Terverifikasi";

            }
            $renlakgiat->save();
            Session::flash('message', 'Berhasil Upload Daftar Hadir Pertemuan Sidang Kelulusan');
            Session::flash('alert-class', 'alert-success');

            $uptdh = Profile::where('users_id', Auth::user()->id)->get();
            foreach ($uptdh as $key => $valued) {
               $namauptd = $valued->nama_lembaga;
            }
            $renlakgiatz = Renlakgiat::where('id', $id)->get();
            foreach ($renlakgiatz as $key => $valuer) {
            $nama = $valuer->kejuruan;
            }
            $jenis = $renlakgiat->daftar_hadir_pertemuan_sidang_kelulusan;
            $aidi = $id;
            $admen = Admin::all();
            foreach ($admen as $key => $asu) {
               $asu->notify(new Newlaporan($jenis, $nama, $namauptd, $aidi));
            }

            return redirect('uptd/laporan/detail/'.$request->renlakgiat_id);
    }

    public function formDna($id){
        $renlakgiat = Renlakgiat::where('id',$id)->get();
        return view('user.formDna', compact('renlakgiat'));
    }


    public function uploadDna($id, Request $request ){
        $this->validate($request,[
            'file' => 'required|mimetypes:application/pdf|max:500',
        ]);

        if ($request->hasFile('file')) {
                $file = $request->file;
                $extension = $file->getClientOriginalExtension();
                $fileName = "Daftar Nilai Akhir" . ' ' . $request->renlakgiat_id . '.' . $extension;
                $request->file('file')->move('upload', $fileName);
                $renlakgiat = Renlakgiat::find($id);
                $renlakgiat->daftar_nilai_akhir = $fileName;
                $renlakgiat->status_daftar_nilai_akhir = "Belum Terverifikasi";

            }
            $renlakgiat->save();
            Session::flash('message', 'Berhasil Upload Daftar Nilai Akhir');
            Session::flash('alert-class', 'alert-success');

            $uptdh = Profile::where('users_id', Auth::user()->id)->get();
            foreach ($uptdh as $key => $valued) {
               $namauptd = $valued->nama_lembaga;
            }
            $renlakgiatz = Renlakgiat::where('id', $id)->get();
            foreach ($renlakgiatz as $key => $valuer) {
            $nama = $valuer->kejuruan;
            }
            $jenis = $renlakgiat->daftar_nilai_akhir;
            $aidi = $id;
            $admen = Admin::all();
            foreach ($admen as $key => $asu) {
               $asu->notify(new Newlaporan($jenis, $nama, $namauptd, $aidi));
            }

            return redirect('uptd/laporan/detail/'.$request->renlakgiat_id);
    }

    public function formRppbk($id){
        $renlakgiat = Renlakgiat::where('id',$id)->get();
        return view('user.formRppbk', compact('renlakgiat'));
    }


    public function uploadRppbk($id, Request $request ){
        $this->validate($request,[
            'file' => 'required|mimetypes:application/pdf|max:500',
        ]);

        if ($request->hasFile('file')) {
                $file = $request->file;
                $extension = $file->getClientOriginalExtension();
                $fileName = "Rekap Penilaian Pelatihan Berbasis Kompetensi" . ' ' . $request->renlakgiat_id . '.' . $extension;
                $request->file('file')->move('upload', $fileName);
                $renlakgiat = Renlakgiat::find($id);
                $renlakgiat->rekap_penilaian_pelatihan_berbasis_kompetensi = $fileName;
                $renlakgiat->status_rekap_penilaian_pelatihan_berbasis_kompetensi = "Belum Terverifikasi";

            }
            $renlakgiat->save();
            Session::flash('message', 'Berhasil Upload Rekap Penilaian Pelatihan Berbasis Kompetensi');
            Session::flash('alert-class', 'alert-success');

            $uptdh = Profile::where('users_id', Auth::user()->id)->get();
            foreach ($uptdh as $key => $valued) {
               $namauptd = $valued->nama_lembaga;
            }
            $renlakgiatz = Renlakgiat::where('id', $id)->get();
            foreach ($renlakgiatz as $key => $valuer) {
            $nama = $valuer->kejuruan;
            }
            $jenis = $renlakgiat->rekap_penilaian_pelatihan_berbasis_kompetensi;
            $aidi = $id;
            $admen = Admin::all();
            foreach ($admen as $key => $asu) {
               $asu->notify(new Newlaporan($jenis, $nama, $namauptd, $aidi));
            }

            return redirect('uptd/laporan/detail/'.$request->renlakgiat_id);
    }

    public function formRahp($id){
        $renlakgiat = Renlakgiat::where('id',$id)->get();
        return view('user.formRahp', compact('renlakgiat'));
    }


    public function uploadRahp($id, Request $request ){
        $this->validate($request,[
            'file' => 'required|mimetypes:application/pdf|max:500',
        ]);

        if ($request->hasFile('file')) {
                $file = $request->file;
                $extension = $file->getClientOriginalExtension();
                $fileName = "Rekapitulasi Akhir hasil Pelatihan" . ' ' . $request->renlakgiat_id . '.' . $extension;
                $request->file('file')->move('upload', $fileName);
                $renlakgiat = Renlakgiat::find($id);
                $renlakgiat->rekapitulasi_akhir_hasil_pelatihan = $fileName;
                $renlakgiat->status_rekapitulasi_akhir_hasil_pelatihan = "Belum Terverifikasi";

            }
            $renlakgiat->save();
            Session::flash('message', 'Berhasil Upload Rekapitulasi Akhir hasil Pelatihan');
            Session::flash('alert-class', 'alert-success');

            $uptdh = Profile::where('users_id', Auth::user()->id)->get();
            foreach ($uptdh as $key => $valued) {
               $namauptd = $valued->nama_lembaga;
            }
            $renlakgiatz = Renlakgiat::where('id', $id)->get();
            foreach ($renlakgiatz as $key => $valuer) {
            $nama = $valuer->kejuruan;
            }
            $jenis = $renlakgiat->rekapitulasi_akhir_hasil_pelatihan;
            $aidi = $id;
            $admen = Admin::all();
            foreach ($admen as $key => $asu) {
               $asu->notify(new Newlaporan($jenis, $nama, $namauptd, $aidi));
            }

            return redirect('uptd/laporan/detail/'.$request->renlakgiat_id);
    }

    public function formTttp($id){
        $renlakgiat = Renlakgiat::where('id',$id)->get();
        return view('user.formTttp', compact('renlakgiat'));
    }


    public function uploadTttp($id, Request $request ){
        $this->validate($request,[
            'file' => 'required|mimetypes:application/pdf|max:500',
        ]);

        if ($request->hasFile('file')) {
                $file = $request->file;
                $extension = $file->getClientOriginalExtension();
                $fileName = "Tanda Terima Transport Peserta" . ' ' . $request->renlakgiat_id . '.' . $extension;
                $request->file('file')->move('upload', $fileName);
                $renlakgiat = Renlakgiat::find($id);
                $renlakgiat->tanda_terima_transport_peserta = $fileName;
                $renlakgiat->status_tanda_terima_transport_peserta = "Belum Terverifikasi";

            }
            $renlakgiat->save();
            Session::flash('message', 'Berhasil Upload Tanda Terima Transport Peserta');
            Session::flash('alert-class', 'alert-success');

            $uptdh = Profile::where('users_id', Auth::user()->id)->get();
            foreach ($uptdh as $key => $valued) {
               $namauptd = $valued->nama_lembaga;
            }
            $renlakgiatz = Renlakgiat::where('id', $id)->get();
            foreach ($renlakgiatz as $key => $valuer) {
            $nama = $valuer->kejuruan;
            }
            $jenis = $renlakgiat->tanda_terima_transport_peserta;
            $aidi = $id;
            $admen = Admin::all();
            foreach ($admen as $key => $asu) {
               $asu->notify(new Newlaporan($jenis, $nama, $namauptd, $aidi));
            }

            return redirect('uptd/laporan/detail/'.$request->renlakgiat_id);
    }

    public function formTtap($id){
        $renlakgiat = Renlakgiat::where('id',$id)->get();
        return view('user.formTtap', compact('renlakgiat'));
    }


    public function uploadTtap($id, Request $request ){
        $this->validate($request,[
            'file' => 'required|mimetypes:application/pdf|max:500',

        ]);

        if ($request->hasFile('file')) {
                $file = $request->file;
                $extension = $file->getClientOriginalExtension();
                $fileName = "Tanda Terima kartu Asuransi Peserta" . ' ' . $request->renlakgiat_id . '.' . $extension;
                $request->file('file')->move('upload', $fileName);
                $renlakgiat = Renlakgiat::find($id);
                $renlakgiat->tanda_terima_asuransi_peserta = $fileName;
                $renlakgiat->status_tanda_terima_asuransi_peserta = "Belum Terverifikasi";

            }
            $renlakgiat->save();
            Session::flash('message', 'Berhasil Upload Tanda Terima kartu Asuransi Peserta');
            Session::flash('alert-class', 'alert-success');

            $uptdh = Profile::where('users_id', Auth::user()->id)->get();
            foreach ($uptdh as $key => $valued) {
               $namauptd = $valued->nama_lembaga;
            }
            $renlakgiatz = Renlakgiat::where('id', $id)->get();
            foreach ($renlakgiatz as $key => $valuer) {
            $nama = $valuer->kejuruan;
            }
            $jenis = $renlakgiat->tanda_terima_asuransi_peserta;
            $aidi = $id;
            $admen = Admin::all();
            foreach ($admen as $key => $asu) {
               $asu->notify(new Newlaporan($jenis, $nama, $namauptd, $aidi));
            }

            return redirect('uptd/laporan/detail/'.$request->renlakgiat_id);
    }

    public function formTtpkp($id){
        $renlakgiat = Renlakgiat::where('id',$id)->get();
        return view('user.formTtpkp', compact('renlakgiat'));
    }


    public function uploadTtpkp($id, Request $request ){
        $this->validate($request,[
            'file' => 'required|mimetypes:application/pdf|max:500',

        ]);

        if ($request->hasFile('file')) {
                $file = $request->file;
                $extension = $file->getClientOriginalExtension();
                $fileName = "Tanda Terima Pakaian Kerja Peserta" . ' ' . $request->renlakgiat_id . '.' . $extension;
                $request->file('file')->move('upload', $fileName);
                $renlakgiat = Renlakgiat::find($id);
                $renlakgiat->tanda_terima_pakaian_kerja_peserta = $fileName;
                $renlakgiat->status_tanda_terima_pakaian_kerja_peserta = "Belum Terverifikasi";

            }
            $renlakgiat->save();
            Session::flash('message', 'Berhasil Upload Tanda Terima Pakaian Kerja Peserta');
            Session::flash('alert-class', 'alert-success');

            $uptdh = Profile::where('users_id', Auth::user()->id)->get();
            foreach ($uptdh as $key => $valued) {
               $namauptd = $valued->nama_lembaga;
            }
            $renlakgiatz = Renlakgiat::where('id', $id)->get();
            foreach ($renlakgiatz as $key => $valuer) {
            $nama = $valuer->kejuruan;
            }
            $jenis = $renlakgiat->tanda_terima_pakaian_kerja_peserta;
            $aidi = $id;
            $admen = Admin::all();
            foreach ($admen as $key => $asu) {
               $asu->notify(new Newlaporan($jenis, $nama, $namauptd, $aidi));
            }

            return redirect('uptd/laporan/detail/'.$request->renlakgiat_id);
    }

    public function formTtatkp($id){
        $renlakgiat = Renlakgiat::where('id',$id)->get();
        return view('user.formTtatkp', compact('renlakgiat'));
    }


    public function uploadTtatkp($id, Request $request ){
        $this->validate($request,[
            'file' => 'required|mimetypes:application/pdf|max:500',

        ]);

        if ($request->hasFile('file')) {
                $file = $request->file;
                $extension = $file->getClientOriginalExtension();
                $fileName = "Tanda Terima ATK Peserta" . ' ' . $request->renlakgiat_id . '.' . $extension;
                $request->file('file')->move('upload', $fileName);
                $renlakgiat = Renlakgiat::find($id);
                $renlakgiat->tanda_terima_atk_peserta = $fileName;
                $renlakgiat->status_tanda_terima_atk_peserta = "Belum Terverifikasi";

            }
            $renlakgiat->save();
            Session::flash('message', 'Berhasil Upload Tanda Terima ATK Peserta');
            Session::flash('alert-class', 'alert-success');

            $uptdh = Profile::where('users_id', Auth::user()->id)->get();
            foreach ($uptdh as $key => $valued) {
               $namauptd = $valued->nama_lembaga;
            }
            $renlakgiatz = Renlakgiat::where('id', $id)->get();
            foreach ($renlakgiatz as $key => $valuer) {
            $nama = $valuer->kejuruan;
            }
            $jenis = $renlakgiat->tanda_terima_atk_peserta;
            $aidi = $id;
            $admen = Admin::all();
            foreach ($admen as $key => $asu) {
               $asu->notify(new Newlaporan($jenis, $nama, $namauptd, $aidi));
            }

            return redirect('uptd/laporan/detail/'.$request->renlakgiat_id);
    }

    public function formTtm($id){
        $renlakgiat = Renlakgiat::where('id',$id)->get();
        return view('user.formTtm', compact('renlakgiat'));
    }


    public function uploadTtm($id, Request $request ){
        $this->validate($request,[
            'file' => 'required|mimetypes:application/pdf|max:500',

        ]);

        if ($request->hasFile('file')) {
                $file = $request->file;
                $extension = $file->getClientOriginalExtension();
                $fileName = "Tanda Terima Modul" . ' ' . $request->renlakgiat_id . '.' . $extension;
                $request->file('file')->move('upload', $fileName);
                $renlakgiat = Renlakgiat::find($id);
                $renlakgiat->tanda_terima_modul = $fileName;
                $renlakgiat->status_tanda_terima_modul = "Belum Terverifikasi";

            }
            $renlakgiat->save();
            Session::flash('message', 'Berhasil Upload Tanda Terima Modul');
            Session::flash('alert-class', 'alert-success');

            $uptdh = Profile::where('users_id', Auth::user()->id)->get();
            foreach ($uptdh as $key => $valued) {
               $namauptd = $valued->nama_lembaga;
            }
            $renlakgiatz = Renlakgiat::where('id', $id)->get();
            foreach ($renlakgiatz as $key => $valuer) {
            $nama = $valuer->kejuruan;
            }
            $jenis = $renlakgiat->tanda_terima_modul;
            $aidi = $id;
            $admen = Admin::all();
            foreach ($admen as $key => $asu) {
               $asu->notify(new Newlaporan($jenis, $nama, $namauptd, $aidi));
            }

            return redirect('uptd/laporan/detail/'.$request->renlakgiat_id);
    }

    public function formTtkp($id){
        $renlakgiat = Renlakgiat::where('id',$id)->get();
        return view('user.formTtkp', compact('renlakgiat'));
    }


    public function uploadTtkp($id, Request $request ){
        $this->validate($request,[
            'file' => 'required|mimetypes:application/pdf|max:500',

        ]);

        if ($request->hasFile('file')) {
                $file = $request->file;
                $extension = $file->getClientOriginalExtension();
                $fileName = "Tanda Terima Konsumsi Peserta" . ' ' . $request->renlakgiat_id . '.' . $extension;
                $request->file('file')->move('upload', $fileName);
                $renlakgiat = Renlakgiat::find($id);
                $renlakgiat->tanda_terima_konsumsi_peserta = $fileName;
                $renlakgiat->status_tanda_terima_konsumsi_peserta = "Belum Terverifikasi";

            }
            $renlakgiat->save();
            Session::flash('message', 'Berhasil Upload Tanda Terima Konsumsi Peserta');
            Session::flash('alert-class', 'alert-success');

            $uptdh = Profile::where('users_id', Auth::user()->id)->get();
            foreach ($uptdh as $key => $valued) {
               $namauptd = $valued->nama_lembaga;
            }
            $renlakgiatz = Renlakgiat::where('id', $id)->get();
            foreach ($renlakgiatz as $key => $valuer) {
            $nama = $valuer->kejuruan;
            }
            $jenis = $renlakgiat->tanda_terima_konsumsi_peserta;
            $aidi = $id;
            $admen = Admin::all();
            foreach ($admen as $key => $asu) {
               $asu->notify(new Newlaporan($jenis, $nama, $namauptd, $aidi));
            }

            return redirect('uptd/laporan/detail/'.$request->renlakgiat_id);
    }

    public function formFdk($id){
        $renlakgiat = Renlakgiat::where('id',$id)->get();
        return view('user.formFdk', compact('renlakgiat'));
    }


    public function uploadFdk($id, Request $request ){
        $this->validate($request,[
            'file' => 'required|mimetypes:application/pdf|max:500',

        ]);

        if ($request->hasFile('file')) {
                $file = $request->file;
                $extension = $file->getClientOriginalExtension();
                $fileName = "Foto Dokumentasi Kegiatan" . ' ' . $request->renlakgiat_id . '.' . $extension;
                $request->file('file')->move('upload', $fileName);
                $renlakgiat = Renlakgiat::find($id);
                $renlakgiat->foto_dokumentasi_kegiatan = $fileName;
                $renlakgiat->status_foto_dokumentasi_kegiatan = "Belum Terverifikasi";

            }
            $renlakgiat->save();
            Session::flash('message', 'Berhasil Upload Foto Dokumentasi Kegiatan');
            Session::flash('alert-class', 'alert-success');

            $uptdh = Profile::where('users_id', Auth::user()->id)->get();
            foreach ($uptdh as $key => $valued) {
               $namauptd = $valued->nama_lembaga;
            }
            $renlakgiatz = Renlakgiat::where('id', $id)->get();
            foreach ($renlakgiatz as $key => $valuer) {
            $nama = $valuer->kejuruan;
            }
            $jenis = $renlakgiat->foto_dokumentasi_kegiatan;
            $aidi = $id;
            $admen = Admin::all();
            foreach ($admen as $key => $asu) {
               $asu->notify(new Newlaporan($jenis, $nama, $namauptd, $aidi));
            }

            return redirect('uptd/laporan/detail/'.$request->renlakgiat_id);
    }

     public function formFsp($id){
        $renlakgiat = Renlakgiat::where('id',$id)->get();
        return view('user.formFsp', compact('renlakgiat'));
    }


    public function uploadFsp($id, Request $request ){
        $this->validate($request,[
            'file' => 'required|mimetypes:application/pdf|max:500',

        ]);

        if ($request->hasFile('file')) {
                $file = $request->file;
                $extension = $file->getClientOriginalExtension();
                $fileName = "Fotocopy Sertifikasi Peserta" . ' ' . $request->renlakgiat_id . '.' . $extension;
                $request->file('file')->move('upload', $fileName);
                $renlakgiat = Renlakgiat::find($id);
                $renlakgiat->fotocopy_sertifikasi_peserta = $fileName;
                $renlakgiat->status_fotocopy_sertifikasi_peserta = "Belum Terverifikasi";

            }
            $renlakgiat->save();
            Session::flash('message', 'Berhasil Upload Fotocopy Sertifikasi Peserta');
            Session::flash('alert-class', 'alert-success');

            $uptdh = Profile::where('users_id', Auth::user()->id)->get();
            foreach ($uptdh as $key => $valued) {
               $namauptd = $valued->nama_lembaga;
            }
            $renlakgiatz = Renlakgiat::where('id', $id)->get();
            foreach ($renlakgiatz as $key => $valuer) {
            $nama = $valuer->kejuruan;
            }
            $jenis = $renlakgiat->fotocopy_sertifikasi_peserta;
            $aidi = $id;
            $admen = Admin::all();
            foreach ($admen as $key => $asu) {
               $asu->notify(new Newlaporan($jenis, $nama, $namauptd, $aidi));
            }

            return redirect('uptd/laporan/detail/'.$request->renlakgiat_id);
    }

    public function sendEmail($id){
        $rr = Renlakgiat::find($id);
        $admin = Admin::all();
        foreach ($admin as $key) {
            $email = $key->email;
        }
				$user = Auth::user()->email;
        Mail::to($email)->send(new LaporanMail($user));
        Session::flash('message', 'Berhasil Mengirimkan email ke admin');
        Session::flash('alert-class', 'alert-success');
        return redirect()->back();

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
                $daftar_permintaan_bahan_pelatihan = $key->daftar_permintaan_bahan_pelatihan;
                $bukti_penerimaan_bahan_pelatihan = $key->bukti_penerimaan_bahan_pelatihan;
                $laporan_mingguan_penggunaan_bahan_pelatihan = $key->laporan_mingguan_penggunaan_bahan_pelatihan;
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
            $pdf->addPDF('upload/'.$daftar_permintaan_bahan_pelatihan, 'all');
            $pdf->addPDF('upload/'.$bukti_penerimaan_bahan_pelatihan, 'all');
            $pdf->addPDF('upload/'.$laporan_mingguan_penggunaan_bahan_pelatihan, 'all');
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
		}
}
