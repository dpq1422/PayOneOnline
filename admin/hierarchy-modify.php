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
										Hierarchy Details
									</div>
									<div class="panel-body panel-primary text-center">
										<form action="hierarchy-modify-code.php" method="post">
											<?php
												$query1="SELECT * FROM child_hierarchy where hierarchy_id='".$_REQUEST['hierarchyid']."' and status=1";
												$result1=mysql_query($query1);
												$num_rows1 = mysql_num_rows($result1);
												if($num_rows1>0)
												{
													while($r1 = mysql_fetch_assoc($result1)) {
											?>
											<table>
												<tr>
													<td align="left">Hierarchy Name<br>
													<input <?php if($r1['hierarchy_id']==1) echo 'readonly'; ?> name="HierarchyName" value="<?php echo $r1['hierarchy_name'];?>" required size="30" />
													<input type="hidden" name="HierarchyId" value="<?php echo $r1['hierarchy_id'];?>" />
													</td>
													<td width="50"></td>
													<td align="left">Team Share<br>
													<input type="number" <?php if($r1['hierarchy_id']==1) echo 'readonly'; ?> name="TeamShare" value="<?php echo $r1['share_in_per'];?>" required size="30" />
													</td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td colspan="5" align="center"><input type="submit" value="Modify" /></td>
												</tr>
											</table>
											<?php
													}
												}
											?>
										</form>
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
