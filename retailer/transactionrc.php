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
                        <h5><i class="fa fa-search fa-1x"></i> Transactions</h5>
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
									$dwn_link="";
									if(isset($_POST['a']))
									{
										$s1=$_POST['a'];
										if($s1!="")
										$cond=" and rc_id=$s1 ";
									}
									if(isset($_POST['b']))
									{
										$s2=$_POST['b'];
										if($s2!="")
										$cond=" and mobile_number=$s2 ";
									}
									if(isset($_POST['c']))
									{
										$s3=$_POST['c'];
										if($s3!="")
										$cond=" and date(created_on)='$s3' ";
										//$dwn_link="?dwndts=$s3";
									}
									?>
										<tr>
											<td width='100'><input type='number' id='a' onclick='document.getElementById("b").value="";document.getElementById("c").value="";' value="<?php echo $s1;?>" name='a' placeholder='Txn No'/></td>
											<td width='100'><input type='date' id='c' onclick='document.getElementById("a").value="";document.getElementById("b").value="";' value="<?php echo $s3;?>" name='c' placeholder='Date'/></td>
											<td width='200'><input type='number' id='b' onclick='document.getElementById("a").value="";document.getElementById("c").value="";' value="<?php echo $s2;?>" name='b' placeholder='Mobile No'/></td>
											<td><input class="btn btn-block btn-danger" type="submit" name='submit' value='Search'/></td>
											<!--
											<td><a href="download-transactions.php<?php echo $dwn_link;?>" class="btn green" >Download</a></td>-->
										</tr>
									</table>
									</form>
									<table class='responsive-table striped table-bordered'> 
											<thead>
												<tr>
													<th>Txn No</th>
													<th>Date Time</th>
													<th>Product Name</th>
													<th>Mobile</th>
													<th>Operator<br>Circle</th>
													<th>Amount</th>
													<th>Previous Balance</th>
													<th>Deducted</th>
													<th>Balance</th>
													<th>Status</th>
												</tr>														
											</thead>
											<tbody>
											<?php
											$query="SELECT * FROM main_transaction_rc where user_id=$user_id $cond order by rc_id desc limit 0,50";
											$result=mysql_query($query);
											$num_rows = mysql_num_rows($result);	
											if($num_rows>0)
											{
												while($rs = mysql_fetch_assoc($result))
												{	
													$product=$rs['type'];
													if($product==3)
														$product="Recharge";
													else if($product==4)
														$product="DTH";
													$status=$rs['rc_status'];
													if($status==0)
													$status="Not initiated";
													if($status==1 || $status==3 || $status==6)
													$status="Initiated";
													if($status==2)
													$status="Success";
													if($status==4)
													$status="Failed";
													if($status==5)
													$status="Refunded";
											?>
												<tr>
													<td><?php echo $rs['rc_id'];?></td>
													<td><?php echo $rs['created_on'];?></td>
													<td><?php echo $product;?></td>
													<td><?php echo $rs['mobile_number'];?></td>
													<td><?php echo $rs['operator']."<br>".$rs['circle'];?></td>
													<td style='text-align:right;'><?php echo $rs['amount'];?></td>
													<td style='text-align:right;'><?php echo $rs['pre_bal'];?></td>
													<td style='text-align:right;'><?php echo $rs['deducted_amt'];?></td>
													<td style='text-align:right;'><?php echo $rs['post_bal'];?></td>
													<td><?php echo $status;?></td>
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
