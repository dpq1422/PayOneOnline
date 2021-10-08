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
                        <h5 style="float:left;"><i class="fa fa-ticket fa-1x"></i> Sent Wallet Requests</h5><input type="button" value="New Wallet Request" onclick="location.href='send-wallet-request.php';" style="float:right;"  class="waves-effect waves-light btn white-text green margin-bottom-10 ladda-button" /><a href="fund-received.php" class="waves-effect waves-light btn white-text green margin-bottom-10 ladda-button" style="margin:0 50px;float:right;">Fund Received</a><br>
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
									$cond=" ";
									if(isset($_POST['a']))
									{
										$s1=$_POST['a'];
										if($s1!="")
										$cond=" and deposite_date='$s1' ";
									}
									if(isset($_POST['b']))
									{
										$s2=$_POST['b'];
										if($s2!="")
										$cond=" and deposit_amount=$s2 ";
									}
									?>
										<tr>
											<td width='375'><input type='date' id='a' onclick='document.getElementById("b").value="";' value="<?php echo $s1;?>" name='a' placeholder='Deposit Date'/></td>
											<td width='375'><input type='number' id='b' onclick='document.getElementById("a").value="";' value="<?php echo $s2;?>" name='b' placeholder='Deposit Amount'/></td>
											<td><input class="btn btn-block btn-danger" type="submit" name='submit' value='Search'/></td>
										</tr>
									</table>
									</form>
									<table class='responsive-table striped table-bordered'>
										<thead>
											<tr class="gridheader" align="center">
												<th>Sr.No.</th>
												<th>Req ID</th>
												<th>Date of Deposit</th>
												<th>Company Account</th>
												<th>Payment Method</th>
												<th>Ref No</th>
												<th>Requested Amount</th>
												<th>Remarks</th>
												<th>Status</th>
											</tr>														
										</thead>
										<tbody>
									<?php 
										include '../_common-retail.php';
										include '../functions/_ShowAdminBankClient.php';
										
										$query="SELECT * FROM child_wallet_requests where user_id=$user_id $cond order by request_id desc limit 0,50";
										$result=mysql_query($query);
										$num_rows = mysql_num_rows($result);	
										if($num_rows>0)
										{				
											$i=0;
											//$userstatus="";
											while($rs = mysql_fetch_assoc($result)) {
											$i++;
											if($i%2!=0)
											$style="style='background-color:white;'";
											else
											$style="style='background-color:#e5e5e5;'";
											
											$pm="";
											if($rs['payment_mode']==1)
											$pm="Demand Draft";
											else if($rs['payment_mode']==2)
											$pm="Cheque";
											else if($rs['payment_mode']==3)
											$pm="NEFT / RTGS";
											else if($rs['payment_mode']==4)
											$pm="IMPS";
											else if($rs['payment_mode']==5)
											$pm="Cash Deposit";
											else if($rs['payment_mode']==6)
											$pm="CDM - Cash Deposit Machine";
											else if($rs['payment_mode']==7)
											$pm="Cash Value";
											else if($rs['payment_mode']==8)
											$pm="Advance Value";
											
											$st="";
											if($rs['request_status']==1)
											$st="Sent";
											else if($rs['request_status']==2)
											$st="Accepted";
											else if($rs['request_status']==3)
											$st="Rejected";
										
											$remarks=explode(" by ",$rs['remarks'])[0];
											
											if($rs['bank_id']<100000)
											$bnk=show_admin_bank_client(1001,$rs['bank_id']);
											else
											$bnk=$rs['bank_id'];
											
									?>
												<tr <?php echo $style;?>>
													<td><?php echo $i;?></td>
													<td><?php echo $rs['request_id'];?></td>
													<td><?php echo $rs['deposite_date'];?></td>
													<td><?php echo $bnk;?></td>
													<td><?php echo $pm;?></td>
													<td><?php echo $rs['ref_no'];?></td>
													<td><?php echo $rs['deposit_amount'];?></td>
													<td><?php echo $remarks;?></td>
													<td><?php echo $st;?></td>
												</tr>
									<?php
											}
										}
										else
										{
									?>
												<tr>
													<td colspan="9">No Records Available</td>
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
