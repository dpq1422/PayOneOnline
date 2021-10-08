<html>
<head>
<title>Updating records</title>
<style> 
*{font-family: "Courier New", Courier, monospace;text-align:right!important;} h4{font-size:18px;}
h1{font-family:Arial!important;}
.blinking{
    animation:blinkingText 1s infinite;
}
@keyframes blinkingText{
    0%{     color: #4CAF50;    }
    10%{     color: #4CAF50;    }
    49%{    color: #4CAF50; }
    50%{    color: #4CAF50; }
    75%{    color:transparent;  }
    100%{   color: #4CAF50;    }
}
</style>
</head>
<body>
<?php
//header("Content-type: text/html; charset=utf-8");
include('../zc-gyan-info-admin.php');
include('../zc-commons-admin.php');

echo "<h1>Started @ $datetime_datetime</h1>";
echo str_pad('',16384);flush();ob_flush();usleep(200000);
echo "<h4 style='color:#448aff;'>Checking AV-1 STATUS/TID to update</h4>";
include_once('update-av-tid.php');

echo str_pad('',16384);flush();ob_flush();usleep(200000);
echo "<h4 style='color:#ff9800;'>Checking AV-1 failed to refund update</h4>";
include_once('update-av-refund-failed.php');
/*
echo str_pad('',16384);flush();ob_flush();usleep(200000);
echo "<h4 style='color:#4CAF50;'>Checking AV-1 TIDs to update</h4>";
include_once('update-av-com.php');
*/
echo str_pad('',16384);flush();ob_flush();usleep(200000);
echo "<h4 style='color:#ff9800;'>Checking AV-3 failed to refund update</h4>";
include_once('update-av-refund-failed3.php');
/*
echo str_pad('',16384);flush();ob_flush();usleep(200000);
echo "<h4 style='color:#4CAF50;'>Checking AV-3 TIDs to update</h4>";
include_once('update-av-com3.php');
*/
echo str_pad('',16384);flush();ob_flush();usleep(200000);
echo "<h4 style='color:#448aff;'>Checking RC-2 STATUS to update</h4>";
include_once('update-rc-status.php');

echo str_pad('',16384);flush();ob_flush();usleep(200000);
echo "<h4 style='color:#ff9800;'>Checking RC-2 failed to refund update</h4>";
include_once('update-rc-refund-failed.php');
/*
echo str_pad('',16384);flush();ob_flush();usleep(200000);
echo "<h4 style='color:#448aff;'>Checking RC-2 TIDs to update</h4>";
include_once('update-rc-com.php');
*/
echo str_pad('',16384);flush();ob_flush();usleep(200000);
echo "<h4 style='color:#448aff;'>Checking RC-4 STATUS to update</h4>";
include_once('update-rc-status4.php');

echo str_pad('',16384);flush();ob_flush();usleep(200000);
echo "<h4 style='color:#ff9800;'>Checking RC-4 failed to refund update</h4>";
include_once('update-rc-refund-failed4.php');
/*
echo str_pad('',16384);flush();ob_flush();usleep(200000);
echo "<h4 style='color:#4CAF50;'>Checking RC-4 TIDs to update</h4>";
include_once('update-rc-com4.php');
*/
echo str_pad('',16384);flush();ob_flush();usleep(200000);
echo "<h4 style='color:#448aff;'>Checking MT-1 TID to update</h4>";
include_once('update-mt-tid.php');

echo str_pad('',16384);flush();ob_flush();usleep(200000);
echo "<h4 style='color:#448aff;'>Checking MT-1 STATUS to update</h4>";
include_once('update-mt-status.php');
/*
echo str_pad('',16384);flush();ob_flush();usleep(200000);
echo "<h4 style='color:#4CAF50;'>Checking MT-1 TIDs to update</h4>";
include_once('update-mt-com.php');
*/
echo str_pad('',16384);flush();ob_flush();usleep(200000);
echo "<h4 style='color:#448aff;'>Checking MT-3 STATUS to update</h4>";
include_once('update-mt-status3.php');
/*
echo str_pad('',16384);flush();ob_flush();usleep(200000);
echo "<h4 style='color:#4CAF50;'>Checking MT-3 TIDs to update</h4>";
include_once('update-mt-com3.php');
*/
include('../zc-gyan-info-admin.php');
include('../zc-commons-admin.php');
echo "<h1>Completed @ $datetime_datetime</h1>";
echo "<h4 class='blinking'>Please wait while re-updating records...</h4>";
echo str_pad('',16384);flush();ob_flush();usleep(1000000);
?>
<meta http-equiv='refresh' content='5'>
</body>
</html>