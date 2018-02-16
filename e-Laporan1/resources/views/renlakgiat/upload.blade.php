@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard Profil UPTD</div>
                <div class="panel-body">
                    @foreach($user as $data)
                        <form class="form-horizontal" action="{{url('/admin/renlakgiat/upload/'.$data->id)}}" method="POST"  enctype="multipart/form-data">
                    @endforeach
                        {{ csrf_field() }}
                    		    <div class="form-group">
                                    <label for="excel" class="col-md-4 control-label">Excel File</label>
                                        <div class="col-md-6">
                                            <input type="file" name="excel" class="form-control" required>
                                        </div>
                                </div>
                    	<div class="form-group">
                    		<div class="col-md-8 col-md-offset-4">
                    			<button class="btn btn-success">Simpan</button>
                    		</div>
                    	</div>
                   		
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
