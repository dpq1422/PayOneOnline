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
										Browse Tickets
									</div>
									<?php
									$t1="";
									$t2="";
									$cond="";
									if(isset($_POST['t1']))
										$t1=$_POST['t1'];
									if(isset($_POST['t2']))
										$t2=$_POST['t2'];
									
									if($t1!="")
										$cond=" and ticket_id='$t1' ";
									if($t2!="")
										$cond=" and date(date_time)='$t2' ";
									
									?>
									<div class="panel-body panel-primary text-left">
										<form method="post">
										Search by &nbsp;&nbsp;&nbsp;
										<input size="20" name="t1" id="t1" onclick="document.getElementById('t2').value='';" value="<?php echo $t1;?>" placeholder="Ticket ID"/>
										&nbsp;&nbsp;&nbsp;
										<input name="t2" id="t2" onclick="document.getElementById('t1').value='';" value="<?php echo $t2;?>" type="date" placeholder="Date"/>
										&nbsp;&nbsp;&nbsp;
										<input type="submit" value="Search" />
										&nbsp;&nbsp;&nbsp;
										<input type="button" value="Generate New Ticket" onclick="document.location.href='ticket.php'" />
										</form>
									</div>
									<div class="panel-body panel-primary text-center">
										<table class="table clsgrid rounded_corners" cellspacing="0" rules="all" border="1" id="ctl00_ContentPlaceHolder1_tagcost" style="width:100%;border-collapse:collapse;font-family:Calibri;font-weight:500;">
											<tbody>
												<tr class="gridheader" align="center" style="background-color:#009DE2;">
													<th>Ticket ID</th>
													<th>Ticket Type</th>
													<th>Date Time</th>
													<th>User ID / User Name</th>
													<th>Details</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
												<?php
												$query="SELECT * FROM child_tickets where user_id='$user_id' $cond order by ticket_id desc";
												$result=mysql_query($query);
												$num_rows = mysql_num_rows($result);	
												$i=0;
												if($num_rows>0)
												{
													include '../functions/_my_uname.php';
													while($rs = mysql_fetch_assoc($result))
													{
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
														
														$tstatus=$rs['ticket_status'];
														if($tstatus==1)
														$tstatus="Opened";
														else if($tstatus==2)
														$tstatus="In-Progress";
														else if($tstatus==3)
														$tstatus="Re-Opened";
														else if($tstatus==4)
														$tstatus="Closed";
												?>
												<tr style="background-color:White;">
													<td><?php echo $rs['ticket_id'];?></td>
													<td><?php echo $ttype;?></td>
													<td><?php echo $rs['date_time'];?></td>
													<td><?php echo show_my_uname($rs['user_id']);?></td>
													<td><?php echo $rs['ticket_description'];?></td>
													<td><?php echo $tstatus;?></td>
													<td>
														<a href="ticket-show.php?tid=<?php echo $rs['ticket_id'];?>">Show Details</a>
														&nbsp;&nbsp;&nbsp;
														<a href="ticket-reply.php?tid=<?php echo $rs['ticket_id'];?>">Reply</a>
													</td>
												</tr>
												<?php
													}
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
