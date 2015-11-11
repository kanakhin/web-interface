<?php
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&  $_SERVER['HTTP_X_REQUESTED_WITH'] != "XMLHttpRequest") die();

require_once("connector.php");

$addr = $_POST['addr'];
$pin = $_POST['pin'];

$txt = "";
if($addr && $pin) {
	Transaction($addr, 3, $pin);
	$txt .= 'if( $("#lamp'.$addr.$pin.'").hasClass("lamp_active") ) { $("#lamp'.$addr.$pin.'").removeClass("lamp_active"); } else { $("#lamp'.$addr.$pin.'").addClass("lamp_active"); }';
}

echo "<script>".$txt."</script>";
?>