<?php

if (Auth::guard('web')->check()) {
	$data = Auth::user()->unreadNotificationsByType;
	$result = count($data);
		echo $result;
	}
elseif (Auth::guard('admin')->check()) {unreadNotificationsuptd
	$data = Auth::user()->unreadNotificationsuptd;
	$result = count($data);
		echo $result;
	}
else {
	echo "not logged in";
}

?>
