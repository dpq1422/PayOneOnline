<?php
//header('location:../logout.php');
$online_url=$_SERVER['HTTP_HOST'];
if($user_id=="100001")
{
?>
								<div style="clear:both"></div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-comn">
									<!--<div class="navbar navbar-default" role="navigation">
										<div class="navbar-header" style="width:100%;">-->
										<marquee style="color:red;padding:.5% 1%;width:96%;font-weight:bold;" scrolldelay="120">Dear Partner, ICICI Bank Account is closed now. Use only SBI Account for depost / transfer money for fast processing of LIMIT.</marquee>
										<!--</div>
									</div>-->
								</div>
								<div style="clear:both"></div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-comn" style="height:10px;background:#ffffff;">
									<div class="navbar navbar-default" role="navigation">
										<div class="navbar-header">
										</div>
									</div>
								</div>
								<div style="clear:both"></div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-comn">
									<div class="navbar navbar-default" role="navigation">
										<div class="navbar-header">
											<a class="navbar-brand" href="#"></a>
											<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
												<span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span><span
													class="icon-bar"></span><span class="icon-bar"></span>
											</button>
										</div>
										<nav class="collapse navbar-collapse no-print" id="navbar">
											<ul class="nav navbar-nav" id="menu">
												<li><a href='home.php'><span class="menu">Dashboard</span></a></li>
												<li><a href='' class="dropdown-toggle" data-toggle="dropdown">User
													<b class="caret"></b></a>
													<ul class="dropdown-menu">
														 <li><a href='users.php'>List of User</a></li>
														 <li><a href='user.php'>Create User</a></li>
														 <li><a href='margin.php'>My Margin</a></li>
														 <li><a href='hierarchys.php'>List of Hierarchy</a></li>
														 <li><a href='hierarchy.php'>Create Hierarchy</a></li>
														 <!--<li><a href='employees.php'>List of Employee</a></li>-->
													</ul>
												</li>
												<li><a href='' class="dropdown-toggle" data-toggle="dropdown">Members
													<b class="caret"></b></a>
													<ul class="dropdown-menu">
														 <li><a href='kyc-status.php'>KYC Status</a></li>
														 <li><a href='distributors.php'>List of Team</a></li>
														 <li><a href='distributor.php'>Add Team</a></li>
														 <!--<li><a href=''>MAP Commission (New)</a></li>
														 <li><a href=''>Re-ordering and MAP</a></li>-->
													<!--</ul>
												</li>
												<li><a href='' class="dropdown-toggle" data-toggle="dropdown">Retailer
													<b class="caret"></b></a>
													<ul class="dropdown-menu">-->
														 <li><a href='retailers.php'>List of Retailer</a></li>
														 <li><a href='retailer.php'>Add Retailer</a></li>
														 <!--<li><a href='retailers-edit.php'>Edit Retailer</a></li>
														 <li><a href=''>Re-ordering and MAP</a></li>-->
													</ul>
												</li>
												<li><a href='' class="dropdown-toggle" data-toggle="dropdown">Services
													<b class="caret"></b></a>
													<ul class="dropdown-menu">
														 <!--<li><a href=''>Set Auto Commission Dates</a></li>-->
														 <?php
														 /*
														 include('../functions/_ShowServiceTypeName.php');
														 for($stp=0;$stp<count($ssc);$stp++)
														 {
															$sscv=$ssc[$stp];
															$sscn=show_service_type_name($sscv);										
														 ?>
														 <li><a href='commission-show-<?php echo $sscv;?>.php'>Show Comm. or Charges - <?php echo $sscn;?></a></li>
														 <?php
														 }
														 */
														 ?>
														 <li><a href='transactions-in-progress.php'>Transaction MT (In Progress)</a></li>
														 <li><a href='transactions-refund-pending.php'>Transaction MT (Refund Pending)</a></li>
														 <li><a href='admin-process-refund.php'>Process Refund MT</a></li>
														 <li><a href='transactions-orders.php'>Search Transaction MT</a></li>
														 <li><a href='transactions-orders-rc.php'>Search Transaction RC</a></li>
														 <li><a href='transactions-real-mt.php'>Transactions MT (Admin)</a></li>
														 <li><a href='transactions-real-rc.php'>Transactions RC (Admin)</a></li>
														 <li><a href='transactions-retailer-mt.php'>Transactions MT (Retailer)</a></li>
														 <li><a href='transactions-retailer-rc.php'>Transactions RC (Retailer)</a></li>
														 <li><a href='transactions-refunded-mt.php'>Transactions MT (Refunded)</a></li>
														 <li><a href='transactions-refunded-rc.php'>Transactions RC (Refunded)</a></li>
													</ul>
												</li>
												<li><a href='' class="dropdown-toggle" data-toggle="dropdown">Wallet
													<b class="caret"></b></a>
													<ul class="dropdown-menu">
														 <li><a href='wallet-status.php'>Wallet Status</a></li>
														 <li><a href='wallet-request-receiveds.php'>Wallet Request Received</a></li>
														 <li><a href='wallet-log-admin.php'>Wallet Transfers (Admin)</a></li>
														 <li><a href='wallet-log-team.php'>Wallet Transfers (Team)</a></li>
														 <li><a href='wallet-log-user.php'>Wallet History (User Wallet)</a></li>
														 <li><a href='wallet-request-sents.php'>Send Wallet Request</a></li>
													</ul>
												</li>
												<li><a href='' class="dropdown-toggle" data-toggle="dropdown">Support
													<b class="caret"></b></a>
													<ul class="dropdown-menu">
														 <!--<li><a href='report-bank.php'>Bank Details</a></li>-->
														 <li><a href='tickets.php'>Browse Ticket</a></li>
														 <li><a href='contact.php'>Contact Matrix</a></li>
														 <li><a href='bank-details.php'>My Banks</a></li>
													</ul>
												</li>
												<li><a href='' class="dropdown-toggle" data-toggle="dropdown">Turnover
													<b class="caret"></b></a>
													<ul class="dropdown-menu">
														 <li><a href='collection.php'>Team Work (Today)</a></li>
														 <li><a href='collections.php'>Team Work (All)</a></li>
														 <li><a href='commission-unpaid-team.php'>Team Commission</a></li>
														 <li><a href='reports.php'>Reports</a></li>
													</ul>
												</li>
												<li><a href='' class="dropdown-toggle" data-toggle="dropdown">Audit
													<b class="caret"></b></a>
													<ul class="dropdown-menu">
														 <li><a href='tally-sbi-bank.php'>Upload SBI Bank Txns</a></li>
														 <li><a href='tally-icici-bank.php'>Upload ICICI Bank Txns</a></li>
														 <li style='border-top:1px solid black;'><a href='tally-bank-requests.php'>Show Wallet Requests (cr update)</a></li>
														 <li><a href='tally-bank-transactions.php'>Show Bank Txns (cr update)</a></li>
														 <li><a href='tally-source-requests.php'>Show Source Requests (dr update)</a></li>
														 <li><a href='tally-comm-paids.php'>Show Comm. Paid (dr update)</a></li>
														 <li><a href='tally-charges-paids.php'>Show Bank Charges (dr update)</a></li>
														 <li style='border-top:1px solid black;'><a><b>Un-identified Records</b></a></li>
														 <li><a href='tally-bank-request.php'>Wallet Requests (cr)</a></li>
														 <li><a href='tally-bank-transaction.php'>Bank Txn (cr)</a></li>
														 <li><a href='tally-bank-transaction-debit.php'>Bank Txn (dr)</a></li>
														 <li><a href='tally-source-request.php'>Source Requests (dr)</a></li>
														 <li><a href='tally-comm-paid.php'>Comm. Paid (dr)</a></li>
														 <li><a href='tally-charges-paid.php'>Bank Charges (dr)</a></li>
													</ul>
												</li>
												<li><a href='../logout.php'><span class="menu">Logout</span></a></li>
											</ul>
										</nav>
									</div>
								</div>		
								<div style="clear:both"></div>
								<!-- Sub Menu Start -->
								<!--
								<div class="sub-menu-new col-sm-12 col-md-12 col-xs-12 .col-comn" style="height: 100px;background">
									<div class="sub-menu-new-box">
										<img src="img/home_32.png" /><br>Home
									</div>									
								</div>
								-->
								<!-- Sub Menu Finish -->
								<div class="col-sm-12 col-md-12 col-xs-12 .col-comn" style="height: 25px;">
								</div>
								<div style="clear:both"></div>
<?php
}
else if($online_url=="payoneonline.com" && $user_id=="100010")
{
?>
								<div style="clear:both"></div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-comn">
									<div class="navbar navbar-default" role="navigation">
										<div class="navbar-header" style="width:100%;">
										<marquee behavior="alternate" style="color:#ffffff;padding:.5% 1%;width:96%;font-weight:bold;" scrolldelay="120">NOTE: Server will be down for maintenance between 11PM to 3AM daily.</marquee>
										</div>
									</div>
								</div>
								<div style="clear:both"></div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-comn" style="height:10px;background:#ffffff;">
									<div class="navbar navbar-default" role="navigation">
										<div class="navbar-header">
										</div>
									</div>
								</div>
								<div style="clear:both"></div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-comn">
									<div class="navbar navbar-default" role="navigation">
										<div class="navbar-header">
											<a class="navbar-brand" href="#"></a>
											<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
												<span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span><span
													class="icon-bar"></span><span class="icon-bar"></span>
											</button>
										</div>
										<nav class="collapse navbar-collapse no-print" id="navbar">
											<ul class="nav navbar-nav" id="menu">
												<li><a href='home.php'><span class="menu">Dashboard</span></a></li>
												<li><a href='' class="dropdown-toggle" data-toggle="dropdown">Services
													<b class="caret"></b></a>
													<ul class="dropdown-menu">
														 <li><a href='kyc-status.php'>KYC Status</a></li>
														 <li><a href='transactions-in-progress.php'>Transaction MT (In Progress)</a></li>
														 <li><a href='transactions-refund-pending.php'>Transaction MT (Refund Pending)</a></li>
														 <li><a href='transactions-real-mt.php'>Transactions MT (Admin)</a></li>
														 <li><a href='transactions-real-rc.php'>Transactions RC (Admin)</a></li>
														 <li><a href='transactions-retailer-mt.php'>Transactions MT (Retailer)</a></li>
														 <li><a href='transactions-retailer-rc.php'>Transactions RC (Retailer)</a></li>
														 <li><a href='admin-process-refund.php'>Process Refund</a></li>
														 <li><a href='transactions-orders.php'>Search Transaction MT</a></li>
														 <li><a href='transactions-orders-rc.php'>Search Transaction RC</a></li>
														 <li><a href='transactions-refunded-mt.php'>Transactions MT (Refunded)</a></li>
														 <li><a href='transactions-refunded-rc.php'>Transactions MT (Refunded)</a></li>
													</ul>
												</li>
												<li><a href='' class="dropdown-toggle" data-toggle="dropdown">Wallet
													<b class="caret"></b></a>
													<ul class="dropdown-menu">
														 <li><a href='wallet-status.php'>Wallet Status</a></li>
														 <li><a href='wallet-request-receiveds.php'>Wallet Request Received</a></li>
														 <li><a href='wallet-log-admin.php'>Wallet Transfers (Admin)</a></li>
														 <li><a href='wallet-log-team.php'>Wallet Transfers (Team)</a></li>
														 <li><a href='wallet-log-user.php'>Wallet History (User Wallet)</a></li>
														 <li><a href='wallet-request-sents.php'>Send Wallet Request</a></li>
													</ul>
												</li>
												<li><a href='' class="dropdown-toggle" data-toggle="dropdown">Audit
													<b class="caret"></b></a>
													<ul class="dropdown-menu">
														 <li><a href='tally-sbi-bank.php'>Upload SBI Bank Txns</a></li>
														 <li><a href='tally-icici-bank.php'>Upload ICICI Bank Txns</a></li>
														 <li style='border-top:1px solid black;'><a href='tally-bank-requests.php'>Show Wallet Requests (cr update)</a></li>
														 <li><a href='tally-bank-transactions.php'>Show Bank Txns (cr update)</a></li>
														 <li><a href='tally-source-requests.php'>Show Source Requests (dr update)</a></li>
														 <li><a href='tally-comm-paids.php'>Show Comm. Paid (dr update)</a></li>
														 <li><a href='tally-charges-paids.php'>Show Bank Charges (dr update)</a></li>
														 <li style='border-top:1px solid black;'><a><b>Un-identified Records</b></a></li>
														 <li><a href='tally-bank-request.php'>Wallet Requests (cr)</a></li>
														 <li><a href='tally-bank-transaction.php'>Bank Txn (cr)</a></li>
														 <li><a href='tally-bank-transaction-debit.php'>Bank Txn (dr)</a></li>
														 <li><a href='tally-source-request.php'>Source Requests (dr)</a></li>
														 <li><a href='tally-comm-paid.php'>Comm. Paid (dr)</a></li>
														 <li><a href='tally-charges-paid.php'>Bank Charges (dr)</a></li>
													</ul>
												</li>
												<li><a href='../logout.php'><span class="menu">Logout</span></a></li>
											</ul>
										</nav>
									</div>
								</div>		
								<div style="clear:both"></div>
								<div class="col-sm-12 col-md-12 col-xs-12 .col-comn" style="height: 25px;">
								</div>
								<div style="clear:both"></div>
<?php
}
else if($online_url=="payoneonline.com" && $user_id=="100006")
{
?>
								<div style="clear:both"></div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-comn">
									<div class="navbar navbar-default" role="navigation">
										<div class="navbar-header" style="width:100%;">
										<marquee behavior="alternate" style="color:#ffffff;padding:.5% 1%;width:96%;font-weight:bold;" scrolldelay="120">NOTE: Server will be down for maintenance between 11PM to 3AM daily.</marquee>
										</div>
									</div>
								</div>
								<div style="clear:both"></div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-comn" style="height:10px;background:#ffffff;">
									<div class="navbar navbar-default" role="navigation">
										<div class="navbar-header">
										</div>
									</div>
								</div>
								<div style="clear:both"></div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-comn">
									<div class="navbar navbar-default" role="navigation">
										<div class="navbar-header">
											<a class="navbar-brand" href="#"></a>
											<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
												<span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span><span
													class="icon-bar"></span><span class="icon-bar"></span>
											</button>
										</div>
										<nav class="collapse navbar-collapse no-print" id="navbar">
											<ul class="nav navbar-nav" id="menu">
												<li><a href='home.php'><span class="menu">Dashboard</span></a></li>
												<li><a href='' class="dropdown-toggle" data-toggle="dropdown">List
													<b class="caret"></b></a>
													<ul class="dropdown-menu">
														 <li><a href='distributors.php'>List of Team</a></li>
														 <li><a href='retailers.php'>List of Retailer</a></li>
													</ul>
												</li>
												<li><a href='' class="dropdown-toggle" data-toggle="dropdown">Update
													<b class="caret"></b></a>
													<ul class="dropdown-menu">
														 <li><a href='tickets.php'>Update Ticket</a></li>
														 <!--<li><a href='retailers-edit.php'>Update Retailer</a></li>-->
													</ul>
												</li>
												<li><a href='' class="dropdown-toggle" data-toggle="dropdown">Transactions
													<b class="caret"></b></a>
													<ul class="dropdown-menu">
														 <li><a href='transactions-orders.php'>Search Transaction MT</a></li>
														 <li><a href='transactions-retailer-mt.php'>Transactions MT (Retailer)</a></li>
														 <li><a href='transactions-in-progress.php'>Transaction MT (In Progress)</a></li>
														 <li><a href='transactions-refund-pending.php'>Transaction MT (Refund Pending)</a></li>
														 <li><a href='transactions-refunded-mt.php'>Transactions MT (Refunded)</a></li>
														 <li style='border-top:1px solid black;'><a href='transactions-orders-rc.php'>Search Transaction RC</a></li>
														 <li><a href='transactions-retailer-rc.php'>Transactions RC (Retailer)</a></li>
														 <li><a href='transactions-refunded-rc.php'>Transactions RC (Refunded)</a></li>
													</ul>
												</li>
												<li><a href='' class="dropdown-toggle" data-toggle="dropdown">Wallet
													<b class="caret"></b></a>
													<ul class="dropdown-menu">
														 <li><a href='wallet-status.php'>Wallet Status</a></li>
														 <li><a href='wallet-request-receiveds.php'>Wallet Request Received</a></li>
														 <li><a href='wallet-log-admin.php'>Wallet Transfers (Admin)</a></li>
														 <li><a href='wallet-log-team.php'>Wallet Transfers (Team)</a></li>
														 <li><a href='wallet-log-user.php'>Wallet History (User Wallet)</a></li>
														 <li><a href='wallet-request-sents.php'>Send Wallet Request</a></li>
													</ul>
												</li>
												<li><a href='' class="dropdown-toggle" data-toggle="dropdown">Support
													<b class="caret"></b></a>
													<ul class="dropdown-menu">
														 <!--<li><a href='report-bank.php'>Bank Details</a></li>-->
														 <li><a href='contact.php'>Contact Matrix</a></li>
														 <li><a href='bank-details.php'>My Banks</a></li>
													</ul>
												</li>
												<li><a href='../logout.php'><span class="menu">Logout</span></a></li>
											</ul>
										</nav>
									</div>
								</div>		
								<div style="clear:both"></div>
								<div class="col-sm-12 col-md-12 col-xs-12 .col-comn" style="height: 25px;">
								</div>
								<div style="clear:both"></div>
<?php
}
?>