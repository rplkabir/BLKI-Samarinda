@extends('layouts.app')
@section('content')
<style type="text/css">
    li {
        list-style-type: none;
    }
</style>
<div class="container">
    <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard Dokumen</div>
                <div class="panel-body">
                    <strong>Laporan Baru    :</strong>
                    @foreach(Auth::user()->unreadNotificationsByAdmin as $notif)
                                            <li ><a href="{{url('admin/renlakgiat/detail/'.$notif->data['aidi'])}}">{{ $notif->data['namauptd'] }} 
                                            <b> mengupload Laporan :  </b>{{ $notif->data['jenis'] }} <b> pada kejuruan </b>{{ $notif->data['nama'] }}      </a>{{ $notif->created_at }}</li>
                    @endforeach
                    <div><br></div>
                    <strong>Laporan Sebelumnya    :</strong>
                    @foreach(Auth::user()->readNotificationsByAdmin as $notif)
                                            <li ><a href="{{url('admin/renlakgiat/detail/'.$notif->data['aidi'])}}">{{ $notif->data['namauptd'] }} 
                                            <b> mengupload Laporan :  </b>{{ $notif->data['jenis'] }} <b> pada kejuruan </b>{{ $notif->data['nama'] }}      &emsp; &emsp; &emsp; &emsp;</a>{{ $notif->created_at }}</li>
                    @endforeach
                   
                </div>
            </div>
    </div>
</div>
@endsection