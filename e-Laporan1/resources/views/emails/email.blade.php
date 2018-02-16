@component('mail::message')
# Pengiriman Laporan RENLAKGIAT oleh {{ $rr->User->name}}

Telah mengirimkan laporan lengkap Untuk kegiatan dengan Rencana Pelaksanaan Kegiatan Kejuruan {{ $rr->kejuruan }} paket {{ $rr->paket }}. Mohon untuk di cek <br>
Terima Kasih<br>

@component('mail::button', ['url' => 'http://localhost:8000/admin/renlakgiat/laporan/'.$rr->id, 'color' => 'green'])
View Cek
@endcomponent

@endcomponent
