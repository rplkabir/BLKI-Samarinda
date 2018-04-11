<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dokumen;
use Auth;
use App\Profile;
use Session;
use Carbon\Carbon;
use App\User;
use App\Notifications\notifdokumen;
use App\Notifications;
use Illuminate\Notifications\Notifiable;

class DokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $dokumen = Dokumen::orderBy('created_at','desc')->get();
        return view('dokumen.index', compact('dokumen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dokumen.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'bail|required|min:6',
            'isi' => 'required',
            'file' => 'bail|required|mimes:pdf|max:500',
        ]);

        if($request->hasFile('file')){
                $request->file('file')->move('dokumen', $request->file->getClientOriginalName());
        }

        $dokumen = new Dokumen;
        $dokumen->judul = $request->judul;
        $dokumen->isi = $request->isi;
        $dokumen->file = $request->file->getClientOriginalName();

        $dokumen->save();

        $isi = $request->isi;
        Session::flash('message','Berhasil Menambahkan Dokumen Khusus untuk diberikan ke seluruh UPTD/BLK');
        $User = User::All();
        foreach ($User as $user) {
            $user->notify(new notifdokumen($isi));
        }
        return redirect()->route('dokumen');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dokumen = Dokumen::where('id',$id)->get();
        return view('dokumen.edit', compact('dokumen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dokumen = Dokumen::find($id);
        $dokumen->delete();
        Session::flash('message','Berhasil Menghapus Dokumen Khusus untuk diberikan ke seluruh UPTD/BLK');
        return redirect()->route('dokumen');
    }

    public function laporanuptd()
    {   
        $useruptd = Profile::all();
        foreach ($useruptd as $value) {
            # code...
        }
        $data = Auth::user()->unreadNotificationsByAdmin;
        $dataread = Auth::user()->unreadNotificationsLaporan;
        return view('dokumen.laporanuptd', compact('useruptd'));
    }

    
}
