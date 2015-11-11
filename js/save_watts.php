<?php

mysql_connect("localhost", "konan", "uhf8bwfgf") or die (mysql_error ());
mysql_select_db("watts") or die(mysql_error());

exec("sudo i2cget -y 7 0x37", $output);
$tmp = @$output[0];
while (strpos($tmp,"rror")!==false) {
	exec("sudo i2cget -y 7 0x37", $output);
	$tmp = @$output[0];
}

$impulse = hexdec($tmp);

$tm = time();
if (date("s") <30)
	$i = 0;
else
	$i = 30;
$min = mktime (date("H"), date("i"), $i, date("n"), date("j"), date("Y") );
$watt = 1000*$impulse/53;
mysql_query("INSERT INTO `watts`.`minutes` (`id`, `date`, `impulse`, `watt`) VALUES (NULL, '$min', '$impulse', '$watt');") or die (mysql_error());

mysql_close();

exit;
?>