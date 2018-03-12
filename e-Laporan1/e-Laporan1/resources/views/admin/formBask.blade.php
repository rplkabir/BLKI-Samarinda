@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Berita Acara Sidang Kelulusan</div>
                <div class="panel-body">
                    {!! Form::model($renlakgiat,['files'=>true,'url'=>'admin/renlakgiat/laporan/bask/simpan/'.$renlakgiat->id,'class'=>'form-horizontal','enctype' => 'multipart/form-data']) !!}
                    <table>
                        <tr>
                            <td>
                                @foreach(DB::table('renlakgiats')->where('id','=',$renlakgiat->id)->get() as $c)
                                    <embed src="{{asset('upload/'.$c->berita_acara_sidang_kelulusan)}}" width="500" height="475"></embed>
                                @endforeach
                            </td>
                            <td>
                                <div>
                                    {!! Form::hidden('id',null) !!}
                                </div>
                                
                                <div class="form-group{{ $errors->has('status_berita_acara_sidang_kelulusan') ? 'has-error': ''}}">
                                    <label for="status_berita_acara_sidang_kelulusan" class="col-md-4 control-label">Status Berita Acara Sidang Kelulusan</label>
                                        <div class="col-md-6">
                                           {!! Form::select('status_berita_acara_sidang_kelulusan',array('Belum Terverifikasi' => 'Belum Terverifikasi','Revisi' => 'Revisi','Terverifikasi' => 'Terverifikasi') ,null,['class'=>'form-control','placeholder'=>'Status surat_keputusan']) !!}
                                        </div>

                                         @if ($errors->has('status_berita_acara_sidang_kelulusan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('status_berita_acara_sidang_kelulusan') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('catatan_berita_acara_sidang_kelulusan') ? 'has-error': ''}}">
                                    <label for="catatan_berita_acara_sidang_kelulusan" class="col-md-4 control-label">catatan Berita Acara Sidang Kelulusan</label>
                                        <div class="col-md-6">
                                            {!! Form::textarea('catatan_berita_acara_sidang_kelulusan',null,['class'=>'form-control']) !!}
                                        </div>
                                         @if ($errors->has('catatan_berita_acara_sidang_kelulusan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('catatan_berita_acara_sidang_kelulusan') }}</strong>
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
