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
										Exp/Comm. Paid through Bank Dr
									</div>
									<div class="panel-body panel-primary text-left">
									<?php
										$max_req=0;
										$max_qry="select max(paid_id) reqid from child_bank_comm_paid";
										$max_res=mysql_query($max_qry);
										while($max_rs = mysql_fetch_array($max_res)) {
											$max_req=$max_rs['reqid'];
										}
										if($max_req==NULL)
											$max_req=0;
										
										$pull_data="insert into child_bank_comm_paid(paid_id, etid, date_time, user_id, details, dr) SELECT paid_id, etid, date_time, user_id, details, dr FROM main_commission_paid where dr!=0 and paid_id>$max_req ";
										mysql_query($pull_data);
										
										$t1="";
										if(isset($_POST['t1']))
											$t1=$_POST['t1'];
										
										
										$t2="";
										if(isset($_POST['t2']))
										{
											$t2=$_POST['t2'];
											echo "<script>window.location.href = 'tally-comm-paids.php?rdts=$t2';</script>";
										}
										
										$t3="";
										if(isset($_POST['t3']))
											$t3=$_POST['t3'];
										
										$cond=" 1=1 order by paid_id limit 0,100 ";
										$dts="";
										if($t1!="")
											$cond=" 1=1 and user_id='$t1' ";
										if(isset($_REQUEST['rdts']))
											$t2=$_REQUEST['rdts'];
										if($t2=="")
											$t2=$date_time;
										if($t2!="")
										{
											$cond=" 1=1 and date(date_time) = '$t2' order by paid_id";
											//$cond=" and ((request_date between '$t2' and '$t3') or (request_date between '$t3' and '$t2'))  order by request_id desc ";
											//$dts="?dts2=$t2&dts3=$t3";
										}
									?>
										<form method="post">
										Date 
										<input type="date" required name="t2" id='t2' value="<?php echo $t2;?>" />&nbsp;&nbsp;
										<input type="submit" value="Search" />
										</form>
									</div>
									<div class="panel-body panel-primary text-center">
										<table class="table clsgrid rounded_corners" cellspacing="0" rules="all" border="1" id="ctl00_ContentPlaceHolder1_tagcost" style="width:100%;border-collapse:collapse;font-family:Calibri;font-weight:500;">
											<tbody>
												<tr class="gridheader" align="center" style="background-color:#009DE2;">
													<!--<th>Sr.No.</th>-->
													<th>Paid ID</th>
													<th>Date Time</th>
													<th>User Name <br>(User ID)</th>
													<th>Details</th>
													<th>Amount</th>
													<th>Bank Txn No</th>
												</tr>
												<?php 
												include '../_common-admin.php';
												include '../functions/_my_uname.php';
												
												$query="SELECT * FROM child_bank_comm_paid where $cond ";
												$result=mysql_query($query);
												$num_rows = mysql_num_rows($result);	
												if($num_rows>0)
												{				
													$i=0;
													//$userstatus="";
													while($rs = mysql_fetch_array($result)) {
													$i++;
													if($i%2!=0)
													$style="style='background-color:white;'";
													else
													$style="style='background-color:#e5e5e5;'";
													
													$rid=$rs['paid_id'];
													$cid=$rs['user_id'];
													
													$act="";
													$rdts=explode(" ",$rs['date_time'])[0];
													$act=$rs['bnk_id'];
													if($act==0)
													$act="<a href='tally-update-paid-txn.php?rid=$rid&cid=$cid&rdts=$rdts'>Update</a>";
													else
													{
														$style="style='background-color:#aee2ae;'";
													}
													
											?>
											<tr <?php echo $style;?>>
												<!--<td><?php echo $i;?></td>-->
												<td><?php echo $rs['paid_id'];?></td>
												<td><?php echo $rs['date_time'];?></td>
												<td><?php echo show_my_uname($rs['user_id'])."<br>(".$rs['user_id'].")";?></td>
												<td><?php echo $rs['details'];?></td>
												<td><?php echo $rs['dr'];?></td>
												<td><?php echo $act;?></td>
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
