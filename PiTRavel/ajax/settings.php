<?php
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);
	

	$array = array("ac_ssid" => $_REQUEST['ac_ssid'], 
				   "ac_pass" => $_REQUEST['ac_pass'],
				   "ac_channel" => $_REQUEST['ac_channel'],
				   "ac_mode" => $_REQUEST['ac_mode'],
				   "ac_security" => $_REQUEST['ac_security'],
				   "ac_host" => $_REQUEST['ac_host'],
				   "ac_hidden" => $_REQUEST['ac_hidden'],
				   "router_ip" => $_REQUEST['router_ip'],
				   "router_start" => $_REQUEST['router_start'], 
				   "router_end" => $_REQUEST['router_end'],
				   "router_ip_leach" => $_REQUEST['router_ip_leach'],
				   "router_netmask" => $_REQUEST['router_netmask'],
				   "r_mode" => $_REQUEST['r_mode'],
				   "r_ssid" => $_REQUEST['r_ssid'],
				   "r_pass" => $_REQUEST['r_pass'],
				   "r_ssid_sec" => $_REQUEST['r_ssid_sec'],
				   "tor" => $_REQUEST['tor'],
				   "vpn" => $_REQUEST['vpn'],
				   "ssh_remote" => $_REQUEST['ssh_remote'],
				   "ssh_remote_port" => $_REQUEST['ssh_remote_port'],
				   "ssh_local_port" => $_REQUEST['ssh_local_port'],
				   "ssh_remote_user" => $_REQUEST['ssh_remote_user'],
				   "ssh_remote_pass" => $_REQUEST['ssh_remote_pass'],
				   "samba_host" => $_REQUEST['samba_host'],
				   "samba_dir" => $_REQUEST['samba_dir'],
				   "samba_username" => $_REQUEST['samba_username'],
				   "samba_password" => $_REQUEST['samba_password'],
				   "rpi_pass" => $_REQUEST['rpi_pass'],
				   "web_pass" => $_REQUEST['web_pass'],
				   "rpi_host" => $_REQUEST['rpi_host']
				);
	
	$json = json_encode($array, JSON_PRETTY_PRINT);			
	
	$fp = fopen('/etc/PiTravel/settings.json', 'w');
	fwrite($fp, $json);
	fclose($fp);
	
	echo "<pre><code>";
	print_r($json);
	echo "</code></pre>";	
?>
