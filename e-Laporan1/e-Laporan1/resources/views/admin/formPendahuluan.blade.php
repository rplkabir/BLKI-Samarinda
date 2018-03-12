@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Pendahuluan</div>
                <div class="panel-body">
                    {!! Form::model($renlakgiat,['files'=>true,'url'=>'admin/renlakgiat/laporan/pendahuluan/simpan/'.$renlakgiat->id,'class'=>'form-horizontal','enctype' => 'multipart/form-data']) !!}   
                        <table>
                            <tr>
                                <td>
                                    @foreach(DB::table('renlakgiats')->where('id','=',$renlakgiat->id)->get() as $c)
                                            <embed src="{{asset('upload/'.$c->pendahuluan)}}" width="500" height="475"></embed>
                                    @endforeach
                                </td>
                                <td>
                                    <div>
                                        {!! Form::hidden('id',null) !!}
                                    </div>
                                            <div class="form-group{{ $errors->has('status_pendahuluan') ? 'has-error': ''}}">
                                                <label for="status_pendahuluan" class="col-md-4 control-label">Status Pendahuluan</label>
                                                    <div class="col-md-6">
                                                       {!! Form::select('status_pendahuluan',array('Belum Terverifikasi' => 'Belum Terverifikasi','Revisi' => 'Revisi','Terverifikasi' => 'Terverifikasi') ,null,['class'=>'form-control','placeholder'=>'Status pendahuluan']) !!}
                                                    </div>

                                                     @if ($errors->has('status_pendahuluan'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('status_pendahuluan') }}</strong>
                                                        </span>
                                                    @endif
                                            </div>
                                            <div class="form-group{{ $errors->has('catatan_pendahuluan') ? 'has-error': ''}}">
                                                <label for="catatan_pendahuluan" class="col-md-4 control-label">Status pendahuluan</label>
                                                    <div class="col-md-6">
                                                        {!! Form::textarea('catatan_pendahuluan',null,['class'=>'form-control']) !!}
                                                    </div>
                                                     @if ($errors->has('catatan_pendahuluan'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('catatan_pendahuluan') }}</strong>
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
