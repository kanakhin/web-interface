<?php
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&  $_SERVER['HTTP_X_REQUESTED_WITH'] != "XMLHttpRequest") die();

require_once("connector.php");

$addr = $_POST['addr'];
$pins = $_POST['pins'];

$txt = "";

if($addr && $pins) {
	$pins = explode(",", $pins);
	$state = Transaction($addr, 1, 0, count($pins), 3);
	
	foreach($pins AS $key=>$pin) {
		$enabled = @intval($state[$key]);
		
		if ($enabled){
			$txt .= '$("#lamp'.$addr.$pin.'").addClass("lamp_active");';
		}else{
			$txt .= '$("#lamp'.$addr.$pin.'").removeClass("lamp_active");';
		}
	}
}

echo "<script>".$txt."</script>";
?>