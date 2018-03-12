@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Rekap Penilaian Pelatihan Berbasis Kompetensi</div>
                <div class="panel-body">
                    {!! Form::model($renlakgiat,['files'=>true,'url'=>'admin/renlakgiat/laporan/rppbk/simpan/'.$renlakgiat->id,'class'=>'form-horizontal','enctype' => 'multipart/form-data']) !!}
                    <table>
                        <tr>
                            <td>
                                @foreach(DB::table('renlakgiats')->where('id','=',$renlakgiat->id)->get() as $c)
                                    <embed src="{{asset('upload/'.$c->rekap_penilaian_pelatihan_berbasis_kompetensi)}}" width="500" height="475"></embed>
                                @endforeach
                            </td>
                            <td>
                                <div>
                                    {!! Form::hidden('id',null) !!}
                                </div>
                                
                                <div class="form-group{{ $errors->has('status_rekap_penilaian_pelatihan_berbasis_kompetensi') ? 'has-error': ''}}">
                                    <label for="status_rekap_penilaian_pelatihan_berbasis_kompetensi" class="col-md-4 control-label">Status Rekap Penilaian Pelatihan Berbasis Kompetensi</label>
                                        <div class="col-md-6">
                                           {!! Form::select('status_rekap_penilaian_pelatihan_berbasis_kompetensi',array('Belum Terverifikasi' => 'Belum Terverifikasi','Revisi' => 'Revisi','Terverifikasi' => 'Terverifikasi') ,null,['class'=>'form-control','placeholder'=>'Status surat_keputusan']) !!}
                                        </div>

                                         @if ($errors->has('status_rekap_penilaian_pelatihan_berbasis_kompetensi'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('status_rekap_penilaian_pelatihan_berbasis_kompetensi') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('catatan_rekap_penilaian_pelatihan_berbasis_kompetensi') ? 'has-error': ''}}">
                                    <label for="catatan_rekap_penilaian_pelatihan_berbasis_kompetensi" class="col-md-4 control-label">catatan Rekap Penilaian Pelatihan Berbasis Kompetensi</label>
                                        <div class="col-md-6">
                                            {!! Form::textarea('catatan_rekap_penilaian_pelatihan_berbasis_kompetensi',null,['class'=>'form-control']) !!}
                                        </div>
                                         @if ($errors->has('catatan_rekap_penilaian_pelatihan_berbasis_kompetensi'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('catatan_rekap_penilaian_pelatihan_berbasis_kompetensi') }}</strong>
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
