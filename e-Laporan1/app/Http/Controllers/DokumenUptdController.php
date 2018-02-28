<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DokumenUptd;
use Session;
use Auth;

class DokumenUptdController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index()
    {
        $dokumenuptd = DokumenUptd::where('users_id',Auth::user()->id)->orderBy('created_at','desc')->get();
        return view('dokumenuptd.index', compact('dokumenuptd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dokumenuptd.add');
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
            'judul' => 'required|min:6',
            'isi' => 'required',
            'file' => 'required|mimes:pdf|max:500',
        ]);

        if($request->hasFile('file')){
                $request->file('file')->move('dokumen', $request->file->getClientOriginalName());
        }

        $dokumenuptd = new DokumenUptd;
        $dokumenuptd->judul = $request->judul;
        $dokumenuptd->isi = $request->isi;
        $dokumenuptd->file = $request->file->getClientOriginalName();
        $dokumenuptd->users_id = Auth::user()->id;
        $dokumenuptd->save();

        Session::flash('message','Berhasil Mengupload Dokumen');
        
        return redirect('uptd/dokumen/index');
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
        //
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
        $dokumenuptd = DokumenUptd::find($id);
        $dokumenuptd->delete();
        Session::flash('message','Berhasil Menghapus Dokumen');
        return redirect('uptd/dokumen/index');
    }
}
