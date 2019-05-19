<?php
set_time_limit(0);
$program = "F:/WELLY BACKUP/Kuliah/Semester 8/TekVir/cobaTekvir/Debug/cobaTekvir.exe";
$vm = $_POST['loginVM'];
$type = $_POST['type'];
$username = $_POST['username'];
$password = $_POST['password'];
echo $output = shell_exec('"'.$program.'"'.' '.$type.' '.'"'.$vm.'"'.' '.$username.' '.$password);


?>