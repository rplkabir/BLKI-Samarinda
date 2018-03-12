@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard Profil UPTD</div>
                <div class="panel-body">
                    
                    {{ Form::model($renlakgiat,['url' => 'admin/updateTanggalLaporan/'.$renlakgiat->id]) }}
                        {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('tgl_kumpul_laporan') ? 'has-error': ''}}">
                                    <label for="tgl_kumpul_laporan" class="col-md-4 control-label">Tanggal Kumpul Laporan</label>
                                        <div class="col-md-6">
                                            {{ Form::date('tgl_kumpul_laporan',null,['class' => 'form-control', 'id' => 'tgl_kumpul_laporan' ,'readonly'])}}
                                        </div>

                                         @if ($errors->has('tgl_kumpul_laporan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('tgl_kumpul_laporan') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('new_tanggal_kumpul_laporan') ? 'has-error': ''}}">
                                    <label for="new_tanggal_kumpul_laporan" class="col-md-4 control-label">Tanggal Kumpul Laporan Baru</label>
                                        <div class="col-md-6">
                                            {{ Form::date('new_tgl_kumpul_laporan',null,['class' => 'form-control', 'id' => 'new_tgl_kumpul_laporan', 'placeholder'=> 'Tanggal Batas Pengumpulan Laporan Baru']) }}
                                        </div>

                                         @if ($errors->has('new_tanggal_kumpul_laporan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('new_tanggal_kumpul_laporan') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button class="btn btn-success">Update</button>
                            </div>
                        </div>
               
                    {{ Form::close()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
