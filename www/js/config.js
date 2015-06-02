// Save event

$("#submit").click(function(event) {
	event.preventDefault();
		
	console.log( "Click submit" );
	
	// AC settings
	var ac_ssid = $("#ac_ssid").val();
	var ac_pass = $("#ac_pass").val();
	var ac_channel = $("#ac_channel").val();
	var ac_mode = $("#ac_mode").val();
	var ac_security = $("#ac_security").val();
	var ac_host = $("#ac_host").is(":checked");
	var ac_hidden = $("#ac_hidden").is(":checked");
	 	
	// DCHP settings
	var router_ip = $("#router_ip").val();
	var router_start = $("#router_start").val();
	var router_end = $("#router_end").val();
	var router_ip_leach = $("#router_ip_leach").val(); 
	var router_netmask = $("#router_netmask").val();
		
	// Router mode
	var r_mode = $('input:radio[name=r_mode]:checked').val();
	var r_ssid = $("#r_ssid").val();
	var r_pass = $("#r_pass").val();
	
	// get ssid security
	var regExp = /\(([^)]+)\)/;
	var matches = (regExp.exec($("#r_ssid :selected").text()) == null) ? "" : regExp.exec($("#r_ssid :selected").text());
	var r_ssid_sec = (matches == "") ? "" : matches[1];
			 
	// tor		
	var tor = $("#tor").is(":checked");
		
	// vpn
	var vpn = $("#vpn").is(":checked");
		
	// ssh
	var ssh_remote = $("#ssh_remote").val();
	var ssh_remote_port = $("#ssh_remote_port").val();
	var ssh_local_port = $("#ssh_local_port").val();
	var ssh_remote_user = $("#ssh_remote_user").val();
	var ssh_remote_pass = $("#ssh_remote_pass").val();
		
	// samba
	var samba_host = $("#samba_host").val();
	var samba_dir = $("#samba_dir").val();
	var samba_username = $("#samba_username").val();
	var samba_password = $("#samba_password").val();
		
	// rpi settings
	var rpi_pass = $("#rpi_pass").val();
	var web_pass = $("#web_pass").val();
	var rpi_host = $("#rpi_host").val();
	
$.ajax({
    	url: 'ajax/settings.php',
    	data: {
    		"ac_ssid" : ac_ssid,
     		"ac_pass" : ac_pass,
      		"ac_channel" : ac_channel,
      		"ac_mode" : ac_mode,
      		"ac_security" : ac_security,
      		"ac_host" : ac_host,
      		"ac_hidden" : ac_hidden,
      		"router_ip" : router_ip,
      		"router_start" : router_start,
      		"router_end" : router_end,
      		"router_ip_leach" : router_ip_leach,
      		"router_netmask" : router_netmask,
      		"r_mode" : r_mode,
      		"r_ssid" : r_ssid,
      		"r_pass" : r_pass,
      		"r_ssid_sec" : r_ssid_sec,
      		"tor" : tor,
      		"vpn" : vpn,
      		"ssh_remote" : ssh_remote,
      		"ssh_remote_port" : ssh_remote_port,
      		"ssh_local_port" : ssh_local_port,
      		"ssh_remote_user" : ssh_remote_user,
      		"ssh_remote_pass" : ssh_remote_pass,
      		"samba_host" : samba_host,
      		"samba_dir" : samba_dir,
      		"samba_username" : samba_username,
      		"samba_password" : samba_password,
      		"rpi_pass" : rpi_pass,
      		"web_pass" : web_pass,
      		"rpi_host" : rpi_host
      	},
  	   	success: function(data) {
        	$("#info").html(data);
        	
        	$(".settings_wrapper").trigger("refresh");
        
     	  	//	alert(data);
     	},
     	error: function() {
       		//$('#info').html('<p>An error has occurred</p>');
     	}
	});		
});

$("#generate").click(function(event) {
		event.preventDefault();
		
		console.log( "Click generate" );
	
	   	 		
	   	 		$.ajax({
		   	 		url : "ajax/generate.php",
		   	 		type: "POST",
		    		success: function(data, textStatus, jqXHR) {
		        		//data - response from server
		        		$("#info").html(data);
		    		},
		    		error: function (jqXHR, textStatus, errorThrown) {
		 		    	// data
		 		    }
	     		});
			});	
			


$("#activate").click(function(event) {
		event.preventDefault();
		
		console.log( "Click active" );
	
	   	 		
	   	 		$.ajax({
		   	 		url : "ajax/command.php",
		   	 		type: "POST",
		   			data : { 
		   				code : "active" 
		   			},
		    		success: function(data, textStatus, jqXHR) {
		        		//data - response from server
		        		$("#info").html(data);
		    		},
		    		error: function (jqXHR, textStatus, errorThrown) {
		 		    	// data
		 		    }
	     		});
			});	
			
		$("#reboot").click(function(event) {
		event.preventDefault();
		
		console.log( "Click reboot" );
	   	 		$.ajax({
		   	 		url : "ajax/command.php",
		   	 		type: "POST",
		   			data : { 
		   				code : "reboot" 
		   			},
		    		success: function(data, textStatus, jqXHR) {
		        		//data - response from server
		        		$("#info").html(data);
		    		},
		    		error: function (jqXHR, textStatus, errorThrown) {
		 		    	// data
		 		    }
	     		});
			});	
