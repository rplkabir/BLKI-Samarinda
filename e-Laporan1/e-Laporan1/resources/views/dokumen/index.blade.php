@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard Dokumen Khusus
                    <a class="pull-right" align="right" href="{{route('dokumen.add')}}"><button class="btn btn-link">Tambah Dokumen Khusus</button></a>
                </div>



                <div class="panel-body">
                    <table class="responsive-table">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Isi</th>
                            <th>Nama File</th>
                            <th>Aksi</th>
                        </tr>
                        <?php $x=1; ?>
                        @foreach($dokumen as $data)
                            <tr>
                                <td>{{ $x++ }}</td>
                                <td>{{ $data->judul }}</td>
                                <td>{{ $data->isi }}</td>
                                <td>{{ $data->file }}</td>

                                <td>
                                   <a href="{{url('admin/dokumen/hapus/'.$data->id)}}" onclick="return confirm('Yakin ingin menghapus data?');"><button class="btn btn-danger">Hapus</button></a>
                                </td>
                        @endforeach
                    </table>
                </div>
            </div>

    </div>
</div>
@endsection
