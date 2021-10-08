<?php
function upload_kyc($file,$doc_1)
{
	$kyc_error="";
	$imageFileType = pathinfo(basename($file["name"]),PATHINFO_EXTENSION);
	$target_dir = "../kyc/";
	$target_file = $target_dir . $doc_1 . "." . $imageFileType;
	$uploadOk = 1;
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($file["tmp_name"]);
		if($check !== true) {        
			$kyc_error .= "File is not an image.";
			$uploadOk = 0;
		}
	}
	// Check if file already exists
	if (file_exists($target_file)) {
		$kyc_error .= "Sorry, file already exists.";
		$uploadOk = 0;
	}
	// Check file size
	if ($file["size"] > 1048576) {
		$kyc_error .= "Sorry, your file is too large it should not be larger than 250 KB each. ";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		$kyc_error .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed. $imageFileType";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		$kyc_error .= "Sorry, your file was not uploaded.";
		
	// if everything is ok, try to upload file
	} 
	return $kyc_error;
}

?>