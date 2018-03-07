@extends('layouts.app')

@section('content')

    <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Data Histori Perubahan</div>
                <div class="panel-body">

                    <table class="table">
                      <tr>
                        <th>No</th>
                        <th>UPTD/BLK Terkait</th>
                        <th>Kejuruan</th>
                        <th>Tanggal Mulai Lama</th>
                        <th>Tanggal Selesai Lama</th>
                        <th>Tanggal Mulai Baru</th>
                        <th>Tanggal Selesai Baru</th>
                        <th>Alasan</th>
                        <th>Dilakukan Perubahan Pada Tanggal</th>
                          @foreach($histori as $data)
                            <?php $x=1; ?>
                            <tr>
                              <td>{{ $x++ }}</td>
                              <td>{{ $data->renlakgiat->user->name }}</td>
                              <td>{{ $data->renlakgiat->kejuruan }}</td>
                              <td>{{ $data->tgl_mulai_lama }}</td>
                              <td>{{ $data->tgl_selesai_lama }}</td>
                              <td>{{ $data->tgl_mulai_baru }}</td>
                              <td>{{ $data->tgl_selesai_baru }}</td>
                              <td>{{ $data->alasan }}</td>
                              <td>{{ $data->created_at }}</td>
                            </tr>
                          @endforeach
                      </tr>
                    </table>

                </div>
            </div>
        </div>

@endsection
