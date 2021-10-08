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
                        <h5><i class="fa fa-calendar fa-1x"></i> My Ledger</h5><br><a href="margin.php" class="waves-effect waves-light btn white-text green margin-bottom-10 ladda-button">My Margin</a><a href="my-earnings-detailed.php" class="waves-effect waves-light btn white-text green margin-bottom-10 ladda-button" style="margin-left:50px;">My Earnings</a><a href="my-earnings-summary.php" class="waves-effect waves-light btn white-text green margin-bottom-10 ladda-button" style="margin-left:50px;">Payout Summary</a><a href="fund-received.php" class="waves-effect waves-light btn white-text green margin-bottom-10 ladda-button" style="margin-left:50px;">Fund Received</a>
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
										$cond=" and wallet_date='$s1' ";
									}
									if(isset($_POST['b']))
									{
										$s2=$_POST['b'];
										if($s2!="")
										$cond=" and (amount_cr=$s2 or amount_dr=$s2) ";
									}
									?>
										<tr>
											<td width='375'><input type='date' id='a' onclick='document.getElementById("b").value="";' value="<?php echo $s1;?>" name='a' placeholder='Date'/></td>
											<td width='375'><input type='number' id='b' onclick='document.getElementById("a").value="";' value="<?php echo $s2;?>" name='b' placeholder='Amount'/></td>
											<td><input class="btn btn-block btn-danger" type="submit" name='submit' value='Search'/></td>
										</tr>
									</table>
									</form>
									<table class='responsive-table striped table-bordered'>
										<thead>
											<tr class="gridheader" align="center">
												<th>Sr.No.</th>
												<th>Wallet ID</th>
												<th>Date</th>
												<th>Time</th>
												<th>Transaction Type</th>
												<th>Transaction Description</th>
												<th>Previous Balance</th>
												<th>Amount Cr</th>
												<th>Amount Dr</th>
												<th>Balance</th>
											</tr>														
										</thead>
										<tbody>
									<?php 
										include '../_common-retail.php';
										
										$query="SELECT * FROM child_wallet_remain where user_id=$user_id $cond order by wallet_id desc limit 0,50";
										$result=mysql_query($query);
										$num_rows = mysql_num_rows($result);	
										if($num_rows>0)
										{				
											$i=0;
											//$userstatus="";
											$a=$b=$c=$d=0;
											while($rs = mysql_fetch_assoc($result)) {
											$i++;
											if($i%2!=0)
											$style="style='background-color:white;'";
											else
											$style="style='background-color:#e5e5e5;'";
											$transaction_type=$rs['transaction_type'];
											if($transaction_type=="0") 
											$transaction_type="Account Opened"; 
											else if($transaction_type=="1") 
											$transaction_type="Wallet Amount Received";
											else if($transaction_type=="2")
											$transaction_type="Wallet Transeferred Manual by Admin"; 
											else if($transaction_type=="3")
											$transaction_type="Wallet Transfer on Request by Admin"; 
											else if($transaction_type=="4")
											$transaction_type="Wallet Transferred by Team"; 
											else if($transaction_type=="5")
											$transaction_type="Wallet Withdraw Manual by Admin";
											else if($transaction_type=="6")
											$transaction_type="Order Generated";
											else if($transaction_type=="7")
											$transaction_type="Failed Order Refunded";
											else if($transaction_type=="8" || $transaction_type=="9")
											$transaction_type="Commission";
											else if($transaction_type=="10" || $transaction_type=="11")
											$transaction_type="Surcharges";
											else if($transaction_type=="12" || $transaction_type=="13")
											$transaction_type="Chargeback";
											else if($transaction_type=="14" || $transaction_type=="15")
											$transaction_type="Other";
											else if($transaction_type=="16")
											$transaction_type="Software Amount";
											else if($transaction_type=="17")
											$transaction_type="Security Amuount";
											else if($transaction_type=="18")
											$transaction_type="Created Commission";
											
											$a+=$rs['amount_pre'];
											$b+=$rs['amount_cr'];
											$c+=$rs['amount_dr'];
											$d+=$rs['amount_bal'];
											
											$tr_desc=explode(" from ",$rs['transaction_description'])[0];
											if($transaction_type=="Failed Order Refunded")
											{
												$tr_desc=explode(" by ",$tr_desc)[0];
												$tr_desc=$tr_desc." at ".$rs['wallet_date']." ".$rs['wallet_time'];
											}
											
									?>
												<tr <?php echo $style;?>>
													<td><?php echo $i;?></td>
													<td><?php echo $rs['wallet_id'];?></td>
													<td><?php echo $rs['wallet_date'];?></td>
													<td><?php echo $rs['wallet_time'];?></td>
													<td><?php echo $transaction_type;?></td>
													<td><?php echo $tr_desc;?></td>
													<td style="text-align:right;"><?php echo $rs['amount_pre'];?></td>
													<td style="text-align:right;"><?php echo $rs['amount_cr'];?></td>
													<td style="text-align:right;"><?php echo $rs['amount_dr'];?></td>
													<td style="text-align:right;"><?php echo $rs['amount_bal'];?></td>
												</tr>
									<?php
											}
											?>
											<!--<tr bgcolor='#e1e1e1' style='color:#000000;'>
													<td colspan='4'></td>
													<td>
													<?php
													if($a+$b==$c+$d)
													echo "<b style='color:green;'>Matched</b>";
													else
													echo "<b style='color:red;'>Not Matched</b>";
													?>
													</td>
													<td colspan='2'><?php echo $a;?> + <?php echo $b;?></td>
													<td colspan='2'><?php echo $c;?> + <?php echo $d;?></td>
													<td></td>
												</tr>-->
											<?php
										}
										else
										{
									?>
												<tr>
													<td colspan="10">No Records Available</td>
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
