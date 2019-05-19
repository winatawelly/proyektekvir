<?php
include_once "connect.php";
$sortBy = $_GET['sortBy'];
$result = array();
if($sortBy != 'All'){
	$sql = "SELECT * FROM vmlocation where type = '$sortBy'";
}
else{
	$sql = "SELECT * FROM vmlocation";
}

$query = mysqli_query($con,$sql);
while($row = mysqli_fetch_assoc($query)){
	$result[] = $row;
}
echo json_encode($result,JSON_UNESCAPED_SLASHES);



?>