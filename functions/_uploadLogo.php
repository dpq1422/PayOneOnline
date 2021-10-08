<?php
function upload_logo($file,$doc_1)
{
	$logo_error="";
	$imageFileType = pathinfo(basename($file["name"]),PATHINFO_EXTENSION);
	$target_dir = "../logo/";
	$target_file = $target_dir . $doc_1 . "." . $imageFileType;
	$uploadOk = 1;
	// Check if image file is a actual image or fake image
	/*
	if(isset($_POST["submit"])) {
		$check = getimagesize($file["tmp_name"]);
		if($check !== true) {        
			$logo_error .= "File is not an image.";
			$uploadOk = 0;
		}
	}
	*/
	// Check if file already exists
	if (file_exists($target_file)) {
		$logo_error .= "Sorry, file already exists.";
		$uploadOk = 0;
	}
	// Check file size
	if ($file["size"] > 1048576) {
		$logo_error .= "Sorry, your file is too large it should not be larger than 250 KB each. ";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		$logo_error .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed. $imageFileType";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		$logo_error .= "Sorry, your file was not uploaded.";
		
	// if everything is ok, try to upload file
	} 
	return $logo_error;
}

?>