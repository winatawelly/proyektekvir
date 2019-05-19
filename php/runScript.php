<?php
include_once "programList.php";
set_time_limit(0);
$vm = $_POST['loginVM'];
$type = $_POST['type'];
$username = $_POST['username'];
$password = $_POST['password'];
$interpreter = $_POST['interpreter'];
$script = $_POST['script'];
echo $output = shell_exec('"'.$guestOps.'"'.' '.$type.' '.'"'.$vm.'"'.' '.'"'.$interpreter.'"'.' '.'"'.$script.'"'.' '.$username.' '.$password);
?>