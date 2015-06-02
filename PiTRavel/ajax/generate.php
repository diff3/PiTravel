<?php
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);
	
	$string = file_get_contents("settings.json");
	$json = json_decode($string, true);

	function fileWrite($file, $text) {
		$fp = fopen('/etc/PiTravel/' .$file, 'w')
			or die("Write failed {$file}");
		$ret = fwrite($fp, $text);
		fclose($fp);
	}

	function hostapd_conf($json) {
		$tmp = "";
		
		echo "hostapd.conf<br/>";

		$tmp .= "# 1. The Device which will act as AP\n";
		$tmp = $tmp . "interface=wlan1\n";
	

		// Driver switch
		switch ((string)$json['ac_host']) {
			case "true":
				$tmp = $tmp . "driver=rtl871xdrv\n";
				break;
			case "false":
				$tmp = $tmp . "driver=nl80211\n";
				break;
			 default:
		}
		
		$tmp .= "\n";
		
		$tmp = $tmp . "# 2. Parameters so that the daemon runs\n";
		$tmp = $tmp . "ctrl_interface=/var/run/hostapd\n";
		$tmp = $tmp . "ctrl_interface_group=0\n\n";
		
		$tmp = $tmp . "# 3. The Wifi configuration\n";
		$tmp = $tmp . "ssid={$json['ac_ssid']}\n";
		$tmp = $tmp . "channel={$json['ac_channel']}\n";
		
		// network mode
		switch ($json['ac_mode']) {
			case "g0": // b mode
				$tmp = $tmp . "hw_mode=b\n";
				$tmp = $tmp . "ieee80211n=0\n";
				break;
			case "g1": // g mode 
				$tmp = $tmp . "hw_mode=g\n";
				$tmp = $tmp . "ieee80211n=0\n";
				break;
			case "g": // bgn mode
				$tmp = $tmp . "hw_mode=g\n";
				$tmp = $tmp . "ieee80211n=1\n";
				$tmp = $tmp . "wmm_enabled=1\n";
				break;
			case "a": // a mode
				$tmp = $tmp . "hw_mode=a\n";
				$tmp = $tmp . "ieee80211n=1\n";
				$tmp = $tmp . "wmm_enabled=1\n";					
				break;
			default:
		}
		
		// hide ssid
		switch ((string)$json['ac_hidden']) {
			case "true":
				$tmp = $tmp . "ignore_broadcast_ssid=0\n";
				break; 
			case "false":
				$tmp = $tmp . "ignore_broadcast_ssid=2\n";
				break;
			default:
		}
		
		$tmp .= "\n";
		
		$tmp = $tmp . "# 4. Security of the Wifi connection\n";
		
		switch ((string)$json['ac_security']) {
			case "1": // wpa 
			case "2": // wpa2
				$tmp = $tmp . "wpa={$json['ac_security']}\n";
				$tmp = $tmp . "wpa_passphrase={$json['ac_pass']}\n";
				$tmp = $tmp . "wpa_key_mgmt=WPA-PSK\n";
				$tmp = $tmp . "wpa_pairwise=CCMP\n";
				$tmp = $tmp . "rsn_pairwise=CCMP\n";
				$tmp = $tmp . "auth_algs=1\n";
				break;
			case "w": // wep
				echo "hello";
				$tmp = $tmp . "wep_default_key=1\n";
				$tmp = $tmp . "wep_key1=\"{$json['ac_pass']}\"\n";
				$tmp = $tmp . "wep_key_len_broadcast=\"5\"\n";
				$tmp = $tmp . "wep_key_len_unicast=\"5\"\n";
				$tmp = $tmp . "wep_rekey_period=300\n";	
				$tmp = $tmp . "auth_algs=3\n";			
			break;
			case "n": // none
				echo "hello2";
				$tmp = $tmp . "auth_algs=1\n";
			break;
			default:
		}
			
		$tmp .= "\n";	
			
		$tmp = $tmp . "# 5. Other settings\n";
		$tmp = $tmp . "beacon_int=100\n";
		
		fileWrite("hostapd.conf", $tmp);
	}

	function wpa_conf($json) {
		echo "wpa.conf<br/>";
		
		$tmp = "ctrl_interface=/var/run/wpa_supplicant\n";
	#	$tmp .= "ctrl_interface_group=wheel";
		
		switch(strtolower($json['r_ssid_sec'])) {
			case "open": 
    			$tmp .= "ssid=\"{$json['r_ssid']}\n";
   				$tmp .= "key_mgmt=NONE\n"; 
				fileWrite("wpa.conf", $tmp);
			break;
			case "wep": 
				$tmp .= "ssid=\"{$json['r_ssid']}\n\"";
	     	    $tmp .= "key_mgmt=NONE";
	     		$tmp .= "wep_tx_keyidx=0";
	     		$tmp .= "# hex keys	denoted	without	quotes";
	     		$tmp .= "# wep_key0=42FEEDDEAFBABEDEAFBEEFAA55";
	     		$tmp .= "# ASCII keys denoted with quotes.";
	     		$tmp .= "wep_key=0\"{$json['r_pas']}!\"";
				fileWrite("wpa.conf", $tmp);
			break;
			case "wpa":
			case "wpa2":
			case "wpa/wpa2":
			case "wpa2/wpa":
				fileWrite("wpa.conf", $tmp);
				shell_exec('sudo wpa_passphrase "' . $json['r_ssid'] . '" "' . $json['r_pass'] .'" >> conf/wpa.conf');
			break;
			default:			
		}
	}
	
if ($json['r_mode'] == 3) {
	// dnsmasq.conf
	$tmp = "interface=wlan1\n";
	$tmp = $tmp . "dhcp-range={$json['router_start']},{$json['router_end']},{$json['router_netmask']},{$json['router_ip_leach']}h\n";
	$tmp = $tmp . "dhcp-option=3,{$json['router_ip']}";
	
	$fp = fopen('/etc/PiTravel/dnsmasq.conf', 'w');
	fwrite($fp, $tmp)
		or die("Write failed dnsmasq.conf");
	fclose($fp);

	$tmp = "";

	// hostapd.conf
	hostapd_conf($json);

	$tmp = "";

	// hostapd
	$tmp = "DAEMON_CONF=/etc/hostapd/hostapd.conf";

	$fp = fopen('/etc/PiTravel/hostapd', 'w')
		or die("Write failed hostapd");
	$ret = fwrite($fp, $tmp);
	fclose($fp);

	$tmp = "";

	//wpa.conf
	wpa_conf($json);
	
	$tmp = "";

	// interface
	$tmp = "#lo\n";
	$tmp .= "auto lo\n";
	$tmp .= "iface lo inet loopback\n\n";
	$tmp .= "#eth0\n";
	$tmp .= "iface eth0 inet dhcp\n\n";
	$tmp .= "#wlan0\n";
	$tmp .= "auto wlan0\n";
	$tmp .= "iface wlan0 inet dhcp\n";
	$tmp .= "wpa-conf /etc/wpa.conf\n\n";
	$tmp .= "#wlan1\n";
	$tmp .= "iface wlan1 inet static\n";
	$tmp .= "address {$json['router_ip']}\n";
	$tmp .= "netmask {$json['router_netmask']}";
	
	$fp = fopen('/etc/PiTravel/interfaces', 'w')
		or die("Write failed interfaces");
	$ret = fwrite($fp, $tmp);
	fclose($fp);
	
	$tmp = "";

	// iptables
	$tmp = "iptables --table nat --append POSTROUTING --out-interface wlan0 -j MASQUERADE\n"; 
	$tmp .= "iptables --append FORWARD --in-interface wlan1 -j ACCEPT";
	
        $fp = fopen('/etc/PiTravel/router.sh', 'w')
                or die("Write failed wpa.conf");
        $ret = fwrite($fp, $tmp);
        fclose($fp);
	
	$tmp = "";
	echo "Config files generated for router mode: {$json['r_mode']}";
	}
?>
