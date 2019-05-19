<?php
include_once "connect.php";
$program = "F:/WELLY BACKUP/Kuliah/Semester 8/TekVir/cobaTekvir/Debug/power.exe";
$vmname = $_POST['vmname'];
$vmloc = $_POST['vmloc'];
$mode = "delete";
$output = shell_exec('"'.$program.'"'.' '.$mode.' '.'"'.$vmloc.'"');

if($output == "deleted"){
	$sql = "DELETE FROM vmlocation where name = '$vmname'";
	mysqli_query($con,$sql);
	

}


?>