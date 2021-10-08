<div class="responsive_menu w3-sidebar w3-animate-left" id="LeftMenu" style="display:none; overflow:inherit;">
    	<div class="res_logo2 wh w3-left">
        	<img src="../img/logos.png">
            <a class="close-icon2 w3-right" onclick="closeNavigationMenu()"><img src="../img/close2.png"></a>
        </div> 
        <div class="menu_scroll wh w3-left">
            <div class="wallet2 wh w3-left">
            	<img src="../img/wallet-icon2.png"><span><img src="../img/doller-icon2.png"><?php echo $wbal;?></span>
            </div>
            <ul>
            	<li><a href="DashboardServlet">Home</a></li>
                <li><a>My Account <span class="res_arrow"></span></a>
                	<ul>
						<li><a href="MyProfileServlet">My Profile</a></li>
						<li><a href="MyChangePasswordServlet">Change Password</a></li>
						<li><a href="MyChangeTpinServlet">Change T-PIN</a></li>
						<li><a href="MyMarginServlet">My Margin</a></li>
                    </ul>
                </li>
                <li><a>Team <span class="res_arrow"></span></a>
                	<ul>
									<?php
									if($logged_user_type!=5)
									{
									?>
						<li><a href="TeamsMembersServlet">List of Members</a></li>
						<li><a href="TeamsMemberServlet">Add New Member</a></li>
									<?php
									}
									?>
						<li><a href="TeamsRetailersServlet">List of Retailers</a></li>
						<li><a href="TeamsRetailerServlet">Add New Retailer</a></li>
						<li><a href="KycStatusServlet">KYC Status</a></li>
                    </ul>
                </li>
                <li><a>Wallet <span class="res_arrow"></span></a>
                	<ul>
						<li><a href="WalletStatusServlet">Wallet Status</a></li>
						<li><a href="WalletHistoryUserServlet">My Ledger</a></li>
						<li><a href="WalletTransferAddServlet">Wallet Transfer</a></li>
						<li><a href="WalletSentRequestsServlet">Wallet Requests Sent</a></li>
						<li><a href="WalletSendRequestServlet">Send New Wallet Request</a></li>
                    </ul>
                </li>
                <li><a>Transaction <span class="res_arrow"></span></a>
                	<ul>
						<li><a href="TxnServiceDmtServlet">Domestic Money Transfer</a></li>
						<li><a href="TxnServiceRcServlet">Prepaid / DTH Recharge</a></li>
						<li><a href="TxnServicePostpaidServlet">Postpaid / Landline / Datacard</a></li>
						<li><a href="TxnServiceUtilityServlet">Electricity / Water / Gas</a></li>
						<li><a href="TxnServiceInsuranceServlet">Insurance Premium</a></li>
                    </ul>
                </li>
                <li><a>Support <span class="res_arrow"></span></a>
                	<ul>
						<li><a href="BankContactServlet">Bank &amp; Contact Info</a></li>
						<li><a href="TicketsSentServlet">List of Tickets (Sent)</a></li>
						<li><a href="TicketSendNewServlet">Generate New Ticket</a></li>
                    </ul>
                </li>
                <li><a>Commission <span class="res_arrow"></span></a>
                	<ul>
						<li><a href="CommissionMyEarning">My Earning</a></li>
						<li><a href="ReportTeamCollectionServlet">Today's Work</a></li>
						<li><a href="ReportInActivityServlet">In-activity Report</a></li>
                    </ul>
                </li>
				<li><a href="LogoutServlet">Logout</a></li>
            </ul>             
        </div>  	
    </div>