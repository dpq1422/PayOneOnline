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
										Commission Paid (Summary) 
									</div>
									<div class="panel-body panel-primary text-left">
									<?php											
									$s1="";
									$s2="";
									$s3="";
									$cond=" ";
									if(isset($_POST['a']))
									{
										$s1=$_POST['a'];
										if($s1!="")
										$cond=" and date(date_time)='$s1' ";
									}
									if(isset($_POST['b']))
									{
										$s2=$_POST['b'];
										if($s2!="")
										$cond=" and deposit_amount=$s2 ";
									}
									?>
										<form method="post">
											Search by 
											<input type='date' id='a' value="<?php echo $s1;?>" name='a' placeholder='Deposit Date'/>&nbsp;&nbsp;
											<input type="submit" name='submit' value='Search'/>
										</form>
									</div>
									<div class="panel-body panel-primary text-center">
										<table class="table clsgrid rounded_corners" cellspacing="0" rules="all" border="1" id="ctl00_ContentPlaceHolder1_tagcost" style="width:100%;border-collapse:collapse;font-family:Calibri;font-weight:500;">
											<tbody>
													<tr class="gridheader" align="center" style="background-color:#009DE2;">
														<th>Date</th>
														<th>Total Earning</th>
														<th>Cr</th>
														<th>Dr</th>
														<th>Balance</th>
														<th>Action</th>
													</tr>
											<?php
											include('../functions/_payout.php');
											payout($user_id);
											$bal=0;
											$query="SELECT * FROM main_commission_paid_group where user_id=$user_id $cond order by date_time desc";
											$result=mysql_query($query);
											$num_rows = mysql_num_rows($result);	
											if($num_rows>0)
											{
												while($rs = mysql_fetch_assoc($result))
												{
													$dt=explode(" ",$rs['date_time'])[0];
													$status="<a href='earnings.php?ddtt=$dt'>Show Details</a>";
											?>
												<tr>
													<td><?php echo $dt;?></td>
													<td><?php echo $rs['cr'];?></td>
													<td><?php echo $rs['cr'];?></td>
													<td><?php echo $rs['dr'];?></td>
													<td><?php echo $rs['bal'];?></td>
													<td><?php echo $status;?></td>
												</tr>
											<?php
												}
												/*
											?>
												<tr>
													<th colspan='5' align='right'>Total</th>
													<th><?php echo $a;?></th>
													<th><?php echo $b;?></th>
													<th><?php echo $c;?></th>
													<th></th>
												</tr>
											<?php
											*/
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
