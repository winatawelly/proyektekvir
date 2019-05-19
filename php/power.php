<?php
	set_time_limit(0);
	$program = "F:/WELLY BACKUP/Kuliah/Semester 8/TekVir/cobaTekvir/Debug/power.exe";
	//$vm = "F:\WELLY BACKUP\ubuntu\ubuntu.vmx";
	$vm = $_POST['selectedVM'];
	$mode = $_POST['mode'];
	echo $output = shell_exec('"'.$program.'"'.' '.$mode.' '.'"'.$vm.'"');
	
?>