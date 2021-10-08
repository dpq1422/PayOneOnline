<?php

if(!isset($_SESSION))
{
	session_start();
}
date_default_timezone_set('Asia/Kolkata');
ini_set('error_reporting', E_ALL);
ini_set('display_errors', '0');

require('_gyan-info-admin.php');

$second_time="0";
$domain_name=$_SERVER['HTTP_HOST'];
if($domain_name!="localhost")
$second_time="19800";//19800
$query_time="select date(DATE_ADD(sysdate(), INTERVAL $second_time SECOND)) as date_time,
time(DATE_ADD(sysdate(), INTERVAL $second_time SECOND)) as time_time,
sysdate() + interval $second_time second as datetime_time;";
$result_time=mysql_query($query_time);
$date_time="";
$time_time="";
$datetime_time="";
while($row_time=mysql_fetch_array($result_time))
{
	$date_time=$row_time['date_time'];
	$time_time=$row_time['time_time'];
	$datetime_time=$row_time['datetime_time'];
}

//error_reporting(0); // for server
//ob_start("ob_gzhandler"); // for server

//ini_set("log_errors", 1);
//ini_set("error_log", "_error_log.txt");
?>