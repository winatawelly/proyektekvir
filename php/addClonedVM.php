<?php
$selectedVM = $_POST['selectedVM'];
$clonedvmName = $_POST['clonedvmName'];
$cloneType = $_POST['cloneType'];
$cloneDir = $_POST['cloneDir'];

set_time_limit(0);
$program = "F:/WELLY BACKUP/Kuliah/Semester 8/TekVir/cobaTekvir/Debug/power.exe";

echo $answer = shell_exec('"'.$program.'"'.' '.$cloneType.' '.'"'.$selectedVM.'"'.' '.'"'.$cloneDir.'"');
?>