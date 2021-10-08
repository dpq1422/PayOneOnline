<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head id="ctl00_Head1"><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<?php include '_head-tag.php'; ?>
		<?php include_once '../admin/_update_all_wallets.php'; ?>
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
										Wallet Status
									</div>
									<div class="panel-body panel-primary text-left">
									<?php
										$cond="";
										if(isset($_POST['t1']))
											$cond=$_POST['t1'];
									?>
										<form method="post">
										Search by 
										<input size="60" name="t1" required value="<?php echo $cond;?>" placeholder="User ID / Name"/>
										<input type="submit" value="Search" />
										</form>
									</div>
									<div class="panel-body panel-primary text-center">
										<table class="table clsgrid rounded_corners" cellspacing="0" rules="all" border="1" id="ctl00_ContentPlaceHolder1_tagcost" style="width:100%;border-collapse:collapse;font-family:Calibri;font-weight:500;">
											<tbody>
												<tr class="gridheader" align="center" style="background-color:#009DE2;">
													<th>S.No.</th>
													<th>User ID</th>
													<th>Name</th>
													<th>Designation</th>
													<th>Parent Name</th>
													<th>Parent Designation</th>
													<th>Current Wallet Balance</th>
												</tr>
									<?php 
										if($cond!="")
											$cond=" and (user_id='$cond' or user_name like '%$cond%') ";
										
										$hierar_no="hierarchy_".$user_type."_no";
										$hierar_id="hierarchy_".$user_type."_id";								
										$query="SELECT * FROM child_user where user_type not in(0,1) and $hierar_no='$user_type' and $hierar_id='$user_id' and user_status=1 $cond order by wallet_balance desc,user_id desc";
										$result=mysql_query($query);
										$num_rows = mysql_num_rows($result);
										if($num_rows>0)
										{
											include '../functions/_my_hname.php';
											include '../functions/_parent_hname_name.php';
											include_once '../functions/_wallet_balance.php';
											$i=0;
											$userstatus="";
											while($rs = mysql_fetch_assoc($result)) {
											$i++;
											if($i%2!=0)
											$style="style='background-color:white;'";
											else
											$style="style='background-color:#e5e5e5;'";
										
											$rwb=wallet_balance($rs['user_id']);
											$max_uid=$rs['user_id'];
											$max_user=0;
											$max_qry="SELECT count(*) nums FROM child_wallet_remain where user_id=$max_uid";
											$max_res=mysql_query($max_qry);
											while($max_rs = mysql_fetch_assoc($max_res)) {
												$max_user=$max_rs['nums']-1;
											}
											
											$rwb="<b style='color:green;'>$rwb</b>";
											if($max_user==0)
											$rwb=$rwb." <b>( In-active )</b>";
											else
											$rwb=$rwb;
										
							$hname=show_my_hname($rs['user_type']);
							if($rs['user_type']==2)
							$hname="<b style='color:blue;'>".show_my_hname($rs['user_type'])."</b>";
							else if($rs['user_type']==3)
							$hname="<b style='color:#cc5801;'>".show_my_hname($rs['user_type'])."</b>";
							else if($rs['user_type']==11)
							$hname="<b style='color:green;'>".show_my_hname($rs['user_type'])."</b>";
									?>
												<tr <?php echo $style;?>>
													<td><?php echo $i;?></td>
													<td><?php echo $rs['user_id'];?></td>
													<td><?php echo $rs['user_name'];?></td>
													<td><?php echo $hname;?></td>
													<td><?php echo show_parent_hname_name2($rs['user_id']);?></td>
													<td><?php echo $rwb;?></td>
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
