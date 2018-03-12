@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">daftar permintaan bahan pelatihan</div>
                <div class="panel-body">
                    {!! Form::model($renlakgiat,['files'=>true,'url'=>'admin/renlakgiat/laporan/dpbl/simpan/'.$renlakgiat->id,'class'=>'form-horizontal','enctype' => 'multipart/form-data']) !!}
                    <table>
                        <tr>
                            <td>
                                @foreach(DB::table('renlakgiats')->where('id','=',$renlakgiat->id)->get() as $c)
                                    <embed src="{{asset('upload/'.$c->daftar_permintaan_bahan_pelatihan)}}" width="500" height="475"></embed>
                                @endforeach
                            </td>
                            <td>
                                <div>
                                    {!! Form::hidden('id',null) !!}
                                </div>
                                
                                <div class="form-group{{ $errors->has('status_daftar_permintaan_bahan_pelatihan') ? 'has-error': ''}}">
                                    <label for="status_daftar_permintaan_bahan_pelatihan" class="col-md-4 control-label">Status daftar permintaan bahan pelatihan</label>
                                        <div class="col-md-6">
                                           {!! Form::select('status_daftar_permintaan_bahan_pelatihan',array('Belum Terverifikasi' => 'Belum Terverifikasi','Revisi' => 'Revisi','Terverifikasi' => 'Terverifikasi') ,null,['class'=>'form-control','placeholder'=>'Status surat_keputusan']) !!}
                                        </div>

                                         @if ($errors->has('status_daftar_permintaan_bahan_pelatihan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('status_daftar_permintaan_bahan_pelatihan') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('catatan_daftar_permintaan_bahan_pelatihan') ? 'has-error': ''}}">
                                    <label for="catatan_daftar_permintaan_bahan_pelatihan" class="col-md-4 control-label">catatan daftar permintaan bahan pelatihan</label>
                                        <div class="col-md-6">
                                            {!! Form::textarea('catatan_daftar_permintaan_bahan_pelatihan',null,['class'=>'form-control']) !!}
                                        </div>
                                         @if ($errors->has('catatan_daftar_permintaan_bahan_pelatihan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('catatan_daftar_permintaan_bahan_pelatihan') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button class="btn btn-success">Update</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
@endsection
