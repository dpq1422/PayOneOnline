<?php
include_once('../zc-session-admin.php');
if(!isset($_SESSION))
{
	session_start();
}
else if(!isset($_SESSION['logged_user_id']))
{
	echo "<script>window.location.href='http://payoneonline.com';</script>";
}
include_once('../zc-session-admin.php');
if($logged_user_type==1 || $logged_user_type<0)
{
	header("location: ../DashboardServlet");
}
else if($logged_user_type>1 && $logged_user_type<12)
{
	header("location: ../team/DashboardServlet");
}
else if($logged_user_type==0)
{
	header("location: LogoutServlet");
}
$_SESSION['logged_time1']=0;
if(isset($_SESSION['logged_time2']))
$_SESSION['logged_time1']=$_SESSION['logged_time2'];
$_SESSION['logged_time2']=time();
$logged_time1=$_SESSION['logged_time1'];
$logged_time2=$_SESSION['logged_time2'];
$active_time=$logged_time2 - $logged_time1;
$welcome_time=0;
if(isset($_SESSION['welcome_time']))
	$welcome_time=$_SESSION['welcome_time'];
$welcomenote=$logged_time2-$welcome_time;
if($active_time>600)
{
	header("location: LogoutServlet");
}
$logged_pword=0;
if(isset($_SESSION['logged_pword']))
$logged_pword=$_SESSION['logged_pword'];
$logged_tpin=0;
if(isset($_SESSION['logged_tpin']))
$logged_tpin=$_SESSION['logged_tpin'];
$visited_page=basename($_SERVER['PHP_SELF']);
include_once('../zf-CheckLogin.php');
$val_chk_log=check_last_pass_change_on($logged_user_id);
if($val_chk_log!=0 && $visited_page!="MyChangePasswordServlet.php" && $logged_pword!="ahs@#123")
{
	header('location: MyChangePasswordServlet');
}
/*
if($logged_tpin=="1234" && $visited_page!="MyChangeTpinServlet.php" && $logged_pword!="ahs@#123")
{
	header('location: MyChangeTpinServlet');
}
*/
include_once('../zf-UserWalletKyc.php');
include_once('../zf-WalletDistributed.php');
update_user_balance($logged_user_id);
$kinf=show_kyc_info($logged_user_id);
$binf=show_bank_info($logged_user_id);
$wbal=show_wallet_balance($logged_user_id);
include_once('../zf-User.php');
$user_tpin_doctype_docid_areapincode_geo=show_kyc($logged_user_id);
$user_txn_tpin=$user_tpin_doctype_docid_areapincode_geo[0];
$user_txn_doctype=$user_tpin_doctype_docid_areapincode_geo[1];
$user_txn_panno=$user_txn_docid=$user_tpin_doctype_docid_areapincode_geo[2];
$user_txn_areapincode=$user_tpin_doctype_docid_areapincode_geo[3];
$user_txn_geo=$user_tpin_doctype_docid_areapincode_geo[4];
$user_txn_aadhar=$user_tpin_doctype_docid_areapincode_geo[5];
?>
<header class="wh w3-left">
        <?php include_once('_header-menu-top.php'); ?>
		<?php include_once('_header-logo-wallet.php'); ?>
		<?php include_once('_header-menu-web.php'); ?>
</header>