@extends('layouts.app')
@section('content')
    <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard Pengelola
                    
                     <a class="pull-right" align="right" href="{{url('uptd/pktp/tambah/'.Auth::user()->id)}}"><button class="btn btn-link">Tambah Data Pengelola</button></a>
                    
                </div>

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
                            <th>Aksi</th>
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
                                <td>
                                    <a href="{{url('uptd/pktp/edit/'.$data->id)}}" onclick="return confirm('Yakin ingin mengubah data?');"><i class="material-icons">edit</i></a>
                                    <a href="{{url('uptd/pktp/hapus/'.$data->id)}}" onclick="return confirm('Yakin ingin menghapus data?');"><i style="color: red" class="material-icons">delete</i></a>
                                </td>
                        @endforeach
                    </table>
                    {{ $pktp->links()}}
                </div>
            </div>

    </div>

@endsection
