<?php
$ip = "192.168.1.103";
$pins = array(3,4,5,6);

$txt = "";
foreach ($pins AS $pin) {
	$html = file_get_contents('http://'.$ip.'/?off'.$pin);
}

?>