<?php/*
if(isset($_POST['Send']))
{
	$to = "admin@payoneonline.com";
	$subject = "Inquiry via Website";
	$Name= $_POST['Name'];
	$Email= $_POST['Email'];
	$Mobile= $_POST['Mobile'];
	$Message= $_POST['Message'];

	$messages="Email Received Through Inquiry Form on Website";
	$messages=$messages."\r\n\r\nFULL NAME :: ".$Name;
	$messages=$messages."\r\n\r\nE-MAIL :: ".$Email;
	$messages=$messages."\r\n\r\nMOBILE NUMBER :: ".$Mobile;
	$messages=$messages."\r\n\r\nMESSAGE :: ".$Message;
	$headers = "From: $Email\r\nCC: admin@payoneonline.in,info@payoneonline.in";


	mail($to,$subject,$messages,$headers);
	header("location: join-us.php?msg=done");
}
else
{
	header("location: join-us.php?msg=failed");
}*/
?>