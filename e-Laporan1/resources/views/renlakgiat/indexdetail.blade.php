@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default" style="width: 100% !important;">
            <div class="panel-heading"><strong>Dashboard Detail Renlakgiat dan Laporan</strong></div>
                <div class="panel-body">
                 <table>
                @foreach($renlakgiat as $data)
                <table class="table" style="position: fixed; width: 40%">
                            <tr>
                                <th>Id Renlakgiat</th >
                                <td>:</td>
                                <td>{{ $data->id }}</td>
                            </tr>
                            <tr>
                                <th>kejuruan</th>
                                <td>:</td>
                                <td>{{ $data->kejuruan }}</td>
                            </tr>
                            <tr>
                                <th>Program Pelatihan</th >
                                 <td>:</td>
                                 <td>{{ $data->program_pelatihan }}</td>
                            </tr> 
                            <tr>
                                <th>Sumber Dana</th >
                                <td>:</td>
                                <td>{{ $data->sumber_dana }}</td>
                            </tr>
                            <tr>
                                <th>Durasi</th>
                                <td>:</td>
                                <td>{{$data->durasi}}</td>
                            </tr>
                            <tr>
                                 <th>Paket</th >
                                 <td>:</td>
                                 <td>{{$data->paket}}</td>
                            </tr> 
                            <tr>
                                  <th>Orang</th >
                                  <td>:</td>
                                  <td>{{$data->orang}}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Mulai</th >
                                <td>:</td>
                                <td>{{date('d M Y', strtotime($data->tgl_mulai))}}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Selesai</th>
                                <td>:</td>
                                  <td> {{date('d M Y', strtotime($data->tgl_selesai))}}</td>
                            </tr>
                            <tr> 
                              <th>Status</th>
                              <td>:</td>
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
                          </tr>
                          <tr>
                                <th>Histori Perubahan</th>
                                <td>:</td>
                                <td>
                                    <strong>Jumlah Perubahan: </strong>{{DB::table('historis')->where('renlakgiat_id',$data->id)->count()}}/3 <br>

                                    <?php $x = 1; ?>
                                    @foreach(DB::table('historis')->where('renlakgiat_id',$data->id)->orderBy('created_at','desc')->get() as $hs)
                                        <div class="well">
                                            <strong>Tanggal Sebelum Perubahan:</strong> {{$hs->tgl_mulai_lama}} - {{$hs->tgl_selesai_lama}} <br>
                                            <strong>Alasan Perubahan:</strong> {{$hs->alasan}} <br>
                                            <strong>Tanggal Melakukan Perubahan:</strong> {{ $hs->created_at }} <br>
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                        </table>
                        <table class="table" align="right" style="width: 30%; border-left: 1px solid;">
                        <tr>
                            <td align="center">
                                <div class="well">
                                <a href="{{url('admin/renlakgiat/laporan/cover/tambah/'.$data->id)}}">
                                    <button class="btn btn-link">cover</button>
                                </a><br>
                                <strong>File: </strong>{{$data->cover}}<br>
                                <strong>Status:</strong> {{ $data->status_cover}}<br>
                                <strong> Catatan:</strong> {{ $data->catatan_cover}}
                                <br>
                                </div>

                                <div class="well">
                                <a href="{{url('admin/renlakgiat/laporan/pendahuluan/tambah/'.$data->id)}}">
                                    <button class="btn btn-link">pengantar, pendahuluan dan isi laporan</button>
                                </a><br>
                                <strong>File: </strong>{{$data->pendahuluan}}<br>
                                <strong>Status:</strong> {{$data->status_pendahuluan}}<br>
                                <strong>Catatan:</strong> {{ $data->catatan_pendahuluan}}
                                <br>
                                </div>

                                <div class="well">
                                <a href="{{url('admin/renlakgiat/laporan/sk/tambah/'.$data->id)}}">
                                    <button class="btn btn-link">Surat Keputusan</button>
                                </a><br>
                                <strong>File: </strong>{{$data->surat_keputusan}}<br>
                                <strong>Status</strong> {{$data->status_surat_keputusan}}<br>
                                <strong>Catatan</strong> {{$data->catatan_surat_keputusan}}
                                <br>
                                </div>
                                <div class="well">
                                <a href="{{url('admin/renlakgiat/laporan/npp/tambah/'.$data->id)}}">
                                    <button class="btn btn-link">Nominatif Perserta Pelatihan</button>
                                </a><br>
                                <strong>File: </strong>{{$data->nominatif_peserta_pelatihan}}<br>
                                <strong>Status:</strong> {{$data->status_nominatif_peserta_pelatihan}}<br>
                                <strong>Catatan:</strong> {{ $data->catatan_nominatif_peserta_pelatihan}}
                                <br>
                                </div>
                                <div class="well">
                                <a href="{{url('admin/renlakgiat/laporan/ni/tambah/'.$data->id)}}">
                                    <button class="btn btn-link">nominatif instruktur</button>
                                </a><br>
                                <strong>File: </strong>{{$data->nominatif_instruktur}}<br>
                                <strong>Status:</strong> {{$data->status_nominatif_instruktur}}<br>
                                <strong>Catatan:</strong> {{ $data->catatan_nominatif_instruktur}}
                                <br>
                                </div>
                                <div class="well">
                                <a href="{{url('admin/renlakgiat/laporan/kurikulum/tambah/'.$data->id)}}">
                                    <button class="btn btn-link">kurikulum</button>
                                </a><br>
                                <strong>File: </strong>{{$data->kurikulum}}<br>
                                <strong>Status:</strong> {{$data->status_kurikulum}}<br>
                                <strong>Catatan:</strong>{{ $data->catatan_kurikulum}}
                                <br>
                                </div>
                                <div class="well">
                                <a href="{{url('admin/renlakgiat/laporan/jpm/tambah/'.$data->id)}}">
                                    <button class="btn btn-link">jadwal pelatihan mingguan</button>
                                </a><br>
                                <strong>File: </strong>{{$data->jadwal_pelatihan_mingguan}}<br>
                                <strong>Status:</strong> {{$data->status_jadwal_pelatihan_mingguan}}<br>
                                <strong>Catatan:</strong> {{ $data->catatan_jadwal_pelatihan_mingguan}}
                                <br>
                                </div>
                                <div class="well">

                                <a href="{{url('admin/renlakgiat/laporan/dhi/tambah/'.$data->id)}}">
                                    <button class="btn btn-link">Daftar hadir instruktur</button>
                                </a><br>
                                <strong>File: </strong>{{$data->daftar_hadir_instruktur}}<br>
                                <strong>Status:</strong> {{$data->status_daftar_hadir_instruktur}}<br>
                                <strong>Catatan:</strong> {{ $data->catatan_daftar_hadir_instruktur}}
                                <br>
                                </div>
                                <div class="well">
                                <a href="{{url('admin/renlakgiat/laporan/djmi/tambah/'.$data->id)}}">
                                    <button class="btn btn-link">daftar jam mengajar instruktur</button>
                                </a> <br>
                                <strong>File: </strong>{{$data->daftar_jam_mengajar_instruktur}}<br>
                                <strong>Status:</strong> {{$data->status_daftar_jam_mengajar_instruktur}}<br>
                                <strong>Catatan:</strong> {{ $data->catatan_daftar_jam_mengajar_instruktur}}
                                <br>
                                </div>
                                <div class="well">
                                <a href="{{url('admin/renlakgiat/laporan/dhpp/tambah/'.$data->id)}}">
                                    <button class="btn btn-link">daftar hadir peserta pelatihan</button>
                                </a>
                                <br>
                                <strong>File: </strong>{{$data->daftar_hadir_peserta_pelatihan}}<br>
                                <strong>Status:</strong> {{$data->status_daftar_hadir_peserta_pelatihan}}<br>
                                <strong>Catatan:</strong> {{ $data->catatan_daftar_hadir_peserta_pelatihan}}
                                <br>
                                </div>
                                <div class="well">
                                <a href="{{url('admin/renlakgiat/laporan/dpbl/tambah/'.$data->id)}}">
                                    <button class="btn btn-link">daftar permintaan bahan latihan</button>
                                </a><br>
                                <strong>File: </strong>{{$data->daftar_permintaan_bahan_pelatihan}}<br>
                                <strong>Status:</strong> {{$data->status_daftar_permintaan_bahan_pelatihan}}<br>
                                <strong>Catatan:</strong> {{ $data->catatan_daftar_permintaan_bahan_pelatihan}}
                                <br>
                                </div>
                                <div class="well">
                                <a href="{{url('admin/renlakgiat/laporan/bpbl/tambah/'.$data->id)}}">
                                    <button class="btn btn-link">bukti penerimaan bahan pelatihan</button>
                                </a><br>
                                <strong>File: </strong>{{$data->bukti_penerimaan_bahan_pelatihan}}<br>
                                <strong>Status:</strong> {{$data->status_bukti_penerimaan_bahan_pelatihan}}<br>
                                <strong>Catatan:</strong> {{ $data->catatan_bukti_penerimaan_bahan_pelatihan}}
                                <br>
                                </div>
                                <div class="well">
                                <a href="{{url('admin/renlakgiat/laporan/lmpbl/tambah/'.$data->id)}}">
                                    <button class="btn btn-link">laporan mingguan penggunaan bahan latihan</button>
                                </a>
                                <br>
                                <strong>File: </strong>{{$data->laporan_mingguan_penggunaan_bahan_pelatihan}}<br>
                                <strong>Status:</strong> {{$data->status_laporan_mingguan_penggunaan_bahan_pelatihan}} <br>
                                <strong>Catatan:</strong> {{ $data->catatan_laporan_mingguan_penggunaan_bahan_pelatihan}}
                                <br>
                                </div>
                                <div class="well">
                                <a href="{{url('admin/renlakgiat/laporan/usk/tambah/'.$data->id)}}">
                                    <button class="btn btn-link">undangan sidang kelulusan</button>
                                </a>
                                <br>
                                <strong>File: </strong>{{$data->undangan_sidang_kelulusan}}<br>
                                <strong>Status:</strong> {{$data->status_undangan_sidang_kelulusan}} <br>
                                <strong>Catatan:</strong> {{ $data->catatan_undangan_sidang_kelulusan}}
                                <br>
                                </div>
                                <div class="well">
                                <a href="{{url('admin/renlakgiat/laporan/bask/tambah/'.$data->id)}}">
                                    <button class="btn btn-link">berita acara sidang kelulusan</button>
                                </a>
                                <br>
                                <strong>File: </strong>{{$data->berita_acara_sidang_kelulusan}}<br>
                                <strong>Status:</strong> {{$data->status_berita_acara_sidang_kelulusan}} <br>
                                <strong>Catatan:</strong> {{ $data->catatan_berita_acara_sidang_kelulusan}}
                                <br>
                                </div>
                                <div class="well">
                                <a href="{{url('admin/renlakgiat/laporan/dhpsk/tambah/'.$data->id)}}">
                                    <button class="btn btn-link">daftar hadir pertemuan sidang kelulusan</button>
                                </a>
                                <br>
                                <strong>File: </strong>{{$data->daftar_hadir_pertemuan_sidang_kelulusan}}<br>
                                <strong>Status:</strong> {{$data->status_daftar_hadir_pertemuan_sidang_kelulusan}}<br>
                                <strong>Catatan:</strong> {{ $data->catatan_daftar_hadir_pertemuan_sidang_kelulusan}}
                                <br>
                                </div>
                                <div class="well">
                                <a href="{{url('admin/renlakgiat/laporan/dna/tambah/'.$data->id)}}">
                                    <button class="btn btn-link">daftar nilai akhir</button>
                                </a>
                                <br>
                                <strong>File: </strong>{{$data->daftar_nilai_akhir}}<br>
                                <strong>Status:</strong> {{$data->status_daftar_nilai_akhir}}<br>
                                <strong>Catatan:</strong> {{ $data->catatan_daftar_nilai_akhir}}
                                <br>
                                </div>
                                <div class="well">
                                <a href="{{url('admin/renlakgiat/laporan/rppbk/tambah/'.$data->id)}}">
                                    <button class="btn btn-link">Rekap Penilaian Pelatihan Berbasis Kompetensi</button>
                                </a>
                                <br>
                                <strong>File: </strong>{{$data->rekap_penilaian_pelatihan_berbasis_kompetensi}}<br>
                                <strong>Status:</strong> {{$data->status_rekap_penilaian_pelatihan_berbasis_kompetensi}}<br>
                                <strong>Catatan:</strong> {{ $data->catatan_rekap_penilaian_pelatihan_berbasis_kompetensi}}
                                <br>
                                </div>
                                <div class="well">
                                <a href="{{url('admin/renlakgiat/laporan/rahp/tambah/'.$data->id)}}">
                                    <button class="btn btn-link">Rekapitulasi Akhir Hasil Pelatihan</button>
                                </a>
                                <br>
                                <strong>File: </strong>{{$data->rekapitulasi_akhir_hasil_pelatihan}}<br>
                                <strong>Status:</strong> {{$data->status_rekapitulasi_akhir_hasil_pelatihan}}<br>
                                <strong>Catatan:</strong> {{ $data->catatan_rekapitulasi_akhir_hasil_pelatihan}}
                                <br>
                                </div>
                                <div class="well">
                                <a href="{{url('admin/renlakgiat/laporan/tttp/tambah/'.$data->id)}}">
                                    <button class="btn btn-link">tanda terima transport peserta</button>
                                </a>
                                <br>
                                <strong>File: </strong>{{$data->tanda_terima_transport_peserta}}<br>
                                <strong>Status:</strong> {{$data->status_tanda_terima_transport_peserta}}<br>
                                <strong>Catatan:</strong> {{ $data->catatan_tanda_terima_transport_peserta}}
                                <br>
                                </div>
                                <div class="well">
                                <a href="{{url('admin/renlakgiat/laporan/ttap/tambah/'.$data->id)}}">
                                    <button class="btn btn-link">Tanda Terima Kartu Asuransi Peserta</button>
                                </a>
                                <br>
                                <strong>File: </strong>{{$data->tanda_terima_asuransi_peserta}}<br>
                                <strong>Status:</strong> {{$data->status_tanda_terima_asuransi_peserta}}<br>
                                <strong>Catatan:</strong> {{ $data->catatan_tanda_terima_asuransi_peserta}}
                                <br>
                                </div>
                                <div class="well">
                                <a href="{{url('admin/renlakgiat/laporan/ttpkp/tambah/'.$data->id)}}">
                                    <button class="btn btn-link">tanda terima pakaian kerja perserta</button>
                                </a>
                                <br>
                                <strong>File: </strong>{{$data->tanda_terima_pakaian_kerja_peserta}}<br>
                                <strong>Status:</strong> {{$data->status_tanda_terima_pakaian_kerja_peserta}}<br>
                                <strong>Catatan:</strong> {{ $data->catatan_tanda_terima_pakaian_kerja_peserta}}
                                <br>
                                </div>
                                <div class="well">
                                <a href="{{url('admin/renlakgiat/laporan/ttatkp/tambah/'.$data->id)}}">
                                    <button class="btn btn-link">tanda terima atk peserta</button>
                                </a>
                                <br>
                                <strong>File: </strong>{{$data->tanda_terima_atk_peserta}}<br>
                                <strong>Status:</strong> {{$data->status_tanda_terima_atk_peserta}}<br>
                                <strong>Catatan:</strong> {{ $data->catatan_tanda_terima_atk_peserta}}
                                <br>
                                </div>
                                <div class="well">
                                <a href="{{url('admin/renlakgiat/laporan/ttm/tambah/'.$data->id)}}">
                                    <button class="btn btn-link">tanda terima modul</button>
                                </a>
                                <br>
                                <strong>File: </strong>{{$data->tanda_terima_modul}}<br>
                                <strong>Status:</strong> {{$data->status_tanda_terima_modul}}<br>
                                <strong>Catatan:</strong> {{ $data->catatan_tanda_terima_modul}}
                                <br>
                                </div>
                                <div class="well">
                                <a href="{{url('admin/renlakgiat/laporan/ttkp/tambah/'.$data->id)}}">
                                    <button class="btn btn-link">tanda terima konsumsi perserta</button>
                                </a>
                                <br>
                                <strong>File: </strong>{{$data->tanda_terima_konsumsi_peserta}}<br>
                                <strong>Status:</strong> {{$data->status_tanda_terima_konsumsi_peserta}}<br>
                                <strong>Catatan:</strong> {{ $data->catatan_tanda_terima_konsumsi_peserta}}
                                <br>
                                </div>
                                <div class="well">
                                <a href="{{url('admin/renlakgiat/laporan/fdk/tambah/'.$data->id)}}">
                                    <button class="btn btn-link">foto dokumentasi kegiatan</button>
                                </a>
                                <br>
                                <strong>File: </strong>{{$data->foto_dokumentasi_kegiatan}}<br>
                                <strong>Status:</strong> {{$data->status_foto_dokumentasi_kegiatan}}<br>
                                <strong>Catatan:</strong> {{ $data->catatan_foto_dokumentasi_kegiatan}}
                                <br>
                                </div>
                                <div class="well">
                                <a href="{{url('admin/renlakgiat/laporan/fsp/tambah/'.$data->id)}}">
                                    <button class="btn btn-link">fotocopy sertifikasi peserta</button>
                                </a>
                                <br>
                                <strong>File: </strong>{{$data->fotocopy_sertifikasi_peserta}}<br>
                                <strong>Status:</strong> {{$data->status_fotocopy_sertifikasi_peserta}}<br>
                                <strong>Catatan:</strong> {{ $data->catatan_fotocopy_sertifikasi_peserta}}
                                <br>
                                </div>
                            </td>
                        </tr>
                    </table>
                    @if($data->status_cover == "Terverifikasi" and $data->status_pendahuluan == "Terverifikasi" and $data->status_surat_keputusan == "Terverifikasi" and $data->status_nominatif_peserta_pelatihan == "Terverifikasi"and $data->status_nominatif_instruktur == "Terverifikasi" and $data->status_kurikulum == "Terverifikasi" and $data->status_jadwal_pelatihan_mingguan == "Terverifikasi" and $data->status_daftar_hadir_instruktur == "Terverifikasi" and $data->status_daftar_jam_mengajar_instruktur == "Terverifikasi" and $data->status_daftar_hadir_peserta_pelatihan == "Terverifikasi" and $data->status_daftar_permintaan_bahan_latihan == "Terverifikasi" and $data->status_bukti_penerimaan_bahan_pelatihan == "Terverifikasi" and $data->status_lapandan_mingguan_penggunaan_bahan_latihan == "Terverifikasi" and $data->status_undangan_sidang_kelulusan == "Terverifikasi" and $data->status_berita_acara_sidang_kelulusan == "Terverifikasi" and $data->status_daftar_hadir_pertemuan_sidang_kelulusan == "Terverifikasi" and $data->status_daftar_nilai_akhir == "Terverifikasi"and $data->status_rekap_penilaian_pelatihan_berbasis_kompetensi == "Terverifikasi" and $data->status_rekapitulasi_akhir_hasil_pelatihan == "Terverifikasi" and $data->status_tanda_terima_transpandt_peserta == "Terverifikasi" and $data->status_tanda_terima_asuransi_peserta == "Terverifikasi" and $data->status_tanda_terima_pakaian_kerja_peserta == "Terverifikasi" and $data->status_tanda_terima_atk_peserta == "Terverifikasi" and $data->status_tanda_terima_modul == "Terverifikasi"and $data->status_tanda_terima_konsumsi_peserta == "Terverifikasi" and $data->status_foto_dokumentasi_kegiatan == "Terverifikasi" and $data->status_fotocopy_sertifikasi_peserta == "Terverifikasi")
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <a href="{{ url('admin/cetak/'.$data->id)}}"><button class="btn btn-info">Cetak</button></a>
                                </div>
                            </div>
                        @else
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button class="btn btn-danger" disabled>Cetak</button>
                                </div>
                            </div>
                        @endif
                        
                </div>
            </div>
        @endforeach      
    </div>
</div>   
</div>
@endsection
