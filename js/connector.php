<?php

function get_data($address, $action, $cnt) {
	exec("sudo i2cset -y 7 $address 0x00 0x0$action", $output);
	$tmp = @$output[0];
	while (strpos($tmp,"rror")!==false) {
		exec("sudo i2cset -y 7 $address 0x00 0x0$action", $output);
		$tmp = @$output[0];
	}
	$str = "";
	for ($i = 1; $i <= $cnt; $i++) {
		exec("sudo i2cget -y 7 $address", $output);
		$tmp = @$output[0];
		while (strpos($tmp,"rror")!==false) {
			exec("sudo i2cget -y 7 $address", $output);
			$tmp = @$output[0];
		}
		if ($tmp) {
			if (strpos($tmp,"1")!==false)
				$str .= "1";
			else
				$str .= "0";
		}
		unset($output);
		unset($tmp);
	}
			
	return $str;
}

function Transaction($addr, $action, $port=0, $cnt=0, $tryes=0) {

	if ($action < 3) {
		$str = array();
		$c = 1;
		while ($c <= $tryes) {
			$tmp = get_data($addr, $action, $cnt);
			
			if (strlen($tmp) == $cnt)
				$str[] = $tmp;
			
			$c++;
		}
		
		$new_array = array_count_values($str);
		
		asort($new_array);
		
		$res = "";
		$max = 0;
		foreach ($new_array AS $key=>$val) {
			if ($val >= $max) {
				$res = $key;
				$max = $val;
			}
		}
		
		return preg_split('//', $res, -1, PREG_SPLIT_NO_EMPTY);
	} elseif ($action < 5 ) {
		if ($action == 3)
			$val_hex = dechex(intval($port) + 100);
		else
			$val_hex = dechex(intval($port) + 200);

		exec("sudo i2cset -y 7 $addr 0x00 0x$val_hex", $output);
		$tmp = @$output[0];
		while (strpos($tmp,"rror")!==false) {
			exec("sudo i2cset -y 7 $addr 0x00 0x$val_hex", $output);
			$tmp = @$output[0];
		}

		return true;
	} elseif ($action < 7 ) {
		exec("sudo i2cset -y 7 $addr 0x00 0x0$action", $output);
		$tmp = @$output[0];
		while (strpos($tmp,"rror")!==false) {
			exec("sudo i2cset -y 7 $addr 0x00 0x0$action", $output);
			$tmp = @$output[0];
		}

		return true;
	}
}


?>
