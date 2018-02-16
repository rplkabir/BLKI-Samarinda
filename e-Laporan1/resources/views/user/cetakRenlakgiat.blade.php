<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Renlakgiat</title>
        <body>
            <style type="text/css">
           
                .tg  {border-collapse:collapse;border-spacing:0;border-color:#ccc;width: 95%; }
                .tb-as  {border-collapse:collapse;border-spacing:1;border-color:#ccc;width: 95%; }
                .tg td{font-family:Arial;font-size:12px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
                .tg th{font-family:Arial;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
                .tg .tg-3wr7{font-weight:bold;font-size:12px;font-family:"Arial", Helvetica, sans-serif !important;;text-align:center}
                .tg .tg-ti5e{font-size:10px;font-family:"Arial", Helvetica, sans-serif !important;;text-align:center}
                .tg .tg-rv4w{font-size:10px;font-family:"Arial", Helvetica, sans-serif !important;}
            </style>
            <div style="font-family:Arial; font-size:12px;">
                <center><h2>Recana Pelaksanaan Kegiatan @foreach($renlakgiat as $data) {{$data->User->name}} @endforeach</h2></center>
            </div>
            <br>
            <div style="padding-left: 75px;">
               <table class="tg" border="1">
                @foreach($renlakgiat as $data)
                        <tr>
                            <th>Id</th>
                            <td>:</td>
                            <td>{{ $data->id }}</td>
                        </tr>
                        <tr>
                            <th>kejuruan</th>
                            <td>:</td>
                            <td>{{ $data->kejuruan }}</td>
                        </tr>
                        <tr>
                            <th>Program Pelatihan</th>
                            <td>:</td>
                            <td>{{ $data->program_pelatihan }}</td>
                        </tr>
                        <tr>
                            <th>Sumber Dana</th>
                            <td>:</td>
                            <td>{{ $data->sumber_dana }}</td>
                        </tr>
                        <tr>
                            <th>Durasi</th>
                            <td>:</td>
                            <td>{{$data->durasi}}</td>
                        </tr>
                        <tr>
                            <th>Paket</th>
                            <td>:</td>
                            <td>{{$data->paket}}</td>
                        </tr>
                        <tr>
                            <th>Orang</th>
                            <td>:</td>
                            <td>{{$data->orang}}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Mulai</th>
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
                            <td>{{ $data->status }}</td>
                        </tr>
                @endforeach  
                </table>
              </div>    
            
            
        </body>
    </head>
</html>



