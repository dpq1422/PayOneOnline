<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php include('_head-tag.php'); ?>
</head>
<body class="cyan-scheme">
<div id="form1">

    <!--Page load animation-->
 
    <div class="wrapper vertical-sidebar" id="full-page">
        <?php include('_nav-menu.php'); ?>

        <main id="content">
            <div id="page-content">

                
      <div class="row content-container elements">
        <div class="col s12 m12 l12 socialMessage">
            <div class="messageBox">
                <div class="card ">
                    <div class="card-content">
                        <h5><i class="fa fa-percent fa-1x"></i> My Margin</h5>
                    </div>
                    <div class="card-action">

                        <div class="row">
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
								
								$out  = "<h5>Money Transfer</h5>";
								$out .= "<table class='striped table-bordered'><tbody>";
								$i=0;
								foreach($data_array_row as $key => $element){
									$i++;
									$out .= "<tr>";
									foreach($element as $subkey => $subelement){
										if($i==1 || $i==2)
										$out .= "<td><b>$subelement</b></td>";
										else
										$out .= "<td>$subelement</td>";
									}
									$out .= "</tr>";
								}
								$out .= "</tbody></table>";
								?>
                            <div class="col l6 m12 s12 pad-10" id="oneStep">
                                <div class="">
                                    <div class="margin">  
										<?php echo $out;?>
									</div>
                                </div>
                            </div>
                            <div class="col l6 m12 s12 pad-10" id="oneStep">
                                <div class="">
                                    <div class="margin">  
										<h5>Recharge / DTH</h5>
										<table class='striped table-bordered'>
											<tbody>
												<tr>
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
														$ret="0.00";
											?>
												<tr <?php echo $style;?>>
													<td><?php echo $i;?></td>
													<td><?php echo $service_type_nm;?></td>
													<td><?php echo $operator_nm;?></td>
													<td><?php echo $ret;?></td>
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
                </div>
            </div>
        </div>

      
    </div>





            </div>
        </main>
    
        <?php include('_footer.php');?>
    </div>
    <script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
			
			<script src="../js/spin.js"></script>
			<script src="../js/ladda.js"></script>
			<script src="../js/ladda.jquery.js"></script>
			

			<script type="text/javascript" src="../js/materialize.js"></script>

			<script type="text/javascript" src="../js/prism.min.js"></script>
			<script type="text/javascript" src="../js/mara.min.js"></script>
			<script src="../js/sweetalert2.min.js"></script>
			<script src="../js/site.js"></script>
			<script type="text/javascript" src="../js/chosen.jquery.min.js"></script>
			<script>
				$(".chosen").chosen();
			</script>

			<script>
				jQuery.fn.ForceNumericOnly =
			function () {
				return this.each(function () {
					$(this).keydown(function (e) {
						var key = e.charCode || e.keyCode || 0;
						// allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
						// home, end, period, and numpad decimal
						return (
							key == 8 ||
							key == 9 ||
							key == 13 ||
							key == 46 ||
							key == 110 ||
							key == 190 ||
							(key >= 35 && key <= 40) ||
							(key >= 48 && key <= 57) ||
							(key >= 96 && key <= 105));
					});
				});
			};


				$(".numericOnlyText").ForceNumericOnly();



				function setactiveClass(id) {

					$(".myMenu li a").removeClass('active');

					$("#" + id).addClass('active');
					$("#" + id).parent().addClass('active');

				}
			</script>
    

    <script>
        setactiveClass('prof');
    </script>


    
</div>
</body>
</html>
