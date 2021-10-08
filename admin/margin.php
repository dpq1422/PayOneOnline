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
							<div class="col-md-6">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Money Transfer
									</div>
									<div class="panel-body panel-primary text-center">
											<?php
											$qry4="select * from child_products_margin_mt where user_id='$user_id'";
											$result4=mysql_query($qry4);
											$data_array_col1=array("Transfer Charges");
											$data_array_col2=array("Slab and Method");
											$data_array_col3=array("Amount from 0-1000");
											$data_array_col4=array("Amount from 1001-2000");
											$data_array_col5=array("Amount from 2001-3000");
											$data_array_col6=array("Amount from 3001-4000");
											$data_array_col7=array("Amount from 4001-5000");
											while($rs4=mysql_fetch_assoc($result4))
											{
												$pid=$rs4['source_id'];
												$pm_id=$rs4['payment_method'];
												$payment_method=$rs4['payment_method'];
												if($payment_method==1)
												$payment_method="NEFT";
												else
												$payment_method="IMPS";
												$source_name="";
												
												$rate_01=0;
												$rate_02=0;
												$rate_03=0;
												$rate_04=0;
												$rate_05=0;
												$rate_10=0;
												$rate_15=0;
												$rate_20=0;
												$rate_25=0;
												
												$rate_01=$rs4['m_01000'];
												$rate_02=$rs4['m_02000'];
												$rate_03=$rs4['m_03000'];
												$rate_04=$rs4['m_04000'];
												$rate_05=$rs4['m_05000'];
												
												$qry3="select source_name from all_recharge_source where source_id='$pid'";
												$result3=mysql_query($qry3);
												while($rs3=mysql_fetch_assoc($result3))
												{
													$source_name=$rs3['source_name'];
												}
												array_push($data_array_col1, $source_name);
												array_push($data_array_col2, $payment_method);
												array_push($data_array_col3, $rate_01);
												array_push($data_array_col4, $rate_02);
												array_push($data_array_col5, $rate_03);
												array_push($data_array_col6, $rate_04);
												array_push($data_array_col7, $rate_05);
											}
											$data_array_row=array($data_array_col1,$data_array_col2,$data_array_col3,$data_array_col4,$data_array_col5,$data_array_col6,$data_array_col7);
											
											$out  = "";
											$out .= "<table>";
											$i=0;
											foreach($data_array_row as $key => $element){
												$i++;
												$st="style='background-color:#ffffff;'";
												if($i%2!=0)
													$st="style='background-color:#e5e5e5;'";
												$out .= "<tr height='50' $st><td width='25'></td>";
												$j=0;
												foreach($element as $subkey => $subelement){
													$j++;
													$stl="";
													if($j==1)
														$stl="align='left' width='250'";
													if($i==1 || $i==2)
													$out .= "<td $stl><b>$subelement</b></td>";
													else
													$out .= "<td $stl>$subelement</td>";
												
													$out .= "<td width='25'></td>";
												}
												$out .= "</tr>";
											}
											echo $out .= "</table>";
											?>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Recharge / DTH
									</div>
									<div class="panel-body panel-primary text-center">
										<table class="table clsgrid rounded_corners" cellspacing="0" rules="all" border="1" id="ctl00_ContentPlaceHolder1_tagcost" style="width:100%;border-collapse:collapse;font-family:Calibri;font-weight:500;">
												<tbody>
													<tr class="gridheader" align="center" style="background-color:#009DE2;">
														<th>S.No.</th>
														<th>Service Type</th>
														<th>Provider Name</th>
														<th>% Margin</th>
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
													if($operator_nm=="Idea")
														$adm="0.00";
											?>
												<tr <?php echo $style;?>>
													<td><?php echo $i;?></td>
													<td><?php echo $service_type_nm;?></td>
													<td><?php echo $operator_nm;?></td>
													<td><?php echo $adm;?></td>
												</tr>
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
