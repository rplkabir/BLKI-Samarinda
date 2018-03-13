<ul id="refreshlist" class='dropdown-menu' role="menu" >
  <?php
    $data = \DB::table('notifications')
            ->where('type', 'App\Notifications\Newlaporan')
            ->whereNull('read_at')
            ->get();
		$result = count($data);
  ?>
      @foreach($data as $notif)
        <li style="background-color: #42f459; " ><a onclick="marknotifasread()" href="{{url('admin/renlakgiat/detail/'.$notif->data['aidi'])}}">{{ $notif->data['namauptd'] }} <b>mengupload Laporans : </b> {{ $notif->data['jenis'] }} <b> pada kejuruan  </b>{{ $notif->data['nama'] }}</a></li>
      @endforeach
    <?php  $i = 0  ?>
        <?php
          $read = \DB::table('notifications')->where('type', 'App\Notifications\Newlaporan');
          var_dump($read);
          $aidi = json_decode($read->data['aidi'], true);
        ?>

        @foreach($read as $notif)
        <?php if (++$i > 5) {
          break;
        }
        ?>
        <li><div class="divider"></div></li>
      <li ><a href="{{url('admin/renlakgiat/detail/'.$aidi)}}">{{ $notif->data['namauptd'] }} <b> mengupload Laporans :  </b>{{ $notif->data['jenis'] }} <b> pada kejuruan </b>{{ $notif->data['nama'] }}</a></li>
      @endforeach
</ul>
