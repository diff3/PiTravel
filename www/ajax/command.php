<?php
	if ($_REQUEST['code'] == "ssid") {
		$output = shell_exec("sudo iwlist wlan0 scan");
		$array = explode("\n" ,$output);

		$a = -1;
		
		for ($i = 1; $i < count($array); $i++) {
			// echo $array[$i] . "<br/>";
			if (stripos($array[$i], 'Cell') !== false) {		 
				$a++;	
			}
			
			if (stripos($array[$i], 'ESSID') !== false) {
				if(preg_match_all('/\"(.*?)\"/',$array[$i],$match)) {            
 			      	$ssid[][0] = $match[1][0];        
				}
			} elseif (stripos($array[$i], 'IE:') !== false) {
				if (stripos($array[$i], 'WPA ')) {
					$ssid[$a][1] = (isset($ssid[0][1])) ? "WPA/WPA2" : "WPA";	
				} else if (stripos($array[$i], 'WPA2 ')) {
					$ssid[$a][1] = (isset($ssid[0][1])) ? "WPA/WPA2" : "WPA2";		
				}							
			} elseif (stripos($array[$i], 'Encryption key:off') !== false) {
				$ssid[$a][1] = "open";	 
			}
			elseif (stripos($array[$i], 'Encryption key:on') !== false) {
				$ssid[$a][1] = "wep";	 
			}
		}
		
		echo "<div class=\"dropdown_container\">";
		echo "<select class=\"r_ssid\" name=\"r_ssid\" id=\"r_ssid\">";
				echo "<option value=\"none\">Välj nät</option>";
				foreach ($ssid as $value) {
					echo "<option value=\"$value[0]\">$value[0] ($value[1])</option>";
		  		}
			echo "</select>";
		echo "</div>";
	}
	else if ($_REQUEST['code'] == "active") {
		$output[] = shell_exec("sudo cp -vr /etc/PiTravel/conf/hostapd.conf /etc/hostapd");
		$output[] = shell_exec("sudo cp -vr /etc/PiTravel/conf/wpa.conf /etc");
		$output[] = shell_exec("sudo cp -vr /etc/PiTravel/conf/dnsmasq.conf /etc");
		$output[] = shell_exec("sudo cp -vr /etc/PiTravel/conf/hostapd /etc");
		$output[] = shell_exec("sudo cp -vr /etc/PiTravel/conf/interfaces /etc/network/interfaces");
		$output[] = shell_exec("sudo cp -vr /etc/PiTravel/conf/router.sh /etc/network/if-up.d");

		print_r($output);	
	}
	else if ($_REQUEST['code'] == "reboot") {
		$output[] = shell_exec("sudo reboot");
		print_r($output);
	}
?>
