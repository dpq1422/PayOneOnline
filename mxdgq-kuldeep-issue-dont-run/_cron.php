<?php
/*
/usr/bin/php -q /home/bankatyf/public_html/_mentor-india.in/login/script/cron.php
*/
include_once('../zc-gyan-info-admin.php');
$query_start="insert into bankatyf_common.all_cron(started_on) value((sysdate() + interval 19800 second));";
mysql_query($query_start);
$cron_id=mysql_insert_id();

include_once('update-status.php');

$query_end="update bankatyf_common.all_cron set completed_on=(sysdate() + interval 19800 second) where id='$cron_id';";
mysql_query($query_end);

$query_exe_time="update bankatyf_common.all_cron set exet =(completed_on - started_on) where id='$cron_id';";
mysql_query($query_exe_time);
?>