@extends('layouts.app')

@section('content')
    <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard Profil UPTD</div>
                <div class="panel-body">
                    {{ Form::model($renlakgiat,['url' => 'admin/update-tanggal-laporan/'.$renlakgiat->id])}}
                                <div class="form-group{{ $errors->has('tgl_mulai') ? 'has-error': ''}}">
                                    <label for="tgl_mulai" class="col-md-4 control-label">Tanggal Kumpul Laporan Sebelumnya</label>
                                        <div class="col-md-6">
                                           {{ Form::date('tgl_kumpul_laporan',null,['class' => 'form-control','readonly'])}}
                                        </div>

                                         @if ($errors->has('tgl_mulai'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('tgl_mulai') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('tgl_mulai') ? 'has-error': ''}}">
                                    <label for="tgl_mulai" class="col-md-4 control-label">Tanggal Kumpul Laporan Baru</label>
                                        <div class="col-md-6">
                                           {{ Form::date('tgl_kumpul_laporan_baru',null,['class' => 'form-control','required'])}}
                                        </div>

                                         @if ($errors->has('tgl_mulai'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('tgl_mulai') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button class="btn btn-success">Update</button>
                            </div>
                        </div>
                   
                    {{ Form::close() }}
                </div>
            </div>
        </div>
@endsection
