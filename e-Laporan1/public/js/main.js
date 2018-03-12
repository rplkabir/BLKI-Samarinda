function marknotifasread() {
	$.get('/markAsRead');
}

function marknotifasreads() {
	$.get('/usermark');
}

var auto_refresh = setInterval(
function ()
{
$('#load_notif').load('/notifreload').fadeIn("slow");
}, 10000);

var auto_refreshh = setInterval(
function ()
{
$('#load_comment').load('/notifcommentreload').fadeIn("slow");
}, 10000);

var auto_refreshhh = setInterval(
function ()
{
$('#load_notifuptd').load('/notifcommentreloaduptd').fadeIn("slow");
}, 10000);

