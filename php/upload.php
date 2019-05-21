<?php
	$target_dir = "C:/xampp/htdocs/proyektekvir/uploads/";
	$target_file = $target_dir . basename($_FILES["fileupload"]["name"]);
	
	
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		 echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["fileupload"]["tmp_name"], $target_file)) {
			
			echo $target_file;
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
	
?>