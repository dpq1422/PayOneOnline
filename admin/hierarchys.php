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
										Hierarchies
									</div>
									<div class="panel-body panel-primary text-center">
										<table class="table clsgrid rounded_corners" cellspacing="0" rules="all" border="1" id="ctl00_ContentPlaceHolder1_tagcost" style="width:100%;border-collapse:collapse;font-family:Calibri;font-weight:500;">
											<tbody>
												<tr class="gridheader" align="center" style="background-color:#009DE2;">
													<th>S.No.</th>
													<th>Hierarchy Name</th>
													<th>Team Share</th>
													<th>Registrations</th>
													<th>Status</th>
													<!--<th>Action</th>-->
												</tr>
									<?php 
										$query="SELECT * FROM child_hierarchy where hierarchy_id not in (0,1) and status=1 order by hierarchy_id asc";
										$result=mysql_query($query);
										$num_rows = mysql_num_rows($result);	
										if($num_rows>0)
										{									
											include '../functions/_hno_users.php';
											$i=0;
											//$userstatus="";
											while($rs = mysql_fetch_assoc($result)) {
											$i++;
											if($i%2!=0)
											$style="style='background-color:white;'";
											else
											$style="style='background-color:#e5e5e5;'";
											
											$hierarchyid=$rs['hierarchy_id'];
											$hno_users=show_hno_users($rs['hierarchy_id']);
											$hmodify="<a href='hierarchy-show.php?hierarchyid=$hierarchyid'>Show</a>";
											//$hmodify.=" / <a href='hierarchy-modify.php?hierarchyid=$hierarchyid'>Modify</a>";
											if($hno_users!="0")
											{
												$hstatus="<b style='color:green;'>Active<b>";
											}
											else
											{
												$hstatus="<b style='color:red;'>Not Active<b>";
												//$hmodify.=" / <a href='hierarchy-delete.php?hierarchyid=$hierarchyid'>Delete</a>";
											}
											if($hierarchyid==11)
											{
												$hmodify="<a href='hierarchy-show.php?hierarchyid=$hierarchyid'>Show</a>";
											}
									?>
												<tr <?php echo $style;?>>
													<td><?php echo $i;?></td>
													<td><?php echo $rs['hierarchy_name'];?></td>
													<td><?php if($rs['share_in_per']!=0) echo $rs['share_in_per']; else echo "Predefined as per service type, you can not update it here";?></td>
													<td><?php echo $hno_users;?></td>
													<td><?php echo $hstatus;?></td>
													<!--<td><?php echo $hmodify;?></td>-->
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
