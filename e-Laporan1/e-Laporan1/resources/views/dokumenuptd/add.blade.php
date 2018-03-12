@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel panel-heading">Dashboard Dukumen</div>
				<div class="panel-body">
					{{Form::open(['url' => 'uptd/dokumen/simpan','method' => 'POST','files' => true])}}
									<div class="form-group{{ $errors->has('judul') ? 'has-error': ''}}">
		                				<label for="judul" class="col-md-4 control-label">Judul Dokumen</label>
			                				<div class="col-md-6">
			                					{{Form::text('judul',null,['class' => 'form-control'])}}
			                				</div>

			                				 @if ($errors->has('judul'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('judul') }}</strong>
			                                    </span>
			                                @endif
		                    		</div>
	                                <div class="form-group{{ $errors->has('isi') ? 'has-error': ''}}">
	                                    <label for="isi" class="col-md-4 control-label">Isi</label>
	                                        <div class="col-md-6">
	                                            {{Form::textarea('isi',null,['class' => 'form-control'])}}
	                                            
	                                        </div>

	                                         @if ($errors->has('isi'))
	                                            <span class="help-block">
	                                                <strong>{{ $errors->first('isi') }}</strong>
	                                            </span>
	                                        @endif
	                                </div>
		                    		<div class="form-group{{ $errors->has('file')}}">
		                    			<label for="file" class="col-md-4 control-label" id="file">File</label>
			                    			<div class="col-md-6">
			                    				{{Form::file('file',null,['class' => 'form-control'])}}
			                    			</div>
			                    			@if ($errors->has('file'))
			                                    <span class="help-block">
			                                        <strong>{{ $errors->first('file') }}</strong>
			                                    </span>
			                                @endif
	                    			</div>
	                    		<div class="form-group">
		                    		<div class="col-md-8 col-md-offset-4">
		                    			<button class="btn btn-success">Upload</button>
		                    		</div>
                    			</div>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection