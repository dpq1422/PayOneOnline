<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head id="ctl00_Head1"><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<?php include '_head-tag.php'; ?>
		<?php include_once '_update_all_wallets.php'; ?>
	</head>
	<body>
		<div class="container-fluid">
			<div class="col-md-12">
				<div class="col-sm-12 col-md-12 col-xs-12 col-comn" style="box-shadow: 0 0 3px #c9c9c9;
					padding: 0px">
					<?php include '../_logged-user-info.php'; ?>
					<?php include '_nav-menu.php'; ?>
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-12">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Wallet Status
									</div>
									<div class="panel-body panel-primary text-left">
									<?php
										$t1=$t2=$t3=$cond="";
										
										if(isset($_POST['t1']))
										{
											$t1=$_POST['t1'];
											if($t1!="")
											$cond=" $cond and (user_id='$t1' or user_name like '%$t1%') ";
										}
										if(isset($_POST['t2']))
										{
											$t2=$_POST['t2'];
											if($t2!="")
											$cond=" $cond and user_type=$t2 ";
										}
										if(isset($_POST['t3']))
										{
											$t3=$_POST['t3'];
											if($t3!="-1")
											$cond=" $cond and kyc_status='$t3' ";
										}
									?>
										<form method="post">
										Search by 
										<input style="width:220px;height:30px;" name="t1" value="<?php echo $t1;?>" placeholder="User ID / Name"/>&nbsp;&nbsp;
										<select style="width:220px;height:30px;" name="t2">
											<option value=''>Designation</option>
											<option value='2' <?php if($t2=="2") echo "selected";?>>Super Distributor</option>
											<option value='3' <?php if($t2=="3") echo "selected";?>>Distributor</option>
											<option value='11' <?php if($t2=="11") echo "selected";?>>Retailer</option>
										</select>&nbsp;&nbsp;
										<select style="width:220px;height:30px;" name="t3">
											<option value='-1'>KYC Status</option>
											<option value='0' <?php if($t3=="0") echo "selected";?>>Pending</option>
											<option value='1' <?php if($t3=="1") echo "selected";?>>Uploaded</option>
											<option value='2' <?php if($t3=="2") echo "selected";?>>Re-Uploaded</option>
											<option value='3' <?php if($t3=="3") echo "selected";?>>Verified</option>
											<option value='4' <?php if($t3=="4") echo "selected";?>>Rejected</option>
										</select>&nbsp;&nbsp;
										<input type="submit" value="Search" />
										</form>
									</div>
									<div class="panel-body panel-primary text-center">
										<table class="table clsgrid rounded_corners" cellspacing="0" rules="all" border="1" id="ctl00_ContentPlaceHolder1_tagcost" style="width:100%;border-collapse:collapse;font-family:Calibri;font-weight:500;">
											<tbody>
												<tr class="gridheader" align="center" style="background-color:#009DE2;">
													<th>S.No.</th>
													<th>User ID</th>
													<th>User Name</th>
													<th>User Designation</th>
													<th>Parent Name<br>(Parent Designation)</th>
													<th>KYC Status</th>
													<th>Current Wallet Balance</th>
												</tr>
									<?php 
										//if($cond!="")
											//$cond=" and (user_id='$cond' or user_name like '%$cond%') ";
										
										$query="SELECT * FROM child_user where user_type not in(0,1) and user_status=1 $cond order by wallet_balance desc,user_id desc";
										$result=mysql_query($query);
										$num_rows = mysql_num_rows($result);
										if($num_rows>0)
										{
											include_once '../functions/_my_hname.php';
											include_once '../functions/_parent_hname_name.php';
											include_once '../functions/_wallet_balance.php';
											include_once '../functions/_my_umobile.php';
											$i=0;
											$userstatus="";
											while($rs = mysql_fetch_assoc($result)) {
											$i++;
											if($i%2!=0)
											$style="style='background-color:white;'";
											else
											$style="style='background-color:#e5e5e5;'";
											
											$uwb=$rs['wallet_balance'];
											$wwb=wallet_balance($rs['user_id']);
											$rwb="";
											if($uwb==$wwb)
											$rwb="<b style='color:green;'>$wwb</b>";
											else
											$rwb="<b style='color:red;'>W: $wwb / U: $uwb</b>";
										
											$max_uid=$rs['user_id'];
											$max_user=0;
											$max_qry="SELECT count(*) nums FROM child_wallet_remain where user_id=$max_uid";
											$max_res=mysql_query($max_qry);
											while($max_rs = mysql_fetch_assoc($max_res)) {
												$max_user=$max_rs['nums']-1;
											}
											
											if($max_user==0)
											$rwb=$rwb." <b>( In-active )</b>";
											else
											$rwb=$rwb;
										
							$hname=show_my_hname($rs['user_type']);
							if($rs['user_type']==2)
							$hname="<b style='color:blue;'>".show_my_hname($rs['user_type'])."</b>";
							else if($rs['user_type']==3)
							$hname="<b style='color:#cc5801;'>".show_my_hname($rs['user_type'])."</b>";
							else if($rs['user_type']==11)
							$hname="<b style='color:green;'>".show_my_hname($rs['user_type'])."</b>";
						
											$kyc_status=$rs['kyc_status'];
											if($kyc_status==0)
												$kyc_status="<b style='color:blue;'>Pending</b>";
											else if($kyc_status==1)
												$kyc_status="<b style='color:#cc5801;'>Uploaded</b>";
											else if($kyc_status==2)
												$kyc_status="<b style='color:#cc5801;'>Re-Uploaded</b>";
											else if($kyc_status==3)
												$kyc_status="<b style='color:green;'>Verified</b>";
											else if($kyc_status==4)
												$kyc_status="<b style='color:red;'>Rejected</b>";
									?>
												<tr <?php echo $style;?>>
													<td><?php echo $i;?></td>
													<td><?php echo $rs['user_id'];?></td>
													<td><?php echo $rs['user_name']." - ".show_my_umobile($rs['user_id'])."<br>".$rs['join_date'];?></td>
													<td><?php echo $hname;?></td>
													<td><?php echo show_parent_hname_name($rs['user_id']);?></td>
													<td><?php echo $kyc_status;?></td>
													<td><?php echo $rwb;?></td>
												</tr>
									<?php
											}
										}
									?>
											</tbody>
									</table>
									</div>
									<div class="panel-body panel-primary text-right">
										<a href="#"><<</a> Page <b>1</b> of 20 <a href="#">>></a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php include '_footer.php'; ?>
				</div>
			</div>
		</div>
	</body>
</html>
