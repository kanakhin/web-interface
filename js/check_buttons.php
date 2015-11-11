<?php
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&  $_SERVER['HTTP_X_REQUESTED_WITH'] != "XMLHttpRequest") die();

require_once("connector.php");

$addr = $_POST['addr'];
$pins = $_POST['pins'];

$txt = "";
if($addr && $pins) {
	$pins = explode(",", $pins);
	$state = Transaction($addr, 2, 0, count($pins), 3);
	
	foreach($pins AS $key=>$pin) {
		$enabled = @intval($state[$key]);
		
		if ($enabled){
			$txt .= '$("#button'.$addr.$pin.'").addClass("button_disabled");';
		}else{
			$txt .= '$("#button'.$addr.$pin.'").removeClass("button_disabled");';
		}
	}
}

echo "<script>".$txt."</script>";
?>