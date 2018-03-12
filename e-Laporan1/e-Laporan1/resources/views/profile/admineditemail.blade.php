@extends('layouts.app')
@section('content')


	<div class="container">
		 <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard Renlakgiat
                </div>

                <div class="panel-body">
                   <div class="form-horizontal">

                   	@foreach($admin as $data)
                   	<form class="form-group" action="{{url('/admin/updateemail/'.$data->id)}}" method="POST"  enctype="multipart/form-data">
                   	{{ csrf_field() }}
                      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                          <label for="email" class="col-md-4 control-label flow-text">E-Mail Lama</label>

                          <div class="col-md-6">
                              <input id="email" type="email" class="form-control" name="email" value="{{ $data->email }}" readonly autofocus>

                              @if ($errors->has('email'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('email') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group{{ $errors->has('newemail') ? ' has-error' : '' }}">
                          <label for="newemail" class="col-md-4 control-label flow-text">E-Mail Baru</label>

                          <div class="col-md-6">
                              <input id="newemail" type="email" class="form-control" name="newemail" autofocus>

                              @if ($errors->has('newemail'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('newemail') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                          <label for="password" class="col-md-4 control-label flow-text">Password</label>

                          <div class="col-md-6">
                              <input id="password" type="password" class="form-control" name="password" required>

                              @if ($errors->has('password'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('password') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-md-8 col-md-offset-4">
                              <button type="submit" class="btn btn-primary">
                                  Login
                              </button>
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
