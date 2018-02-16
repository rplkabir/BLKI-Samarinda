@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard Profil UPTD</div>
                <div class="panel-body">
                    @foreach($renlakgiat as $data)
                    <form class="form-horizontal" action="{{url('admin/renlakgiat/updateTanggal/'.$data->id)}}" method="POST"  enctype="multipart/form-data">
                        {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('tgl_mulai') ? 'has-error': ''}}">
                                    <label for="tgl_mulai" class="col-md-4 control-label">Tanggal Mulai</label>
                                        <div class="col-md-6">
                                            <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control" value="{{$data->tgl_mulai}}" readonly>
                                        </div>

                                         @if ($errors->has('tgl_mulai'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('tgl_mulai') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('tgl_selesai') ? 'has-error': ''}}">
                                    <label for="tgl_selesai" class="col-md-4 control-label">Tanggal Selesai</label>
                                        <div class="col-md-6">
                                            <input type="date" name="tgl_selesai" id="tgl_selesai" class="form-control" value="{{$data->tgl_selesai}}" readonly>
                                        </div>

                                         @if ($errors->has('tgl_selesai'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('tgl_selesai') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('newtgl_mulai') ? 'has-error': ''}}">
                                    <label for="newtgl_mulai" class="col-md-4 control-label">Tanggal Mulai</label>
                                        <div class="col-md-6">
                                            <input type="date" name="newtgl_mulai" id="tgl_mulai" class="form-control" required value="{{ old('newtgl_mulai')}}" >
                                        </div>

                                         @if ($errors->has('newtgl_mulai'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('newtgl_mulai') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('newtgl_selesai') ? 'has-error': ''}}">
                                    <label for="newtgl_selesai" class="col-md-4 control-label">Tanggal Selesai</label>
                                        <div class="col-md-6">
                                            <input type="date" name="newtgl_selesai" id="tgl_selesai" class="form-control" required value="{{old('newtgl_selesai')}}">
                                        </div>

                                         @if ($errors->has('newtgl_selesai'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('newtgl_selesai') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('alasan') ? 'has-error': ''}}">
                                    <label for="alasan" class="col-md-4 control-label">Alasan</label>
                                        <div class="col-md-6">
                                            <textarea name="alasan" id="alasan" class="form-control">{{ old('alasan') }}    
                                            </textarea>
                                            
                                        </div>

                                         @if ($errors->has('alasan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('alasan') }}</strong>
                                            </span>
                                        @endif
                                </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button class="btn btn-success">Update</button>
                            </div>
                        </div>
                    @endforeach 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
