<?php

if (Auth::guard('web')->check()) {
	$data = Auth::user()->unreadNotificationsByType;
	$result = count($data);
		echo $result;
	}
elseif (Auth::guard('admin')->check()) {
	$data = DB::table('notifications')->where('type','App\Notifications\notifuptd')->get();
	$result = count($data);
		echo $result;
	}
else {
	echo "not logged in";
}

?>
