<?php
if (Auth::guard('web')->check()) {
	$data = Auth::user()->unreadNotificationsnotifcomment;
	$result = count($data);
		echo $result;
	}	
else {
	echo "not logged in";
}
?>