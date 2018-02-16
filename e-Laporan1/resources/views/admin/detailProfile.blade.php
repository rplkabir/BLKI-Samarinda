@extends('layouts.app')
@section('content')
<style>
    .gedung
    {
        position: relative !important;
        width: 100% !important;
        z-index: 1;
    }
    .pimpinan
    {
        position: absolute !important;
        top: 70% !important; 
        left:10% !important;
        z-index: 2;
    }
    </style>
<div class="container">
    <div class="row">
        
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard Profil UPTD
                </div>
                    @foreach($profile as $data)
                    <div style="width: 100%; height: 100%; position: relative;">
                    <img class="img materialboxed" src="{{asset('upload/'.$data->foto_gedung)}}" height="500" style="width: 100%; z-index: 1; position: relative;">
                    <img class="img materialboxed img-thumbnail" align="center" src="{{asset('upload/'.$data->foto_pimpinan)}}" width="180" height="180" style=" left:5%; top: 70%;  z-index: 2; position: absolute; float: left;">  
                    </div>
                    @endforeach
                <div class="panel-body">
                    <table class="responsive-table" style="width: 100%">
                        @foreach($profile as $data)

                            <tr>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Nama Lembaga</th>
                                <td>{{ $data->nama_lembaga }}</td>
                            </tr>
                            <tr>
                                <th>Eselonisasi</th>
                                <td>{{ $data->eselonisasi }}</td>
                            </tr>
                            <tr>
                                <th>Provinsi</th>
                                <td>{{ $data->provinsi }}</td>
                            </tr>
                            <tr>
                                <th>Kab/Kota</th>
                                <td>{{ $data->kab_kota }}</td>
                            </tr>
                            <tr>
                                <th>Alamat Lengkap</th>
                                <td>{{ $data->alamat }}</td>
                            </tr>
                            <tr>
                                <th>No Telepon</th>
                                <td>{{ $data->no_telp }}</td>
                            </tr>
                            <tr>
                                <th>No Fax</th>
                                <td>{{ $data->no_fax }}</td>
                            </tr>
                            <tr>
                                <th>Email Kantor</th>
                                <td>{{ $data->email_kantor }}</td>
                            </tr>
                            
                        @endforeach
                        
                       
                            
                            
                        </table>
                </div>
            </div>
                
    </div>
</div>
@endsection
