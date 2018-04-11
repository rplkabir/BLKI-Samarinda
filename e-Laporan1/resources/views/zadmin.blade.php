@extends('layouts.app')
{!! Charts::assets() !!}
@section('content')
<style type="text/css">
    
</style>
<div class="container" style="width: 200%" style="padding-right: 5%;">
    <div class="row">
        <div class="col">
            <div class="card card-default">
                <div class="card-heading" align="center">Admin Dashboard
                </div>
                <div class="card-body">
                     @if(count($profile) < 1)
                            <strong>Belum Ada data</strong>
                    @else
                        @foreach($profile as $datauser)
                        <div id="accordion">
                          <div class="card">
                            <div class="card-header" id="headingOne">
                              <h5 class="mb-0" align="center">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapse".{{$datauser->id}}>
                                 <i class="material-icons">insert_chart</i>@foreach(DB::table('users')->where('id',$datauser->users_id)->get() as $datar) {{ $datar->name }} </div>
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
                                </button>
                              </h5>
                            </div>
                    
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                              <div class="card-body">
                                <span>
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
                                    </span>
                              </div>
                            </div>
                          </div>
                        </div>
                        @endforeach
                     @endif
                    </div>
            </div>
        </div>
    </div>

@endsection
