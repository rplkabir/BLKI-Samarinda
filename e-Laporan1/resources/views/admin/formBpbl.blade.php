@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Bukti Penerimaan Bahan Pelatihan</div>
                <div class="panel-body">
                    {!! Form::model($renlakgiat,['files'=>true,'url'=>'admin/renlakgiat/laporan/bpbl/simpan/'.$renlakgiat->id,'class'=>'form-horizontal','enctype' => 'multipart/form-data']) !!}
                                <div>
                                    {!! Form::hidden('id',null) !!}
                                </div>
                                
                                <div class="form-group{{ $errors->has('status_bukti_penerimaan_bahan_pelatihan') ? 'has-error': ''}}">
                                    <label for="status_bukti_penerimaan_bahan_pelatihan" class="col-md-4 control-label">Status Bukti Penerimaan Bahan Pelatihan</label>
                                        <div class="col-md-6">
                                           {!! Form::select('status_bukti_penerimaan_bahan_pelatihan',array('Belum Terverifikasi' => 'Belum Terverifikasi','Revisi' => 'Revisi','Terverifikasi' => 'Terverifikasi') ,null,['class'=>'form-control','placeholder'=>'Status surat_keputusan']) !!}
                                        </div>

                                         @if ($errors->has('status_bukti_penerimaan_bahan_pelatihan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('status_bukti_penerimaan_bahan_pelatihan') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('catatan_bukti_penerimaan_bahan_pelatihan') ? 'has-error': ''}}">
                                    <label for="catatan_bukti_penerimaan_bahan_pelatihan" class="col-md-4 control-label">catatan Bukti Penerimaan Bahan Pelatihan</label>
                                        <div class="col-md-6">
                                            {!! Form::textarea('catatan_bukti_penerimaan_bahan_pelatihan',null,['class'=>'form-control']) !!}
                                        </div>
                                         @if ($errors->has('catatan_bukti_penerimaan_bahan_pelatihan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('catatan_bukti_penerimaan_bahan_pelatihan') }}</strong>
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
