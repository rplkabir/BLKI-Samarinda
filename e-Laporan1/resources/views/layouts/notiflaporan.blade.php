@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard Dokumen</div>
                <div class="panel-body">
                   @if(Auth::guard('admin')->check())
                        <?php $data = \DB::table('notifications')->where('type', 'App\Notifications\Newlaporan')->whereNull('read_at')->get();
                        $result = count($data);
                        foreach ($data as $key) {

                        ?>
                                    <li ><a href="{{url('admin/renlakgiat/detail/'.$notif->data['aidi'])}}">
                                      {{ $notif->data['namauptd'] }} 
                                      <b> mengupload Laporan :  </b>{{ $notif->data['jenis'] }} <b>
                                        pada kejuruan </b>{{ $notif->data['nama'] }}</a></li>

                        <?php
                        }
                        ?>
                    @endif
                </div>
            </div>
    </div>
</div>
@endsection
