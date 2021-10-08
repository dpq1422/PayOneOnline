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
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-12">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Commission Unpaid
									</div>
									<div class="panel-body panel-primary text-left">
					<?php
						include('../functions/_payout.php');
						payout(100001);
						payout(1);
						payout(100000);
						payouts(100005);
					?>
									<?php
										$t1="";
										if(isset($_POST['t1']))
											$t1=$_POST['t1'];
										$t2="";
										if(isset($_POST['t2']))
											$t2=$_POST['t2'];
										
										$cond="";
										if($t1!="")
											$cond=" and user_id='$t1' ";
										if($t2!="")
											$cond=" and date(date_time)<='$t2' ";
									?>
										<form method="post">
										Search by 
										<input size="30" name="t1" value="<?php echo $t1;?>" placeholder="User ID"/>
										<input size="30" name="t2" type='date' value="<?php echo $t2;?>" placeholder="User ID"/>
										<input type="submit" value="Search" />
										</form>
									</div>
									<div class="panel-body panel-primary text-center">
										<table class="table clsgrid rounded_corners" cellspacing="0" rules="all" border="1" id="ctl00_ContentPlaceHolder1_tagcost" style="width:100%;border-collapse:collapse;font-family:Calibri;font-weight:500;">
											<tbody>
													<tr class="gridheader" align="center" style="background-color:#009DE2;">
													<th>Sr. No.</th>
													<th>User ID</th>
													<th>User Name<br>Designation</th>
													<th>Location</th>
													<th>Parent<br>Designation</th>
													<th>Cr</th>
													<th>Dr</th>
													<th>Remain</th>
													<th>Action</th>
													</tr>
											<?php
											$query="SELECT user_id id,sum(cr) cr,sum(dr) dr, (sum(cr)-sum(dr)) bal FROM main_commission_paid_group where user_id in (1,100000,100001,100005) $cond group by user_id order by cr desc";
											$result=mysql_query($query);
											$num_rows = mysql_num_rows($result);	
											if($num_rows>0)
											{
												$i=0;
												while($rs = mysql_fetch_assoc($result))
												{
													$status="";
													$i++;
													$uid=$rs['id'];
													$cr=$rs['cr'];
													$dr=$rs['dr'];
													$bal=$rs['bal'];
													
													$status="";
													if($uid==100001)
													{
														$status=$status."<a href='commission-unpaid-teams.php?uid=$uid'>Show Details</a><br><br><a href='commission-unpaid-teams-dr.php?uid=$uid'>Paid Only</a>";
														$status=$status."<br><br>";
														$status=$status."<a href='commission-pay.php?uid=$uid&cr=$cr&dr=$dr&bal=$bal'>Pay Now</a>";
													}
													$uname=$desi=$state=$dist=$utp="";
													$qry="select * from child_user where user_id='$uid';";
													$res=mysql_query($qry);
													while($rss=mysql_fetch_assoc($res))
													{
														$uname=$rss['user_name'];
														$desi=$rss['user_type'];
														$state=$rss['state_id'];
														$dist=$rss['distt_id'];
														$utp=$rss['user_type'];
													}
													include_once '../functions/_my_hname.php';
													include_once '../functions/_parent_hname_name.php';
													include_once '../functions/_state.php';
													include_once '../functions/_distt.php';
													if($dr!=0)
														$dr="<b>$dr</b>";
											?>
												<tr>
													<td><?php echo $i;?></td>
													<td><?php echo $uid;?></td>
													<td>
														<?php echo $uname;?>
														<br>
														(<?php echo show_my_hname($utp);?>)
													</td>
													<td>
														<?php echo show_distt($dist);?>
														<br>
														<?php echo show_state($state);?>
													</td>
													<td><?php echo show_parent_hname_name($uid);?></td>
													<td><?php echo $cr;?></td>
													<td><?php echo $dr;?></td>
													<td><?php echo $bal;?></td>
													<td><?php echo $status;?></td>
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
