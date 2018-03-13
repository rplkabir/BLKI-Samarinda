@extends('layouts.app')
{!! Charts::assets() !!}
@section('content')
<link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
<div class="container">
    <div class="row">
        <div class="col" style="width: 100% !important;">
            <div class="panel panel-default">
                <div class="panel-heading">Admin Dashboard
                </div>
                <div class="panel-body">

                    <ul class="collapsible" data-collapsible="accordion" style="">
                        @if(count($profile) < 1)
                            <strong>Belum Ada data</strong>
                        @else
                                @foreach($profile as $datauser)

                                    <li>
                                    <div class="collapsible-header"><i class="material-icons">insert_chart</i>@foreach(DB::table('users')->where('id',$datauser->users_id)->get() as $datar) {{ $datar->name }} </div>
                                    @endforeach

                                            <?php
                                                     $userid = $datauser->users_id;
                                                     $belum = DB::table('renlakgiats')->where('users_id',$userid)->where('status', 'Belum Berjalan')->get();
                                                     $sedang = DB::table('renlakgiats')->where('users_id',$userid)->where('status', 'Sedang Berjalan')->get();
                                                     $telah = DB::table('renlakgiats')->where('users_id',$userid)->where('status', 'Sudah Selesai')->get();
                                                     $null = DB::table('renlakgiats')->where('users_id',$userid)->where('status', (NULL))->get();

                                                     $datauser->nama_lembaga = Charts::create('donut', 'highcharts')
                                                    ->title($datauser->nama_lembaga)
                                                    ->labels(['Belum Berjalan', 'Sedang Berjalan', 'Sudah Selesai','Belum Direncanakan'])
                                                    ->values([count($belum),count($sedang),count($telah),count($null)])
                                                    ->dimensions(500,300)
                                                    ->responsive(false)
                                                    ->credits(false);

                                            ?>

                                                <?php
                                                    $statuslaporan = DB::table('renlakgiats')->where('users_id',$userid)->where('status_Laporan', 'Belum Lengkap')->get();

                                                    $statuslaporanok = DB::table('renlakgiats')->where('users_id',$userid)->where('status_Laporan', 'Sudah Lengkap')->get();
                                                    $blm = count($statuslaporan);
                                                    $sdh = count($statuslaporanok);

                                                    $laporans = Charts::create('donut', 'highcharts')
                                                    ->title("laporan")
                                                    ->labels(['Sudah Lengkap', 'Belum Lengkap'])
                                                    ->values([$sdh,$blm])
                                                    ->dimensions(500,300)
                                                    ->responsive(false)
                                                    ->credits(false);

                                                ?>
                                    <div class="collapsible-body"><span>
                                        <table style="width: 100%">
                                            <tr>
                                                <td style="width: 50%">
                                                    {!! $datauser->nama_lembaga->render() !!}
                                                </td>
                                                <td style="width: 50%">
                                                    {!!  $laporans->render() !!}
                                                </td>
                                            </tr>
                                        </table>
                                    </span></div>
                                <div class="collapsible-body">
                                        <table class="table">
                                            <tr>
                                                <td>Belum Direncanakan</td>
                                                <td>{{ DB::table('renlakgiats')->where('users_id',$datauser->users_id)->where('status',(NULL))->count() }}</td>
                                            </tr>
                                            <tr>
                                                <td>Belum Berjalan</td>
                                                <td>{{ DB::table('renlakgiats')->where('users_id',$datauser->users_id)->where('status','Belum Berjalan')->count() }}</td>
                                            </tr>
                                            <tr>
                                                <td>Sedang Berjalan</td>
                                                <td>{{ DB::table('renlakgiats')->where('users_id',$datauser->users_id)->where('status','Sedang Berjalan')->count() }}</td>
                                            </tr>
                                            <tr>
                                                <td>Sudah Selesai</td>
                                                <td>{{ DB::table('renlakgiats')->where('users_id',$datauser->users_id)->where('status','Sudah Selesai')->count() }}</td>
                                            </tr>
                                            <tr>
                                                <td>Total Renlakgiat</td>
                                                <td>{{ DB::table('renlakgiats')->where('users_id',$datauser->users_id)->count() }}</td>
                                            </tr>
                                        </table>
                                    </div>

                                </li>
                            @endforeach
                        @endif

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
