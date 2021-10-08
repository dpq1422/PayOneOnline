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
										Retailers
									</div>
									<div class="panel-body panel-primary text-left">
									<?php
										$cond="";
										$t1=$t2="";
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
											$cond=" $cond and user_status=$t2 ";
										}
									?>
										<form method="post">
										Search by 
										<input style="width:220px;height:30px;" name="t1" value="<?php echo $t1;?>" placeholder="User ID / Name"/>&nbsp;&nbsp;
										<select style="width:220px;height:30px;" name="t2">
											<option value=''>Status</option>
											<option value='1' <?php if($t2=="1") echo "selected";?>>Active</option>
											<option value='2' <?php if($t2=="2") echo "selected";?>>Blocked</option>
											<option value='3' <?php if($t2=="3") echo "selected";?>>Suspended</option>
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
													<th>Name<br>Location</th>
													<th>Software<br>(Received)</th>
													<th>Security<br>(Received)</th>
													<th>Wallet Balance</th>
													<th>Parent Name and Hierarchy</th>
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
										
										$query="SELECT * FROM child_user where user_type=11 $cond order by user_status asc,hierarchy_1_no,hierarchy_2_no,hierarchy_3_no,user_id desc";
										$result=mysql_query($query);
										$num_rows = mysql_num_rows($result);
										$rst="";
										if($num_rows>0)
										{
											include '../functions/_parent_hname_name.php';
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
												if($user_id!=100006)
												{
													if($rs['hierarchy_1_id']==100001 && $rs['hierarchy_2_id']==0 && $rs['hierarchy_3_id']==0)
													$useraction="$useraction<a style='color:green;font-weight:normal;' href='set-mt-marginr.php?uid=$useraccount'>Set/Show Margin</a><br>";
												}
												$useraction="$useraction<a href='retailer-suspend.php?userid=$useraccount' style='color:red;'>Suspend Account</a>";
											}
											else if($userstatus==2)
											{
												$userstatus="<b style='color:blue;font-weight:normal;'>Blocked";
												$useraction="<a href='retailer-active.php?userid=$useraccount' style='color:blue;'>Block To Active</a>
												<br><a href='retailer-suspend.php?userid=$useraccount' style='color:red;'>Suspend Account</a>";
											}
											else if($userstatus==3)
											{
												$userstatus="<b style='color:red;font-weight:normal;'>Suspended</b>";
												$useraction="<a href='retailer-show.php?userid=$useraccount'>Show Details</a>";
											}
											$query2="SELECT hierarchy_name FROM child_hierarchy where hierarchy_id='$userdesignation' and status=1";
											$result2=mysql_query($query2);
											while($rs2 = mysql_fetch_assoc($result2)) {
												$userdesignation=$rs2['hierarchy_name'];
											}
											$reg_amt=$rs['reg_amount'];
											if($reg_amt!=0 && $rs['reg_amount']==$rs['regc_amount'])
												$reg_amt="<b style='color:green;'>".$rs['reg_amount']."<br>(".$rs['regc_amount'].")</b>";
											else if($reg_amt!=0 && $rs['reg_amount']!=$rs['regc_amount'])
												$reg_amt="".$rs['reg_amount']."<br>(".$rs['regc_amount'].")";
											else
												$reg_amt="-";
											$sec_amt=$rs['sec_amount'];
											if($sec_amt!=0 && $rs['sec_amount']==$rs['secc_amount'])
												$sec_amt="<b style='color:green;'>".$rs['sec_amount']."<br>(".$rs['secc_amount'].")</b>";
											else if($sec_amt!=0 && $rs['sec_amount']!=$rs['secc_amount'])
												$sec_amt="".$rs['sec_amount']."<br>(".$rs['secc_amount'].")";
											else
												$sec_amt="-";
											$rst="<a href='rst-pwd-r.php?ruid=$useraccount'>Reset Password</a>";
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
													<td><?php echo $reg_amt;?></td>
													<td><?php echo $sec_amt;?></td>
													<td><?php echo $rs['wallet_balance'];?></td>
													<td><?php echo show_parent_hname_name($rs['user_id']);?></td>
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
