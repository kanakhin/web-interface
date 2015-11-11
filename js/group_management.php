<?php
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&  $_SERVER['HTTP_X_REQUESTED_WITH'] != "XMLHttpRequest") die();

require_once("connector.php");

$addr = $_POST['addr'];
$action = $_POST['action'];

$txt = "";
if($addr && $action) {
	if ($action == "on") {
		Transaction($addr, 5);
		$txt .= '$(".lamp[rel=\''.$addr.'\']'.'").addClass("lamp_active");';
	} elseif ($action == "off") {
		Transaction($addr, 6);
		$txt .= '$(".lamp[rel=\''.$addr.'\']'.'").removeClass("lamp_active");';
	}
}

echo "<script>".$txt."</script>";
?>