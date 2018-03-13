@extends('layouts.app')
@section('content')
<style type="text/css">
    li {
        list-style-type: none;
    }
    hr
{
border:solid 1px black;
width: 96%;
color: #FFFF00;
height: 1px;

}
</style>
<div class="container">
    <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard Dokumen</div>
                <div class="panel-body">
                    <ul class="collapsible" data-collapsible="accordion">
                        <li>
                          <div class="collapsible-header"><i class="material-icons">filter_drama</i>Laporan Baru</div>
                          <div class="collapsible-body">
                              <?php
                                $data = Auth::user()->unreadNotificationsByAdmin; ?>
                                @foreach($data as $notif)
                                <a onclick="marknotifasread()"  href="{{url('admin/renlakgiat/detail/'.$notif->data['aidi'])}}">{{ $notif->data['namauptd'] }}
                                  <b> mengupload Laporan :  </b>{{ $notif->data['jenis'] }} <b> pada kejuruan </b>{{ $notif->data['nama'] }} </a><i class="pull-right"> {{ $notif->created_at }} </i>
                                  <hr>
                                <br>
                                @endforeach

                          </div>
                        </li>
                      </ul>
                      <ul class="collapsible" data-collapsible="accordion">
                        <li>
                          <div class="collapsible-header"><i class="material-icons">filter_drama</i>Laporan Sebelumnya</div>
                          <div class="collapsible-body">
                              <?php
                                $dataread = Auth::user()->unreadNotificationsLaporan; ?>
                                @foreach($dataread as $notif)
                                  <a href="{{url('admin/renlakgiat/detail/'.$notif->data['aidi'])}}">{{ $notif->data['namauptd'] }}
                                    <b> mengupload Laporan :  </b>{{ $notif->data['jenis'] }} <b> pada kejuruan </b>{{ $notif->data['nama'] }} </a> <br> <i class="pull-right"> {{ $notif->created_at }} </i>
                                    <hr>
                                  <br>
                                @endforeach
                          </div>
                        </li>
                      </ul>
                </div>
            </div>
    </div>
</div>
@endsection
