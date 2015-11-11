<?php
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&  $_SERVER['HTTP_X_REQUESTED_WITH'] != "XMLHttpRequest") die();

require_once("connector.php");

$addr = $_POST['addr'];
$pin = $_POST['pin'];

$txt = "";
if($addr && $pin) {
	Transaction($addr, 4, $pin);
	$txt .= 'if( $("#button'.$addr.$pin.'").hasClass("button_disabled") ) { $("#button'.$addr.$pin.'").removeClass("button_disabled"); } else { $("#button'.$addr.$pin.'").addClass("button_disabled"); }';
}

echo "<script>".$txt."</script>";
?>