@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Foto Dokumentasi Kegiatan</div>
                <div class="panel-body">
                    {!! Form::model($renlakgiat,['files'=>true,'url'=>'admin/renlakgiat/laporan/fdk/simpan/'.$renlakgiat->id,'class'=>'form-horizontal','enctype' => 'multipart/form-data']) !!}
                    <table>
                        <tr>
                            <td>
                                @foreach(DB::table('renlakgiats')->where('id','=',$renlakgiat->id)->get() as $c)
                                    <embed src="{{asset('upload/'.$c->foto_dokumentasi_kegiatan)}}" width="500" height="475"></embed>
                                @endforeach
                            </td>
                            <td>
                                <div>
                                    {!! Form::hidden('id',null) !!}
                                </div>
                                
                                <div class="form-group{{ $errors->has('status_foto_dokumentasi_kegiatan') ? 'has-error': ''}}">
                                    <label for="status_foto_dokumentasi_kegiatan" class="col-md-4 control-label">Status Foto Dokumentasi Kegiatan</label>
                                        <div class="col-md-6">
                                           {!! Form::select('status_foto_dokumentasi_kegiatan',array('Belum Terverifikasi' => 'Belum Terverifikasi','Revisi' => 'Revisi','Terverifikasi' => 'Terverifikasi') ,null,['class'=>'form-control','placeholder'=>'Status surat_keputusan']) !!}
                                        </div>

                                         @if ($errors->has('status_foto_dokumentasi_kegiatan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('status_foto_dokumentasi_kegiatan') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('catatan_foto_dokumentasi_kegiatan') ? 'has-error': ''}}">
                                    <label for="catatan_foto_dokumentasi_kegiatan" class="col-md-4 control-label">catatan Foto Dokumentasi Kegiatan</label>
                                        <div class="col-md-6">
                                            {!! Form::textarea('catatan_foto_dokumentasi_kegiatan',null,['class'=>'form-control']) !!}
                                        </div>
                                         @if ($errors->has('catatan_foto_dokumentasi_kegiatan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('catatan_foto_dokumentasi_kegiatan') }}</strong>
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
                    </table>
                    {!! Form::close() !!}
                   
                </div>
            </div>
        </div>
@endsection
