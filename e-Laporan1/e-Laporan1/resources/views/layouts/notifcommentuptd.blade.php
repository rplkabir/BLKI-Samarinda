<?php
if (Auth::guard('admin')->check()) {
	$data = \DB::table('notifications')->where('type', 'App\Notifications\notifuptd')->whereNull('read_at')->get();
	$result = count($data);
		echo $result;
	}	
else {
	echo "not logged in";
}
?>