@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">daftar nilai akhir</div>
                <div class="panel-body">
                    {!! Form::model($renlakgiat,['files'=>true,'url'=>'admin/renlakgiat/laporan/dna/simpan/'.$renlakgiat->id,'class'=>'form-horizontal','enctype' => 'multipart/form-data']) !!}
                    <table>
                        <tr>
                            <td>
                                @foreach(DB::table('renlakgiats')->where('id','=',$renlakgiat->id)->get() as $c)
                                    <embed src="{{asset('upload/'.$c->daftar_nilai_akhir)}}" width="500" height="475"></embed>
                                @endforeach
                            </td>
                            <td>
                                <div>
                                    {!! Form::hidden('id',null) !!}
                                </div>
                                
                                <div class="form-group{{ $errors->has('status_daftar_nilai_akhir') ? 'has-error': ''}}">
                                    <label for="status_daftar_nilai_akhir" class="col-md-4 control-label">Status daftar nilai akhir</label>
                                        <div class="col-md-6">
                                           {!! Form::select('status_daftar_nilai_akhir',array('Belum Terverifikasi' => 'Belum Terverifikasi','Revisi' => 'Revisi','Terverifikasi' => 'Terverifikasi') ,null,['class'=>'form-control','placeholder'=>'Status surat_keputusan']) !!}
                                        </div>

                                         @if ($errors->has('status_daftar_nilai_akhir'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('status_daftar_nilai_akhir') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('catatan_daftar_nilai_akhir') ? 'has-error': ''}}">
                                    <label for="catatan_daftar_nilai_akhir" class="col-md-4 control-label">catatan daftar nilai akhir</label>
                                        <div class="col-md-6">
                                            {!! Form::textarea('catatan_daftar_nilai_akhir',null,['class'=>'form-control']) !!}
                                        </div>
                                         @if ($errors->has('catatan_daftar_nilai_akhir'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('catatan_daftar_nilai_akhir') }}</strong>
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
