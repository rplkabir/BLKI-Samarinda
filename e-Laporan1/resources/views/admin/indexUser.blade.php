@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard Profile UPTD
                    <a href="{{route('admin.user.add')}}" class="pull-right"><span class="medium material-icons">person_add</span></a>
                </div>

                <div class="panel-body">
                    <table class="responsive-table">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            
                            <th>Aksi</th>
                        </tr>
                        <?php $x=1; ?>
                        @foreach($user as $datauser)
                            <tr>
                                <td>{{ $x++ }}</td>
                                <td><a href=" {{ url('/admin/profile/detail/'.$datauser->id)}}">{{ $datauser->name }}</a></td>
                                <td>{{ $datauser->email }}</td>
                                
                                <td>

                                    <a href="{{url('admin/user/edit/'.$datauser->id)}}" onclick="return confirm('Yakin ingin mengubah data?');"><button class="btn btn-primary" title="Edit"><i class="large material-icons">edit</i></button></a>
                                    <a href="{{url('admin/user/hapus/'.$datauser->id)}}" onclick="return confirm('Yakin ingin menghapus data?');"><button class="btn btn-danger" title="Hapus"><i class="large material-icons">delete</i></button></a>

                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

    </div>
</div>
@endsection
