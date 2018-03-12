@extends('layouts.app')
@section('content')
	

	<div class="container">
		 <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard Renlakgiat
                </div>
               
                <div class="panel-body">
                   <div class="form-horizontal">

                   	@foreach($user as $data)
                   	<form class="form-group" action="{{url('/uptd/editpass/update/'.$data->id)}}" method="POST"  enctype="multipart/form-data">
                   	@endforeach
                   	{{ csrf_field() }}
                                    <label for="excel" class="col-md-4 control-label">Old Password</label>
                                        <div class="col-md-6">
                                            <input type="Password" name="old" class="form-control">
                                    </div>
                                    <label for="excel" class="col-md-4 control-label">New Password</label>
                                        <div class="col-md-6">
                                            <input type="Password" name="new" class="form-control">
                                    </div>
                                    <div class="col-md-8 col-md-offset-4">
                                    <button class="btn btn-success">submit</button>
                                    </div>
                     </form>

                   </div>
                </div>
            </div>
        
    </div>
	</div>

@endsection