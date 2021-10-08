<style>
.hide-on-med-and-down li{height:65px!important;}
.hide-on-med-and-down li a,.hide-on-med-and-down li a:hover{height:65px!important;}
</style>
<script>
window.oncontextmenu = function () { return false; }
</script>
<script type="text/JavaScript">

	function killCopy(e)
	{
		return false;
	}
	function reEnable()
	{
		return true;
	}
	document.onselectstart=new Function ("return false");
	if (window.sidebar)
	{
		document.onmousedown=killCopy;
		document.onclick=reEnable;
	}

</script>
<?php
//header('location:../logout.php');
include_once '../functions/_wallet_balance.php';
$wallet_balance=wallet_balance($user_id);
$qry_kyc="select kyc_status from child_user where user_id='$user_id';";
$res_kyc=mysql_query($qry_kyc);
$mykycstatus=0;
while($rs_kyc=mysql_fetch_array($res_kyc))
{
	$mykycstatus=$rs_kyc['kyc_status'];
												
	if($mykycstatus==0 || $mykycstatus==4)
	$mykycstatus="<b style='color:red;'>KYC - PENDING (Documents Not Received)</b><br>";
	else if($mykycstatus==1 || $mykycstatus==2)
	$mykycstatus="<b style='color:orange;'>KYC - IN PROGRESS (Verification In-Progress)</b><br>";
	else if($mykycstatus==3)
	$mykycstatus="<b style='color:green;'>KYC - VERIFIED</b><br>";
}
?>
				<header id="header" class="">
					<div class="navbar">
						<nav class="">
							<a href="" data-activates="nav-mobile" class="button-collapse top-nav full waves-effect waves-light"><i class="material-icons">***&nbsp;</i></a>
							<div class="nav-wrapper">
								<ul class="left">
									<li>
										<a href="" class="brand-logo"><img src="../img/payone-logo-my.png" alt="" height="40"></a>
									</li>
								</ul>
								<div id="tickerMessages" class="search-top-bar hide-on-med-and-down"> <marquee behavior="alternate" class="scroll-news" scrolldelay="120">
							<ul class='list-inline list-unstyled'>
								<!-- TickerText is the column name in datasource -->
								<li><h6 style="font-weight:bold;color:#fff!important;">Dear Partner, ICICI Bank Account is closed now. Use only SBI Account for depost / transfer money for fast processing of LIMIT.</h6></li>
							</ul>                        
							</marquee></div>
							</div>
						</nav>
					</div>
				</header>

				<aside class="sidebar-left">
					<ul class="side-nav fixed clearfix left" id="nav-mobile">
						<li>
							<ul class="collapsible myMenu" data-collapsible="accordion">
							  <li style="text-align:center; padding:20px; border-bottom:1px dashed blue;">
								  <span id="userDet"><b>PAYONE ID : <?php echo $user_id;?><br>(<?php echo $user_name; ?>)</b><br><?php echo $mykycstatus;?><i class='fa fa-inr'>&nbsp;</i><b><?php echo $wallet_balance; ?></b></span>
									 
								  <br>
								
							  </li>
									<li>
										<a href="home.php" class="collapsible-header waves-effect">
											<i class="fa fa-home fa-4x"></i>Home</a>
									</li>
									<li>
										<a href="transactionp.php" class="collapsible-header waves-effect">
											<i class="fa fa-search fa-4x"></i>TXNs In-Progress</a>
									</li>
									<li>
										<a href="prepaid.php" class="collapsible-header waves-effect" id="mobRech">
											<i class="fa fa-mobile fa-4x"></i>Mobile Recharge</a>
									</li>
									<li>
										<a href="dth.php" class="collapsible-header waves-effect" id="dthRech">
											<i class="fa fa-tv fa-4x"></i>DTH Recharge</a>
									</li>
									<li>
										<a href="money-transfer-1-search.php" class="collapsible-header waves-effect">
											<i class="fa fa-money fa-4x"></i>Money Transfer</a>
									</li>
									<li>
										<a href="sent-wallet-requests.php" class="collapsible-header waves-effect">
											<i class="fa fa-ticket fa-4x"></i>Sent Wallet Requests</a>
									</li>
									<!--<li>
										<a href="fund-received.php" class="collapsible-header waves-effect">
											<i class="fa fa-check fa-4x"></i>Fund Received</a>
									</li>-->
									<li>
										<a href="fund-refund.php" class="collapsible-header waves-effect">
											<i class="fa fa-inr fa-4x"></i>My Refunds</a>
									</li>
									<li>
										<a href="wallet-history.php" class="collapsible-header waves-effect">
											<i class="fa fa-calendar fa-4x"></i>My Ledger</a>
									</li>
									<li>
										<a href="tickets.php" class="collapsible-header waves-effect" id="suppTckt">
											<i class="fa fa-support fa-4x"></i>Support Tickets</a>
									</li>
									<li>
										<a href="contact.php" class="collapsible-header waves-effect" id="contUs">
											<i class="fa fa-phone fa-4x"></i>Contact Us</a>
									</li>
									<li>
										<a href="my-profile.php" class="collapsible-header waves-effect">
											<i class="fa fa-street-view fa-4x"></i>My Profile</a>
									</li>
									<li>
										<a href="../logout.php" class="collapsible-header waves-effect">
											<i class="fa fa-sign-out fa-4x"></i>Logout</a>
									</li>		
									<?php
									/*
									?>
									<li>
										<a href="bank-code.php" class="collapsible-header waves-effect">
											<i class="fa fa-bank fa-4x"></i>Bank Details</a>
									</li>
									<li>
										<a href="" class="collapsible-header waves-effect" id="elecBill">
											<i class="fa fa-bolt fa-4x"></i>Electricity Bill</a>
									</li>
									  <li>
										<a href="" class="collapsible-header waves-effect" id="landBill">
											<i class="fa fa-phone fa-4x"></i>Landline Bill</a>
									</li>
									<li>
										<a href="" class="collapsible-header waves-effect" id="dateop">
											<i class="fa fa-clock-o fa-4x"></i>By Date & Operator</a>
									</li>
									<li>
										<a href="" class="collapsible-header waves-effect" id="smsLog">
											<i class="fa fa-envelope-o fa-4x"></i>SMS log</a>
									</li>
									<?php
									*/
									?>		
								</ul>
							</li>
						</ul>
					</aside>