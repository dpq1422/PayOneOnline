		<script>
		window.oncontextmenu = function () { return false; }
		</script>
		<script type="text/javascript">
		
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
$online_url=$_SERVER['HTTP_HOST'];
include_once '../functions/_wallet_balance.php';
if($user_type==0)
$wallet_balance=wallet_balance(100001);
else
$wallet_balance=wallet_balance($user_id);
$wallet_bals=wallet_balance(100000)+wallet_balance(100005);

$wallet_bals="Admin Wallet : <b id='ResultBal'>$wallet_bals</b>";
if($online_url=="payoneonline.com" && ($user_id==100010 || $user_id==100006))
{
	$query="SELECT * FROM child_wallet_realtime order by wallet_id desc limit 0,1";
	$result=mysql_query($query);
	$realtime_wallet=0;
	$num_rows = mysql_num_rows($result);
	if($num_rows>0)
	{
		while($rs = mysql_fetch_assoc($result)) {
			$realtime_wallet=$rs['amount_bal'];
		}
	}
	if($realtime_wallet=="")
	$realtime_wallet=0;
	$wallet_bals=$realtime_wallet;
	$wallet_bals=$wallet_bals-1500000;
	$wallet_bals="Real Time : <b id='ResultBal'>$wallet_bals</b>";
}
?>
								<div class="col-sm-12 col-md-12 col-xs-12 .col-comn">
									<div class="col-md-2 col-xs-2 col-sm-2 .col-comn" style="padding:15px 0 0 0;" align="left">
										<a href="home.php">
											<img alt="" src="../img/payone-logo-my.png" />
										</a>
									</div>
									<div class="col-md-4 col-xs-4 col-sm-4" style="padding: 0px; margin-top: 11px;" align="right">
										<!--<a>
											<img alt="" class='guru-ji' height="80" src="../img/mentor-logo.png" />
										</a>-->
									</div>
									<div class="col-md-6 col-xs-6 col-sm-6 nopadding" align="right" style="margin: 27px 0;">
										<?php
										if($user_type==0 || $user_type==1)
										{
										?>
										<div class="col-md-3 input-group" style="padding: 0px;" align="right">
											<span class="input-group-addon input-group-addon1 input-group-custom">
												<span id="ctl00_lblAgentName" style="font-weight: BOLD; font-size: 18px;color: #43a02c;"><?php echo $user_type_name;?><br>
												</span>
												<br><br>
											</span>&nbsp; 
											<span class="input-group-btn">
											<?php
											if($user_id==100001)
											{
											?>
												<div id="ctl00_updaterefresh" style="width:220px;">	
													<a id="ctl00_balanceChk" style="font-size: 15px; cursor: pointer;"><img src="../img/refresh.png" id="RefreshImage" onclick="ChangeImage()" height="24" alt="Click to Refresh Balance" title="Click to Refresh Balance"/></a>
											</span> 
											<span id="ctl00_lblBalance" style="font-weight: BOLD; font-size: 18px;"> &nbsp;| <?php echo $wallet_bals;?>
											<br><span id="ctl00_lblBalance" style="font-weight: BOLD; font-size: 18px;">Admin Balance : <b id="ResultBal2"><?php echo $wallet_balance;?></b>
											</span>
												</div>
											<?php
											}
											else
											{
											?>
											</span>&nbsp; 
											<span class="input-group-btn">
												<div id="ctl00_updaterefresh" style="width:220px;">	
													<a id="ctl00_balanceChk" style="font-size: 15px; cursor: pointer;"><img src="../img/refresh.png" id="RefreshImage" onclick="ChangeImage()" height="24" alt="Click to Refresh Balance" title="Click to Refresh Balance"/></a>
											</span> 
											<span id="ctl00_lblBalance" style="font-weight: BOLD; font-size: 18px;"> &nbsp;| <?php echo $wallet_bals;?>
											<br><span id="ctl00_lblBalance" style="font-weight: BOLD; font-size: 18px;">Admin Balance : <b id="ResultBal2"><?php echo $wallet_balance;?></b>
											</span>
												</div>
											<?php
											}
											?>
											<br>
										</div>
										<?php
										}
										else
										{
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
										<div class="col-md-3 input-group" style="padding: 0px;" align="right">
											<span class="input-group-addon input-group-addon1 input-group-custom">
												<span id="ctl00_lblAgentName" style="font-weight: BOLD; font-size: 18px;color: #43a02c;">
													<?php echo $user_type_name;?>
												</span>
											</span>&nbsp; 
											<span class="input-group-btn">
												<div id="ctl00_updaterefresh">	
													<a id="ctl00_balanceChk" style="font-size: 15px; cursor: pointer;">
														<img src="../img/refresh.png" id="RefreshImage" onclick="ChangeImage()" height="24" alt="Click to Refresh Balance" title="Click to Refresh Balance"/>
													</a>
													</span> 
													<span id="ctl00_lblBalance" style="font-weight: BOLD; font-size: 18px;"> | Balance : <b id="ResultBal"><?php echo $wallet_balance;?></b></span>
												</div>
										</div>
										<span id="ctl00_lblUser"><?php echo $mykycstatus;?></span>
										<?php
										}
										?>
										Welcome :
										<span id="ctl00_lblUser"><a href="my-profile.php"><?php echo $user_name;?></a></span>&nbsp;<span>|
											<a href="change-password.php">Change Password</a>
											<span>|</span>
											<a href="../logout.php">Logout</a>
											
										</span>
									</div>
								</div>															