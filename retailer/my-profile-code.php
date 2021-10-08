<?php
	include('../_session-retail.php');
	if(isset($_POST['submit']))
	{
		$field_name=$_POST['field_name'];
		$field_value=$_POST['field_value'];
		echo $qry="update child_user set $field_name='$field_value' where user_id=$user_id;";
		mysql_query($qry);
		header("location:my-profile.php");
	}
	if(isset($_POST['submit2']))
	{
		include('../functions/_uploadLogo.php');
		$field_name=$_POST['field_name'];
		$unqtm=date_timestamp_get(date_create());
		$doc_1="$user_id-$unqtm-logo";
		
		if(isset($_FILES["field_value"]))
		{
			$file1=$_FILES["field_value"];
			if(upload_logo($file1,$doc_1)=="")
			{
				$target_dir = "../logo/";
				$imageFileType = pathinfo(basename($file1["name"]),PATHINFO_EXTENSION);
				$target_file = $target_dir . $doc_1 . "." . $imageFileType;
				$file1=move_uploaded_file($_FILES["field_value"]["tmp_name"], $target_file);
			}
		}
		
		$qry="insert into child_user_update_request (date_time, user_id, request_by_user_id, business_logo, logo_verified, update_status) VALUE('$datetime_time', '$user_id', '$user_id', '$target_file', 0, 0);";
		mysql_query($qry);

		$qry="update child_user set $field_name='$target_file',logo_verified=0 where user_id=$user_id;";
		mysql_query($qry);
		header("location:my-profile.php");
	}
?>