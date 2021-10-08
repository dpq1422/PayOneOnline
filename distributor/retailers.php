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
										<input size="60" name="t1" required value="<?php echo $cond;?>" placeholder="User ID / Name"/>
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
													<th>Mobile</th>
													<th>Location</th>
													<th>Software Amount</th>
													<th>Security Amount</th>
													<th>Wallet balance</th>
													<th>Parent Name and Hierarchy</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
									<?php 
										if($cond!="")
											$cond=" and (user_id='$cond' or user_name like '%$cond%') ";
										
		$field_name1="hierarchy_".$user_type."_no";
		$field_name2="hierarchy_".$user_type."_id";
		$query="SELECT * FROM child_user where $field_name1=$user_type and $field_name2=$user_id and user_type=11 $cond order by user_status asc,hierarchy_1_no,hierarchy_2_no,hierarchy_3_no,user_type";
		$result=mysql_query($query);
		$num_rows = mysql_num_rows($result);
		if($num_rows>0)
		{
			include '../functions/_parent_hname_name.php';
			include '../functions/_state.php';
			include '../functions/_distt.php';
			$i=0;
			$userstatus="";
			while($rs = mysql_fetch_assoc($result)) {
			$i++;
			if($i%2!=0)
			$style="style='background-color:white;'";
			else
			$style="style='background-color:#e5e5e5;'";
			
			$useraccount=$rs['user_id'];											
			$userstatus=$rs['user_status'];
			$useraction="";
			$userdesignation=$rs['user_type'];
			$useraction="$useraction<br><a href='retailer-active.php?userid=$useraccount' style='color:blue;'>Block To Active</a>";
			if($userstatus==1)
			{
				$userstatus="<b style='color:green;font-weight:normal;'>Active</b>";
				$useraction="";
				if(($user_type==2 && $rs['hierarchy_1_id']==100001 && $rs['hierarchy_2_id']==$user_id && $rs['hierarchy_3_id']==0) || ($user_type==3 && $rs['hierarchy_1_id']==100001 && $rs['hierarchy_3_id']==$user_id))
				{
					if($user_type==2)
					$useraction="$useraction<a style='color:green;font-weight:normal;' href='set-mt-marginr.php?uid=$useraccount'>Set/Show Margin</a><br>";
					else if($user_type==3)
					$useraction="$useraction<a style='color:green;font-weight:normal;' href='set-mt-margin.php?uid=$useraccount'>Set/Show Margin</a><br>";
					//$useraction="$useraction<a style='color:blue;font-weight:normal;' href='retailer-edit.php?uid=$useraccount'>Edit Retailer</a><br>";
				}
				if($userdesignation==1)
				$useraction="$useraction<a href='retailer-suspend.php?userid=$useraccount' style='color:red;'>Suspend Account</a>";
			}
			else if($userstatus==2)
			{
				$userstatus="<b style='color:blue;font-weight:normal;'>Blocked</b>";
				//$useraction="<a href=''>Modify Details</a>";
				if($userdesignation==1)
				{
					$useraction="$useraction<br><a href='retailer-suspend.php?userid=$useraccount' style='color:red;'>Suspend Account</a>";
				}
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
			
			$rets_id=$rs['user_id'];
			$uid_eof=0;
			$uid_name=$rs['user_id'];
			$qry_eof="select * from child_employee_retailer where retailer_uid='$rets_id'";
			$res_eof=mysql_query($qry_eof);
			while($rs_eof = mysql_fetch_assoc($res_eof)) 
			{
				$uid_eof=$rs_eof['under_uid'];
			}
			$qry_eof="select * from child_user where user_id='$uid_eof'";
			$res_eof=mysql_query($qry_eof);
			while($rs_eof = mysql_fetch_assoc($res_eof)) 
			{
				$uid_name=$rs_eof['user_name'];
			}
			$uid_name="$uid_name<br>($uid_eof - EMPLOYEE)";
			
			if($uid_eof==0)
			{
				$uid_name=show_parent_hname_name($rs['user_id']);
			}
									?>
												<tr <?php echo $style;?>>
													<td><?php echo $i;?></td>
													<td><?php echo $rs['user_id'];?></td>
													<td><?php echo $rs['user_name'];?></td>
													<td><?php echo $rs['user_contact_no'];?></td>
													<td>
														<?php echo show_distt($rs['distt_id']);?>
														<br>
														<?php echo show_state($rs['state_id']);?>
													</td>
													<td><?php echo $rs['reg_amount'];?></td>
													<td><?php echo $rs['sec_amount'];?></td>
													<td><?php echo $rs['wallet_balance'];?></td>
													<td><?php echo $uid_name;?></td>
													<td><?php echo $userstatus;?></td>
													<td><?php if($useraccount!=100001) echo $useraction; else echo 'No Change for Admin'?></td>
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
