<?php
include_once "connect.php";
include_once "programList.php";
$vmname = $_POST['vmname'];
$vmloc = $_POST['vmloc'];
$mode = "delete";
$output = shell_exec('"'.$power.'"'.' '.$mode.' '.'"'.$vmloc.'"');

if($output == "deleted"){
	$sql = "DELETE FROM vmlocation where name = '$vmname'";
	mysqli_query($con,$sql);
	

}


?>