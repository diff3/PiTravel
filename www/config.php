<?php
	// ini_set('display_errors', 'On');
	// error_reporting(E_ALL);
	
	include "header.php";
	$json_data = file_get_contents("/etc/PiTravel/settings.json");
	$json = json_decode($json_data, true);
?>

<form>
	<div class="settings_wrapper">
		<div class="settings_title"><h2>Access Point Settings (AP)</h2></div>
		
		<div class="info_wrapper">
			<div class="row_wrapper">
				<span class="label">Wireless ISSN Name:</span>
				<span class="infos"><input type="text" id="ac_ssid" name="ac_ssid" value="<?php echo $json['ac_ssid'] ?>"></span>
			</div>		
			<div class="row_wrapper">
				<span class="label">Password</span>
				<span class="infos"><input type="password" id="ac_pass" name="ac_pass" value="<?php echo $json['ac_pass'] ?>"></span>	
			</div>
			<div class="row_wrapper">
				<span class="label">Wireless Channel:</span>
				<span class="infos">
					<div class="dropdown_container">
						<select id="ac_channel" name="ac_channel">
							<option value="1">[1] - 2.412 MHz</option>
							<option value="2">[2] - 2.417 MHz</option>
							<option value="3">[3] - 2.422 MHz</option>
							<option value="4">[4] - 2.427 MHz</option>
							<option value="5">[5] - 2.432 MHz</option>
							<option value="6">[6] - 2.437 MHz</option>
							<option value="7">[7] - 2.442 MHz</option>
							<option value="8">[8] - 2.447 MHz</option>
							<option value="9">[9] - 2.452 MHz</option>
							<option value="10">[10] - 2.457 MHz</option>
							<option value="11">[11] - 2.462 MHz</option>
							<option value="12">[12] - 2.467 MHz</option>
							<option value="13">[13] - 2.472 MHz</option>
							<option value="14">[14] - 2.484 MHz</option>
						</select> 
					</div>
				</span>
			</div>
			<div class="row_wrapper">
				<span class="label">802.11 Mode:</span>
				<span class="infos">
					<div class="dropdown_container">
						<select id="ac_mode" name="ac_mode">
							<option value="g0">802.11b</option>
							<option value="g1">802.11g</option>
							<option value="g">802.11bgn</option>
							<option value="a">802.11a</option>
						</select> 
					</div>
				</span>
			</div>	
			<div class="row_wrapper">
				<span class="label">Security Mode:</span>
				<span class="infos">
					<div class="dropdown_container">
						<select id="ac_security" name="ac_security">
							<option value="n">None</option>
							<option value="w">WEP</option>
							<option value="1">WPA</option>
							<option value="2">WPA2</option>
						</select>
					</div> 
				</span>
			</div>
			<div class="row_wrapper">
				<span class="label">Edimax hostapd</span>
				<span class="infos"><input type="checkbox" name="ac_host" id="ac_host"></span>
			</div>	
			<div class="row_wrapper">
				<span class="label">SSID hidden</span>
				<span class="infos"><input type="checkbox" name="ac_hidden" id="ac_hidden"></span>
			</div>			
		</div>		
	</div>
	
	<div class="settings_wrapper">
		<div class="settings_title"><h2>DHCP AC</h2></div>
		<div class="info_wrapper">
			<div class="row_wrapper">
				<span class="label">Router IP</span>
				<span class="infos"><input type="text" name="router_ip" id="router_ip" value="<?php echo $json['router_ip'] ?>"></span>
			</div>
			<div class="row_wrapper">
				<span class="label">DCHP ip start</span>
				<span class="infos"><input type="text" name="router_start" id="router_start" value="<?php echo $json['router_start'] ?>"></span>
			</div>
			<div class="row_wrapper">
				<span class="label">DHCP ip end</span>
				<span class="infos"><input type="text" name="router_end" id="router_end" value="<?php echo $json['router_end'] ?>"></span>
			</div>
			<div class="row_wrapper">
				<span class="label">DHCP netmask</span>
				<span class="infos"><input type="text" name="router_netmask" id="router_netmask" value="<?php echo $json['router_netmask'] ?>"></span>
			</div>	
			<div class="row_wrapper">
				<span class="label">DHCP leach time (hours)</span>
				<span class="infos"><input type="text" name="router_ip_leach" id="router_ip_leach" value="<?php echo $json['router_ip_leach'] ?>"></span>
			</div>				
		</div>		
	</div>
	
	<div class="settings_wrapper">
		<div class="settings_title"><h2>Router Mode</h2></div>
		<div class="info_wrapper">
			<div class="row_wrapper">
				<input type="radio" id="r_mode" name="r_mode" value="1"> Eth0 Wan - Wlan0 Off, Wlan1 AP
			</div>
			<div class="row_wrapper">			
			<input type="radio" id="r_mode" name="r_mode" value="2"> Eth0 - Wlan0 Wan, Wlan1 Off
			</div>
			<div class="row_wrapper">
			<input type="radio" id="r_mode" name="r_mode" value="3"> Eth0 - Wlan0 Wan, Wlan1 AP
			</div>
			<div class="row_wrapper">
				<input type="radio" id="r_mode" name="r_mode" value="4"> Eth0 Wan, Wifis off
			</div>
			<div class="row_wrapper">
				<span class="label">Wlan0 Wan SSID:</span>
				<span class="infos" id="rssid" name="rssid">
					<div class="dropdown_container">
						<select id="r_ssid" name="ac_r_ssid">
							<option value="value="<?php echo $json['r_ssid'] ?>">None</option>
						</select>
					</div> 
				</span>
			</div>
			<div class="row_wrapper">
				<span class="label">Password</span>
				<span class="infos"><input type="password" id="r_pass" name="r_pass" value="<?php echo $json['r_pass'] ?>"></span>	
			</div>	
		</div>
	</div>
	
	<div class="settings_wrapper">
		<div class="settings_title"><h2>Tor Settings</h2></div>
		<div class="info_wrapper">
			<div class="row_wrapper">
				<span class="label">Use Tor network</span>
				<span class="infos"><input type="checkbox" name="tor" id="tor"> (Outbound trafic)</span>
			</div>
		</div>
	</div>
	
	<div class="settings_wrapper">
		<div class="settings_title"><h2>OpenVPN Settings</h2></div>
		<div class="info_wrapper">
			<div class="row_wrapper">
				<span class="label">Use OpenVPN</span>
				<span class="infos"><input type="checkbox" name="vpn" id="vpn"> (Outbound trafic)</span>
			</div>
			<div class="row_wrapper">
				<span class="label">VPN Client file</span>
				<span class="infos">(OVPN file)</span>						
			</div>
			<div class="row_wrapper">
				<input type="file" name="fileToUepload" id="fileTesoUpload">
			</div>
			<div class="row_wrapper">			
				<input type="submit" value="Upload" name="submit"></span>	
			</div>			
		</div>
	</div>	
	
	<div class="settings_wrapper">
		<div class="settings_title"><h2>SSH Tunnel</h2></div>
		<div class="info_wrapper">
			<div class="row_wrapper">
				<span class="label">Remote adress</span>
				<span class="infos"><input type="text" name="ssh_remote" id="ssh_remote" value="<?php echo $json['ssh_remote'] ?>"></span>
			</div>
			<div class="row_wrapper">
				<span class="label">Remote port</span>
				<span class="infos"><input type="text" name="ssh_remote_port" id="ssh_remote_port" value="<?php echo $json['ssh_remote_port'] ?>"></span>
			</div>
			<div class="row_wrapper">
				<span class="label">Local port</span>
				<span class="infos"><input type="text" name="ssh_local_port" id="ssh_local_port" value="<?php echo $json['ssh_local_port'] ?>"></span>
			</div>		
			<div class="row_wrapper">
				<span class="label">Remote username</span>
				<span class="infos"><input type="text" name="ssh_remote_user" id="ssh_remote_user" value="<?php echo $json['ssh_remote_user'] ?>"></span>
			</div>		
			<div class="row_wrapper">
				<span class="label">Remote password</span>
				<span class="infos"><input type="password" name="ssh_remote_pass" id="ssh_remote_pass" value="<?php echo $json['ssh_remote_pass'] ?>"></span>
			</div>				
		</div>
	</div>
	
	<div class="settings_wrapper">
		<div class="settings_title"><h2>Samba mount</h2></div>
		<div class="info_wrapper">
			<div class="row_wrapper">
				<span class="label">Remote samba share</span>
				<span class="infos"><input type="text" name="samba_host" id="samba_host" value="<?php echo $json['samba_host'] ?>"></span>
			</div>
			<div class="row_wrapper">
				<span class="label">Local mount dir</span>
				<span class="infos"><input type="text" name="samba_dir" id="samba_dir" value="<?php echo $json['samba_dir'] ?>"></span>
			</div>
			<div class="row_wrapper">
				<span class="label">Remote username</span>
				<span class="infos"><input type="text" name="samba_username" id="samba_username" value="<?php echo $json['samba_username'] ?>"></span>
			</div>
	
			<div class="row_wrapper">
				<span class="label">Remote password</span>
				<span class="infos"><input type="password" name="samba_password" id="samba_password" value="<?php echo $json['samba_password'] ?>"></span>
			</div>				
		</div>
	</div>	
	
	<div class="settings_wrapper">
		<div class="settings_title"><h2>Raspberry Pi Settings</h2></div>
		<div class="info_wrapper">
			<div class="row_wrapper">
				<span class="label">Raspberry Pi password</span>
				<span class="infos"><input type="password" id="rpi_pass" name="rpi_pass" value="<?php echo $json['rpi_pass'] ?>"></span>
			</div>		
			<div class="row_wrapper">
				<span class="label">Web password</span>
				<span class="infos"><input type="password" id="web_pass" name="web_pass" value="<?php echo $json['web_pass'] ?>"></span>
			</div>	
			<div class="row_wrapper">
				<span class="label">Hostname</span>
				<span class="infos"><input type="text" id="rpi_host" name="rpi_host" value="PiTravel" value="<?php echo $json['rpi_host'] ?>"></span>
			</div>		
		</div>
	</div>
	
	<div class="settings_wrapper">
		<div class="settings_title"><h2>Commands</h2></div>
			<div class="info_wrapper">
				<div class="row_wrapper">
					<input id="submit" type="submit" value="Spara">
					<input id="generate" type="submit" value="Generate">
					<input id="activate" type="submit" value="Activera">
					<input id="reboot" type="submit" value="Reboot">
				</div>
			</div>
		</div>
	</div>
</form>	

<div class="settings_wrapper">
	<div class="settings_title"><h2>Info</h2></div>
		<div class="info_wrapper">
			<div class="row_wrapper">
				<div id="info"></div>
			</div>
		</div>
	</div>
</div>

<script src="js/config.js"></script>
    
<script>
    	
$( document ).ready(function() {
	console.log( "ready!" );
		
	$("#ac_host").prop("checked", ("<?php echo $json['ac_host'] ?>" == "") ? false : <?php echo $json['ac_host'] ?> );
	$("ac_hidden").prop("checked", ("<?php echo $json['ac_hidden'] ?>" == "") ? false : <?php echo $json['ac_hidden'] ?> );	
	$("#ac_channel").val(("<?php echo $json['ac_channel'] ?>" == "") ? "1" : "<?php echo $json['ac_channel'] ?>" );
	$("#ac_mode").val(("<?php echo $json['ac_mode'] ?>" == "") ? "g" : "<?php echo $json['ac_mode'] ?>");
	$("#ac_security").val(("<?php echo $json['ac_security'] ?>" == "") ? "2" : "<?php echo $json['ac_security'] ?>");
	$("#tor").prop("checked", ("<?php echo $json['tor'] ?>" == "") ? false : <?php echo $json['tor'] ?> );
	$("#vpn").prop("checked", ("<?php echo $json['vpn'] ?>" == "") ? false : <?php echo $json['vpn'] ?> );
	var tmp = ("<?php echo $json['r_mode'] ?>" == "") ? "3" : "<?php echo $json['r_mode'] ?>";
	$("input:radio[name='r_mode']").filter("[value=" + tmp + "]").prop("checked", true);
	   		 	
	$.ajax({
		url : "ajax/command.php",
	   	type: "POST",
	   	data : { 
	   		code : "ssid" 
	   	},
	    success: function(data, textStatus, jqXHR) {
	        //data - response from server
	        $("#rssid").html(data);
	    	$("#r_ssid").val("<?php echo $json['r_ssid'] ?>");
	    },
	    error: function (jqXHR, textStatus, errorThrown) {
	 		// data
		}
	});		   	 	
});	
		
</script>		
		
<?php
	include "footer.php";
?>
