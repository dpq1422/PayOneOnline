		<?php include('../_session-retail.php'); ?>
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
		if($user_type!=11)
		{
			if($user_type>=0 && $user_type<=1)
			{
				header('location:../admin/index.php');
			}
			else if($user_type>=2 || $user_type<=10)
			{
				header('location:../distributor/index.php');
			}
		}
		$qry_chk_log="SELECT count(*) chklog FROM `child_user` where user_id='$user_id' and DATE_ADD(past_change_on, INTERVAL 10080 MINUTE)<sysdate()";	
		$res_chk_log=mysql_query($qry_chk_log);
		$val_chk_log=0;
		while($rs_chk_log=mysql_fetch_array($res_chk_log))
		{
			$val_chk_log=$rs_chk_log['chklog'];
		}
		//if($val_chk_log!=0 && basename($_SERVER['PHP_SELF'])!="change-password.php")
		//header('location:change-password.php');
		$qry_charges="select guardian_spouse_contact_no from child_user where user_id='$user_id';";
		$result_charges=mysql_query($qry_charges);
		while($rs_charges = mysql_fetch_assoc($result_charges))
		{
			$_SESSION['retailer_charges']=$rs_charges['guardian_spouse_contact_no'];
		}
		include_once '../functions/_update_wallet.php';
		update_wallet($user_id);
		?>
		<meta charset="UTF-8" />
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
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="description" content="PayOne Retailer" />
		<title>Retailer</title>
		<link rel="shortcut icon" type="image/x-icon" href="../img/fav.png" />
		<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
		<link rel="stylesheet" href="../css/material-design-iconic-font.css" />
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="../css/mara.min.css" media="screen" />
		<!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" type="text/css" href="../css/prism.css" />
		<link href="../css/sweetalert2.min.css" rel="stylesheet" />
		<link href="https://opensource.keycdn.com/fontawesome/4.6.3/font-awesome.min.css" rel="stylesheet" />
		<link href="../css/ladda-themeless.min.css" rel="stylesheet" />
		<link type="text/css" rel="stylesheet" href="../css/chosen.min.css" media="screen" />
   
    <style>

        .brand-logo img {
            width: 130px;
            filter: brightness(0) invert(1);
        }

         pre.regular-table:before{
            display: none!important;
        }
        .card-default .card-header {
            padding-left: 20px;
        }

        .card-default {
            border: 1px solid #eaeaea;
        }
        .table-height .card-header {
            padding: 10px 20px;
        } 
        .card-default .card-header {
            background-color: #eaeaea;
            border-bottom: 1px solid #ccc;            
        }
        pre {
            max-height: 596px;
        }
        table.dataTable tbody td {
            padding: 8px 18px;
        }
        #search-items{
            display: inline-block;
            background: transparent none repeat scroll 0 0;
            font-size: 16px;
            line-height: 40px;
            height: 40px;
            color: black;
            transition: border-color 0.3s ease 0s;
        }
        .search-div i{
            display: inline-block;
            position: absolute;
            bottom: 20px;
            margin-left: -24px;
            color: #000000;
        }
        .search-div label {
            margin-left: 0;
            /*left: -184px*/

        }

        .label-success {
            background-color: #4CAF50;
        }

        .label-warning {
            background-color: #ff9800;
        }

        .label-danger {
            background-color: #F44336;
        }

        .label {
            display: inline;
            padding: .2em .6em .3em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25em;
        }

        .text-center {
            text-align:center;
        }

        .pad-10 {
            padding:10px !important;
        }

        .btn:disabled {
            cursor: not-allowed;
            filter: alpha(opacity=65);
            -webkit-box-shadow: none;
            box-shadow: none;
            opacity: .65;
        }


        .material-select ul::-webkit-scrollbar, .chosen-drop ul::-webkit-scrollbar {
            width: 0.5em;
        }

        .material-select ul::-webkit-scrollbar-thumb, .chosen-drop ul::-webkit-scrollbar-thumb {
            background-color: darkgrey;
            outline: 1px solid slategrey;
        }

        .material-select ul {
            max-height:250px;
            overflow-x:scroll;
        }

        .myContainer {
            min-height:250px;
        }

        .chosen-search input[type=text] {
            padding: 14px 12px !important;
        }

        .collection .collection-item.avatar .circle {
            border: 1px solid rgba(158, 158, 158, 0.38);
            width: 50px;
            height: 50px;
        }


    </style>

    <style>
       td .circle{
           max-width:35px;
        }
    </style>

    


    <style>
        .search-top-bar{
            /*width:calc(100% - 628px);*/
            margin-bottom:5px;
        }
    </style>