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
                        <h5><i class="fa fa-bank fa-1x"></i> Bank Details</h5>
                    </div>
                    <div class="card-action">

                        <div class="row" id="oneStep">

                            <div class="col l12 m12 s12 pad-10">
                                <div id="ContentPlaceHolder1_myMarginSet">
									<table class='responsive-table striped table-bordered'>
										<thead>
											<tr class="gridheader" align="center">
												<th>Sr. No.</th>
												<th>Bank Code</th>
												<th>Bank Name</th>
												<th>IFSC Status</th>
												<th>Payent Method</th>
												<th>Account Verification</th>
											</tr>														
										</thead>
										<tbody>
									<?php
									$query="SELECT * FROM eko_bank order by eko_bank_id";
									$result=mysql_query($query);
									$num_rows = mysql_num_rows($result);
									$i=0;
									if($num_rows>0)
									{
										$stl="style='bachground-color:white;'";
										while($rs = mysql_fetch_assoc($result))
										{
											$i++;
											if($i%2==0)
												$stl="style='bachground-color:white;'";
											else
												$stl="style='bachground-color:#e5e5e5;'";
											
											$ifsc=$rs['ifsc_status'];
											if($ifsc==1)
												$ifsc="Bank short code (e.g. SBIN) works for both IMPS and NEFT";
											else if($ifsc==2)
												$ifsc="<i style='color:red'>Bank short code works for IMPS only</i>";
											else if($ifsc==3)
												$ifsc="<i style='color:green'>System can generate logical IFSC for both IMPS and NEFT</i>";
											else if($ifsc==4)
												$ifsc="<i style='color:red'>IFSC is required</i>";
											
											$veri=$rs['verification_available'];
											if($veri==0)
												$veri="<i style='color:red'>Not Available</i>";
											else if($veri==1)
												$veri="<i style='color:green'>Available</i>";
											
											$channel=$rs['available_channels'];
											if($channel==0)
												$channel="<i style='color:green'>Both (IMPS and NEFT)</i>";
											else if($channel==1)
												$channel="<i style='color:red'>NEFT only</i>";
											else if($channel==2)
												$channel="<i style='color:red'>IMPS only</i>";
												
									?>
											<tr <?php echo $stl;?>>
												<td><?php echo $rs['eko_bank_id'];?></td>
												<td><?php echo $rs['bank_code'];?></td>
												<td align='left'><?php echo $rs['bank_name'];?></td>
												<td><?php echo $ifsc;?></td>
												<td><?php echo $channel;?></td>
												<td><?php echo $veri;?></td>
											</tr>
									<?php
										}
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
        setactiveClass("prodMar");
    </script>


    
</div>
</body>
</html>
