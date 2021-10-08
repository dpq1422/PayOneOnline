		<?php include('../_session-team.php'); ?>
		<?php			
$_SESSION['logged_time1']=$_SESSION['logged_time2'];
$_SESSION['logged_time2']=time();
$logged_time1=$_SESSION['logged_time1'];
$logged_time2=$_SESSION['logged_time2'];
$active_time=$logged_time2 - $logged_time1;
if($active_time>600)
{
	header("location: ../logout.php");
}
		if(!($user_type>=2 && $user_type<=10))
		{
			if($user_type>=0 && $user_type<=1)
			{
				header('location:../admin/index.php');
			}		
			else if($user_type==11)
			{
				header('location:../retailer/index.php');
			}
		}
		$qry_chk_log="SELECT count(*) chklog FROM `child_user` where user_id='$user_id' and DATE_ADD(past_change_on, INTERVAL 10080 MINUTE)<sysdate()";	
		$res_chk_log=mysql_query($qry_chk_log);
		$val_chk_log=0;
		while($rs_chk_log=mysql_fetch_array($res_chk_log))
		{
			$val_chk_log=$rs_chk_log['chklog'];
		}
		if($val_chk_log!=0 && basename($_SERVER['PHP_SELF'])!="change-password.php")
		header('location:change-password.php');
		include_once '../functions/_update_wallet.php';
		update_wallet($user_id);
		?>
<?php 
ini_set('expose_php',0);
header("X-Powered-By: CentOS"); 
header("X-Powered-By: Ubuntu"); 
header("X-Powered-By: Servlet"); 
//header("X-Powered-By: Tomcat"); 
//header("X-Powered-By: Coyote"); 
?>
<script>if(window.Polymer==window.Polymer){}</script>
<script src="../js/angular.min.js"></script>
<script src="../js/node.js"></script>
<script src="../js/backbone.js"></script>
<meta name="gwt:property" content="panel="/>
		<meta http-equiv="Page-Enter" content="blendTrans(Duration=0)" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>PayOne</title>
		<link href="../img/mentor.ico" rel="icon" type="image/png" />
		<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="../css/api.css" rel="stylesheet" type="text/css" />
		<link href="../css/Custom.css" rel="stylesheet" type="text/css" />
		<link href="../css/ControllsDesigns.css" rel="stylesheet" type="text/css" />
		<link href="../css/validate.css" rel="stylesheet" type="text/css" />
		<link href="../css/font-awesome.css" rel="stylesheet" />
		<link href="../css/common.css" rel="stylesheet" type="text/css" />
		<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="../css/jquery.alerts.css" rel="stylesheet" type="text/css" />
		<link href="../css/bootstrap-switch.css" rel="stylesheet" />
		<link href="../css/datepicker.css" rel="stylesheet" type="text/css" />
		<link href="../css/style.css" rel="stylesheet" type="text/css" />
		<link href="../css/bootstrap-datepicker3.css" rel="stylesheet" />
		<link href="../css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="../css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
		<script src="../js/jquery-1.7.2.min.js" type="text/javascript"></script>	
		<script src="../js/bootstrap.min.js" type="text/javascript"></script>
		<script>
		function ChangeImage()
		{
			$("#ResultBal").html("<img height='24' width='75' src='../img/balance.gif'/>");
			document.getElementById('RefreshImage').src='../img/refresh.gif';
			setTimeout(ChangeImage2,1000);
		}
		function ChangeImage2()
		{
			window.location.reload();
		}
		</script>
		<style type="text/css">
			.bgheadcolor
			{
				background-color: #009de2;
			}
		</style>