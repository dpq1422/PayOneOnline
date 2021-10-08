<html>
<head>
<title>Updating records</title>
<style> 
*{font-family: "Courier New", Courier, monospace;text-align:right!important;} h4{font-size:18px;}
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
<script>
function openInNewTab(url) {
  var win = window.open(url, '_blank');
  win.focus();
}
function waitSeconds(iMilliSeconds) {
    var counter= 0
        , start = new Date().getTime()
        , end = 0;
    while (counter < iMilliSeconds) {
        end = new Date().getTime();
        counter = end - start;
    }
}
</script>
</head>
<body>
<?php
//header("Content-type: text/html; charset=utf-8");
/*
echo str_pad('',16384);flush();ob_flush();usleep(200000);
echo "<h4 style='color:#448aff;'>Checking AV-1 STATUS/TID to update</h4>";
include_once('update-av-tid.php');

echo str_pad('',16384);flush();ob_flush();usleep(200000);
echo "<h4 style='color:#4CAF50;'>Checking AV-1 TIDs to update</h4>";
include_once('update-av-com.php');

echo str_pad('',16384);flush();ob_flush();usleep(200000);
echo "<h4 style='color:#ff9800;'>Checking AV-1 failed to refund update</h4>";
include_once('update-av-refund-failed.php');

echo str_pad('',16384);flush();ob_flush();usleep(200000);
echo "<h4 style='color:#448aff;'>Checking RC-2 STATUS to update</h4>";
include_once('update-rc-status.php');

echo str_pad('',16384);flush();ob_flush();usleep(200000);
echo "<h4 style='color:#ff9800;'>Checking RC-2 failed to refund update</h4>";
include_once('update-rc-refund-failed.php');

echo str_pad('',16384);flush();ob_flush();usleep(200000);
echo "<h4 style='color:#448aff;'>Checking RC-2 TIDs to update</h4>";
include_once('update-rc-com.php');

echo str_pad('',16384);flush();ob_flush();usleep(200000);
echo "<h4 style='color:red;'>Checking MT charges difference</h4>";
include_once('update-mt-deduct-1001.php');

echo str_pad('',16384);flush();ob_flush();usleep(200000);
echo "<h4 style='color:#448aff;'>Checking MT-1 TID to update</h4>";
include_once('update-mt-tid.php');

echo str_pad('',16384);flush();ob_flush();usleep(200000);
echo "<h4 style='color:#448aff;'>Checking MT-1 STATUS to update</h4>";
include_once('update-mt-status.php');

echo str_pad('',16384);flush();ob_flush();usleep(200000);
echo "<h4 style='color:#4CAF50;'>Checking MT-1 TIDs to update</h4>";
include_once('update-mt-com.php');

echo str_pad('',16384);flush();ob_flush();usleep(200000);
echo "<br><br><h4 class='blinking'>Please wait while re-updating...</h4>";
*/
echo "<br><br><h4 class='blinking'>Please wait while re-updating records...</h4>";
echo str_pad('',16384);flush();ob_flush();usleep(1000000);
echo "<script>window.close();openInNewTab('update-av-tid.php');</script>";
?>
<!--<meta http-equiv='refresh' content='10'>-->
</body>
</html>