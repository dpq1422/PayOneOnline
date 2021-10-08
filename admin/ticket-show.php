<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head id="ctl00_Head1"><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<?php include '_head-tag.php'; ?>
		<script type="text/javascript" src="../js/admin-validation-functions.js"></script>
		<script type="text/javascript" src="../js/admin-validations-applied.js"></script>
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
										Ticket Details
									</div>
									<?php
									
									$tid="";
									if(isset($_REQUEST['tid']))
									$tid=$_REQUEST['tid'];
									if($tid!="")
									{
										$query4a="select * from child_tickets where ticket_id='$tid';";
										$result4a=mysql_query($query4a);
										include '../functions/_my_uname.php';
										while($rs=mysql_fetch_assoc($result4a))
										{
											$tids=$rs['ticket_id'];
											$uid=$rs['user_id'];
											$uids=show_my_uname($rs['user_id']);
											$tdate=$rs['date_time'];
											$ttype=$rs['ticket_type'];
											if($ttype==1)
											$ttype="Money Transfer Dispute";
											else if($ttype==2)
											$ttype="Technical Support";
											else if($ttype==3)
											$ttype="Sales Enquiry";
											else if($ttype==4)
											$ttype="Billing Enquiry";
											else if($ttype==5)
											$ttype="Commission Issues";
											$tdesc=$rs['ticket_description'];
											$tresp=$rs['ticket_response'];
											$tstatus=$rs['ticket_status'];
										}
									}
									?>
									<div class="panel-body panel-primary text-center">
										<table>
											<tr>
												<td align="left">Ticket ID<br><?php echo $tids;?></td>
												<td width="75"></td>
												<td align="left">User ID<br><?php echo $uid;?></td>
												<td width="75"></td>
												<td align="left">User Name<br><?php echo $uids;?></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td align="left">Generated Date Time<br><?php echo $tdate;?></td>
												<td width="75"></td>
												<td align="left">Ticket Type<br><?php echo $ttype;?></td>
												<td width="75"></td>
												<td align="left">Ticket Description<br><?php echo $tdesc;?></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td align="left" colspan="5"><b>Ticket Reponse</b><br><?php echo $tresp;?></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td align="left">
													<input type="button" value="Back" onclick="document.location.href='tickets.php'" />
												</td>
											</tr>
										</table>
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
