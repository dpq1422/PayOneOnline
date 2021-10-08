<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head id="ctl00_Head1"><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<?php include '_head-tag.php'; ?>
	</head>
	<body><!--oncontextmenu="return false"-->
		<div class="container-fluid">
			<div class="col-md-12">
				<div class="col-sm-12 col-md-12 col-xs-12 col-comn" style="box-shadow: 0 0 3px #c9c9c9;
					padding: 0px">
					<?php include '../_logged-user-info.php'; ?>
					<?php include '_nav-menu.php'; ?>
					<div class="row">
						<div class="col-sm-12">
							<div class="col-md-3">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Today&quot;s Opening Balance
									</div>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures">2,08,537</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Today&quot;s Wallet Update
									</div>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures">4,25,000</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Today&quot;s Transactions
									</div>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures">1,23,000</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Current Wallet Balance
									</div>
									<div class="panel-body panel-primary text-center">
										<div class="high-light-figures">5,10,537</div>
									</div>
								</div>
							</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-12">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Admin Wallet History
									</div>
									<div class="panel-body panel-primary text-left">
										Search by 
										<input size="25" placeholder="Request ID / Wallet ID"/>
										&nbsp;&nbsp;&nbsp;Period <input type="date" /> to <input type="date" />
										&nbsp;&nbsp;&nbsp;
										<select>
											<option>Transaction Type</option>
											<option>Manual Add</option>
											<option>Manual Withdraw</option>
											<option>Wallet Request</option>
										</select>&nbsp;&nbsp;&nbsp;
										<select>
											<option>Status</option>
											<option>Success</option>
											<option>Failed</option>
											<option>Charge Back</option>
										</select>&nbsp;&nbsp;&nbsp;
										<input type="submit" value="Search" />
									</div>
									<div class="panel-body panel-primary text-center">
										<table class="table clsgrid rounded_corners" cellspacing="0" rules="all" border="1" id="ctl00_ContentPlaceHolder1_tagcost" style="width:100%;border-collapse:collapse;font-family:Calibri;font-weight:500;">
				<tbody><tr class="gridheader" align="center" style="background-color:#009DE2;">
					<th>S.No.</th><th>Request Sent Date Time / User ID / User Name</th><th>Request ID</th><th>Wallet ID</th><th>Transaction Type</th><th>Amount</th><th>Status</th>
				</tr><tr style="background-color:White;">
					<td>1</td><td>12-March-2015 11:55:53 by User ID / User Name</td><td>123</td><td>12345-14152</td><td>Manual Add</td><td>1500</td><td>Success</td>
				</tr><tr style="background-color:White;">
					<td>2</td><td>12-March-2015 11:55:53 by User ID / User Name</td><td>345</td><td>41598-74589</td><td>Wallet Request</td><td>2500</td><td>Success</td>
				</tr><tr style="background-color:White;">
					<td>3</td><td>12-March-2015 11:55:53 by User ID / User Name</td><td>456</td><td></td><td>Wallet Request</td><td>2500</td><td>Failed</td><tr style="background-color:White;">
					<td>4</td><td>12-March-2015 11:55:53 by User ID / User Name</td><td>567</td><td>95462-25642</td><td>Manual Withdraw</td><td>132</td><td>Charge Back</td>
				</tr><tr style="background-color:White;">
					<td>5</td><td>12-March-2015 11:55:53 by User ID / User Name</td><td>456</td><td>95462-25642</td><td>Charge Back</td><td>132</td><td>Success</td>
				</tr><tr style="background-color:White;">
					<td>6</td><td>12-March-2015 11:55:53 by User ID / User Name</td><td>567</td><td>95462-25642</td><td>Charge Back</td><td>132</td><td>Success</td>
				</tr>
			</tbody></table>
									</div>
									<div class="panel-body panel-primary text-right">
										<a href="#"><<</a> Page <b>1</b> of 20 <a href="#">>></a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php include '_footer.php'; ?>
				</div>
			</div>
		</div>
	</body>
</html>
