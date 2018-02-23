@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard Pemberitahuan</div>
                <div class="panel-body">
                    @foreach($dokumen as $data)
                        <div class="well well-md">
                            <strong>Judul: {{$data->judul}}</strong><br>
                            {{$data->isi}} - File: {{$data->file}}
                            <a href="{{asset('dokumen/'.$data->file)}}" download>Download</a>
                        </div>
                    @endforeach
                </div>
            </div>
    </div>
</div>
@endsection