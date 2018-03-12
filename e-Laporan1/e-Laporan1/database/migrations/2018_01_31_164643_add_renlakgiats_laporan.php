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
            $table->text('cover')->nullable();
            $table->text('status_cover')->nullable();
            $table->text('catatan_cover')->nullable();
            $table->text('pendahuluan')->nullable();
            $table->text('status_pendahuluan')->nullable();
            $table->text('catatan_pendahuluan')->nullable();
            $table->text('surat_keputusan')->nullable();
            $table->text('status_surat_keputusan')->nullable();
            $table->text('catatan_surat_keputusan')->nullable();
            $table->text('nominatif_peserta_pelatihan')->nullable();
            $table->text('status_nominatif_peserta_pelatihan')->nullable();
            $table->text('catatan_nominatif_peserta_pelatihan')->nullable();
            $table->text('nominatif_instruktur')->nullable();
            $table->text('status_nominatif_instruktur')->nullable();
            $table->text('catatan_nominatif_instruktur')->nullable();
            $table->text('kurikulum')->nullable();
            $table->text('status_kurikulum')->nullable();
            $table->text('catatan_kurikulum')->nullable();
            $table->text('jadwal_pelatihan_mingguan')->nullable();
            $table->text('status_jadwal_pelatihan_mingguan')->nullable();
            $table->text('catatan_jadwal_pelatihan_mingguan')->nullable();
            $table->text('daftar_hadir_instruktur')->nullable();
            $table->text('status_daftar_hadir_instruktur')->nullable();
            $table->text('catatan_daftar_hadir_instruktur')->nullable();
            $table->text('daftar_jam_mengajar_instruktur')->nullable();
            $table->text('status_daftar_jam_mengajar_instruktur')->nullable();
            $table->text('catatan_daftar_jam_mengajar_instruktur')->nullable();
            $table->text('daftar_hadir_peserta_pelatihan')->nullable();
            $table->text('status_daftar_hadir_peserta_pelatihan')->nullable();
            $table->text('catatan_daftar_hadir_peserta_pelatihan')->nullable();
            $table->text('daftar_permintaan_bahan_pelatihan')->nullable();
            $table->text('status_daftar_permintaan_bahan_pelatihan')->nullable();
            $table->text('catatan_daftar_permintaan_bahan_pelatihan')->nullable();
            $table->text('bukti_penerimaan_bahan_pelatihan')->nullable();
            $table->text('status_bukti_penerimaan_bahan_pelatihan')->nullable();
            $table->text('catatan_bukti_penerimaan_bahan_pelatihan')->nullable();
            $table->text('laporan_mingguan_penggunaan_bahan_pelatihan')->nullable();
            $table->text('status_laporan_mingguan_penggunaan_bahan_pelatihan')->nullable();
            $table->text('catatan_laporan_mingguan_penggunaan_bahan_pelatihan')->nullable();
            $table->text('undangan_sidang_kelulusan')->nullable();
            $table->text('status_undangan_sidang_kelulusan')->nullable();
            $table->text('catatan_undangan_sidang_kelulusan')->nullable();
            $table->text('berita_acara_sidang_kelulusan')->nullable();
            $table->text('status_berita_acara_sidang_kelulusan')->nullable();
            $table->text('catatan_berita_acara_sidang_kelulusan')->nullable();
            $table->text('daftar_hadir_pertemuan_sidang_kelulusan')->nullable();
            $table->text('status_daftar_hadir_pertemuan_sidang_kelulusan')->nullable();
            $table->text('catatan_daftar_hadir_pertemuan_sidang_kelulusan')->nullable();
            $table->text('daftar_nilai_akhir')->nullable();
            $table->text('status_daftar_nilai_akhir')->nullable();
            $table->text('catatan_daftar_nilai_akhir')->nullable();
            $table->text('rekap_penilaian_pelatihan_berbasis_kompetensi')->nullable();
            $table->text('status_rekap_penilaian_pelatihan_berbasis_kompetensi')->nullable();
            $table->text('catatan_rekap_penilaian_pelatihan_berbasis_kompetensi')->nullable();
            $table->text('rekapitulasi_akhir_hasil_pelatihan')->nullable();
            $table->text('status_rekapitulasi_akhir_hasil_pelatihan')->nullable();
            $table->text('catatan_rekapitulasi_akhir_hasil_pelatihan')->nullable();
            $table->text('tanda_terima_transport_peserta')->nullable();
            $table->text('status_tanda_terima_transport_peserta')->nullable();
            $table->text('catatan_tanda_terima_transport_peserta')->nullable();
            $table->text('tanda_terima_asuransi_peserta')->nullable();
            $table->text('status_tanda_terima_asuransi_peserta')->nullable();
            $table->text('catatan_tanda_terima_asuransi_peserta')->nullable();
            $table->text('tanda_terima_pakaian_kerja_peserta')->nullable();
            $table->text('status_tanda_terima_pakaian_kerja_peserta')->nullable();
            $table->text('catatan_tanda_terima_pakaian_kerja_peserta')->nullable();
            $table->text('tanda_terima_atk_peserta')->nullable();
            $table->text('status_tanda_terima_atk_peserta')->nullable();
            $table->text('catatan_tanda_terima_atk_peserta')->nullable();
            $table->text('tanda_terima_modul')->nullable();
            $table->text('status_tanda_terima_modul')->nullable();
            $table->text('catatan_tanda_terima_modul')->nullable();
            $table->text('tanda_terima_konsumsi_peserta')->nullable();
            $table->text('status_tanda_terima_konsumsi_peserta')->nullable();
            $table->text('catatan_tanda_terima_konsumsi_peserta')->nullable();
            $table->text('foto_dokumentasi_kegiatan')->nullable();
            $table->text('status_foto_dokumentasi_kegiatan')->nullable();
            $table->text('catatan_foto_dokumentasi_kegiatan')->nullable();
            $table->text('fotocopy_sertifikasi_peserta')->nullable();
            $table->text('status_fotocopy_sertifikasi_peserta')->nullable();
            $table->text('catatan_fotocopy_sertifikasi_peserta')->nullable();
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
