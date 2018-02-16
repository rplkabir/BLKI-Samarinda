@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">daftar permintaan bahan latihan</div>
                <div class="panel-body">
                    {!! Form::model($renlakgiat,['files'=>true,'url'=>'admin/renlakgiat/laporan/dpbl/simpan/'.$renlakgiat->id,'class'=>'form-horizontal','enctype' => 'multipart/form-data']) !!}
                                <div>
                                    {!! Form::hidden('id',null) !!}
                                </div>
                                
                                <div class="form-group{{ $errors->has('status_daftar_permintaan_bahan_latihan') ? 'has-error': ''}}">
                                    <label for="status_daftar_permintaan_bahan_latihan" class="col-md-4 control-label">Status daftar permintaan bahan latihan</label>
                                        <div class="col-md-6">
                                           {!! Form::select('status_daftar_permintaan_bahan_latihan',array('Belum Terverifikasi' => 'Belum Terverifikasi','Revisi' => 'Revisi','Terverifikasi' => 'Terverifikasi') ,null,['class'=>'form-control','placeholder'=>'Status surat_keputusan']) !!}
                                        </div>

                                         @if ($errors->has('status_daftar_permintaan_bahan_latihan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('status_daftar_permintaan_bahan_latihan') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('catatan_daftar_permintaan_bahan_latihan') ? 'has-error': ''}}">
                                    <label for="catatan_daftar_permintaan_bahan_latihan" class="col-md-4 control-label">catatan daftar permintaan bahan latihan</label>
                                        <div class="col-md-6">
                                            {!! Form::textarea('catatan_daftar_permintaan_bahan_latihan',null,['class'=>'form-control']) !!}
                                        </div>
                                         @if ($errors->has('catatan_daftar_permintaan_bahan_latihan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('catatan_daftar_permintaan_bahan_latihan') }}</strong>
                                            </span>
                                        @endif
                                </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button class="btn btn-success">Update</button>
                            </div>
                        </div>
                        
                    {!! Form::close() !!}
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
