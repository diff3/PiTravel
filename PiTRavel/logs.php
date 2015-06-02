<?php
	include "header.php";
?>
		
	<div class="settings_wrapper_text">
		<div class="settings_title_text"><h2>DMESG</h2></div>
		<textarea rows="4" cols="48">
		<?php
			$output = shell_exec('dmesg | tac');
			echo "" . nl2br($output) . "";
		?>
		</textarea>			
	</div>	
	
	<div class="settings_wrapper_text">
		<div class="settings_title_text"><h2>MESSAGES</h2></div>
		<textarea rows="4" cols="48">
		<?php
			$output = shell_exec('sudo tail -n 50 /var/log/messages | tac');
			echo "" . nl2br($output) . "";
		?>
		</textarea>			
	</div>	
	
		<div class="settings_wrapper_text">
		<div class="settings_title_text"><h2>ROUTERLOG</h2></div>
		<textarea rows="4" cols="48">
		<?php
			$output = shell_exec('sudo tail -n 50 /var/log/raspberrywap.log | tac');
			echo "" . nl2br($output) . "";
		?>
		</textarea>			
	</div>
	
		<div class="settings_wrapper_text">
		<div class="settings_title_text"><h2>SYSLOG</h2></div>
		<textarea rows="4" cols="48">
		<?php
			$output = shell_exec('sudo tail -n 50 /var/log/syslog | tac');
			echo "" . nl2br($output) . "";
		?>
		</textarea>			
	</div>
		
 
  <?php
	include "footer.php";
  ?>
    

