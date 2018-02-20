@extends('layouts.app')
@section('content')

    <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard Renlakgiat
                    <div class="pull-right"><a href="{{url('/uptd/renlakgiat/cetak/')}}"><button class="btn btn-link">Cetak Data Renlakgiat</button></a></div>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <th>No</th>
                            <th>@sortablelink('kejuruan')</th>
                            <th>@sortablelink('program_pelatihan','Program Pelatihan')</th>
                            <th>@sortablelink('sumber_dana','Sumber Dana')</th>
                            <th>@sortablelink('durasi')</th>
                            <th>@sortablelink('paket')</th>
                            <th>@sortablelink('orang')</th>
                            <th>@sortablelink('tanggal_mulai','Tanggal Mulai')</th>
                            <th>@sortablelink('tanggal_selesai','Tanggal Selesai')</th>
                            <th>@sortablelink('status')</th>
                            <th>Edit Tanggal</th>
                            <th>Detail & Laporan</th>
                            <th>Cetak Laporan</th>
                            <th>Batas Pengumpulan Laporan</th>   
                        </tr>
                        <?php $x=1; ?>
                        @foreach($renlakgiat as $data)
                            <tr>
                                <td>{{ $x++ }}</td>
                                <td>{{ $data->kejuruan }}</td>
                                <td>{{ $data->program_pelatihan }}</td>
                                <td>{{ $data->sumber_dana }}</td>
                                <td>{{ $data->durasi }}</td>
                                <td>{{ $data->paket }}</td>
                                <td>{{ $data->orang }}</td>
                                <td>@if($data->tgl_mulai == "") Silahkan Mengisi data tanggal @else {{date('d M Y', strtotime($data->tgl_mulai))}} @endif</td>
                                <td>@if($data->tgl_selesai == "") Silahkan Mengisi data tanggal @else {{date('d M Y', strtotime($data->tgl_selesai))}} @endif</td>
                                    
                                @if($data->tgl_mulai == "")
                                <td>Belum Direncanakan</td>
                                @else
                                    @if(Carbon\Carbon::now() < $data->tgl_mulai)
                                    
                                        <?php DB::table('renlakgiats')
                                            ->where('id', $data->id)
                                            ->update(['status' => 'Belum Berjalan']); ?>
                                           <td> Belum Berjalan</td>
                                    
                                    @elseif(Carbon\Carbon::now() > $data->tgl_selesai)
                                    
                                        <?php DB::table('renlakgiats')
                                                ->where('id', $data->id)
                                                ->update(['status' => 'Sudah Selesai']) ?>
                                        <td> Sudah Selesai</td>
                                    
                                    @else
                                    
                                        <?php DB::table('renlakgiats')
                                                ->where('id', $data->id)
                                                ->update(['status' => 'Sedang Berjalan']) ?>

                                        <td> Sedang Berjalan</td>

                                    @endif
                                @endif
                                <td>
                                    @if($data->tgl_mulai=="" && $data->tgl_selesai=="")
                                    <a href="{{url('uptd/renlakgiat/edit/'.$data->id)}}"><button class="btn btn-warning"><span class="material-icons">edit</span></button></a>
                                    @else
                                    <h6>silahkan hubungi admin untuk mengubah tanggal</h6>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('uptd/laporan/detail/'.$data->id)}}"><button class="btn btn-info"><span class="material-icons">details</span></button></a>
                                </td>
                                <td>
                                    @if($data->status_cover == "Terverifikasi" and $data->status_pendahuluan == "Terverifikasi" and $data->status_surat_keputusan == "Terverifikasi" and $data->status_nominatif_peserta_pelatihan == "Terverifikasi"and $data->status_nominatif_instruktur == "Terverifikasi" and $data->status_kurikulum == "Terverifikasi" and $data->status_jadwal_pelatihan_mingguan == "Terverifikasi" and $data->status_daftar_hadir_instruktur == "Terverifikasi" and $data->status_daftar_jam_mengajar_instruktur == "Terverifikasi" and $data->status_daftar_hadir_peserta_pelatihan == "Terverifikasi" and $data->status_daftar_permintaan_bahan_latihan == "Terverifikasi" and $data->status_bukti_penerimaan_bahan_pelatihan == "Terverifikasi" and $data->status_lapandan_mingguan_penggunaan_bahan_latihan == "Terverifikasi" and $data->status_undangan_sidang_kelulusan == "Terverifikasi" and $data->status_berita_acara_sidang_kelulusan == "Terverifikasi" and $data->status_daftar_hadir_pertemuan_sidang_kelulusan == "Terverifikasi" and $data->status_daftar_nilai_akhir == "Terverifikasi"and $data->status_rekap_penilaian_pelatihan_berbasis_kompetensi == "Terverifikasi" and $data->status_rekapitulasi_akhir_hasil_pelatihan == "Terverifikasi" and $data->status_tanda_terima_transpandt_peserta == "Terverifikasi" and $data->status_tanda_terima_asuransi_peserta == "Terverifikasi" and $data->status_tanda_terima_pakaian_kerja_peserta == "Terverifikasi" and $data->status_tanda_terima_atk_peserta == "Terverifikasi" and $data->status_tanda_terima_modul == "Terverifikasi"and $data->status_tanda_terima_konsumsi_peserta == "Terverifikasi" and $data->status_foto_dokumentasi_kegiatan == "Terverifikasi" and $data->status_fotocopy_sertifikasi_peserta == "Terverifikasi")
                                            <a href="{{url('uptd/cetak/'.$data->id)}}"><button class="btn btn-info"><span class="material-icons">font_download</span></button></a>
                                           
                                    @else
                                           <button class="btn btn-info" disabled><span class="material-icons">font_download</span></button>
                                    @endif
                                
                                </td>  
                                <td>
                                    <?php 
                                        $now = date('d-m-Y');
                                        $dateA = $data->tgl_kumpul_laporan;
                                        $hitung = strtotime($dateA) - strtotime($now);
                                    ?>
                                    @if($data->tgl_kumpul_laporan == "") 
                                        Data Tanggal Belum Diisi
                                    @else
                                        @if(Carbon\Carbon::now() > $data->tgl_kumpul_laporan)
                                            {{date('d M Y', strtotime($data->tgl_kumpul_laporan))}}<br>
                                            Sudah Tidak Bisa Mengupload Laporan, silahkan hubungi admin agar bisa kembali mengumpulkan laporan
                                        @else
                                            {{date('d M Y', strtotime($data->tgl_kumpul_laporan))}}<br>
                                            <?php echo $hitung/(24*60*60); ?> Hari Lagi Batas Pengumpulan Laporan
                                        @endif
                                    @endif
                                    
                                </td>
                        @endforeach
                    </table>
                    {{$renlakgiat->links()}}
                </div>
            </div>
        
</div>
@endsection
