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
                        <h5><i class="fa fa-inr fa-1x"></i> My Earnings</h5>
                    </div>
                    <div class="card-action">

                        <div class="row" id="oneStep">

                            <div class="col l12 m12 s12 pad-10">
                                <div id="ContentPlaceHolder1_myMarginSet">
									<form method="post">
									<table>
									<?php											
									$s1="";
									$s2="";
									$s3="";
									$cond=" ";
									if(isset($_POST['a']))
									{
										$s1=$_POST['a'];
										if($s1!="")
										$cond=" and date(trans_date_time)='$s1' ";
									}
									if(isset($_POST['b']))
									{
										$s2=$_POST['b'];
										if($s2!="")
										$cond=" and etid=$s2 ";
									}
									?>
										<tr>
											<td width='375'><input type='date' id='a' onclick='document.getElementById("b").value="";' value="<?php echo $s1;?>" name='a' placeholder='Deposit Date'/></td>
											<td width='375'><input type='number' id='b' onclick='document.getElementById("a").value="";' value="<?php echo $s2;?>" name='b' placeholder='Order No'/></td>
											<td><input class="btn btn-block btn-danger" type="submit" name='submit' value='Search'/></td>
										</tr>
									</table>
									</form>
									<table class='responsive-table striped table-bordered'> <thead>
												<tr>
													<th>Sr No</th>
													<th>Date Time</th>
													<th>Product Name</th>
													<th>Order No</th>
													<th>Earning</th>
													<th>TDS</th>
													<th>Income</th>
												</tr>														
											</thead>
											<tbody>
											<?php
											$ddtt="";
											$exp="";
											if(isset($_REQUEST['ddtt']))
											{
												$ddtt=$_REQUEST['ddtt'];
												$ddtt=explode(" ",$ddtt)[0];
											}											
											
											if($ddtt!="")
											$exp=" and date(trans_date_time)='$ddtt' ";
											
											$query="SELECT * FROM main_transaction_commission where retailer_id=$user_id and retailer_earning!=0 $exp $cond order by trans_date_time desc limit 0,100";
											$result=mysql_query($query);
											$num_rows = mysql_num_rows($result);	
											if($num_rows>0)
											{
												$i=0;
												while($rs = mysql_fetch_assoc($result))
												{
													$i++;
													$service=$rs['service'];
													
													if($service==2)
													$service="Account Verification";
													else if($service==1)
													$service="Money Transfer";
											?>
												<tr>
													<td><?php echo $i;?></td>
													<td><?php echo $rs['trans_date_time'];?></td>
													<td><?php echo $service;?></td>
													<td><?php echo $rs['etid'];?></td>
													<td><?php echo $rs['retailer_commission'];?></td>
													<td><?php echo $rs['retailer_tds'];?></td>
													<td><?php echo $rs['retailer_earning'];?></td>
												</tr>
											<?php
												}
											?>
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
