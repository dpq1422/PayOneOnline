
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
include '_session.php';
?>
            	<div class="logo">
					<a href="home.php">
						<img src="image/mentor.png" alt="Mentor Business Systems" title="Mentor Business Systems" />
					</a>
                </div>
				<ul id="nav">
					<li class="top"><a href="home.php" class="top_link"><span>Home</span></a></li>
					<?php
					if($user_type=="1") // Application Manager
					{
					?>
					<li class="top"><a href="#" class="top_link"><span class="down">Setup</span></a>
						<ul class="sub">
							<li><a href="users.php">Admin Users</a></li>
							<li><a href="recharge-sources.php">Transaction Sources</a></li>
							<li><a href="banks.php">Admin Bank Details</a></li>
						</ul>
					</li>
					<?php 
					}
					if($user_type=="1" || $user_type=="2") // Service Manager
					{
					?>
					<li class="top"><a href="#" class="top_link"><span class="down">Service</span></a>
						<ul class="sub">
							<li><a href="service-states.php">Service State</a></li>
							<li><a href="service-types.php">Service Type</a></li>
							<li><a href="service-operators.php">Operator / Provider</a></li>
							<li><a href="service-mt-charges.php">Commission / Charges</a></li>
						</ul>
					</li>
					<?php 
					}
					if($user_type=="1" || $user_type=="3") // Tariff Manager
					{/*
					?>
					<li class="top"><a href="#" class="top_link"><span class="down">Prepaid</span></a>
						<ul class="sub">
							<li><a href="tariff-types.php">Tariff Type</a></li>
							<li><a href="tariffs.php">Tariff Plans</a></li>
						</ul>
					</li>
					<?php */
					}
					if($user_type=="1" || $user_type=="4") // Client Manager
					{
					?>
					<li class="top"><a href="#" class="top_link"><span class="down">Clients</span></a>
						<ul class="sub">
							<li><a href="clients.php">List All</a></li>
							<li><a href="clients-wallet-requests.php">Wallet Requests</a></li>
						</ul>
					</li>
					<?php 
					}
					if($user_type=="1" || $user_type=="5") // Order Manager
					{
					?>
					<li class="top"><a href="#" class="top_link"><span class="down">Transaction</span></a>
						<ul class="sub">
							<li><a href="orders.php">Orders Eko</a></li>
							<li><a href="orders2.php">Orders Aqua</a></li>
						</ul>
					</li>
					<li class="top"><a href="#" class="top_link"><span class="down">Wallet</span></a>
						<ul class="sub">
							<li><a href="wallet-admin-transfer-cr-to-admin.php">Update Wallet</a></li>
							<li><a href="wallet-admin.php">Eko Wallet</a></li>
							<li><a href="wallet-admin2.php">Aqua Wallet</a></li>
							<li><a href="wallet-client.php">Distribution Wallet</a></li>
						</ul>
					</li>
					<?php 
					}
					?>
					<li class="top"><a href="#" class="top_link"><span class="down">Profile</span></a>
						<ul class="sub">
							<li><a href="profile.php">My Details</a></li>
							<li><a href="change-password.php">Change Password</a></li>
						</ul>
					</li>
					<li class="top"><a href="logout.php" class="top_link"><span>Logout</span></a></li>
				</ul>