@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Upload Kurikulum</div>
                <div class="panel-body">
                    @foreach($renlakgiat as $data)
                        <form class="form-horizontal" action="{{url('uptd/renlakgiat/laporan/kurikulum/simpan/'.$data->id)}}" method="POST"  enctype="multipart/form-data">
                    	{{ csrf_field() }}
                        
                                <div class="form-group{{ $errors->has('renlakgiat_id') ? 'has-error': ''}}">
                                    <input type="hidden" name="renlakgiat_id" id="renlakgiat_id" class="form-control" value="{{ $data->id }}" readonly required>
                                </div>
                        		 
                                <br>   
                                <div class="form-group{{ $errors->has('file') ? 'has-error': ''}}">
                                    <label for="file" class="col-md-4 control-label">Kurikulum</label>
                                        <div class="col-md-6">
                                            <input type="file" name="file" id="file" class="form-control" required>
                                        </div>

                                         @if ($errors->has('file'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('file') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group">
                                    <label class="col-md-8 control-label">Format File PDF, Maksimal ukuran file adalah 500 Kb</label>
                                </div>
                                    
                    	<div class="form-group">
                    		<div class="col-md-8 col-md-offset-4">
                    			<button class="btn btn-success">Upload</button>
                    		</div>
                    	</div>
                   		
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
