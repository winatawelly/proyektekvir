<?php
include_once "programList.php";
$selectedVM = $_POST['selectedVM'];
$clonedvmName = $_POST['clonedvmName'];
$cloneType = $_POST['cloneType'];
$cloneDir = $_POST['cloneDir'];

set_time_limit(0);


echo $answer = shell_exec('"'.$power.'"'.' '.$cloneType.' '.'"'.$selectedVM.'"'.' '.'"'.$cloneDir.'"');
?>