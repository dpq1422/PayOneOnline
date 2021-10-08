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
										Show Commissions
									</div>
									<div class="panel-body panel-primary text-right">
										<?php //<input type="button" value="Edit / Modify" onclick="location.href='commission-set-101.php';" /> ?>
									</div>
									<div class="panel-body panel-primary text-center">
										<table class="table clsgrid rounded_corners" cellspacing="0" rules="all" border="1" id="ctl00_ContentPlaceHolder1_tagcost" style="width:100%;border-collapse:collapse;font-family:Calibri;font-weight:500;">
											<tbody>
												<tr class="gridheader" align="center" style="background-color:#009DE2;">
													<th>S.No.</th>
													<th>Product Name</th>
													<th>Slab</th>
													<th>Your Flat Charges (A)</th>
													<th>Your Charges % (B)</th>
													<th>Retailer Flat Charges (A)</th>
													<th>Retailer Charges % (B)</th>
													<th>Profit Flat (C=B-A)</th>
													<th>Profit % (C=B-A)</th>
													<th>Team Share (D)</th>
													<th>Admin Share (E=100%-D%)</th>
												</tr>
												<?php
												$query="SELECT * FROM parent_charges_out_mt where charges_status=1";
												$result=mysql_query($query);
												$i=0;
												while($rs = mysql_fetch_assoc($result)) 
												{
													$i++;
													if($i%2!=0)
													$style="style='background-color:white;'";
													else
													$style="style='background-color:#e5e5e5;'";
													$sf=$rs['surcharges_fix'];
													$sp=$rs['surcharges_percent'];
													
													$charges_out_id=$rs['charges_out_id'];
													$service_type_id=$rs['service_type_id'];
													$operator_id=$rs['operator_id'];
													
													$query_sel="select * from child_charges_apply where user_id='$user_id' and charges_out_id='$charges_out_id' and service_type_id='$service_type_id' and operator_id='$operator_id';";
													$result_sel=mysql_query($query_sel);
													$num_rows_sel = mysql_num_rows($result_sel);
													if($num_rows_sel>0)
													{
														$row_sel = mysql_fetch_assoc($result_sel);
													}
													
													$query_sel2="select * from all_operator where operator_id='$operator_id';";
													$result_sel2=mysql_query($query_sel2);
													$num_rows_sel2 = mysql_num_rows($result_sel2);
													if($num_rows_sel2>0)
													{
														$row_sel2 = mysql_fetch_assoc($result_sel2);
														$operator_id=$row_sel2['operator_name'];
													}
											?>
												<form action="commission-set-101-code.php" method="post">
												<tr <?php echo $style;?>>
													<td><?php echo $i;?></td>
													<td><?php echo $operator_id;?></td>
													<td><?php echo $rs['slab_from']." - ".$rs['slab_to'];?></td>
													<td><input class="text" name="surcharges_fix" id="yfc<?php echo $i;?>" size="6" readonly value="<?php echo $sf;?>" /></td>
													<td><input class="text" name="surcharges_percent" id="ypc<?php echo $i;?>" size="6" readonly value="<?php echo $sp;?>" /></td>
													<td><input class="text" readonly name="retailer_fix" id="rfc<?php echo $i;?>" size="6" onkeyup="check(<?php echo $i;?>)" <?php if($sf==0) echo "readonly";?> value="<?php if($num_rows_sel>0) {echo $row_sel['retailer_fix'];} else {echo "0";} ?>" /></td>
													<td><input class="text" readonly name="retailer_percent" id="rpc<?php echo $i;?>" size="6" onkeyup="check(<?php echo $i;?>)" <?php if($sp==0) echo "readonly";?> value="<?php if($num_rows_sel>0) {echo $row_sel['retailer_percent'];} else {echo "0";} ?>" /></td>
													<td><input class="text" name="profit_fix" id="pf<?php echo $i;?>" size="6" readonly value="<?php if($num_rows_sel>0) {echo $row_sel['profit_fix'];} else {echo "0";} ?>" /></td>
													<td><input class="text" name="profit_percent" id="pc<?php echo $i;?>" size="6" readonly value="<?php if($num_rows_sel>0) {echo $row_sel['profit_percent'];} else {echo "0";} ?>" /></td>
													<td><input class="text" readonly name="team_share" id="ts<?php echo $i;?>" onkeyup="check(<?php echo $i;?>)" size="6" value="<?php if($num_rows_sel>0) {echo $row_sel['team_share'];} else {echo "0";} ?>" /></td>
													<td><input class="text" name="admin_share" id="as<?php echo $i;?>" size="6" readonly value="<?php if($num_rows_sel>0) {echo $row_sel['admin_share'];} else {echo "0";} ?>" /></td>
												</tr>
												</form>
											<?php
												}
											?>
											</tbody>
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
