<?php
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&  $_SERVER['HTTP_X_REQUESTED_WITH'] != "XMLHttpRequest") die();

$type = $_POST['type'];

mysql_connect("localhost", "login", "password") or die ();
mysql_select_db("watts") or die(mysql_error());


if ($type == "cur") {
	$res = mysql_query("SELECT * FROM `watts`.`minutes` ORDER BY `id` DESC LIMIT 1;") or die ();
}elseif ($type == "h_avg") {
	$hour = mktime (date("H"), 0, 0, date("n"), date("j"), date("Y") );
	$res = mysql_query("SELECT AVG(watt) AS watt FROM `watts`.`minutes` WHERE `date`>=$hour;") or die ();
}elseif ($type == "m_summ") {
	$month = mktime (0, 0, 0, date("m"), 1, date("Y") );
	$res = mysql_query("SELECT SUM(watt/240) AS watt FROM `watts`.`minutes` WHERE `date`>=$month;") or die ();
}

$row = mysql_fetch_assoc($res);

if( $row['watt'] ) {
	if ($row['watt'] < 1000)
		$watt = round($row['watt'])." Вт";
	else
		$watt = (round($row['watt']/1000, 2))." кВт";
}else{
	$watt = "—";
}

mysql_close();

echo $watt;
exit;
?>