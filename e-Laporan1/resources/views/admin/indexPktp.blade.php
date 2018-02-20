@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>DATA Pengelola @foreach($pktp as $ss) {{ $ss->User->name }} @endforeach</strong></div>
                    
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th>Nama</th>
                            <th>Nip</th>
                            <th>Pangkat</th>
                            <th>Jabatan</th>
                            <th>Kedudukan Tim</th>
                            <th>Alamat</th>
                            <th>No. Hp</th>
                            <th>Foto</th>
                           
                        </tr>
                        <?php $x=1; ?>
                        @foreach($pktp as $data)
                            <tr>
                                <td>{{ $x++ }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->pangkat }}</td>
                                <td>{{ $data->jabatan }}</td>
                                <td>{{ $data->kedudukan }}</td>
                                <td>{{ $data->alamat }}</td>
                                <td>{{ $data->nohp }}</td>
                                <td><img src="{{asset('upload/'.$data->foto)}}" width="120" height="120"></td>
                         @endforeach
                    </table>
                    {{ $pktp->links()}}
                </div>
            </div>
        
    </div>
</div>
@endsection