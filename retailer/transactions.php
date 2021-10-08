<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php include('_head-tag.php'); ?>
		<script language="javascript" type="text/javascript">
		function prints(multiple)
		{
				window.open('prints.php?result='+multiple,'Print Receipt','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=600,height=800');
		}
		function printers(multiple)
		{
				window.open('printers.php?result='+multiple,'Print Receipt','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=600,height=800');
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
                        <h5><i class="fa fa-search fa-1x"></i> Transactions</h5>
                        <marquee style='color:green;font-weight:bold;'>Now you can search money transfer transaction by Sender's Number, Beneficiary's Number, Beneficiary's Bank Account No.</marquee>
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
										$cond=" and bulk_id=$s1 ";
									}
									if(isset($_POST['b']))
									{
										$s2=$_POST['b'];
										if($s2!="")
										$cond=" and (sender=$s2 or receiver=$s2 or racc=$s2) ";
									}
									if(isset($_POST['c']))
									{
										$s3=$_POST['c'];
										if($s3!="")
										$cond=" and date(date_time)='$s3' ";
										$dwn_link="?dwndts=$s3";
									}
									?>
										<tr>
											<td width='100'><input type='number' id='a' onclick='document.getElementById("b").value="";document.getElementById("c").value="";' value="<?php echo $s1;?>" name='a' placeholder='Txn No'/></td>
											<td width='100'><input type='date' id='c' onclick='document.getElementById("a").value="";document.getElementById("b").value="";' value="<?php echo $s3;?>" name='c' placeholder='Date'/></td>
											<td width='300'><input type='number' id='b' onclick='document.getElementById("a").value="";document.getElementById("c").value="";' value="<?php echo $s2;?>" name='b' placeholder='Mobile No / Acc No'/></td>
											<td><input class="btn btn-block btn-danger" type="submit" name='submit' value='Search'/></td>
											<td><a href="download-transactions.php<?php echo $dwn_link;?>" class="btn green" >Download</a></td>
										</tr>
									</table>
									</form>
									<table class='responsive-table striped table-bordered'> 
											<thead>
												<tr>
													<th>Txn No</th>
													<th>Date Time</th>
													<th>Product Name</th>
													<th>Remitter</th>
													<th>Recipient</th>
													<th>Method/Bank/AccNo</th>
													<th>Previous<br>Balance</th>
													<th>Amount<br>Charges<br>Total</th>
													<th>Balance</th>
													<th width='105'>Action</th>
												</tr>														
											</thead>
											<tbody>
											<?php
											$query="SELECT * FROM main_transaction_mt_bulk where retailer_id=$user_id $cond order by bulk_id desc limit 0,50";
											$result=mysql_query($query);
											$num_rows = mysql_num_rows($result);	
											if($num_rows>0)
											{
												while($rs = mysql_fetch_assoc($result))
												{
													$gids=$rs['bulk_id'];
													$senderid="";
													$receiverid="";
													$senderid=$rs['sender'];
													$receiverid=$rs['receiver'];
													
													$rid="";													
													$bank="";
													$method="";

													$qry222="select * from main_transaction_mt where group_id='$gids';";
													$result222=mysql_query($qry222);
													while($rs222 = mysql_fetch_assoc($result222))
													{
														$rid=$rs222['receiver_id'];
														$method=$rs222['channel_desc'];
														$product=$rs222['type'];
														break;
													}			
													
													$senderid=$senderid."<br><br>".$rs['sname']."</b>";
																							
													
													$receiverid=$receiverid."<br><br>".$rs['rname']."</b>";
													$bank="".$method;
													$bank="$bank<br><br>".$rs['rbname'];
													//$bank="$bank<br><br>IFSC: <b>".$rs['rifsc']."</b>";
													$bank="$bank<br><br>ACC.NO.: <b>".$rs['racc']."</b>";
													
													if($product==1)
														$product="Money Transfer";
													else if($product==2)
														$product="Account Verification";
											?>
												<tr>
													<td><?php echo $rs['bulk_id'];?></td>
													<td><?php echo $rs['date_time'];?></td>
													<td><?php echo $product;?></td>
													<td><?php echo $senderid;?></td>
													<td><?php echo $receiverid;?></td>
													<td><?php echo $bank;?></td>
													<td><?php echo $rs['pre_bal'];?></td>
													<td style='text-align:right;'><?php echo $rs['amount'];?><br><?php echo $rs['com_charged'];?><br><?php echo "<b>".$rs['deducted']."</b>";?></td>
													<td><?php echo $rs['post_bal'];?></td>
													<td>
														<a href='transaction.php?gid=<?php echo $rs['bulk_id'];?>'>Show</a>
											<?php
											if($rs['pre_bal']!=$rs['post_bal'])
											{
												if($rs['gst_charged']==0 && $rs['com_earned']==0)
												{
											?>
														<img src='../img/print.png' 
														onclick='printers("<?php echo $rs['bulk_id'];?>")' style='margin:-2px 0px;' height='16' title='Print'/>
											<?php
												}
												else
												{
											?>
														<img src='../img/print.png' 
														onclick='prints("<?php echo $rs['bulk_id'];?>")' style='margin:-2px 0px;' height='16' title='Print'/>
											<?php
												}
											}
											?>
													</td>
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
