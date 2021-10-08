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
										Bank Txns Updated
									</div>
									<?php
									/*
									<div class="panel-body panel-primary text-left">
										$t1="";
										if(isset($_POST['t1']))
											$t1=$_POST['t1'];
										
										$t2="";
										if(isset($_POST['t2']))
											$t2=$_POST['t2'];
										
										$t3="";
										if(isset($_POST['t3']))
											$t3=$_POST['t3'];
										
										$cond=" order by request_id desc limit 0,100 ";
										$dts="";
										if($t1!="")
											$cond=" and user_id='$t1' ";
										if($t2=="")
											$t2=$date_time;
										if($t2!="")
										{
											$cond=" and bnk_date = '$t2' order by request_id";
											//$cond=" and ((bnk_date between '$t2' and '$t3') or (bnk_date between '$t3' and '$t2'))  order by request_id desc ";
											//$dts="?dts2=$t2&dts3=$t3";
										}
										<form method="post">
										Date 
										<input type="date" required name="t2" id='t2' value="<?php echo $t2;?>" />&nbsp;&nbsp;
										<input type="submit" value="Search" />
										</form>
									</div>
										*/
									?>
									<div class="panel-body panel-primary text-center">
										<table class="table clsgrid rounded_corners" cellspacing="0" rules="all" border="1" id="ctl00_ContentPlaceHolder1_tagcost" style="width:100%;border-collapse:collapse;font-family:Calibri;font-weight:500;">
											<tbody>
												<tr class="gridheader" align="center" style="background-color:#009DE2;">
													<!--<th>Sr.No.</th>-->
													<th>Records No</th>
													<th>Date</th>
													<th>Bank</th>
													<th>SbiBranceCode<br>IciciTxnNo</th>
													<th>Cheque No. / Description</th>
													<th>Dr</th>
													<th>Balance</th>
													<!--
													<th>Req ID</th>
													<th>User ID</th>
													<th>Auth ID</th>-->
												</tr>
												<?php 
												include '../_common-admin.php';
												include '../functions/_my_uname.php';
												
												$query="SELECT * FROM child_bank_records where request_id=0 and bnk_date>='2017-10-01' and txn_dr!=0 order by request_id asc,bnk_date desc";
												$result=mysql_query($query);
												$num_rows = mysql_num_rows($result);	
												if($num_rows>0)
												{				
													$i=0;
													//$userstatus="";
													$total=0;
													while($rs = mysql_fetch_assoc($result)) {
													$i++;
													if($i%2!=0)
													$style="style='background-color:white;'";
													else
													$style="style='background-color:#e5e5e5;'";
													
													$bnk=$rs['bank_name'];
													if($bnk=="SBI")
													{
														$value=$rs['sbi_branch_code'];
														$bnk="<b style='color:blue;'>$bnk</b>";
													}
													else
													{
														$value=$rs['bnk_txn_id'];
														$bnk="<b style='color:#cc5801;'>$bnk</b>";
													}
													$desc=$rs['bnk_chk_no'].$rs['bnk_desc'];
													$desc=str_replace("-"," ",$desc);
													$desc=str_replace("/"," / ",$desc);
													//$bnk_user_name=show_my_uname($rs['user_id']);
													$txn_cr=$rs['txn_cr'];
													$txn_dr=$rs['txn_dr'];
													$txn_bal=$rs['txn_bal'];
													if($txn_cr==0)
														$txn_cr="";
													if($txn_dr==0)
														$txn_dr="";
													if($txn_bal==0)
														$txn_bal="";
													if($rs['request_id']!=0)
														$style="style='background-color:#aee2ae;'";
													
													$total+=$txn_dr;
											?>
											<tr <?php echo $style;?>>
												<!--<td><?php echo $i;?></td>-->
												<td><?php echo $rs['bnk_id'];?></td>
												<td><?php echo $rs['bnk_date'];?></td>
												<td><?php echo $bnk;?></td>
												<td><?php echo $value;?></td>
												<td><?php echo $desc;?></td>
												<td align='right'><?php echo $txn_dr;?></td>
												<td align='right'><?php echo $txn_bal;?></td>
												<!--<td><?php echo $rs['request_id'];?></td>
												<td><?php echo $rs['user_id'];?></td>
												<td><?php echo $rs['auth_id'];?></td>-->
											</tr>
											<?php
													}
												}
											?>
											<tr>
												<td colspan='6' align='right'>Total</td>
												<td align='right'><?php echo $total;?></td>
												<!--<td colspan='3'></td>-->
											</tr>
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
