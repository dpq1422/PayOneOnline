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
										KYC Status
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
													<th>Designation</th>
													<th>State</th>
													<th>Distt</th>
													<th>Parent Name and Hierarchy</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
									<?php 
										if($cond!="")
											$cond=" and (user_id='$cond' or user_name like '%$cond%') ";
										
										$field_name1="hierarchy_".$user_type."_no";
										$field_name2="hierarchy_".$user_type."_id";
										$query="SELECT * FROM child_user where (($field_name1=$user_type and $field_name2=$user_id) or (user_id=$user_id)) and user_status=1 $cond order by user_type asc,user_id desc";
										$result=mysql_query($query);
										$num_rows = mysql_num_rows($result);
										if($num_rows>0)
										{
											include '../functions/_parent_hname_name.php';
											include '../functions/_state.php';
											include '../functions/_distt.php';
											include '../functions/_my_hname.php';
											$i=0;
											$userstatus="";
											while($rs = mysql_fetch_assoc($result)) {
											$i++;
											if($i%2!=0)
											$style="style='background-color:white;'";
											else
											$style="style='background-color:#e5e5e5;'";
											
											$useraccount=$rs['user_id'];											
											$kycstatus=$rs['kyc_status'];
											$useraction="";
											$userdesignation=$rs['user_type'];
											if($kycstatus==0)
											{
												$kycstatus="Pending";
												$useraction="<a href='kyc-upload.php?kycuid=$useraccount'>Upload</a>";
											}
											else if($kycstatus==1)
											{
												$kycstatus="<b style='color:blue;'>Uploaded</b>";
												$useraction="<a href='kyc-reupload.php?kycuid=$useraccount'>Re-Upload</a>";
											}
											else if($kycstatus==2)
											{
												$kycstatus="<b style='color:green;'>Verified</b>";
												$useraction="<a href='kyc-reupload.php?kycuid=$useraccount'><b style='color:green;'>Re-Upload</b></a><br>(if any issue)";
											}
											else if($kycstatus==3)
											{
												$kycstatus="<b style='color:red;'>Rejected</b>";
												$useraction="<a href='kyc-reupload.php?kycuid=$useraccount'>Re-Upload</a>";
											}
									?>
												<tr <?php echo $style;?>>
													<td><?php echo $i;?></td>
													<td><?php echo $rs['user_id'];?></td>
													<td><?php echo $rs['user_name'];?></td>
													<td><?php echo show_my_hname($userdesignation);?></td>
													<td><?php echo show_state($rs['state_id']);?></td>
													<td><?php echo show_distt($rs['distt_id']);?></td>
													<td><?php echo show_parent_hname_name($rs['user_id']);?></td>
													<td><?php echo $kycstatus;?></td>
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
