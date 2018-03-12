@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard Pemberitahuan</div>
                <div class="panel-body">
                @foreach($dokumen as $data)
                    <form class="form-horizontal" action="{{url('admin/dokumen/update/'.$data->id)}}" method="POST"  enctype="multipart/form-data">
                    	{{ csrf_field() }}
                    	
                    		
                    			<div class="form-group{{ $errors->has('judul') ? 'has-error': ''}}">
	                				<label for="judul" class="col-md-4 control-label">Judul</label>
		                				<div class="col-md-6">
		                					<input type="text" name="judul" id="judul" class="form-control" value="{{ $data->judul }}">
		                				</div>

		                				 @if ($errors->has('judul'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('judul') }}</strong>
		                                    </span>
		                                @endif
	                    		</div>
                                <div class="form-group{{ $errors->has('isi') ? 'has-error': ''}}">
                                    <label for="isi" class="col-md-4 control-label">isi</label>
                                        <div class="col-md-6">
                                            <textarea name="isi" id="isi" class="form-control">{{ $data->isi }}</textarea>
                                            
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
		                    				<input type="file" name="file" id="file">
		                    			</div>
		                    			@if ($errors->has('file'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('file') }}</strong>
		                                    </span>
		                                @endif
                    			</div>
                    		
                @endforeach
                    	<div class="form-group">
                    		<div class="col-md-8 col-md-offset-4">
                    			<button class="btn btn-success">Upload</button>
                    		</div>
                    	</div>
                   		
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
