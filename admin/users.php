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
										Users
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
													<!--<th>Department</th>-->
													<th>Status</th>
													<th>Action</th>
												</tr>
									<?php 
										if($cond!="")
											$cond=" and (user_id='$cond' or user_name like '%$cond%') ";
										
										$query="SELECT * FROM child_user where user_type in(0,1) $cond and user_id not in(select employee_uid from child_employee) and user_id not in(100000,100001,100005) order by user_status asc,user_id desc";
										$result=mysql_query($query);
										$num_rows = mysql_num_rows($result);
										if($num_rows>0)
										{
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
											$usrtp=$rs['user_type'];
											$useraction="";
											if($userstatus==1 || $userstatus==4)
											{
												$userstatus="Active";
												if($usrtp==0)
												$useraction="<a href='user-suspend.php?userid=$useraccount' style='color:red;'>Suspend Account</a>
												<br><a href='user-login-details.php?userid=$useraccount'>Show Login/Logout Details</a>";
												/*
												<a href='#user-modify.php?userid=$useraccount'>Modify Details</a>
												<br>
												*/												
											}
											else if($userstatus==2)
											{
												$userstatus="Blocked";
												if($usrtp==0)
												$useraction="<a href='user-active.php?userid=$useraccount' style='color:blue;'>Block To Active</a>
												<br><a href='user-suspend.php?userid=$useraccount' style='color:red;'>Suspend Account</a>
												<br><a href='user-login-details.php?userid=$useraccount'>Show Login/Logout Details</a>";
												/*
												<a href='#user-modify.php?userid=$useraccount'>Modify Details</a>
												<br>
												*/
											}
											else if($userstatus==3)
											{
												$userstatus="Suspended";
												if($usrtp==0)
												$useraction="<a href='user-show.php?userid=$useraccount'>Show Details</a>
												<br><a href='user-login-details.php?userid=$useraccount'>Show Login/Logout Details</a>";
											}
											if($usrtp==1)
											{
												$useraction=$useraction."<a href='user-login-details.php?userid=$useraccount'>Show Login/Logout Details</a>";
											}
											$rst="";
											//$rst="<a href='rst-pwd-u.php?ruid=$useraccount'>Reset Password</a>";
											
									?>
												<tr <?php echo $style;?>>
													<td><?php echo $i;?></td>
													<td><?php echo $rs['user_id'];?></td>
													<td><?php echo $rs['user_name'];?></td>
													<!--<td><?php echo $rs['departments'];?></td>-->
													<td><?php echo $userstatus."<br><br>".$rst;?></td>
													<td><?php echo $useraction;?></td>
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
