<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<script>window.location.href='home.php';</script>
		<?php include('_head-tag.php'); ?>
		<!--
		<script type="text/javascript" src="../js/admin-validation-functions.js"></script>
		<script type="text/javascript" src="../js/admin-validations-applied.js"></script>
		-->
		<script>
		function clearother1(vals)
		{
			var a=document.getElementById("a1").value;
			var b=document.getElementById("b1").value;
			var c=document.getElementById("c1").value;
			if(vals==1)
			{
				document.getElementById("b1").value='';
				document.getElementById("c1").value='';
			}
			else if(vals==2)
			{
				document.getElementById("c1").value='';
				document.getElementById("a1").value='';
			}
			else if(vals==3)
			{
				document.getElementById("a1").value='';
				document.getElementById("b1").value='';
			}
			
		}
		function clearother2(vals)
		{
			var a=document.getElementById("a2").value;
			var b=document.getElementById("b2").value;
			var c=document.getElementById("c2").value;
			if(vals==1)
			{
				document.getElementById("b2").value='';
				document.getElementById("c2").value='';
			}
			else if(vals==2)
			{
				document.getElementById("c2").value='';
				document.getElementById("a2").value='';
			}
			else if(vals==3)
			{
				document.getElementById("a2").value='';
				document.getElementById("b2").value='';
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
                        <h5><i class="fa fa-inr fa-1x"></i> My Refunds (Pending)</h5>
                    </div>
                    <div class="card-action">

                        <div class="row" id="oneStep">

                            <div class="col l12 m12 s12 pad-10">
                                <div id="ContentPlaceHolder1_myMarginSet">
									<form method="post" onsubmit="return retailer_trans_search()">
									<?php
									$s1="";
									$s2="";
									$s3="";
									$cond=" ";
									if(isset($_POST['submit1']) && isset($_POST['a']))
									{
										$s1=$_POST['a'];
										if($s1!="")
										$cond=" and eko_transaction_id=$s1 ";
									}
									if(isset($_POST['submit1']) && isset($_POST['b']))
									{
										$s2=$_POST['b'];
										if($s2!="")
										$cond=" and sender_number=$s2 ";
									}
									if(isset($_POST['submit1']) && isset($_POST['c']))
									{
										$s3=$_POST['c'];
										if($s3!="")
										$cond=" and tid=$s3 ";
									}
									?>
									<table>
										<tr>
											<td width='250'><input type='number' id='a1' value="<?php echo $s1;?>" onkeyup='clearother1(1)' name='a' placeholder='Order No'/></td>
											<td width='250'><input type='number' id='b1' value="<?php echo $s2;?>" onkeyup='clearother1(2)' name='b' placeholder='Remitter Mobile No'/></td>
											<td width='250'><input type='number' id='c1' value="<?php echo $s3;?>" onkeyup='clearother1(3)' name='c' placeholder='Txn No'/></td>
											<td><input class="btn btn-block btn-danger" type="submit" name='submit1' value='Search'/></td>
										</tr>
									</table>
									</form>
									<table class='responsive-table striped table-bordered'> 
											<thead>
												<tr>
													<th>Order No</th>
													<th>Date Time</th>
													<th>Product Name</th>
													<th>Remitter</th>
													<th>Recipient</th>
													<th>Amount</th>
													<th>Charges</th>
													<th>Total</th>
													<th>Status</th>													
													<th>Txn No</th>													
													<th>Action</th>
												</tr>														
											</thead>
											<tbody>
											<?php
											$query="SELECT * FROM main_transaction_mt where user_id=$user_id and eko_transaction_status=4 $cond order by eko_transaction_id desc";
											$result=mysql_query($query);
											$num_rows = mysql_num_rows($result);	
											if($num_rows>0)
											{
												while($rs = mysql_fetch_assoc($result))
												{
													$status=$rs['eko_transaction_status'];
													if($status==0)
													$status="Not Initiated";
													else if($status==1)
													$status="<i style='color:#cc5801;'>Initiated</i>";
													else if($status==2)
													$status="<i style='color:green;'>Success</i>";
													else if($status==3)
													$status="<i style='color:blue;'>In Progress</i>";
													else if($status==4)
													$status="<i style='color:red;'>Failed</i>";
													else if($status==5)
													$status="<i style='color:blue;'>Refunded</i>";
													else
													$staus="UNKNOWN";
													
													$receiver_number=$rs['receiver_id'];
													
													$query2="SELECT * FROM eko_receiver where receiver_id='$receiver_number'";
													$result2=mysql_query($query2);
													while($rs2 = mysql_fetch_assoc($result2))
													{
														$receiver_number=$rs2['receiver_number'];
													}
													$response_message=$rs['response_message'];
													$response_message=str_replace(" Last_used_OkeyKey: 233","",$response_message);
													if($response_message=="Transaction successful" || $response_message="Success!trxn.status.enq.successful")
													{
														$response_message=$rs['tid'];
													}
											?>
												<tr>
													<td><?php echo $rs['eko_transaction_id'];?></td>
													<td><?php echo $rs['created_on'];?></td>
													<td>Money Transfer</td>
													<td><?php echo $rs['sender_number'];?></td>
													<td><?php echo $receiver_number;?></td>
													<td><?php echo $rs['amount'];?></td>
													<td><?php echo $rs['com_charged'];?></td>
													<td><?php echo $rs['deducted'];?></td>
													<td><?php echo $status;?></td>
													<td><?php echo $response_message;?></td>
													<td><a href="refund-transaction.php?order=<?php echo $rs['eko_transaction_id'];?>&txn=<?php echo $response_message;?>" class="btn green">Refund</a></td>
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
				<div class="card ">
                    <div class="card-content">
                        <h5><i class="fa fa-inr fa-1x"></i> My Refunds (Completed)</h5>
                    </div>
                    <div class="card-action">

                        <div class="row" id="oneStep">

                            <div class="col l12 m12 s12 pad-10">
                                <div id="ContentPlaceHolder1_myMarginSet">
									<form method="post" onsubmit="return retailer_trans_search()">
									<?php
									$s1b="";
									$s2b="";
									$s3b="";
									$condb=" ";
									if(isset($_POST['submit2']) && isset($_POST['a']))
									{
										$s1b=$_POST['a'];
										if($s1b!="")
										$condb=" and eko_transaction_id=$s1b ";
									}
									if(isset($_POST['submit2']) && isset($_POST['b']))
									{
										$s2b=$_POST['b'];
										if($s2b!="")
										$condb=" and sender_number=$s2b ";
									}
									if(isset($_POST['submit2']) && isset($_POST['c']))
									{
										$s3b=$_POST['c'];
										if($s3b!="")
										$condb=" and tid=$s3b ";
									}
									?>
									<table>
										<tr>
											<td width='250'><input type='number' id='a2' value="<?php echo $s1b;?>" onkeyup='clearother2(1)' name='a' placeholder='Order No'/></td>
											<td width='250'><input type='number' id='b2' value="<?php echo $s2b;?>" onkeyup='clearother2(2)' name='b' placeholder='Remitter Mobile No'/></td>
											<td width='250'><input type='number' id='c2' value="<?php echo $s3b;?>" onkeyup='clearother2(3)' name='c' placeholder='Txn No'/></td>
											<td><input class="btn btn-block btn-danger" type="submit" name='submit2' value='Search'/></td>
										</tr>
									</table>
									</form>
									<table class='responsive-table striped table-bordered'> 
											<thead>
												<tr>
													<th>Txn No</th>
													<th>Order No</th>
													<th>Date Time</th>
													<th>Product Name</th>
													<th>Remitter</th>
													<th>Recipient</th>
													<th>Amount</th>
													<th>Charges</th>
													<th>Total</th>
													<th>Status</th>	
													<th>Wallet Id</th>
												</tr>
											</thead>
											<tbody>
											<?php
											$query="SELECT * FROM main_transaction_mt where user_id=$user_id and eko_transaction_status=5 $condb order by eko_transaction_id desc limit 0,50";
											$result=mysql_query($query);
											$num_rows = mysql_num_rows($result);	
											if($num_rows>0)
											{
												while($rs = mysql_fetch_assoc($result))
												{
													$wallet_id=$rs['refund_cid'];
													$status=$rs['eko_transaction_status'];
													if($status==0)
													$status="Not Initiated";
													else if($status==1)
													$status="<i style='color:#cc5801;'>Initiated</i>";
													else if($status==2)
													$status="<i style='color:green;'>Success</i>";
													else if($status==3)
													$status="<i style='color:blue;'>In Progress</i>";
													else if($status==4)
													$status="<i style='color:red;'>Failed</i>";
													else if($status==5)
													$status="<i style='color:blue;'>Refunded</i>";
													else
													$staus="UNKNOWN";
													
													$receiver_number=$rs['receiver_id'];
													
													$query2="SELECT * FROM eko_receiver where receiver_id='$receiver_number'";
													$result2=mysql_query($query2);
													while($rs2 = mysql_fetch_assoc($result2))
													{
														$receiver_number=$rs2['receiver_number'];
													}
													$response_message=$rs['response_message'];
													$response_message=str_replace(" Last_used_OkeyKey: 233","",$response_message);
													if($response_message=="Transaction successful" || $response_message="Success!trxn.status.enq.successful")
													{
														$response_message=$rs['tid'];
													}
													
													$pname="";
													if($rs['type']==1)
														$pname="Money Transfer";
													else if($rs['type']==2)
														$pname="Account Verification";
											?>
												<tr>
													<td><?php echo $rs['group_id'];?></td>
													<td><?php echo $rs['eko_transaction_id'];?></td>
													<td><?php echo $rs['created_on'];?></td>
													<td><?php echo $pname;?></td>
													<td><?php echo $rs['sender_number'];?></td>
													<td><?php echo $receiver_number;?></td>
													<td><?php echo $rs['amount'];?></td>
													<td><?php echo $rs['com_charged'];?></td>
													<td><?php echo $rs['deducted'];?></td>
													<td><?php echo $status;?></td>
													<td><?php echo $wallet_id;?></td>
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
