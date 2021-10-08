<?php
if(!isset($_SESSION)) {
	session_start();
}
if(!isset($_SESSION['eml']))
	{
		echo "<script>window.location.href='login.php';</script>";
	}
	include("db-conn.php");
	$sess_eml=$_SESSION['eml'];
	$sess_type=$_SESSION['type'];
	$qry="select * from emp_data where e_mail='$sess_eml';";
	$result=mysql_query($qry);
	while($rs=mysql_fetch_array($result))
	{
		$sess_contact_no=$rs['contact_no'];
		$sess_zip_code=$rs['zip_code'];
		$sess_full_name=$rs['full_name'];
		$sess_gender=$rs['gender'];
		$sess_address=$rs['address'];
		$sess_city=$rs['city'];
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="google-site-verification" content="" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <!-- Title -->
    <title>Prepaid Mobile Recharge :: SigmaDeal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Description, Keywords -->
    <meta name="description" content="SigmaDeal is a B2C where people can come easily to make their mobile recharges and bill payments any time from anywhere./">
    <meta name="keywords" content="prepaid mobile recharge, post paid mobile bill payments, utility bill payments, gas bill payments, electricity bill payments, prepaid recharge online, online mobile recharge" />
    <meta name="author" content="SigmaDeal" />

    <!-- Google web fonts -->
    <link href='css/gcss1.css?family=Oswald:400,700' rel='stylesheet' type='text/css'>
    <link href='css/gcss2.css?family=PT+Sans:400,700,400italic' rel='stylesheet' type='text/css'>

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/select2.css" rel="stylesheet" />
    <link href="css/slider.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    <!--[if IE 7]>
  <link rel="stylesheet" href="css/font-awesome-ie7.css">
  <![endif]-->
    <link href="css/style.css" rel="stylesheet">
    <!-- Color Stylesheet - orange, blue, pink, brown, red or green-->
    <link href="css/orange.css" rel="stylesheet">


    <!-- HTML5 Support for IE -->
    <!--[if lt IE 9]>
  <script src="js/html5shim.js"></script>
  <![endif]-->

    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon/favicon.png">

    


    <!-- Google Tag Manager -->
	<!--
    <noscript>
        <iframe src="//www.googletagmanager.com/ns.html?id=GTM-NCLSRK"
            height="0" width="0" style="display: none; visibility: hidden"></iframe>
    </noscript>
    <script>(function (w, d, s, l, i) {
    w[l] = w[l] || []; w[l].push({
        'gtm.start':
        new Date().getTime(), event: 'gtm.js'
    }); var f = d.getElementsByTagName(s)[0],
    j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
    '//www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
})(window, document, 'script', 'dataLayer', 'GTM-NCLSRK');</script>
	-->
    <!-- End Google Tag Manager -->

</head>

<body>
    <form method="post" action="">

<script src="js/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="js/valid.js?d=x2nkrMJGXkMELz33nwnakPZqaV204dGU9mVRdVoLKm8zhKnyOHQEy8T8yj48wwZ25kH6Aee2_oW4OOynmTjAS4SOjsY1&amp;t=636233464529959633" type="text/javascript"></script>
<script type="text/javascript">
//<![CDATA[
function WebForm_OnSubmit() {
if (typeof(ValidatorOnSubmit) == "function" && ValidatorOnSubmit() == false) return false;
return true;
}
//]]>
</script>
        <!-- Header starts -->

        <?php include("header.php");?>

        <!-- Header ends -->

        <!-- Navigation Starts -->

        <!-- Note down the syntax before editing. It is the default twitter bootstrap navigation -->

        <?php include("menu.php");?>


        <!-- Navigation Ends -->

        <!-- Content strats -->
        
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Slider (Parallax Slider) -->
                    
                    <!-- Slider ends -->
					<p align="right">My Account: <?php echo $_SESSION['eml'];?></p>
                    <!-- Features list. Note down the class name before editing. -->
                    <div class="tabbable tabs-left">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs">
                            <!-- Navigation tabs (Job titles ). Use unique value in anchor tags. -->
                            <li class="active" style="background-image: none; padding: 0px;"><a href="#tab1" data-toggle="tab">My Profile</a></li>
							<?php 
							if($sess_type=="Admin")
							{
							echo '<li style="background-image: none; padding: 0px;"><a href="#tab6" data-toggle="tab">Create User</a></li>';
							}
							?>
                            <li style="background-image: none; padding: 0px;"><a href="#tab2" data-toggle="tab">Wallet History</a></li>
                            <li style="background-image: none; padding: 0px;"><a href="#tab3" data-toggle="tab">Transaction History </a></li>
							<li style="background-image: none; padding: 0px;"><a href="#tab4" data-toggle="tab">Complaints</a></li>
                            <li style="background-image: none; padding: 0px;"><a href="#tab5" data-toggle="tab">Change Password</a></li>
							<li style="background-image: none; padding: 0px;"><a href="logout.php" >Logout</a></li>
                        </ul>
                        <div class="tab-content">

                            <!-- In "id", use the value which you used in above anchor tags -->
                            <div class="tab-pane active" id="tab1">
                                <!-- Content -->
                                <div class="col-md-12 col-sm-12">
                                    <div class="cwell" style="padding-top: 10px;">
                                        <h5>My Profile</h5>
                                        <form method="post">
										<div class="form">
                                            <!-- Contact form (not working)-->
                                            <div class="form-horizontal form-horizontals">
                                                <!-- Name -->
												<div class="form-group">
                                                    <label class="control-label col-md-3" for="name">User Type </label>
                                                    <div class="col-md-9">
                                                        <input type="text" readonly class="form-control" id="user_typr" name="user_type" value="<?php echo $sess_type;?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3" for="name">E-mail </label>
                                                    <div class="col-md-9">
                                                        <input type="text" readonly class="form-control" id="e_mail" name="e_mail" value="<?php echo $_SESSION['eml'];?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3" for="name">Mobile Number </label>
                                                    <div class="col-md-9">
                                                        <input type="text" readonly class="form-control" id="mob_no" name="mob_no" value="<?php echo $sess_contact_no;?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3" for="name">PinCode </label>
                                                    <div class="col-md-9">
                                                        <input type="text" readonly class="form-control" id="pincode" name="pincode" value="<?php echo $sess_zip_code;?>">
                                                    </div>
                                                </div>
                                            </div>
											<div class="form-horizontal form-horizontals">
                                                <!-- Email -->
                                                <div class="form-group">
                                                    <label class="control-label col-md-3" for="name">Full Name</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $sess_full_name;?>">
                                                    </div>
                                                </div>
												<div class="form-group ">
                                                    <label class="control-label col-md-3" for="name">Gender</label>
                                                    <div class="col-md-9">
                                                        <select name="gender" id="gender" class="form-control">
															<option value="">Select</option>
															<option value="1" <?php if($sess_gender==1) echo " selected "; ?>>Male</option>
															<option value="2" <?php if($sess_gender==2) echo " selected "; ?>>Female</option>
															<option value="3" <?php if($sess_gender==3) echo " selected "; ?>>TransGender</option>
														</select>
                                                    </div>
                                                </div>                                                
                                                
												<div class="form-group">
                                                    <label class="control-label col-md-3" for="name">Address</label>
                                                    <div class="col-md-9">
                                                        <textarea rows="3" cols="50" class="form-control" id="address" name="address"><?php echo $sess_address;?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3" for="name">City</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="city" name="city" value="<?php echo $sess_city;?>">
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <!-- Buttons -->
                                                    <div class="col-md-9 col-md-offset-9">
														<div class="button" ><input type="submit" value="Update" name="update" id="update"/></div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										</form>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab2">
                                <div class="col-md-12 col-sm-12">
                                    <div class="cwell" style="padding-top: 10px;">
                                        <h5>Wallet History</h5>
										<form method="post">
											<input type="text" name="id" value="<?php if(isset($_POST['id'])){echo $_POST['id'];}?>"/><br><br>
											<input type="submit" value="Submit" name="wsubmit"><br><br>
										</form>
										<?php if(isset($_POST['wsubmit']))
										{
										$id=$_POST['id'];
										?>
                                        <table width="100%" class='mytable' cellpadding='0' cellspacing='0'>
											<tr>
												<th>Date</th>
												<th>Time</th>
												<th>Credit</th>
												<th>Debit</th>
												<th>Amount</th>
												<th>Description</th>
											</tr>
											<?php 
											$userid=$_POST['id'];
											include("db-conn.php");
											$qry="select * from wallet_data where user_id='$id' order by wallet_id desc limit 0,20;";
											$result=mysql_query($qry);
											while($rs=mysql_fetch_array($result))
											{
											?>
											<tr>
												<td><?php echo $rs['w_date'];?></td>
												<td><?php echo $rs['w_time'];?></td>
												<td><?php echo $rs['cr_amt'];?></td>
												<td><?php echo $rs['dr_amt'];?></td>
												<td><?php echo $rs['bal_amt'];?></td>
												<td><?php echo $rs['description'];?></td>
											</tr>
											<?php
											}
											?>
										</table>
										<?php
										}
										?>
                                    </div>
                                </div>
                            </div>
							<div class="tab-pane" id="tab3">
                                <!-- Content -->
                                <div class="col-md-12 col-sm-12">
                                    <div class="cwell" style="padding-top: 10px;">
                                        <h5>Transaction History</h5>
                                        <table width="100%" class='mytable' cellpadding='0' cellspacing='0'>
											<tr>
												<th>Order No.</th>
												<th>Order Date</th>
												<th>Amount</th>
												<th>Status</th>
												<th>User ID</th>
											</tr>
											<?php 
											include("db-conn.php");
											$qry="select * from txn_data order by txn_id desc limit 0,20;";
											$result=mysql_query($qry);
											while($rs=mysql_fetch_array($result))
											{
											$os=$rs['txn_status'];
											if ($os==100)
											$os='<b style="color:green;">Success</b>';
											else if ($os==200)
											$os='<b style="color:red;">Failed</b>';
											else
											$os='<b style="color:blue;">Pending</b><br><a href="update-txn-status-manual.php?txnid='.$rs['txn_id'].'">Update</a>';
											?>
											<tr>
												<td><?php echo $rs['txn_id'];?></td>
												<td><?php echo $rs['txn_date_time'];?></td>
												<td><?php echo $rs['amount'];?></td>
												<td><?php echo $os;?></td>
												<td><?php echo $rs['user_id'];?></td>
											</tr>
											<?php
											}
											?>
											
										</table>
                                    </div>
                                </div>
                            </div>
							<div class="tab-pane" id="tab4">
                                <!-- Content -->
                                <div class="col-md-12 col-sm-12">
                                    <div class="cwell" style="padding-top: 10px;">
                                        <h5>Complaint History</h5>
                                        <table width="100%" class='mytable' cellpadding='0' cellspacing='0'>
											<tr>
												<th>Complpaint Type</th>
												<th>Date & Time</th>
												<th>Transaction ID</th>
												<th>Complaint Description</th>
												<th>Office Reply</th>
												<th>Office Remarks</th>
												<th>Updated On</th>
												<th>Complaint Status</th>
												<th>User ID</th>
											</tr>
											<?php 
											include("db-conn.php");
											$qry="select * from complaint_data order by txn_id desc limit 0,20;";
											$result=mysql_query($qry);
											while($rs=mysql_fetch_array($result))
											{
											$abc=$rs['comp_status'];
											if($abc==1)
											{
												$abc='Closed';
											}
											else
											{
												$abc="Open <br><a href='update-complaint.php?cid=".$rs['complaint_id']."'>Reply</a>";
											}
											?>
											<tr>
												<td><?php echo $rs['comp_type'];?></td>
												<td><?php echo $rs['complaint_date_time'];?></td>
												<td><?php echo $rs['txn_id'];?></td>
												<td><?php echo $rs['user_remarks'];?></td>
												<td><?php echo $rs['office_reply'];?></td>
												<td><?php echo $rs['office_remarks'];?></td>
												<td><?php echo $rs['updated_on'];?></td>
												<td><?php echo $abc;?></td>
												<td><?php echo $rs['user_id'];?></td>
											</tr>
											<?php
											}
											?>
										</table>
                                    </div>
                                </div>
                            </div>
							<div class="tab-pane" id="tab5">
                                <!-- Content -->
                                <div class="col-md-12 col-sm-12">
                                    <div class="cwell" style="padding-top: 10px;">
                                        <h5>Change Password</h5>
                                        <div class="form">
                                            <!-- Contact form (not working)-->
                                            <div class="form-horizontal">
                                                <!-- Name -->
												<div class="form-group">
                                                    <label class="control-label col-md-3" for="name">E-mail </label>
                                                    <div class="col-md-9">
                                                        <input type="text" readonly class="form-control" id="mail" name="mail" value="<?php echo $_SESSION['eml'];?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3" for="name">Mobile Number </label>
                                                    <div class="col-md-9">
                                                        <input type="text" readonly class="form-control" id="mob_no" name="mob_no" value="<?php echo $sess_contact_no;?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3" for="name">Old Password<span class="reqrd">*</span></label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="old_pass" name="old_pass">
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label class="control-label col-md-3" for="name">New Password<span class="reqrd">*</span></label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="new_pass" name="new_pass">
                                                    </div>
                                                </div>
												<!-- Buttons -->
                                                <div class="form-group">
                                                    <!-- Buttons -->
                                                    <div class="col-md-9 col-md-offset-3">
                                                        <div class="button"><input type="submit" name="ch_pass" id="ch_pass" value="Change Password"/></div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<div class="tab-pane" id="tab6">
                                <div class="col-md-12 col-sm-12">
                                    <div class="cwell" style="padding-top: 10px;">
                                        <h5>User Registration</h5>
                                        <form method="post">
										<div class="form">
                                            <!-- Contact form (not working)-->
                                            <div class="form-horizontal form-horizontals">
                                                <!-- Email -->
                                                <div class="form-group">
                                                    <label class="control-label col-md-3" for="name">User Type<span class="reqrd">*</span></label>
                                                    <div class="col-md-9">
                                                        <select name="user_types" id="user_types" class="form-control">
															<option value="">Select</option>
															<option>Admin</option>
															<option>Employee</option>
														</select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3" for="name">E-mail <span class="reqrd">*</span></label>
                                                    <div class="col-md-9">
                                                        <input type="email" class="form-control" id="mail" name="mail">
                                                    </div>
                                                </div>
												<div class="form-group">
                                                    <label class="control-label col-md-3" for="name">Password <span class="reqrd">*</span></label>
                                                    <div class="col-md-9">
                                                        <input type="password" class="form-control" id="password" name="password">
                                                    </div>
                                                </div>
												
                                                <div class="form-group">
                                                    <label class="control-label col-md-3" for="name">Mobile Number <span class="reqrd">*</span></label>
                                                    <div class="col-md-9">
                                                        <input type="number" class="form-control" id="mob_no" name="mob_no">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3" for="name">PinCode <span class="reqrd">*</span></label>
                                                    <div class="col-md-9">
                                                        <input type="number" class="form-control" id="pincode" name="pincode">
                                                    </div>
                                                </div>
                                            </div>
											<div class="form-horizontal form-horizontals">
                                                <!-- Email -->
                                                <div class="form-group">
                                                    <label class="control-label col-md-3" for="name">Full Name</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="full_name" name="full_name">
                                                    </div>
                                                </div>
												<div class="form-group ">
                                                    <label class="control-label col-md-3" for="name">Gender</label>
                                                    <div class="col-md-9">
                                                        <select name="gender" id="gender" class="form-control">
															<option value="">Select</option>
															<option value="1">Male</option>
															<option value="2">Female</option>
															<option value="3">TransGender</option>
														</select>
                                                    </div>
                                                </div>                                                
                                                
												<div class="form-group">
                                                    <label class="control-label col-md-3" for="name">Address</label>
                                                    <div class="col-md-9">
                                                        <textarea rows="3" cols="50" class="form-control" id="address" name="address"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3" for="name">City</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="city" name="city">
                                                    </div>
                                                </div>
                                                
												
                                                <div class="form-group">
                                                    <!-- Buttons -->
                                                    <div class="col-md-9 col-md-offset-9">
														<div class="button" ><input type="submit" value="Register" name="register" id="register"/></div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										</form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Content ends -->

        <!-- Footer -->
        <?php include("footer.php");?>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>

        <script src="js/select2.js"></script>

        <script src="js/jquery.isotope.js"></script>
        <script src="js/jquery.prettyPhoto.js"></script>
        <script src="js/filter.js"></script>

        <script src="js/jquery.cslider.js"></script>
        <script src="js/modernizr.custom.28468.js"></script>
        <script src="js/custom.js"></script>
        <script type="text/javascript">
            ////$(document).ready(function () {
            //$(function () {
            //    $('#da-slider').cslider({
            //        autoplay: true,
            //        interval: 5000
            //    });

            //});
            ////});
        </script>

        
    <script>
        $(document).ready(function () {
            $(function () {
                $('#BodyContentPlaceHolder_ddlServiceProviders').select2({ placeholder: "Select Operator", allowClear: true });
            });
        });
        $(document).ready(function () {
            $(function () {
                $('#BodyContentPlaceHolder_ddlServiceProvidersDTH').select2({ placeholder: "Select Operator", allowClear: true });
            });
        });
    </script>

    </form>
</body>
</html>



<?php
if (isset($_POST['update']))
	{
		$e_mail=$_POST['e_mail'];
		$full_name=$_POST['full_name'];
		$gender=$_POST['gender'];
		$address=$_POST['address'];
		$city=$_POST['city'];
		include("db-conn.php");
		//$dateofbirth=$_POST['dateofbirth'];
		//$dateofbirth=date_format($dateofbirth,"Y-m-d");
		echo $qry="update emp_data set full_name='$full_name',gender='$gender',address='$address',city='$city' where e_mail='$e_mail';";
		mysql_query($qry);
		$result=mysql_affected_rows();
		echo "<script>window.location.href='user-account.php';</script>";
	}
if (isset($_POST['ch_pass']))
	{
		$oldpass=$_POST['old_pass'];
		$oldpass=md5($oldpass);
		$newpass=$_POST['new_pass'];
		$newpass=md5($newpass);
		$eml=$_SESSION['eml'];
		include("db-conn.php");
		//$dateofbirth=$_POST['dateofbirth'];
		//$dateofbirth=date_format($dateofbirth,"Y-m-d");
		echo $qry="update emp_data set pass_code='$newpass' where e_mail='$eml' and pass_code='$oldpass';";
		mysql_query($qry);
		$result=mysql_affected_rows();
		echo "<script>window.location.href='user-account.php';</script>";
	}
if (isset($_POST['comp']))
	{
		$e_mail=$_SESSION['eml'];
		$comptype=$_POST['ctype'];
		$txn_id=$_POST['trans_id'];
		$compdesc=$_POST['comp_desc'];
		include("db-conn.php");
		//$dateofbirth=$_POST['dateofbirth'];
		//$dateofbirth=date_format($dateofbirth,"Y-m-d");
		echo $qry="insert into complaint_data values (NULL,sysdate(),'$e_mail','$comptype','$txn_id','$compdesc','0','0',sysdate(),'0');";
		mysql_query($qry);
		$result=mysql_affected_rows();
		echo "<script>window.location.href='user-account.php';</script>";
		if($result>0)
		echo "Complaint Submitted";
		else
		echo "Some error occured, try later.";
	}
if (isset($_POST['register']))
	{
		$user_types=$_POST['user_types'];
		$mail=$_POST['mail'];
		$password=$_POST['password'];
		$full_name=$_POST['full_name'];
		$mob_no=$_POST['mob_no'];
		$gender=$_POST['gender'];
		$address=$_POST['address'];
		$city=$_POST['city'];
		$pincode=$_POST['pincode'];
		//$dateofbirth=$_POST['dateofbirth'];
		//$dateofbirth=date_format($dateofbirth,"Y-m-d");
		$user_status=1;
		$invalid_att=0;
		$e_verify=0;
		$m_verify=0;
		$reg_ip="192.168.1.1";
		$reg_browser="Chrome";
		include("db-conn.php");
		echo $qry="insert into emp_data value 
		(NULL,'$user_types','$mail',md5('$password'),'$full_name','$mob_no','$gender','$address','$city','$pincode',sysdate(),'$user_status','$invalid_att','$e_verify','$m_verify','$reg_ip','$reg_browser');";
		mysql_query($qry);
		die();
		$result=mysql_affected_rows();
		if ($result>0)
		{
		    $msg="Welcome $full_name,\r\n\r\nYour account is successfully created on http://payoneonline.in/demo\r\n\r\nHappy Recharge\r\n\r\nTeam PayOneOnline";
		    mail($mail,"Account registered on PayOneOnline.in",$msg);
			echo "<script>window.location.href='login.php?msg=done';</script>";
		}
		else
			echo "<script>window.location.href='login.php?msg=failed';</script>";
	}
?>