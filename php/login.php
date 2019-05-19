<?php
set_time_limit(0);
include_once "programList.php";
$vm = $_POST['loginVM'];
$type = $_POST['type'];
$username = $_POST['username'];
$password = $_POST['password'];
echo $output = shell_exec('"'.$guestOps.'"'.' '.$type.' '.'"'.$vm.'"'.' '.$username.' '.$password);


?>