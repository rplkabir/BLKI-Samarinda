<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Renlakgiat</title>

        <body>
            <style type="text/css">

                .tg  {border-collapse:collapse;border-spacing:1;border-color:#ccc;width: 100%; }
                .tb-as  {border-collapse:collapse;border-spacing:0;border-color:#ccc;width: 100%; }
                .tg td{font-family:Arial;font-size:12px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
                .tg th{font-family:Arial;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
                .tg .tg-3wr7{font-weight:bold;font-size:12px;font-family:"Arial", Helvetica, sans-serif !important;;text-align:center}
                .tg .tg-ti5e{font-size:10px;font-family:"Arial", Helvetica, sans-serif !important;;text-align:center}
                .tg .tg-rv4w{font-size:10px;font-family:"Arial", Helvetica, sans-serif !important;}
                th {
                    text-align: center;
                    width: auto;
                }
                td{
                    text-align: center;
                    font-size: 12px;
                }

            </style>
            @foreach($renlakgiat as $data)
            <div style="font-family:Arial; font-size:16px;">
              <h3 align="center">Laporan Rencana Kegiatan untuk Kejuruan: {{ $data->kejuruan }}, Program Pelatihan: {{ $data->program_pelatihan }} Paket {{ $data->paket }}</h3>

            </div>
              <table class="tg" border="1">
                <tr style="background-color: grey;">
                  <th>No</th>
                  <th>Item Laporan</th>
                  <th>:</th>
                  <th>Status</th>
                </tr>
                <tr>
                  <th>1</th>
                  <td>Cover</td>
                  <td>:</td>

                    @if($data->status_cover == "Terverifikasi")
                    <td style="background-color: green;">Terverifikasi</td>
                    @elseif($data->status_cover == "Revisi")
                    <td style="background-color: red;">Revisi</td>
                    @elseif($data->status_cover == "Belum Terverifikasi")
                    <td style="background-color: orange;">Belum Terverifikasi</td>
                    @elseif($data->status_cover == "")
                    <td style="background-color: blue;">Belum Upload</td>
                    @endif
                </tr>
                <tr>
                  <th>2</th>
                  <td>Pengantar, Pendahuluan dan Isi Laporan</td>
                  <td>:</td>

                    @if($data->status_pendahuluan == "Terverifikasi")
                    <td style="background-color: green;">Terverifikasi</td>
                    @elseif($data->status_pendahuluan == "Revisi")
                    <td style="background-color: red;">Revisi</td>
                    @elseif($data->status_pendahuluan == "Belum Terverifikasi")
                    <td style="background-color: orange;">Belum Terverifikasi</td>
                    @elseif($data->status_pendahuluan == "")
                    <td style="background-color: blue;">Belum Upload</td>
                    @endif
                </tr>
                <tr>
                  <th>3</th>
                  <td>Surat Keputusan</td>
                  <td>:</td>

                    @if($data->status_surat_keputusan == "Terverifikasi")
                    <td style="background-color: green;">Terverifikasi</td>
                    @elseif($data->status_surat_keputusan == "Revisi")
                    <td style="background-color: red;">Revisi</td>
                    @elseif($data->status_surat_keputusan == "Belum Terverifikasi")
                    <td style="background-color: orange;">Belum Terverifikasi</td>
                    @elseif($data->status_surat_keputusan == "")
                    <td style="background-color: blue;">Belum Upload</td>
                    @endif
                </tr>
                <tr>
                  <th>4</th>
                  <td>Nominatif Peserta Pelatihan</td>
                  <td>:</td>

                    @if($data->status_nominatif_peserta_pelatihan == "Terverifikasi")
                    <td style="background-color: green;">Terverifikasi</td>
                    @elseif($data->status_nominatif_peserta_pelatihan == "Revisi")
                    <td style="background-color: red;">Revisi</td>
                    @elseif($data->status_nominatif_peserta_pelatihan == "Belum Terverifikasi")
                    <td style="background-color: orange;">Belum Terverifikasi</td>
                    @elseif($data->status_nominatif_peserta_pelatihan == "")
                    <td style="background-color: blue;">Belum Upload</td>
                    @endif
                </tr>
                <tr>
                  <th>5</th>
                  <td>Nominatif Instruktur</td>
                  <td>:</td>

                    @if($data->status_nominatif_instruktur == "Terverifikasi")
                    <td style="background-color: green;">Terverifikasi</td>
                    @elseif($data->status_nominatif_instruktur == "Revisi")
                    <td style="background-color: red;">Revisi</td>
                    @elseif($data->status_nominatif_instruktur == "Belum Terverifikasi")
                    <td style="background-color: orange;">Belum Terverifikasi</td>
                    @elseif($data->status_nominatif_instruktur == "")
                    <td style="background-color: blue;">Belum Upload</td>
                    @endif
                </tr>
                <tr>
                  <th>6</th>
                  <td>Kurikulum</td>
                  <td>:</td>

                    @if($data->status_kurikulum == "Terverifikasi")
                    <td style="background-color: green;">Terverifikasi</td>
                    @elseif($data->status_kurikulum == "Revisi")
                    <td style="background-color: red;">Revisi</td>
                    @elseif($data->status_kurikulum == "Belum Terverifikasi")
                    <td style="background-color: orange;">Belum Terverifikasi</td>
                    @elseif($data->status_kurikulum == "")
                    <td style="background-color: blue;">Belum Upload</td>
                    @endif
                </tr>
                <tr>
                  <th>7</th>
                  <td>Jadwal Pelatihan Mingguan</td>
                  <td>:</td>

                    @if($data->status_jadwal_pelatihan_mingguan == "Terverifikasi")
                    <td style="background-color: green;">Terverifikasi</td>
                    @elseif($data->status_jadwal_pelatihan_mingguan == "Revisi")
                    <td style="background-color: red;">Revisi</td>
                    @elseif($data->status_jadwal_pelatihan_mingguan == "Belum Terverifikasi")
                    <td style="background-color: orange;">Belum Terverifikasi</td>
                    @elseif($data->status_jadwal_pelatihan_mingguan == "")
                    <td style="background-color: blue;">Belum Upload</td>
                    @endif
                </tr>
                <tr>
                  <th>8</th>
                  <td>Daftar Hadir Instruktur</td>
                  <td>:</td>

                    @if($data->status_daftar_hadir_instruktur == "Terverifikasi")
                    <td style="background-color: green;">Terverifikasi</td>
                    @elseif($data->status_daftar_hadir_instruktur == "Revisi")
                    <td style="background-color: red;">Revisi</td>
                    @elseif($data->status_daftar_hadir_instruktur == "Belum Terverifikasi")
                    <td style="background-color: orange;">Belum Terverifikasi</td>
                    @elseif($data->status_daftar_hadir_instruktur == "")
                    <td style="background-color: blue;">Belum Upload</td>
                    @endif
                </tr>
                <tr>
                  <th>9</th>
                  <td>Daftar jam Mengajar Instruktur</td>
                  <td>:</td>

                    @if($data->status_daftar_jam_mengajar_instruktur == "Terverifikasi")
                    <td style="background-color: green;">Terverifikasi</td>
                    @elseif($data->status_daftar_jam_mengajar_instruktur == "Revisi")
                    <td style="background-color: red;">Revisi</td>
                    @elseif($data->status_daftar_jam_mengajar_instruktur == "Belum Terverifikasi")
                    <td style="background-color: orange;">Belum Terverifikasi</td>
                    @elseif($data->status_daftar_jam_mengajar_instruktur == "")
                    <td style="background-color: blue;">Belum Upload</td>
                    @endif
                </tr>
                <tr>
                  <th>10</th>
                  <td>Daftar hadir Peserta Pelatihan</td>
                  <td>:</td>

                    @if($data->status_daftar_hadir_peserta_pelatihan == "Terverifikasi")
                    <td style="background-color: green;">Terverifikasi</td>
                    @elseif($data->status_daftar_hadir_peserta_pelatihan == "Revisi")
                    <td style="background-color: red;">Revisi</td>
                    @elseif($data->status_daftar_hadir_peserta_pelatihan == "Belum Terverifikasi")
                    <td style="background-color: orange;">Belum Terverifikasi</td>
                    @elseif($data->status_daftar_hadir_peserta_pelatihan == "")
                    <td style="background-color: blue;">Belum Upload</td>
                    @endif
                </tr>
                <tr>
                  <th>11</th>
                  <td>Daftar Permintaan Bahan Latihan</td>
                  <td>:</td>

                    @if($data->status_daftar_permintaan_bahan_pelatihan == "Terverifikasi")
                    <td style="background-color: green;">Terverifikasi</td>
                    @elseif($data->status_daftar_permintaan_bahan_pelatihan == "Revisi")
                    <td style="background-color: red;">Revisi</td>
                    @elseif($data->status_daftar_permintaan_bahan_pelatihan == "Belum Terverifikasi")
                    <td style="background-color: orange;">Belum Terverifikasi</td>
                    @elseif($data->status_daftar_permintaan_bahan_pelatihan == "")
                    <td style="background-color: blue;">Belum Upload</td>
                    @endif
                </tr>
                <tr>
                  <th>12</th>
                  <td>Bukti Penerimaan Bahan Latihan</td>
                  <td>:</td>

                    @if($data->status_bukti_penerimaan_bahan_pelatihan == "Terverifikasi")
                    <td style="background-color: green;">Terverifikasi</td>
                    @elseif($data->status_bukti_penerimaan_bahan_pelatihan == "Revisi")
                    <td style="background-color: red;">Revisi</td>
                    @elseif($data->status_bukti_penerimaan_bahan_pelatihan == "Belum Terverifikasi")
                    <td style="background-color: orange;">Belum Terverifikasi</td>
                    @elseif($data->status_bukti_penerimaan_bahan_pelatihan == "")
                    <td style="background-color: blue;">Belum Upload</td>
                    @endif
                </tr>
                <tr>
                  <th>13</th>
                  <td>Laporan Mingguan Penggunaan Bahan Latihan</td>
                  <td>:</td>

                    @if($data->status_laporan_mingguan_penggunaan_bahan_pelatihan == "Terverifikasi")
                    <td style="background-color: green;">Terverifikasi</td>
                    @elseif($data->status_laporan_mingguan_penggunaan_bahan_pelatihan == "Revisi")
                    <td style="background-color: red;">Revisi</td>
                    @elseif($data->status_laporan_mingguan_penggunaan_bahan_pelatihan == "Belum Terverifikasi")
                    <td style="background-color: orange;">Belum Terverifikasi</td>
                    @elseif($data->status_laporan_mingguan_penggunaan_bahan_pelatihan == "")
                    <td style="background-color: blue;">Belum Upload</td>
                    @endif
                </tr>
                <tr>
                  <th>14</th>
                  <td>Undangan Sidang Kelulusan</td>
                  <td>:</td>

                    @if($data->status_undangan_sidang_kelulusan == "Terverifikasi")
                    <td style="background-color: green;">Terverifikasi</td>
                    @elseif($data->status_undangan_sidang_kelulusan == "Revisi")
                    <td style="background-color: red;">Revisi</td>
                    @elseif($data->status_undangan_sidang_kelulusan == "Belum Terverifikasi")
                    <td style="background-color: orange;">Belum Terverifikasi</td>
                    @elseif($data->status_undangan_sidang_kelulusan == "")
                    <td style="background-color: blue;">Belum Upload</td>
                    @endif
                </tr>
                <tr>
                  <th>15</th>
                  <td>Berita Acara Sidang Kelulusan</td>
                  <td>:</td>

                    @if($data->status_berita_acara_sidang_kelulusan == "Terverifikasi")
                    <td style="background-color: green;">Terverifikasi</td>
                    @elseif($data->status_berita_acara_sidang_kelulusan == "Revisi")
                    <td style="background-color: red;">Revisi</td>
                    @elseif($data->status_berita_acara_sidang_kelulusan == "Belum Terverifikasi")
                    <td style="background-color: orange;">Belum Terverifikasi</td>
                    @elseif($data->status_berita_acara_sidang_kelulusan == "")
                    <td style="background-color: blue;">Belum Upload</td>
                    @endif
                </tr>
                <tr>
                  <th>16</th>
                  <td>Daftar Hadir Pertemuan Sidang Kelulusan</td>
                  <td>:</td>

                    @if($data->status_daftar_hadir_pertemuan_sidang_kelulusan == "Terverifikasi")
                    <td style="background-color: green;">Terverifikasi</td>
                    @elseif($data->status_daftar_hadir_pertemuan_sidang_kelulusan == "Revisi")
                    <td style="background-color: red;">Revisi</td>
                    @elseif($data->status_daftar_hadir_pertemuan_sidang_kelulusan == "Belum Terverifikasi")
                    <td style="background-color: orange;">Belum Terverifikasi</td>
                    @elseif($data->status_daftar_hadir_pertemuan_sidang_kelulusan == "")
                    <td style="background-color: blue;">Belum Upload</td>
                    @endif
                </tr>
                <tr>
                  <th>17</th>
                  <td>Daftar Nilai Akhir</td>
                  <td>:</td>

                    @if($data->status_daftar_nilai_akhir == "Terverifikasi")
                    <td style="background-color: green;">Terverifikasi</td>
                    @elseif($data->status_daftar_nilai_akhir == "Revisi")
                    <td style="background-color: red;">Revisi</td>
                    @elseif($data->status_daftar_nilai_akhir == "Belum Terverifikasi")
                    <td style="background-color: orange;">Belum Terverifikasi</td>
                    @elseif($data->status_daftar_nilai_akhir == "")
                    <td style="background-color: blue;">Belum Upload</td>
                    @endif
                </tr>
                <tr>
                  <th>18</th>
                  <td>Rekap Penilaian Pelatihan Berbasis Kompetensi</td>
                  <td>:</td>

                    @if($data->status_rekap_penilaian_pelatihan_berbasis_kompetensi == "Terverifikasi")
                    <td style="background-color: green;">Terverifikasi</td>
                    @elseif($data->status_rekap_penilaian_pelatihan_berbasis_kompetensi == "Revisi")
                    <td style="background-color: red;">Revisi</td>
                    @elseif($data->status_rekap_penilaian_pelatihan_berbasis_kompetensi == "Belum Terverifikasi")
                    <td style="background-color: orange;">Belum Terverifikasi</td>
                    @elseif($data->status_rekap_penilaian_pelatihan_berbasis_kompetensi == "")
                    <td style="background-color: blue;">Belum Upload</td>
                    @endif
                </tr>
                <tr>
                  <th>19</th>
                  <td>Rekapitulasi Akhir Hasil Pelatihan</td>
                  <td>:</td>

                    @if($data->status_rekapitulasi_akhir_hasil_pelatihan == "Terverifikasi")
                    <td style="background-color: green;">Terverifikasi</td>
                    @elseif($data->status_rekapitulasi_akhir_hasil_pelatihan == "Revisi")
                    <td style="background-color: red;">Revisi</td>
                    @elseif($data->status_rekapitulasi_akhir_hasil_pelatihan == "Belum Terverifikasi")
                    <td style="background-color: orange;">Belum Terverifikasi</td>
                    @elseif($data->status_rekapitulasi_akhir_hasil_pelatihan == "")
                    <td style="background-color: blue;">Belum Upload</td>
                    @endif
                </tr>
                <tr>
                  <th>20</th>
                  <td>Tanda Terima Transport Peserta</td>
                  <td>:</td>

                    @if($data->status_tanda_terima_transport_peserta == "Terverifikasi")
                    <td style="background-color: green;">Terverifikasi</td>
                    @elseif($data->status_tanda_terima_transport_peserta == "Revisi")
                    <td style="background-color: red;">Revisi</td>
                    @elseif($data->status_tanda_terima_transport_peserta == "Belum Terverifikasi")
                    <td style="background-color: orange;">Belum Terverifikasi</td>
                    @elseif($data->status_tanda_terima_transport_peserta == "")
                    <td style="background-color: blue;">Belum Upload</td>
                    @endif
                </tr>
                <tr>
                  <th>21</th>
                  <td>Tanda Terima Kartu Asuransi Peserta</td>
                  <td>:</td>

                    @if($data->status_tanda_terima_asuransi_peserta == "Terverifikasi")
                    <td style="background-color: green;">Terverifikasi</td>
                    @elseif($data->status_tanda_terima_asuransi_peserta == "Revisi")
                    <td style="background-color: red;">Revisi</td>
                    @elseif($data->status_tanda_terima_asuransi_peserta == "Belum Terverifikasi")
                    <td style="background-color: orange;">Belum Terverifikasi</td>
                    @elseif($data->status_tanda_terima_asuransi_peserta == "")
                    <td style="background-color: blue;">Belum Upload</td>
                    @endif
                </tr>
                <tr>
                  <th>22</th>
                  <td>Tanda Teriama Pakaian Kerja Peserta</td>
                  <td>:</td>

                    @if($data->status_tanda_terima_pakaian_kerja_peserta == "Terverifikasi")
                    <td style="background-color: green;">Terverifikasi</td>
                    @elseif($data->status_tanda_terima_pakaian_kerja_peserta == "Revisi")
                    <td style="background-color: red;">Revisi</td>
                    @elseif($data->status_tanda_terima_pakaian_kerja_peserta == "Belum Terverifikasi")
                    <td style="background-color: orange;">Belum Terverifikasi</td>
                    @elseif($data->status_tanda_terima_pakaian_kerja_peserta == "")
                    <td style="background-color: blue;">Belum Upload</td>
                    @endif
                </tr>
                <tr>
                  <th>23</th>
                  <td>Tanda Terima ATK Peserta</td>
                  <td>:</td>

                    @if($data->status_tanda_terima_atk_peserta == "Terverifikasi")
                    <td style="background-color: green;">Terverifikasi</td>
                    @elseif($data->status_tanda_terima_atk_peserta == "Revisi")
                    <td style="background-color: red;">Revisi</td>
                    @elseif($data->status_tanda_terima_atk_peserta == "Belum Terverifikasi")
                    <td style="background-color: orange;">Belum Terverifikasi</td>
                    @elseif($data->status_tanda_terima_atk_peserta == "")
                    <td style="background-color: blue;">Belum Upload</td>
                    @endif
                </tr>
                <tr>
                  <th>24</th>
                  <td>Tanda Terima Modul</td>
                  <td>:</td>

                    @if($data->status_tanda_terima_modul == "Terverifikasi")
                    <td style="background-color: green;">Terverifikasi</td>
                    @elseif($data->status_tanda_terima_modul == "Revisi")
                    <td style="background-color: red;">Revisi</td>
                    @elseif($data->status_tanda_terima_modul == "Belum Terverifikasi")
                    <td style="background-color: orange;">Belum Terverifikasi</td>
                    @elseif($data->status_tanda_terima_modul == "")
                    <td style="background-color: blue;">Belum Upload</td>
                    @endif
                </tr>
                <tr>
                  <th>25</th>
                  <td>Tanda Terima Konsumsi Peserta</td>
                  <td>:</td>

                    @if($data->status_tanda_terima_konsumsi_peserta == "Terverifikasi")
                    <td style="background-color: green;">Terverifikasi</td>
                    @elseif($data->status_tanda_terima_konsumsi_peserta == "Revisi")
                    <td style="background-color: red;">Revisi</td>
                    @elseif($data->status_tanda_terima_konsumsi_peserta == "Belum Terverifikasi")
                    <td style="background-color: orange;">Belum Terverifikasi</td>
                    @elseif($data->status_tanda_terima_konsumsi_peserta == "")
                    <td style="background-color: blue;">Belum Upload</td>
                    @endif
                </tr>
                <tr>
                  <th>26</th>
                  <td>Foto Dokumentasi Kegiatan</td>
                  <td>:</td>

                    @if($data->status_foto_dokumentasi_kegiatan == "Terverifikasi")
                    <td style="background-color: green;">Terverifikasi</td>
                    @elseif($data->status_foto_dokumentasi_kegiatan == "Revisi")
                    <td style="background-color: red;">Revisi</td>
                    @elseif($data->status_foto_dokumentasi_kegiatan == "Belum Terverifikasi")
                    <td style="background-color: orange;">Belum Terverifikasi</td>
                    @elseif($data->status_foto_dokumentasi_kegiatan == "")
                    <td style="background-color: blue;">Belum Upload</td>
                    @endif
                </tr>
                <tr>
                  <th>27</th>
                  <td>Fotocopy Sertifikasi Peserta</td>
                  <td>:</td>

                    @if($data->status_fotocopy_sertifikasi_peserta == "Terverifikasi")
                    <td style="background-color: green;">Terverifikasi</td>
                    @elseif($data->status_fotocopy_sertifikasi_peserta == "Revisi")
                    <td style="background-color: red;">Revisi</td>
                    @elseif($data->status_fotocopy_sertifikasi_peserta == "Belum Terverifikasi")
                    <td style="background-color: orange;">Belum Terverifikasi</td>
                    @elseif($data->status_fotocopy_sertifikasi_peserta == "")
                    <td style="background-color: blue;">Belum Upload</td>
                    @endif
                </tr>
                @endforeach
              </table>
        </body>
    </head>
</html>
