@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard Profil UPTD</div>
                <div class="panel-body">
                    @foreach($renlakgiat as $data)
                    <form class="form-horizontal" action="{{url('admin/renlakgiat/update/'.$data->id)}}" method="POST"  enctype="multipart/form-data">
                    	{{ csrf_field() }}
                    	
                    		    <div class="form-group{{ $errors->has('kejuruan') ? 'has-error': ''}}">
                                    <label for="kejuruan" class="col-md-4 control-label">Kejuruan</label>
                                        <div class="col-md-6">
                                            <input type="text" name="kejuruan" id="kejuruan" class="form-control" value="{{$data->kejuruan}}" required>
                                        </div>

                                         @if ($errors->has('kejuruan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('kejuruan') }}</strong>
                                            </span>
                                        @endif
                                </div>
                    			<div class="form-group{{ $errors->has('program_pelatihan') ? 'has-error': ''}}">
                                    <label for="program_pelatihan" class="col-md-4 control-label">Program Pelatihan</label>
                                        <div class="col-md-6">
                                            <input type="text" name="program_pelatihan" id="program_pelatihan" class="form-control" value="{{$data->program_pelatihan}}" required>
                                        </div>

                                         @if ($errors->has('program_pelatihan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('program_pelatihan') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('sumber_dana') ? 'has-error': ''}}">
                                    <label for="sumber_dana" class="col-md-4 control-label">Sumber Dana</label>
                                        <div class="col-md-6">
                                            <input type="text" name="sumber_dana" id="sumber_dana" class="form-control" value="{{$data->sumber_dana}}" required>
                                        </div>

                                         @if ($errors->has('sumber_dana'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('sumber_dana') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('durasi') ? 'has-error': ''}}">
                                    <label for="durasi" class="col-md-4 control-label">Durasi</label>
                                        <div class="col-md-6">
                                            <input type="text" name="durasi" id="durasi" class="form-control" required value="{{$data->durasi}}">
                                        </div>

                                         @if ($errors->has('durasi'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('durasi') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('paket') ? 'has-error': ''}}">
                                    <label for="paket" class="col-md-4 control-label">Paket</label>
                                        <div class="col-md-6">
                                            <input type="text" name="paket" id="paket" class="form-control" required value="{{$data->paket}}">
                                        </div>

                                         @if ($errors->has('paket'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('paket') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('orang') ? 'has-error': ''}}">
                                    <label for="orang" class="col-md-4 control-label">Orang</label>
                                        <div class="col-md-6">
                                            <input type="text" name="orang" id="orang" class="form-control" required value="{{$data->orang}}">
                                        </div>

                                         @if ($errors->has('orang'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('orang') }}</strong>
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
