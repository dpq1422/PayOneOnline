<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head id="ctl00_Head1"><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<?php include '_head-tag.php'; ?>
		<?php include_once '_update_all_wallets.php'; ?>
	</head>
	<body>
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
										Turnover of Today by Team Members
									</div>
									<div class="panel-body panel-primary text-left">
									<?php
										$t1="";
										$t2="";
										$cond="";
										if(isset($_POST['t1']))
											$t1=$_POST['t1'];
										if(isset($_POST['t2']))
											$t2=$_POST['t2'];
										
										if($t2=="")
											$t2=$date_time;
									?>
										<form method="post">
										Search by 
										<!--<input onclick="document.getElementById('t1').value='';" type="date" name="t2" id="t2" value="<?php echo $t2;?>" />-->
										<input onclick="document.getElementById('t2').value='';" size="60" name="t1" id="t1" value="<?php echo $t1;?>" placeholder="User ID / Name"/>
										<input type="submit" value="Search" />
										</form>
									</div>
									<div class="panel-body panel-primary text-center">
										<table class="table clsgrid rounded_corners" cellspacing="0" rules="all" border="1" id="ctl00_ContentPlaceHolder1_tagcost" style="width:100%;border-collapse:collapse;font-family:Calibri;font-weight:500;">
											<tbody>
												<tr class="gridheader" align="center" style="background-color:#009DE2;">
													<th>S.No.</th>
													<th>User ID</th>
													<th>User Name<br>User Designation</th>
													<th>Parent Name<br>Parent Designation</th>
													<th>Retailers</th>
													<th style='text-align:right;'>Transactions</th>
												</tr>
									<?php 
										if($t1!="")
											$cond=" and (user_id='$t1' or user_name like '%$t1%') ";
										
										$query="SELECT * FROM child_user where user_type not in(0,1) and hierarchy_1_no=1 and hierarchy_2_no=2 and hierarchy_2_id=$user_id and hierarchy_3_no=0 $cond order by user_type,user_name";
										$result=mysql_query($query);
										$num_rows = mysql_num_rows($result);
										if($num_rows>0)
										{
											include '../functions/_my_hname.php';
											include '../functions/_parent_hname_name.php';
											include '../functions/_my_retailers.php';
											include '../functions/_my_collection.php';
											include_once '../functions/_wallet_balance.php';
											$i=0;
											$userstatus="";
											$total=0;
											$total2=0;
											while($rs = mysql_fetch_assoc($result)) {
											
											$uwb=$rs['wallet_balance'];
											$wwb=wallet_balance($rs['user_id']);
											$rwb="";
											if($uwb==$wwb)
											$rwb="<b style='color:green;'>$wwb</b>";
											else
											$rwb="<b style='color:red;'>W: $wwb / U: $uwb</b>";
										
											$unm=$rs['user_name'];
											
							if($rs['user_type']==2)
							$unm=$unm."<br><b style='color:blue;'>(".show_my_hname($rs['user_type']).")</b>";
							else if($rs['user_type']==3)
							$unm=$unm."<br><b style='color:#cc5801;'>(".show_my_hname($rs['user_type']).")</b>";
							else if($rs['user_type']==11)
							$unm=$unm."<br><b style='color:green;'>(".show_my_hname($rs['user_type']).")</b>";
						
							$rtl=show_my_retailers($rs['user_id']);
							if($rtl==0)
								$rtl="";
							else
							$rtl="<b style='color:green;font-size:20px;'>$rtl</b>";
						if($rs['user_type']!=11)
						$total+=$collection=show_my_collection_team($rs['user_id'],$t2);
						else
						$total+=$collection=show_my_collection_retailer($rs['user_id'],$t2);
					
						if($collection==0)
							$collection="";
						else
						{
							$collection="<b style='font-size:20px;'>$collection</b>";
						
											$i++;
											if($i%2!=0)
											$style="style='background-color:white;'";
											else
											$style="style='background-color:#e5e5e5;'";
									?>
												<tr <?php echo $style;?>>
													<td><?php echo $i;?></td>
													<td><?php echo $rs['user_id'];?></td>
													<td><?php echo $unm;?></td>
													<td><?php echo show_parent_hname_name($rs['user_id']);?></td>
													<td><?php echo $rtl;?></td>
													<td align='right'><?php echo $collection;?></td>
												</tr>
									<?php
						}
											}
										}
										include_once('../functions/_my_collection.php');
										$earning=show_my_earning($user_id,$t2);
									?>
												<tr bgcolor='#e5e5e5'>
													<td colspan='5' align='right'><b style='font-size:20px;'>TOTAL</b></td>
													<td align='right'><b style='font-size:20px;'><?php echo "$earning from $total";?></b></td>
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
