<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php include('_head-tag.php'); ?>
</head>
<body class="cyan-scheme">
<div id="form1">

    <!--Page load animation-->
 
    <div class="wrapper vertical-sidebar" id="full-page">
        <?php include('_nav-menu.php'); ?>

        <main id="content">
            <div id="page-content">

                
      <div class="row content-container elements">
        <div class="col s8 m8 l8 socialMessage">
            <div class="messageBox">
                <div class="card ">
                    <div class="card-content">
                        <h5><i class="fa fa-street-view fa-1x"></i> My Profile</h5><br><a href="change-password.php" class="waves-effect waves-light btn white-text green margin-bottom-10 ladda-button">Change Password</a>
                    </div>
                    <div class="card-action">

                        <div class="row">

                            <div class="col l12 m12 s12 pad-10" id="oneStep">
                                <div class="">
                                    <div id="theProfile" class="collection margin">  
										<?php
										$msg="";
										if(isset($_REQUEST['msg']))
										$msg=$_REQUEST['msg'];
										
										if($msg!="")
										{
											$field_value="";											
											$field_name="";											
											$field_type="text";
											if($msg==1)
											{
												$field_name="business_name";
												$field_value="Business Name";
											}
											else if($msg==2)
											{
												$field_name="date_of_birth";
												$field_value="Date of Birth";
												$field_type="date";
											}
											else if($msg==3)
											{
												$field_name="pancard_no";
												$field_value="Pancard No";
											}
											else if($msg==4)
											{
												$field_name="bank";
												$field_value="Bank Name";
											}
											else if($msg==5)
											{
												$field_name="account";
												$field_value="Account Number";
											}
											else if($msg==6)
											{
												$field_name="ifsc";
												$field_value="IFCS Code";
											}
											else if($msg==7)
											{
												$field_name="aadhar_no";
												$field_value="Aadhar Number";
											}
											else if($msg==8)
											{
												$field_name="business_address";
												$field_value="Business Address";
											}
											else if($msg==9)
											{
												$field_name="gst";
												$field_value="GST Number";
											}
											else if($msg==10)
											{
												$field_name="business_logo";
												$field_value="Business Logo";
												$field_type="file";
											}
											if($msg!=10)
											{
										?>
											<form action="my-profile-code.php" method="post">
												<table class='responsive-table striped table-bordered'>
													<tr>
														<td class='text-right'><?php echo $field_value;?></td>
														<td class=''>
															<input type="<?php echo $field_type;?>" value="" name="field_value" required/>
															<input type="hidden" value="<?php echo $field_name;?>" name="field_name" required/>
														</td>
														<td class=''>
															<input type="submit" value="Update" name="submit"/>
														</td>
													</tr>
												</table>
											</form>
										<?php
											}
											else if($msg==10)
											{
										?>
											<form action="my-profile-code.php" method="post" enctype="multipart/form-data">
												<table class='responsive-table striped table-bordered'>
													<tr>
														<td class='text-right'><?php echo $field_value;?></td>
														<td class=''>
															<input type="<?php echo $field_type;?>" value="" name="field_value" required/>
															<input type="hidden" value="<?php echo $field_name;?>" name="field_name" required/>
														</td>
														<td class=''>
															<input type="submit" value="Update" name="submit2"/>
														</td>
													</tr>
												</table>
											</form>
										<?php
											}
										}
										else
										{
										?>
										<table class='responsive-table striped table-bordered'>
											<?php
											$qry="select * from child_user where user_id=$user_id;";
											$res=mysql_query($qry);
											while($rs=mysql_fetch_assoc($res))
											{
												$dt=date_create($rs['join_date']);
												$aadhar=$rs['aadhar_no'];
												$business=$rs['business_name'];
												$dob=$rs['date_of_birth'];
												$pan=$rs['pancard_no'];
												$bank=$rs['bank'];
												$acc=$rs['account'];
												$ifsc=$rs['ifsc'];												
												$kyc=$rs['kyc_status'];
												$busiaddr=$rs['business_address'];
												$gst=$rs['gst'];
												$busilogo=$rs['business_logo'];
												
												
												if($kyc==0 || $kyc==4)
												$kyc="<b style='color:red;'>KYC - PENDING (Documents Not Received)</b>";
												else if($kyc==1 || $kyc==2)
												$kyc="<b style='color:orange;'>KYC - IN PROGRESS (Verification In-Progress)</b>";
												else if($kyc==3)
												$kyc="<b style='color:green;'>KYC - VERIFIED</b>";
											?>
											<tbody> 
												<tr>
													<th class='text-right' colspan='2'>USER DETAILS:</th>
												</tr>
												<tr>
													<td class='text-right'>My ID:</td>
													<td class=''><?php echo $user_id;?></td>
												</tr>
												<tr>
													<td class='text-right'>My Role</td>
													<td class=''>Retailer</td>
												</tr>
												<tr>
													<td class='text-right'>Mobile Number:</td>
													<td class=''><?php echo $rs['user_contact_no'];?></td>
												</tr>
												<tr>
													<td class='col-xs-6text-right'>KYC Status</td>
													<td class='col-xs-6'><?php echo $kyc;?></td>
												</tr>
												<tr>
													<td class='col-xs-6text-right'>Member since: </td>
													<td class='col-xs-6'><?php echo date_format($dt,"d-M-Y");?></td>
												</tr>
												<tr height='50'>
												</tr>
												<tr>
													<th class='text-right' colspan='2'>PERSONAL DETAILS:
														<?php
														if($kyc!="<b style='color:green;'>KYC - VERIFIED</b>")
														{
														?>
														<a href="upload-kyc.php" class="right">Upload KYC</a>
														<?php
														}
														?>
													</th>
												</tr>
												<tr>
													<td class='text-right'>Full Name</td>
													<td class=''><?php echo $rs['user_name'];?></td>
												</tr>
												<tr>
													<td class='col-xs-6text-right'>Aadhar No.</td>
													<td class='col-xs-6'><?php if($aadhar==""){echo "<a href='my-profile.php?msg=7'>Fill Details</a>";} else {echo $rs['aadhar_no'];}?></td>
												</tr>
												<tr>
													<td class='text-right'>Date of Birth:</td>
													<td class=''><?php if($dob==""){echo "<a href='my-profile.php?msg=2'>Fill Details</a>";} else {echo $rs['date_of_birth'];}?></td>
												</tr>
												<tr>
													<td class='col-xs-6text-right'>PAN:</td>
													<td class='col-xs-6'><?php if($pan==""){echo "<a href='my-profile.php?msg=3'>Fill Details</a>";} else {echo $rs['pancard_no'];}?></td>
												</tr>
												<tr>
													<td class='col-xs-6text-right'>Bank Name</td>
													<td class='col-xs-6'><?php if($bank==""){echo "<a href='my-profile.php?msg=4'>Fill Details</a>";} else {echo $rs['bank'];}?></td>
												</tr>
												<tr>
													<td class='col-xs-6text-right'>Account Number</td>
													<td class='col-xs-6'><?php if($acc==""){echo "<a href='my-profile.php?msg=5'>Fill Details</a>";} else {echo $rs['account'];}?></td>
												</tr>
												<tr>
													<td class='col-xs-6text-right'>IFSC Code</td>
													<td class='col-xs-6'><?php if($ifsc==""){echo "<a href='my-profile.php?msg=6'>Fill Details</a>";} else {echo $rs['ifsc'];}?></td>
												</tr>
												<tr height='50'>
												</tr>
												<?php
												$status_verified="";
												if($rs['logo_verified']==0)
												{
													$status_verified="<b style='color:red;text-align:right;'>Not Verified</b>";
												}
												else
												{
													$status_verified="<b style='color:green;text-align:right;'>Verified</b>";
												}
												?>
												<tr>
													<th class='text-right'>BUSINESS DETAILS</th>
													<th><?php echo $status_verified;?></th>
												</tr>
												<tr>
													<td class='text-right'>Business Name</td>
													<td class=''><?php if($business==""){echo "<a href='my-profile.php?msg=1'>Fill Details</a>";} else {echo $rs['business_name'];}?></td>
												</tr>
												<tr>
													<td class='text-right'>Business Address</td>
													<td class=''><?php if($busiaddr==""){echo "<a href='my-profile.php?msg=8'>Fill Details</a>";} else {echo $rs['business_address'];}?></td>
												</tr>
												<tr>
													<td class='text-right'>GST No.</td>
													<td class=''><?php if($gst==""){echo "<a href='my-profile.php?msg=9'>Fill Details</a>";} else {echo $rs['gst'];}?></td>
												</tr>
												<tr>
													<td class='text-right'>Business Logo</td>
													<td class=''>
													<?php 
													if($busilogo=="")
													{
														echo "<a href='my-profile.php?msg=10'>Upload Logo</a>";
													} 
													else 
													{
														echo "<img height='80' src='".$rs['business_logo']."'/>";
													}
													?>
													</td>
												</tr>
											</tbody>
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

                       
                        </div>


                    </div>
                </div>
            </div>
        </div>

      
    </div>





            </div>
        </main>
    
        <?php include('_footer.php');?>
    </div>
    <script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
			
			<script src="../js/spin.js"></script>
			<script src="../js/ladda.js"></script>
			<script src="../js/ladda.jquery.js"></script>
			

			<script type="text/javascript" src="../js/materialize.js"></script>

			<script type="text/javascript" src="../js/prism.min.js"></script>
			<script type="text/javascript" src="../js/mara.min.js"></script>
			<script src="../js/sweetalert2.min.js"></script>
			<script src="../js/site.js"></script>
			<script type="text/javascript" src="../js/chosen.jquery.min.js"></script>
			<script>
				$(".chosen").chosen();
			</script>

			<script>
				jQuery.fn.ForceNumericOnly =
			function () {
				return this.each(function () {
					$(this).keydown(function (e) {
						var key = e.charCode || e.keyCode || 0;
						// allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
						// home, end, period, and numpad decimal
						return (
							key == 8 ||
							key == 9 ||
							key == 13 ||
							key == 46 ||
							key == 110 ||
							key == 190 ||
							(key >= 35 && key <= 40) ||
							(key >= 48 && key <= 57) ||
							(key >= 96 && key <= 105));
					});
				});
			};


				$(".numericOnlyText").ForceNumericOnly();



				function setactiveClass(id) {

					$(".myMenu li a").removeClass('active');

					$("#" + id).addClass('active');
					$("#" + id).parent().addClass('active');

				}
			</script>
    

    <script>
        setactiveClass('prof');
    </script>


    
</div>
</body>
</html>
