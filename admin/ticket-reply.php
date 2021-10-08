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
										Reply to Ticket
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
									if(isset($_POST['reply']))
									{
										$tid=$_POST['tid'];
										$uid=$_POST['usid'];
										$response=$_POST['filled_remarks'];
										$status=$_POST['status'];
										$qry="update child_tickets set ticket_response=concat(ticket_response,'<br><br>$response <b>last updated by $user_types ($user_id - $user_name) at $datetime_time</b>'), ticket_status='$status' where ticket_id='$tid';";
										$res=mysql_query($qry);
										include_once('../functions/_zsms.php');
										include_once('../functions/_my_umobile.php');
										$unums=show_my_umobile($uid);
										zsms("".$unums."","Payone Team replied on Ticket no. $tid\n\nPayOne Team");
										if($res)
										{
											echo "<script>document.location.href='tickets.php'</script>";
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
											<form method="post">
											<tr>
												<td align="left" colspan="5">Latest Updated Response about Ticket<br>
												<input type="hidden" name="tid" value="<?php echo $tid?>"/>
												<input type="hidden" name="usid" value="<?php echo $uid?>"/>
												<textarea rows="5" cols="100" required name="filled_remarks"></textarea></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td align="left">
													<select required name="status">
														<option value="">Select Updated Status</option>
														<option value="2">In-Progress</option>
														<option value="4">Closed</option>
													</select>
												</td>
												<td width="75"></td>
												<td align="left">
													<input type="submit" name="reply" value="update" />
												</td>
											</tr>
											</form>
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
