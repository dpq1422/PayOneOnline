<?php
include('../_session-admin.php');
include('../functions/_uploadKYC.php');

$client_id=1001;
$kycuid=$_POST['kuserid'];
$unqtm=date_timestamp_get(date_create());
$doc_1="$client_id-$kycuid-$unqtm-panc";
$doc_2="$client_id-$kycuid-$unqtm-ppic";
$doc_3="$client_id-$kycuid-$unqtm-add1";
$doc_4="$client_id-$kycuid-$unqtm-add2";

$business_name="";
$gender=3;
$pancard_no="";
$date_of_birth="0000-00-00";

if(isset($_POST['biz_name']))
{
	$business_name=$_POST['biz_name'];
}
if(isset($_POST['sex']))
{
	$gender=$_POST['sex'];
}
if(isset($_POST['pan_no']))
{
	$pancard_no=$_POST['pan_no'];
}
if(isset($_POST['dob']))
{
	$date_of_birth=$_POST['dob'];
}

$kyc_error="";
$file1="";
if(isset($_FILES["pan"]))
{
	$file1=$_FILES["pan"];
	if(upload_kyc($file1,$doc_1)=="")
	{
		$target_dir = "../kyc/";
		//$imageFileType = pathinfo(basename($file4["name"]),PATHINFO_EXTENSION);
		$imageFileType = "jpg";
		$target_file = $target_dir . $doc_1 . "." . $imageFileType;
		$file1=move_uploaded_file($_FILES["pan"]["tmp_name"], $target_file);
	}
}
$file2="";
if(isset($_FILES["photo"]))
{
	$file2=$_FILES["photo"];
	if(upload_kyc($file2,$doc_2)=="")
	{
		$target_dir = "../kyc/";
		//$imageFileType = pathinfo(basename($file4["name"]),PATHINFO_EXTENSION);
		$imageFileType = "jpg";
		$target_file = $target_dir . $doc_2 . "." . $imageFileType;
		$file2=move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
	}
}
$file3="";
if(isset($_FILES["proofo"]))
{
	$file3=$_FILES["proofo"];
	if(upload_kyc($file3,$doc_3)=="")
	{
		$target_dir = "../kyc/";
		//$imageFileType = pathinfo(basename($file4["name"]),PATHINFO_EXTENSION);
		$imageFileType = "jpg";
		$target_file = $target_dir . $doc_3 . "." . $imageFileType;
		$file3=move_uploaded_file($_FILES["proofo"]["tmp_name"], $target_file);
	}
}
$file4="";
if(isset($_FILES["prooft"]))
{
	$file4=$_FILES["prooft"];
	if(upload_kyc($file4,$doc_4)=="")
	{
		$target_dir = "../kyc/";
		//$imageFileType = pathinfo(basename($file4["name"]),PATHINFO_EXTENSION);
		$imageFileType = "jpg";
		$target_file = $target_dir . $doc_4 . "." . $imageFileType;
		$file4=move_uploaded_file($_FILES["prooft"]["tmp_name"], $target_file);
	}
}

$result4=0;
if($file1==1)
{
	$query4a="INSERT INTO child_kyc_status(user_id,uploaded_at,status,uploaded_by_user_id,remarks,doc_1)
	VALUES ('$kycuid','$datetime_time','2','$user_id','PAN Card	re-uploaded by $user_types ($user_id - $user_name) at $datetime_time','$doc_1');";
	$result4+=mysql_query($query4a);
}
if($file2==1)
{
	$query4a="INSERT INTO child_kyc_status(user_id,uploaded_at,status,uploaded_by_user_id,remarks,doc_2)
	VALUES ('$kycuid','$datetime_time','2','$user_id','Passport Size Photo re-uploaded by $user_types ($user_id - $user_name) at $datetime_time','$doc_2');";
	$result4+=mysql_query($query4a);
}
if($file3==1)
{
	$query4a="INSERT INTO child_kyc_status(user_id,uploaded_at,status,uploaded_by_user_id,remarks,doc_3)
	VALUES ('$kycuid','$datetime_time','2','$user_id','Address Proof 1 re-uploaded by $user_types ($user_id - $user_name) at $datetime_time','$doc_3');";
	$result4+=mysql_query($query4a);
}
if($file4==1)
{
	$query4a="INSERT INTO child_kyc_status(user_id,uploaded_at,status,uploaded_by_user_id,remarks,doc_4)
	VALUES ('$kycuid','$datetime_time','2','$user_id','Address Proof 2 re-uploaded by $user_types ($user_id - $user_name) at $datetime_time','$doc_4');";
	$result4+=mysql_query($query4a);
}


$query4a="update child_user set business_name='$business_name',gender='$gender',pancard_no='$pancard_no',date_of_birth='$date_of_birth',kyc_status=1 where user_id='$kycuid';";
$result4+=mysql_query($query4a);


if($result4>0)
header("location:kyc-status.php");
else
header("location:kyc-upload.php?kycuid=$kycuid&msg=kyc-upload-fail");

?>