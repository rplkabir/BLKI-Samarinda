@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard Profil UPTD</div>
                <div class="panel-body">
                    <form class="form-horizontal" action="{{url('uptd/pktp/simpan/')}}" method="POST"  enctype="multipart/form-data">
                    	{{ csrf_field() }}
                    		    <div class="form-group{{ $errors->has('nama') ? 'has-error': ''}}">
                                    <label for="nama" class="col-md-4 control-label">Nama</label>
                                        <div class="col-md-6">
                                            <input type="text" name="nama" id="nama" class="form-control" required>
                                        </div>

                                         @if ($errors->has('nama'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nama') }}</strong>
                                            </span>
                                        @endif
                                </div>
                    			<div class="form-group{{ $errors->has('nip') ? 'has-error': ''}}">
                                    <label for="nip" class="col-md-4 control-label">Nip</label>
                                        <div class="col-md-6">
                                            <input type="number" name="nip" id="nip" class="form-control" required>
                                        </div>

                                         @if ($errors->has('nip'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nip') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('pangkat') ? 'has-error': ''}}">
                                    <label for="pangkat" class="col-md-4 control-label">Pangkat</label>
                                        <div class="col-md-6">
                                            <input type="text" name="pangkat" id="pangkat" class="form-control" required>
                                        </div>

                                         @if ($errors->has('pangkat'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('pangkat') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('jabatan') ? 'has-error': ''}}">
                                    <label for="jabatan" class="col-md-4 control-label">Jabatan</label>
                                        <div class="col-md-6">
                                            <input type="text" name="jabatan" id="jabatan" class="form-control" required>
                                        </div>

                                         @if ($errors->has('jabatan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('jabatan') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('kedudukan') ? 'has-error': ''}}">
                                    <label for="kedudukan" class="col-md-4 control-label">Kedudukan</label>
                                        <div class="col-md-6">
                                            <input type="text" name="kedudukan" id="kedudukan" class="form-control" required>
                                        </div>

                                         @if ($errors->has('kedudukan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('kedudukan') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('alamat') ? 'has-error': ''}}">
                                    <label for="alamat" class="col-md-4 control-label">Alamat</label>
                                        <div class="col-md-6">
                                            <input type="text" name="alamat" id="alamat" class="form-control" required>
                                        </div>

                                         @if ($errors->has('alamat'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('alamat') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('nohp') ? 'has-error': ''}}">
                                    <label for="nohp" class="col-md-4 control-label">No. Hp</label>
                                        <div class="col-md-6">
                                            <input type="number" name="nohp" id="nohp" class="form-control" required>
                                        </div>

                                         @if ($errors->has('nohp'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nohp') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('foto') ? 'has-error': ''}}">
                                    <label for="foto" class="col-md-4 control-label">Foto</label>
                                        <div class="col-md-6">
                                            <input type="file" name="foto" id="foto" class="form-control" required>
                                        </div>

                                         @if ($errors->has('foto'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('foto') }}</strong>
                                            </span>
                                        @endif
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
