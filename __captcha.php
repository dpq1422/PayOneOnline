<?php
	session_start();
	include("./__captchaClass.php");	
	
	/*create class object*/
	$phptextObj = new __captchaClass();	
	/*phptext function to genrate image with text*/
	$phptextObj->phpcaptcha('#ffffff','#000000',300,100,0,1000);	
 ?>