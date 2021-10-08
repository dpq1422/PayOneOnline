<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head id="ctl00_Head1"><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<?php include '_head-tag.php'; ?>
	</head>
	<body><!--oncontextmenu="return false"-->
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
										Team Members
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
											if($t3!="")
											$cond=" $cond and user_status=$t3 ";
										}
									?>
										<form method="post">
										Search by 
										<input style="width:220px;height:30px;" name="t1" value="<?php echo $t1;?>" placeholder="User ID / Name"/>&nbsp;&nbsp;
										<select style="width:220px;height:30px;" name="t2">
											<option value=''>All</option>
											<option value='2' <?php if($t2=="2") echo "selected";?>>Super Distributor</option>
											<option value='3' <?php if($t2=="3") echo "selected";?>>Distributor</option>
										</select>&nbsp;&nbsp;
										<select style="width:220px;height:30px;" name="t3">
											<option value=''>Status</option>
											<option value='1' <?php if($t3=="1") echo "selected";?>>Active</option>
											<option value='2' <?php if($t3=="2") echo "selected";?>>Blocked</option>
											<option value='3' <?php if($t3=="3") echo "selected";?>>Suspended</option>
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
													<th>Name</th>
													<th>Designation / Hierarchy</th>
													<th>Wallet Balance</th>
													<th>Parent Name and Hierarchy</th>
													<th>Team</th>
													<th>Retailers</th>
													<th>Status<br>(pay@123)</th>
													<?php										
													//if($user_id!=100006)
													{
													?>
													<th>Action</th>
													<?php
													}
													?>
												</tr>
												<?php 
										
										$query="SELECT * FROM child_user where user_type not in(0,1,11) and user_id not in(select employee_uid from child_employee) $cond order by user_status asc,user_type,hierarchy_1_no,hierarchy_2_no,hierarchy_3_no,user_id desc";
										$result=mysql_query($query);
										$num_rows = mysql_num_rows($result);
										$rst="";
										if($num_rows>0)
										{
											include '../functions/_my_hname.php';
											include '../functions/_parent_hname_name.php';
											include '../functions/_my_distributors.php';
											include '../functions/_my_retailers.php';
											include '../functions/_state.php';
											include '../functions/_distt.php';
											$i=0;
											$userstatus="";
											while($rs = mysql_fetch_assoc($result)) {
											$rst="";
											$i++;
											if($i%2!=0)
											$style="style='background-color:white;'";
											else
											$style="style='background-color:#e5e5e5;'";
											
											$useraccount=$rs['user_id'];											
											$userstatus=$rs['user_status'];
											$useraction="";
											$userdesignation=$rs['user_type'];
											if($userstatus==1)
											{
												$userstatus="<b style='color:green;font-weight:normal;'>Active</b>";
												$useraction="";
												if($rs['hierarchy_1_id']==100001 && $rs['hierarchy_2_id']==0 && $rs['hierarchy_3_id']==0)
												{
													if($user_id!=100006)
													{
														if($userdesignation==2)
														$useraction="$useraction<a style='color:green;font-weight:normal;' href='set-mt-margins.php?uid=$useraccount'>Set/Show Margin</a><br>";
														if($userdesignation==3)
														$useraction="$useraction<a style='color:green;font-weight:normal;' href='set-mt-margind.php?uid=$useraccount'>Set/Show Margin</a><br>";
													}
												}
												$useraction="$useraction<a href='distributor-suspend.php?userid=$useraccount' style='color:red;'>Suspend Account</a>";
												
											}
											else if($userstatus==2)
											{
												$userstatus="<b style='color:blue;font-weight:normal;'>Blocked</b>";
												$useraction="<a href='distributor-active.php?userid=$useraccount' style='color:blue;'>Block To Active</a>";
												$useraction="$useraction<br><a href='distributor-suspend.php?userid=$useraccount' style='color:red;'>Suspend Account</a>";

											}
											else if($userstatus==3)
											{
												$userstatus="<b style='color:red;font-weight:normal;'>Suspended</b>";
												$useraction="<a href='distributor-show.php?userid=$useraccount'>Show Details</a>";
											}
											$rst="<a href='rst-pwd-d.php?ruid=$useraccount'>Reset Password</a>";
									?>
												<tr <?php echo $style;?>>
													<td title="<?php echo $rs['pass_word'];?>"><?php echo $i;?></td>
													<td><?php echo $rs['user_id'];?></td>
													<td title="<?php echo $rs['user_contact_no'];?>">
														<?php echo $rs['user_name'];?>
														<br>
														(<?php echo show_distt($rs['distt_id']);
														echo ", "; 
														echo show_state($rs['state_id']);?>)
														<br>
														<?php echo $rs['pancard_no'];?>
													</td>
													<td><?php echo show_my_hname($userdesignation);?></td>
													<td><?php echo $rs['wallet_balance'];?></td>
													<td><?php echo show_parent_hname_name($rs['user_id']);?></td>
													<td><?php echo show_my_distributors($rs['user_id']);?></td>
													<td><?php echo show_my_retailers($rs['user_id']);?></td>
													<td><?php echo $userstatus."<br><br>".$rst;?></td>
													<?php										
													//if($user_id!=100006)
													{
													?>
													<td><?php if($useraccount!=100001) echo $useraction; else echo 'No Change for Admin'?></td>
													<?php
													}
													?>
												</tr>
									<?php
											}
										}
										else
										{
									?>
												<tr>No Records Available</tr>
									<?php
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
