<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head id="ctl00_Head1"><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<?php include '_head-tag.php'; ?>
		<script>
		function check(row)
		{
			var your=document.getElementById("your"+row).value;
			var ret=document.getElementById("ret"+row).value;
			var dist=document.getElementById("dist"+row).value;
			var sd=document.getElementById("sd"+row).value;
			var adm=(your-ret-dist-sd).toFixed(2);
			document.getElementById("adm"+row).value=adm;
		}
		</script>
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
										Edit / Update Commissions
									</div>
									<div class="panel-body panel-primary text-center">
										<table class="table clsgrid rounded_corners" cellspacing="0" rules="all" border="1" id="ctl00_ContentPlaceHolder1_tagcost" style="width:100%;border-collapse:collapse;font-family:Calibri;font-weight:500;">
											<tbody>
												<tr class="gridheader" align="center" style="background-color:#009DE2;">
													<th>S.No.</th>
													<th>Service Type</th>
													<th>Provider Name</th>
													<th>Your Charges</th>
													<th>Retailer Charges</th>
													<th>Dist Charges</th>
													<th>SD Charges</th>
													<th>Admin Charges</th>
													<th>Action</th>
												</tr>
											<?php
												$query="SELECT * FROM parent_charges_out_mt where service_type_id!=101 and charges_status=1 and surcharges_percent>0";
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
													
													$your=$sp;
													$ret=0;
													$dist=0;
													$sd=0;
													$adm=0;		
													
													$service_type_id=$rs['service_type_id'];
													$operator_id=$rs['operator_id'];
													
													$query_sel="select * from child_charges_apply where operator_id='$operator_id';";
													$result_sel=mysql_query($query_sel);
													$num_rows_sel = mysql_num_rows($result_sel);
													if($num_rows_sel>0)
													{
														$row_sel = mysql_fetch_assoc($result_sel);
														$your=$row_sel['sadmin'];
														$ret=$row_sel['retailer'];
														$dist=$row_sel['dist'];
														$sd=$row_sel['sd'];
														$adm=$row_sel['admin'];
													}
													else
													{
														mysql_query("insert into child_charges_apply value('$operator_id','$your','0','0','0','0')");
													}
													
													$query_sel2="select * from all_operator where operator_id='$operator_id';";
													$operator_nm="";
													$result_sel2=mysql_query($query_sel2);
													$num_rows_sel2 = mysql_num_rows($result_sel2);
													if($num_rows_sel2>0)
													{
														$row_sel2 = mysql_fetch_assoc($result_sel2);
														$operator_nm=$row_sel2['operator_name'];
													}
													
													$query_sel2="select * from all_service_type where service_type_id='$service_type_id';";
													$service_type_nm="";
													$result_sel2=mysql_query($query_sel2);
													$num_rows_sel2 = mysql_num_rows($result_sel2);
													if($num_rows_sel2>0)
													{
														$row_sel2 = mysql_fetch_assoc($result_sel2);
														$service_type_nm=$row_sel2['service_type_name'];
													}		
													if($your=="0")
														$your="";
													if($ret=="0")
														$ret="";
													if($dist=="0")
														$dist="";
													if($sd=="0")
														$sd="";
													if($adm=="0")
														$adm="";
											?>
												<form action="comm-charges-set-code.php" method="post">
												<tr <?php echo $style;?>>
													<td><?php echo $i;?></td>
													<td><?php echo $service_type_nm;?></td>
													<td><?php echo $operator_nm;?></td>
													<td>
													<input type="hidden" name="provider" value="<?php echo $operator_id;?>"/>
													<input class="text" required name="surcharges_percent" id="your<?php echo $i;?>" size="6" readonly value="<?php echo $your;?>" /></td>
													<td><input class="text" required name="retailer_percent" id="ret<?php echo $i;?>" size="6" onkeyup="check(<?php echo $i;?>)" value="<?php echo $ret;?>" /></td>
													<td><input class="text" required name="dist_percent" id="dist<?php echo $i;?>" size="6" onkeyup="check(<?php echo $i;?>)" value="<?php echo $dist;?>" /></td>
													<td><input class="text" required name="sd_percent" id="sd<?php echo $i;?>" size="6" onkeyup="check(<?php echo $i;?>)" value="<?php echo $sd;?>" /></td>
													<td><input class="text" readonly required name="admin_percent" id="adm<?php echo $i;?>" size="6" onkeyup="check(<?php echo $i;?>)" value="<?php echo $adm;?>" /></td>
													<td><input type="submit" name="UpdateRatio" value="Save" /></td>
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
