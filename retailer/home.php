<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php include('_head-tag.php'); ?>
		<meta http-equiv='refresh' content='15'>
	</head>
	<body class="cyan-scheme">
		<div id="form1">

			<!--Page load animation-->
		 
			<div class="wrapper vertical-sidebar" id="full-page">
				<?php include('_nav-menu.php'); ?>
				
				<main id="content">
					<div id="page-content">

						<div class="row section-header">
							 <div class="col l8 m6 s12">
							<h4 id="ContentPlaceHolder1_welcomeMessage" class="page-title">Welcome, <?php echo $user_name; ?> !</h4>
								 </div>
							 <div class="col l4 m6 s12" style="text-align:right;">
								 <img src="../img/payone-logo-my.png" style="max-height:70px;" />
								 </div>
						</div>
						<div class="row content-container general">
							<div class="row">
								<div class="col l3 m6 s12">
									<div class=" small-chart card margin" id="small-chart2" style="background: linear-gradient(to right, rgb(54, 122, 189) 50%, rgba(54, 122, 189, 0.8) 50%);">
										<div class="col l6 m6 s6 scc">
											<div id="smc2">
												<i class="fa fa-money fa-4x"></i>
											</div>
										</div>
										<div class="col l6 m6 s6 sct">
											<small>My Balance</small>
											<h2 id="ContentPlaceHolder1_myBal" class="count"><?php echo $wallet_balance;?></h2>
										</div>
									</div>
								</div>

								<div class="col l3 m6 s12">
									<div class="small-chart card margin" id="small-chart4" style="background: linear-gradient(to right, rgb(176, 46, 103) 50%, rgba(176, 46, 103, 0.8) 50%);">
										<div class="col l6 m6 s6 scc">
											<div id="smc4">
												<i class="fa fa-credit-card fa-4x"></i>
											</div>
										</div>
										<div class="col l6 m6 s6 sct">
											<small>MoneyTransfer</small>
											<h2 id="ContentPlaceHolder1_moneyTransfer">Active</h2>
										</div>
									</div>
								</div>

								<div class="col l3 m6 s12">
									<div class="small-chart card margin" id="small-chart3" style="background: linear-gradient(to right, rgb(255, 165, 0) 50%, rgba(255, 165, 0, 0.8) 50%);">
										<div class="col l6 m6 s6 scc">
											<div id="smc3">
												<i class="fa fa-inr fa-4x"></i>
											</div>
										</div>
										<div class="col l6 m6 s6 sct">
											<small>UnPaidComm.</small>
											<?php
											$qry1="SELECT sum(cr) as comm FROM main_commission_paid where user_id=$user_id;";
											$res1=mysql_query($qry1);
											$comm=0;
											while($rs1=mysql_fetch_assoc($res1))
											{
												$comm=$rs1['comm'];
											}
											
											$earn=0;
											$qry2="SELECT sum(dr) as earn FROM main_commission_paid where user_id=$user_id;";
											$res2=mysql_query($qry2);
											$earn=0;
											while($rs2=mysql_fetch_assoc($res2))
											{
												$earn=$rs2['earn'];
											}
											
											$unpaid=$comm-$earn;
											?>
											<h2 id="ContentPlaceHolder1_moneyTransfer" class="count"><?php echo $unpaid?></h2>
										</div>
									</div>
								</div>

								<div class="col l3 m6 s12">
									<div class="small-chart card margin" id="small-chart3" style="background: linear-gradient(to right, rgb(136, 197, 66) 50%, rgba(136, 197, 66, 0.8) 50%);">
										<div class="col l6 m6 s6 scc">
											<div id="smc3">
												<i class="fa fa-inr fa-4x"></i>
											</div>
										</div>
										<div class="col l6 m6 s6 sct">
											<small>My Earnings</small>
											<h2 id="ContentPlaceHolder1_moneyTransfer" class="count"><?php echo $earn?></h2>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row content-container elements">
							<h5>Today's Transactions</h5>
							<?php 
								include '../_common-retail.php';
								
								$query="SELECT eko_transaction_status,count(*) num,sum(amount) amt FROM main_transaction_mt where user_id='$user_id' and date(created_on)='$date_time' group by eko_transaction_status";
								$result=mysql_query($query);
								$num_rows = mysql_num_rows($result);	
								$trs_num=0;
								$inp_num=0;
								$prf_num=0;
								$rfs_num=0;
								$trs_amt=0;
								$inp_amt=0;
								$prf_amt=0;
								$rfs_amt=0;
								if($num_rows>0)
								{
									while($rs=mysql_fetch_array($result))
									{
										if($rs['eko_transaction_status']==2)
										{
											$trs_num=$rs['num'];
											$trs_amt=$rs['amt'];
										}
										else if($rs['eko_transaction_status']==0 || 
										$rs['eko_transaction_status']==1 || 
										$rs['eko_transaction_status']==3 || 
										$rs['eko_transaction_status']==6)
										{
											$inp_num=$rs['num'];
											$inp_amt=$rs['amt'];
										}
										else if($rs['eko_transaction_status']==4)
										{
											$prf_num=$rs['num'];
											$prf_amt=$rs['amt'];
										}
										else if($rs['eko_transaction_status']==5)
										{
											$rfs_num=$rs['num'];
											$rfs_amt=$rs['amt'];
										}
									}
								}
							?>
							<table class='responsive-table striped table-bordered'>
								<thead>
									<tr>
										<th style='font-size:18px!important;'>Status</th>
										<th style='font-size:18px!important;'>Successful</th>
										<th style='font-size:18px!important;'>In Progress</th>
										<th style='font-size:18px!important;'>Pending Refund</th>
										<th style='font-size:18px!important;'>Refunded</th>
									</tr>														
								</thead>
								<tbody>
									<tr>
										<th style='font-size:18px!important;'>Amount</th>
										<td style='font-size:18px!important;'><a href='transactions.php'><?php echo $trs_amt;?></a></td>
										<td style='font-size:18px!important;'><a href='transactionp.php'><?php echo $inp_amt;?></a></td>
										<td style='font-size:18px!important;'><a href='fund-refund.php'><?php echo $prf_amt;?></a></td>
										<td style='font-size:18px!important;'><a href='fund-refund.php'><?php echo $rfs_amt;?></a></td>
									</tr>
									<tr>
										<th style='font-size:18px!important;'>Orders</th>
										<td style='font-size:18px!important;'><a href='transactions.php'><?php echo $trs_num;?></a></td>
										<td style='font-size:18px!important;'><a href='transactionp.php'><?php echo $inp_num;?></a></td>
										<td style='font-size:18px!important;'><a href='fund-refund.php'><?php echo $prf_num;?></a></td>
										<td style='font-size:18px!important;'><a href='fund-refund.php'><?php echo $rfs_num;?></a></td>
									</tr>
								</tbody>
							</table>
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
			
			<script src="../js/Chart.bundle.min.js"></script>
			<script>

			 

				
				

				$(document).ready(function () {


					setTimeout(function () {
						showYearlyChart();
						showDistanceChart();
					}, 500);

					//setactiveClass("dashBoard");

					try{drawChart();}catch(Error){}

					try{drawChart2();}catch(Error){}

					$('.count').each(function () {
						$(this).prop('Counter',0).animate({
							Counter: $(this).text()
						}, {
							duration: 2000,
							easing: 'swing',
							step: function (now) {
								$(this).text(Math.round(now * 100) /100);
							}
						});
					});

					
					$('.count2').each(function () {
						$(this).prop('Counter',0).animate({
							Counter: $(this).text()
						}, {
							duration: 2000,
							easing: 'swing',
							step: function (now) {
								$(this).text((Math.ceil(now)) + "%");
							}
						});
					});
				});

				function drawChart() {
				  

					try{
						var barData = Saurabh;

						

						var context = document.getElementById('clients').getContext('2d');
						//  var clientsChart = new Chart(context).Bar(barData);
						var clientsChart = new Chart(context, {
							type: 'bar',
							data: barData,
							options: {
								scales: {
									yAxes: [{
										ticks: {
											beginAtZero: true
										}
									}]
								}
							}
						});
					} catch (error) {
						//alert(error);
					}
				};

			   function drawChart2() {
				  

					try{
						var barData2 = Saurabh;

						

						var context2 = document.getElementById('clients2').getContext('2d');
						//  var clientsChart = new Chart(context).Bar(barData);
						var clientsChart2 = new Chart(context2, {
							type: 'bar',
							data: barData2,
							options: {
								scales: {
									yAxes: [{
										ticks: {
											beginAtZero: true
										}
									}]
								}
							}
						});
					} catch (error) {
					   // alert(error);
					}
				};

			</script>
		</div>
	</body>
</html>
