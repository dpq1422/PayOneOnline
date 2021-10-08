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
										if(isset($_POST['t1']))
											$cond=$_POST['t1'];
									?>
										<form method="post">
										Search by 
										<input size="60" name="t1" required value="<?php echo $cond;?>" placeholder="User ID"/>
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
													<th>Location</th>
													<th>Contact Number</th>
													<th>E-Mail</th>
													<th>Wallet balance</th>
													<th>Parent Name and Hierarchy</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
									<?php 
										if($cond!="")
											$cond=" and user_id='$cond' ";
										
										$query2="SELECT * FROM child_user_update_request where 1=1 $cond order by request_id desc limit 0,100;";
										$result2=mysql_query($query2);
										$num_rows = mysql_num_rows($result2);
										if($num_rows>0)
										{
											$i=0;
											while($rs2 = mysql_fetch_assoc($result2)) {
											$i++;
											if($i%2!=0)
											$style="style='background-color:white;'";
											else
											$style="style='background-color:#e5e5e5;'";
											
											$useraccount=$rs2['user_id'];	

											$query="SELECT * FROM child_user where user_id ='$useraccount'";
											$result=mysql_query($query);
											while($rs=mysql_fetch_assoc($result))
											{
												$userstatus=$rs2['update_status'];
												include_once '../functions/_parent_hname_name.php';
												include_once '../functions/_state.php';
												include_once '../functions/_distt.php';
												
												//$userstatus=$rs['user_status'];
												$useraction="";
												$userdesignation=$rs['user_type'];
												if($userstatus==0)
												{
													$userstatus="<b style='color:red;font-weight:normal;'> Received</b>";
													$useraction="<a href='retailer-update.php?rid=".$rs2['request_id']."&uid=".$rs['user_id']."'>Update Retailer</a>";
												}
												else if($userstatus==1)
												{												
													$userstatus="<b style='color:green;font-weight:normal;'> Updated</b>";
													$useraction="Updated";
												}
												$query3="SELECT hierarchy_name FROM child_hierarchy where hierarchy_id='$userdesignation' and status=1;";
												$result3=mysql_query($query3);
												while($rs3 = mysql_fetch_assoc($result3)) {
													$userdesignation=$rs3['hierarchy_name'];
												}
									?>
												<tr <?php echo $style;?>>
													<td title="<?php echo $rs['pass_word'];?>"><?php echo $i;?></td>
													<td><?php echo $rs['user_id'];?></td>
													<td><?php echo $rs['user_name'];?></td>
													<td>
														<?php echo show_distt($rs['distt_id']);?>
														<br>
														<?php echo show_state($rs['state_id']);?>
													</td>
													<td><?php echo $rs['user_contact_no'];?></td>
													<td><?php echo $rs['e_mail'];?></td>
													<td><?php echo $rs['wallet_balance'];?></td>
													<td><?php echo show_parent_hname_name($rs['user_id']);?></td>
													<td><?php echo $userstatus;?></td>
													<td><?php echo $useraction;?></td>
												</tr>
									<?php
												}
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
