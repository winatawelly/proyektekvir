<?php
	include_once "programList.php";
	set_time_limit(0);
	
	//$vm = "F:\WELLY BACKUP\ubuntu\ubuntu.vmx";
	$vm = $_POST['selectedVM'];
	$mode = $_POST['mode'];
	echo $output = shell_exec('"'.$power.'"'.' '.$mode.' '.'"'.$vm.'"');
	
?>