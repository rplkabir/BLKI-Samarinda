<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRenlakgiatsLaporan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('renlakgiats', function($table) {
            $table->text('cover');
            $table->text('status_cover');
            $table->text('catatan_cover');
            $table->text('pendahuluan');
            $table->text('status_pendahuluan');
            $table->text('catatan_pendahuluan');
            $table->text('surat_keputusan');
            $table->text('status_surat_keputusan');
            $table->text('catatan_surat_keputusan');
            $table->text('nominatif_peserta_pelatihan');
            $table->text('status_nominatif_peserta_pelatihan');
            $table->text('catatan_nominatif_peserta_pelatihan');
            $table->text('nominatif_instruktur');
            $table->text('status_nominatif_instruktur');
            $table->text('catatan_nominatif_instruktur');
            $table->text('kurikulum');
            $table->text('status_kurikulum');
            $table->text('catatan_kurikulum');
            $table->text('jadwal_pelatihan_mingguan');
            $table->text('status_jadwal_pelatihan_mingguan');
            $table->text('catatan_jadwal_pelatihan_mingguan');
            $table->text('daftar_hadir_instruktur');
            $table->text('status_daftar_hadir_instruktur');
            $table->text('catatan_daftar_hadir_instruktur');
            $table->text('daftar_jam_mengajar_instruktur');
            $table->text('status_daftar_jam_mengajar_instruktur');
            $table->text('catatan_daftar_jam_mengajar_instruktur');
            $table->text('daftar_hadir_peserta_pelatihan');
            $table->text('status_daftar_hadir_peserta_pelatihan');
            $table->text('catatan_daftar_hadir_peserta_pelatihan');
            $table->text('daftar_permintaan_bahan_pelatihan');
            $table->text('status_daftar_permintaan_bahan_pelatihan');
            $table->text('catatan_daftar_permintaan_bahan_pelatihan');
            $table->text('bukti_penerimaan_bahan_pelatihan');
            $table->text('status_bukti_penerimaan_bahan_pelatihan');
            $table->text('catatan_bukti_penerimaan_bahan_pelatihan');
            $table->text('laporan_mingguan_penggunaan_bahan_pelatihan');
            $table->text('status_laporan_mingguan_penggunaan_bahan_pelatihan');
            $table->text('catatan_laporan_mingguan_penggunaan_bahan_pelatihan');
            $table->text('undangan_sidang_kelulusan');
            $table->text('status_undangan_sidang_kelulusan');
            $table->text('catatan_undangan_sidang_kelulusan');
            $table->text('berita_acara_sidang_kelulusan');
            $table->text('status_berita_acara_sidang_kelulusan');
            $table->text('catatan_berita_acara_sidang_kelulusan');
            $table->text('daftar_hadir_pertemuan_sidang_kelulusan');
            $table->text('status_daftar_hadir_pertemuan_sidang_kelulusan');
            $table->text('catatan_daftar_hadir_pertemuan_sidang_kelulusan');
            $table->text('daftar_nilai_akhir');
            $table->text('status_daftar_nilai_akhir');
            $table->text('catatan_daftar_nilai_akhir');
            $table->text('rekap_penilaian_pelatihan_berbasis_kompetensi');
            $table->text('status_rekap_penilaian_pelatihan_berbasis_kompetensi');
            $table->text('catatan_rekap_penilaian_pelatihan_berbasis_kompetensi');
            $table->text('rekapitulasi_akhir_hasil_pelatihan');
            $table->text('status_rekapitulasi_akhir_hasil_pelatihan');
            $table->text('catatan_rekapitulasi_akhir_hasil_pelatihan');
            $table->text('tanda_terima_transport_peserta');
            $table->text('status_tanda_terima_transport_peserta');
            $table->text('catatan_tanda_terima_transport_peserta');
            $table->text('tanda_terima_asuransi_peserta');
            $table->text('status_tanda_terima_asuransi_peserta');
            $table->text('catatan_tanda_terima_asuransi_peserta');
            $table->text('tanda_terima_pakaian_kerja_peserta');
            $table->text('status_tanda_terima_pakaian_kerja_peserta');
            $table->text('catatan_tanda_terima_pakaian_kerja_peserta');
            $table->text('tanda_terima_atk_peserta');
            $table->text('status_tanda_terima_atk_peserta');
            $table->text('catatan_tanda_terima_atk_peserta');
            $table->text('tanda_terima_modul');
            $table->text('status_tanda_terima_modul');
            $table->text('catatan_tanda_terima_modul');
            $table->text('tanda_terima_konsumsi_peserta');
            $table->text('status_tanda_terima_konsumsi_peserta');
            $table->text('catatan_tanda_terima_konsumsi_peserta');
            $table->text('foto_dokumentasi_kegiatan');
            $table->text('status_foto_dokumentasi_kegiatan');
            $table->text('catatan_foto_dokumentasi_kegiatan');
            $table->text('fotocopy_sertifikasi_peserta');
            $table->text('status_fotocopy_sertifikasi_peserta');
            $table->text('catatan_fotocopy_sertifikasi_peserta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
