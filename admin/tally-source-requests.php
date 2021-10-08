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
										Bank Requests Sent
									</div>
									<div class="panel-body panel-primary text-left">
									<?php
									
										$max_req=0;
										$max_qry="select max(request_id) reqid from child_bank_source_requests";
										$max_res=mysql_query($max_qry);
										while($max_rs = mysql_fetch_array($max_res)) {
											$max_req=$max_rs['reqid'];
										}
										if($max_req==NULL)
											$max_req=0;
										
										$pull_data="insert into child_bank_source_requests(request_id, request_date, request_time, client_id, user_id, deposite_date, bank_id, payment_mode, ref_no, deposit_amount, remarks, request_status, request_remarks) select * from parent_wallet_requests where request_id>$max_req and request_date>='2017-10-01' and request_status=2";
										mysql_query($pull_data);
										
										$qry_updt="SELECT * FROM child_bank_source_requests where bnk_id=0";
										$res_updt=mysql_query($qry_updt);
										while($rs_updt = mysql_fetch_array($res_updt)) {
											$rqid=$rs_updt['request_id'];
											$qry_sel="SELECT * FROM parent_wallet_requests where request_id=$rqid;";
											$res_sel=mysql_query($qry_sel);
											while($rs_sel = mysql_fetch_array($res_sel))
											{
												$reqstt=$rs_sel['request_status'];
												$qry_sel_updt="update child_bank_source_requests set request_status='$reqstt' where request_id='$rqid';";
												mysql_query($qry_sel_updt);
											}											
										}
										
										$t1="";
										if(isset($_POST['t1']))
											$t1=$_POST['t1'];
										
										
										$t2="";
										if(isset($_POST['t2']))
										{
											$t2=$_POST['t2'];
											echo "<script>window.location.href = 'tally-source-requests.php?rdts=$t2';</script>";
										}
										
										$t3="";
										if(isset($_POST['t3']))
											$t3=$_POST['t3'];
										
										$cond=" order by bnk_id,request_id limit 0,100 ";
										$dts="";
										if($t1!="")
											$cond=" and user_id='$t1' ";
										if(isset($_REQUEST['rdts']))
											$t2=$_REQUEST['rdts'];
										if($t2=="")
											$t2=$date_time;
										if($t2!="")
										{
											$cond=" and request_date = '$t2' order by bnk_id,request_id";
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
													<th>Req ID</th>
													<th>Deposit Date<br>Request Date</th>
													<th>User Name <br>(User ID)</th>
													<th>Bank</th>
													<th>Method</th>
													<th>Ref No</th>
													<th>Requested Amount</th>
													<th>Status</th>
													<th>Ref No</th>
												</tr>
												<?php 
												include '../_common-admin.php';
												include '../functions/_ShowAdminBankClient.php';
												include '../functions/_my_uname.php';
												include '../functions/_my_umobile.php';
												
												$query="SELECT * FROM child_bank_source_requests where request_date>='2017-10-01' $cond ";
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
													
													$rid=$rs['request_id'];
													$cid=$rs['user_id'];
													
													$pm="";
													if($rs['payment_mode']==1)
													$pm="DD";
													else if($rs['payment_mode']==2)
													$pm="Cheque";
													else if($rs['payment_mode']==3)
													$pm="NEFT/RTGS";
													else if($rs['payment_mode']==4)
													$pm="IMPS";
													else if($rs['payment_mode']==5)
													$pm="Cash";
													else if($rs['payment_mode']==6)
													$pm="CDM";
													
													$st="";
													if($rs['request_status']==1)
													$st="<b style='color:blue;'>Received</b>";
													else if($rs['request_status']==2)
													$st="<b style='color:green;'>Transferred</b>";
													else if($rs['request_status']==3)
													$st="<b style='color:red;'>Rejected</b>";
													
													$act="";
													$rdts=$rs['request_date'];
													$act=$rs['bnk_id'];
													if($act==0)
													$act="<a href='tally-updates-txn.php?rid=$rid&cid=$cid&rdts=$rdts'>Update</a>";
													else
													{
														$style="style='background-color:#aee2ae;'";
													}
													
											?>
											<tr <?php echo $style;?>>
												<!--<td><?php echo $i;?></td>-->
												<td><?php echo $rs['request_id'];?></td>
												<td>
													<?php echo "D: ".$rs['deposite_date'];?><br>
													<?php echo "R: ".$rs['request_date'];?>
												</td>
												<td><?php echo show_my_uname($rs['user_id'])."<br>(".$rs['user_id'].")";?></td>
												<td>
												<?php 
												if($rs['bank_id']==1)echo "<b style='color:blue;'>SBI</b>";
												if($rs['bank_id']==2)echo "<b style='color:#cc5801;'>ICICI</b>";
												if($rs['bank_id']==3)echo "<b style='color:red;'>PNB</b>";
												?>
												</td>
												<td><?php echo $pm;?></td>
												<td><?php echo $rs['ref_no'];?></td>
												<td><?php echo $rs['deposit_amount'];?></td>
												<td><?php echo $st;?></td>
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
