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
                    background-color: grey;
                    text-align: center;
                }
                td{
                    text-align: center;
                    font-size: 12px;
                }
            </style>
            <div style="font-family:Arial; font-size:12px;">
                <center><h2>Recana Pelaksanaan Kegiatan</h2></center>
            </div>
            <br>
            
               <table class="tb-as" border="1">
                        <tr>
                            <th>No</th>
                            <th>Kejuruan</th>
                            <th>Program Pelatihan</th>
                            <th>Sumber Dana</th>
                            <th>Durasi</th>
                            <th>Paket</th>
                            <th>Orang</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
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
                                    
                        @endforeach
                    </table>
             
            
        </body>
    </head>
</html>



