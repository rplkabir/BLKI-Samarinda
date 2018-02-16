<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\User;
use App\Renlakgiat;
use Lava;
use Charts;
use DB;
use Carbon\Carbon;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Profile::all();
        if (count($user) > 0) {
        
            foreach ($user as $data) {
                $userid = $data->users_id;
                 $belum = Renlakgiat::where('users_id',$userid)->where('status', 'Belum Berjalan')->get();
                 $sedang = Renlakgiat::where('users_id',$userid)->where('status', 'Sedang Berjalan')->get();
                 $telah = Renlakgiat::where('users_id',$userid)->where('status', 'Sudah Selesai')->get();
                 $null = Renlakgiat::where('users_id',$userid)->where('status', (NULL))->get();
                 $data->nama_lembaga = Charts::create('donut', 'highcharts')
                        ->title($data->nama_lembaga)
                        ->labels(['Belum Berjalan', 'Sedang Berjalan', 'Sudah Selesai','Belum Direncanakan'])
                        ->values([count($belum),count($sedang),count($telah),count($null)])
                        ->dimensions(1000,500)
                        ->responsive(false)
                        ->credits(false);
                        return view('admin', compact('user'), ['chart' => $data->nama_lembaga]);
            }

        }else{
            return view('admin', compact('user'));
        }
    }
}
