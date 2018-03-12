@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard Dokumen</div>
                <div class="panel-body">
                    @foreach($dokumenuptd as $data)
                        <div class="well well-md">
                            <strong>Pengirim: </strong>{{ $data->User->name }} <br>
                            <strong>Judul:</strong>{{$data->judul}}
                            <strong>Isi: </strong>{{$data->isi}}
                            <strong>File: </strong>{{$data->file}} <br>
                            <a href="{{asset('dokumen/'.$data->file)}}" download>Download</a>
                        </div>
                    @endforeach
                </div>
            </div>
    </div>
</div>
@endsection