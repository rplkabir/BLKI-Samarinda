@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard Profil UPTD</div>
                <div class="panel-body">

                    @foreach($profile as $data)
                    <form class="form-horizontal" action="{{url('profile/update/'.$data->id)}}" method="POST"  enctype="multipart/form-data">
                    	{{ csrf_field() }}
                    	   
                    		    <div class="form-group{{ $errors->has('nama_lembaga') ? 'has-error': ''}}">
                                    <label for="nama_lembaga" class="col-md-4 control-label">Nama Lembaga</label>
                                        <div class="col-md-6">
                                            <input type="text" name="nama_lembaga" id="nama_lembaga" class="form-control" value="{{ $data->nama_lembaga }}">
                                        </div>

                                         @if ($errors->has('nama_lembaga'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nama_lembaga') }}</strong>
                                            </span>
                                        @endif
                                </div>
                    			<div class="form-group{{ $errors->has('eselonisasi') ? 'has-error': ''}}">
                                    <label for="eselonisasi" class="col-md-4 control-label">Eselonisasi</label>
                                        <div class="col-md-6">
                                            <input type="text" name="eselonisasi" id="eselonisasi" class="form-control" value="{{ $data->eselonisasi }}">
                                        </div>

                                         @if ($errors->has('eselonisasi'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('eselonisasi') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('provinsi') ? 'has-error': ''}}">
                                    <label for="provinsi" class="col-md-4 control-label">Provinsi</label>
                                        <div class="col-md-6">
                                            <input type="text" name="provinsi" id="provinsi" class="form-control" value="{{ $data->provinsi }}">
                                        </div>

                                         @if ($errors->has('provinsi'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('provinsi') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('kab_kota') ? 'has-error': ''}}">
                                    <label for="kab_kota" class="col-md-4 control-label">Kab/Kota</label>
                                        <div class="col-md-6">
                                            <input type="text" name="kab_kota" id="kab_kota" class="form-control" value="{{ $data->kab_kota }}">
                                        </div>

                                         @if ($errors->has('kab_kota'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('kab_kota') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('alamat') ? 'has-error': ''}}">
                                    <label for="alamat" class="col-md-4 control-label">Alamat Lengkap</label>
                                        <div class="col-md-6">
                                            <input type="text" name="alamat" id="alamat" class="form-control" value="{{ $data->alamat }}">
                                        </div>

                                         @if ($errors->has('alamat'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('alamat') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('no_telp') ? 'has-error': ''}}">
                                    <label for="no_telp" class="col-md-4 control-label">No Telepon</label>
                                        <div class="col-md-6">
                                            <input type="text" name="no_telp" id="no_telp" class="form-control" value="{{ $data->no_telp }}">
                                        </div>

                                         @if ($errors->has('no_telp'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('no_telp') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('no_fax') ? 'has-error': ''}}">
                                    <label for="no_fax" class="col-md-4 control-label">No Fax</label>
                                        <div class="col-md-6">
                                            <input type="text" name="no_fax" id="no_fax" class="form-control" value="{{ $data->no_fax }}">
                                        </div>

                                         @if ($errors->has('no_fax'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('no_fax') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('email_kantor') ? 'has-error': ''}}">
                                    <label for="email_kantor" class="col-md-4 control-label">Email Kantor</label>
                                        <div class="col-md-6">
                                            <input type="email" name="email_kantor" id="email_kantor" class="form-control" value="{{ $data->email_kantor }}">
                                        </div>

                                         @if ($errors->has('email_kantor'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email_kantor') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('website') ? 'has-error': ''}}">
                                    <label for="website" class="col-md-4 control-label">Alamat Website</label>
                                        <div class="col-md-6">
                                            <input type="text" name="website" id="website" class="form-control" value="{{ $data->website }}">
                                        </div>

                                         @if ($errors->has('website'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('website') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('nama_pimpinan') ? 'has-error': ''}}">
                                    <label for="nama_pimpinan" class="col-md-4 control-label">Nama Pimpinan</label>
                                        <div class="col-md-6">
                                            <input type="text" name="nama_pimpinan" id="nama_pimpinan" class="form-control" value="{{ $data->nama_pimpinan }}">
                                        </div>

                                         @if ($errors->has('nama_pimpinan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nama_pimpinan') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('nip') ? 'has-error': ''}}">
                                    <label for="nip" class="col-md-4 control-label">NIP</label>
                                        <div class="col-md-6">
                                            <input type="text" name="nip" id="nip" class="form-control">
                                        </div>

                                         @if ($errors->has('nip'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nip') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('no_hp_pimpinan') ? 'has-error': ''}}">
                                    <label for="no_hp_pimpinan" class="col-md-4 control-label">No Hp Pimpinan</label>
                                        <div class="col-md-6">
                                            <input type="text" name="no_hp_pimpinan" id="no_hp_pimpinan" class="form-control" value="{{ $data->no_hp_pimpinan }}">
                                        </div>

                                         @if ($errors->has('no_hp_pimpinan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('no_hp_pimpinan') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('foto_pimpinan')}}">
                                    <label for="foto_pimpinan" class="col-md-4 control-label" id="foto_pimpinan">Foto Pimpinan</label>
                                        <div class="col-md-6">
                                            <input type="file" name="foto_pimpinan" id="foto_pimpinan" onchange="loadFile(event)"><br>
                                            <img id="pimpinan" width="100" height="100" >
                                            <script>
                                              var loadFile = function(event) {
                                                var pimpinan = document.getElementById('pimpinan');
                                                pimpinan.src = URL.createObjectURL(event.target.files[0]);
                                              };
                                            </script>
                                        </div>
                                        @if ($errors->has('foto_pimpinan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('foto_pimpinan') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group{{ $errors->has('foto_gedung')}}">
                                    <label for="foto_gedung" class="col-md-4 control-label" id="foto_gedung">Foto Gedung</label>
                                        <div class="col-md-6">
                                            <input type="file" name="foto_gedung" id="foto_gedung" onchange="loadFilegedung(event)"><br>
                                            <img id="gedung" width="100" height="100" >
                                            <script>
                                              var loadFilegedung = function(event) {
                                                var gedung = document.getElementById('gedung');
                                                gedung.src = URL.createObjectURL(event.target.files[0]);
                                              };
                                            </script>
                                        </div>
                                        @if ($errors->has('foto_gedung'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('foto_gedung') }}</strong>
                                            </span>
                                        @endif
                                </div>
                            @endforeach
                    	<div class="form-group">
                    		<div class="col-md-8 col-md-offset-4">
                    			<button class="btn btn-success">Update</button>
                    		</div>
                    	</div>
                   		 
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
