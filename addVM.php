<?php
include_once "connect.php";
$name = $_POST['name'];
$loc = $_POST['loc'];
$type = $_POST['type'];

$sql = "INSERT INTO vmlocation VALUES('$name', '$loc','$type')";
$result = mysqli_query($con, $sql);
if($result){
     	echo "success";
}else{
	echo "failed";
}

?>