<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php include('_head-tag.php'); ?>
		<meta http-equiv='refresh' content='5'>
		<script language="javascript" type="text/javascript">
		function clearother(vals)
		{
			var a=document.getElementById("a").value;
			var b=document.getElementById("b").value;
			var c=document.getElementById("c").value;
			if(vals==1)
			{
				document.getElementById("b").value='';
				document.getElementById("c").value='';
			}
			else if(vals==2)
			{
				document.getElementById("c").value='';
				document.getElementById("a").value='';
			}
			else if(vals==3)
			{
				document.getElementById("a").value='';
				document.getElementById("b").value='';
			}
			
		}
		</script>
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
                        <h5><i class="fa fa-search fa-1x"></i> Pending Transactions (Money Transfer)</h5>
                        <br><a href="transactions.php" style="float:left;" class="waves-effect waves-light btn white-text green margin-bottom-10 ladda-button">Show All Txn Money Transfer</a>
                        <a href="transactionrc.php" style="float:right;" class="waves-effect waves-light btn white-text green margin-bottom-10 ladda-button">Show All Txn Recharge</a><br><br>
                    </div>
                    <div class="card-action">

                        <div class="row" id="oneStep">

                            <div class="col l12 m12 s12 pad-10">
                                <div id="ContentPlaceHolder1_myMarginSet">
									<table class='responsive-table striped table-bordered'> 
											<thead>
												<tr>
													<th>Txn No<br>(Order No)</th>
													<th>Date Time</th>
													<th>Product Name</th>
													<th>Remitter</th>
													<th>Recipient</th>
													<th>Method/Bank/AccNo</th>
													<th>Amount<br>Charges<br>Total</th>
													<th>Status</th>
												</tr>														
											</thead>
											<tbody>
											<?php
											$gid="";
											
											$cond="";
											if($gid!="")
											$cond=" and field='value' ";
											$query="SELECT * from main_transaction_mt where user_id=$user_id and eko_transaction_status not in(2,5) and type=1 $cond order by eko_transaction_id desc";
											$result=mysql_query($query);
											$num_rows = mysql_num_rows($result);	
											if($num_rows>0)
											{
												while($rs = mysql_fetch_assoc($result))
												{
													$status=$rs['eko_transaction_status'];
													if($status==0)
													{
														$status="Not Initiated";
													}
													else if($status==1)
													{
														$status="<i style='color:#cc5801;'>Initiated</i>";
													}
													else if($status==2)
													{
														$status="<i style='color:green;'>Success</i>";
													}
													else if($status==3 || $status==-1)
													{
														$status="<i style='color:blue;'>In Progress</i>";
													}
													else if($status==4)
													{
														$status="<i style='color:red;'>Refund Pending</i>";
													}
													else if($status==5)
													{
														$status="<i style='color:blue;'>Refunded</i>";
													}
													else
													{
														$status="Awating Response";
													}
													
													$receiver_number=$rs['receiver_id'];
													
													$query2="SELECT * FROM eko_receiver where receiver_id='$receiver_number'";
													$result2=mysql_query($query2);
													while($rs2 = mysql_fetch_assoc($result2))
													{
														$receiver_number=$rs2['receiver_number'];
													}
													$response_message=$rs['response_message'];
													$response_message=str_replace(" Last_used_OkeyKey: 233","",$response_message);
													if(trim($response_message)=="Transaction successful" || $response_message=="Transaction successful Last_used_OkeyKey: 235")
													{
														$response_message=$rs['tid'];
													}
													
													$bank="".$rs['channel_desc'];
													$bank="$bank<br><br>".$rs['rbname'];
													//$bank="$bank<br><br>IFSC: <b>".$rs['rifsc']."</b>";
													$bank="$bank<br><br>ACC.NO.: <b>".$rs['racc']."</b>";
											?>
												<tr>
													<td><?php echo $rs['group_id']."<br>(".$rs['eko_transaction_id'].")";?></td>
													<td><?php echo $rs['updated_on'];?></td>
													<td>Money Transfer</td>
													<td><?php echo $rs['sender_number']."<br><br>".$rs['sname']."</b>";?></td>
													<td><?php echo $rs['receiver_number']."<br><br>".$rs['rname']."</b>";?></td>
													<td><?php echo $bank;?></td>
													<td style='text-align:right;'><?php echo $rs['amount'];?><br><?php echo $rs['com_charged'];?><br><b><?php echo $rs['deducted'];?></b></td>
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
				
				<div class="messageBox">
                <div class="card ">
                    <div class="card-content">
                        <h5><i class="fa fa-search fa-1x"></i> Pending Transactions (Recharge)</h5>
                    </div>
                    <div class="card-action">

                        <div class="row" id="oneStep">

                            <div class="col l12 m12 s12 pad-10">
                                <div id="ContentPlaceHolder1_myMarginSet">
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
											$gid="";
											
											$cond="";
											if($gid!="")
											$cond=" and field='value' ";
											$query="SELECT * FROM main_transaction_rc where user_id=$user_id and rc_status not in(2,5) $cond order by rc_id desc";
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
