								<div style="clear:both"></div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-comn">
									<!--<div class="navbar navbar-default" role="navigation">
										<div class="navbar-header" style="width:100%;">-->
										<marquee style="color:red;padding:.5% 1%;width:96%;font-weight:bold;" scrolldelay="120">Dear Partner, ICICI Bank Account is closed now. Use only SBI Account for depost / transfer money for fast processing of LIMIT.</marquee>
										<!--</div>
									</div>-->
								</div>
								<?php
								//header('location:../logout.php');
									$isemp_id=0;
									$isemp_under=0;
									$isemp_type=0;
									$qry_isemp="select * from child_employee where employee_uid='$user_id';";
									$res_isemp=mysql_query($qry_isemp);
									while($rs_isemp=mysql_fetch_array($res_isemp))
									{
										$isemp_id=$rs_isemp['employee_uid'];
										$isemp_under=$rs_isemp['under_uid'];
									}
									$qry_isemp="select * from child_user where user_id='$isemp_under';";
									$res_isemp=mysql_query($qry_isemp);
									while($rs_isemp=mysql_fetch_array($res_isemp))
									{
										$isemp_type=$rs_isemp['user_type'];
									}
									$online_url=$_SERVER['HTTP_HOST'];
								?>
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
												<?php
							if($online_url=="payoneonline.com" && $isemp_id!=0)
							{
												?>
												<li><a href='' class="dropdown-toggle" data-toggle="dropdown">Retailer
													<b class="caret"></b></a>
													<ul class="dropdown-menu">
														 <li><a href='eretailers.php'>List of Retailer</a></li>
														 <li><a href='eretailer.php'>Add Retailer</a></li>
													</ul>
												</li>
												<li><a href='' class="dropdown-toggle" data-toggle="dropdown">Support
													<b class="caret"></b></a>
													<ul class="dropdown-menu">
														 <li><a href='tickets.php'>My Ticket</a></li>
														 <li><a href='contact.php'>Contact Matrix</a></li>
														 <!-- 
														 <li><a href='bank-details.php'>Bank Details</a></li>
														 will be added later after api and calculation
														 <li><a href='earnings.php'>My Earnings</a></li>
														 -->
													</ul>
												</li>
												<li><a href='../logout.php'><span class="menu">Logout</span></a></li>
												<?php
							}
							else
							{
												?>
												<?php
												if($online_url=="payoneonline.com" && $user_id==100322)
												{
												?>
												<!--<li><a href='' class="dropdown-toggle" data-toggle="dropdown">Employee
													<b class="caret"></b></a>
													<ul class="dropdown-menu">
														 <li><a href='employees.php'>List of Employee</a></li>
														 <li><a href='employee.php'>Create Employee</a></li>
													</ul>
												</li>-->
												<?php
												}
												if($user_type!=3)
												{
												?>
												<li><a href='' class="dropdown-toggle" data-toggle="dropdown">Team
													<b class="caret"></b></a>
													<ul class="dropdown-menu">
														 <li><a href='distributors.php'>List of Team</a></li>
														 <li><a href='distributor.php'>Add Team</a></li>
													</ul>
												</li>
												<?php
												}
												?>
												<li><a href='' class="dropdown-toggle" data-toggle="dropdown">Retailer
													<b class="caret"></b></a>
													<ul class="dropdown-menu">
														 <li><a href='retailers.php'>List of Retailer</a></li>
														 <li><a href='retailer.php'>Add Retailer</a></li>
													</ul>
												</li>
												<li><a href='' class="dropdown-toggle" data-toggle="dropdown">Services
													<b class="caret"></b></a>
													<ul class="dropdown-menu">
														 <li><a href='kyc-status.php'>KYC Status</a></li>
														 <?php
														 /*
														 //will be added later after api and calculation
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
														 <li><a href='transactions-orders.php'>Search Transactions</a></li>
														 <li><a href='transactions.php'>Show Transactions</a></li>
													</ul>
												</li>
												<li><a href='' class="dropdown-toggle" data-toggle="dropdown">Wallet
													<b class="caret"></b></a>
													<ul class="dropdown-menu">
														 <li><a href='wallet-status.php'>Wallet Status</a></li>
														 <li><a href='wallet-request-receiveds.php'>Wallet Request Received</a></li>
														 <li><a href='wallet-add.php'>Fund Transfer</a></li>
														 <li><a href='wallet-log.php'>Wallet History</a></li>
														 <li><a href='wallet-requests-sent.php'>Sent Wallet Request</a></li>
													</ul>
												</li>
												<li><a href='' class="dropdown-toggle" data-toggle="dropdown">Team Work
													<b class="caret"></b></a>
													<ul class="dropdown-menu">
														 <li><a href='collection.php'>Today's Work</a></li>
														 <li><a href='earnings.php'>My Earnings</a></li>
														 <li><a href='commission-paid-summary.php'>Paid Commissions</a></li>
													</ul>
												</li>
												<li><a href='' class="dropdown-toggle" data-toggle="dropdown">Support
													<b class="caret"></b></a>
													<ul class="dropdown-menu">
														 <li><a href='tickets.php'>My Ticket</a></li>
														 <li><a href='contact.php'>Contact Matrix</a></li>
														 <!-- 
														 <li><a href='bank-details.php'>Bank Details</a></li>
														 will be added later after api and calculation
														 <li><a href='earnings.php'>My Earnings</a></li>
														 -->
													</ul>
												</li>
												<li><a href='margin.php'><span class="menu">My Margin</span></a></li>
												<li><a href='../logout.php'><span class="menu">Logout</span></a></li>
												<?php
							}
												?>
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