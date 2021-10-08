        <div class="menu-bar wh">
        	
            	<div class="w3-row-padding">
                	<div class="w3-col">
                    	<ul class="menu">
                            <li><a href="DashboardServlet"><img src="../img/home-icon.png"></a></li>
                            <li><a href="">My Account <img src="../img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
                                    <li><a href="MyProfileServlet">My Profile</a></li>
                                    <li><a href="MyChangePasswordServlet">Change Password</a></li>
                                    <li><a href="MyChangeTpinServlet">Change T-PIN</a></li>
                                    <li><a href="MyMarginServlet">My Margin</a></li>
									<?php
									if($kinf==0 || $kinf==-4)
									{
										echo '<li><a href="KycUpload">Update KYC</a></li>';
									}
									if($binf==0 || $binf==-4)
									{
										echo '<li><a href="BankUpdate">Update Bank Details</a></li>';
									}
									?>
                                </ul>
                            </li>
                            <li><a href="">Wallet <img src="../img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
                                    <li><a href="WalletHistoryUserServlet">My Ledger</a></li>
                                    <li><a href="WalletSentRequestsServlet">Wallet Requests Sent</a></li>
									<li><a href="WalletSendRequestServlet">Send New Wallet Request</a></li>
                                </ul>
                            </li>
                            <li><a href="">Service <img src="../img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
									<li><a href="ServiceDmtServlet">Domestic Money Transfer</a></li>
									<li><a href="">Recharge</a><img src="../img/drop-arrow-r.png" style="margin:0px;">
										<ul>
											<li><a href="ServiceRcMobServlet">Prepaid Mobile Recharge</a></li>
											<li><a href="ServiceRcDthServlet">DTH Recharge</a></li>
										</ul>
									</li>
									<li><a href="">Bill Payments</a><img src="../img/drop-arrow-r.png" style="margin:0px;">
										<ul>
											<li><a href="ServicePostpaidMobServlet">Postpaid Mobile Payment</a></li>
											<li><a href="ServiceDatacardServlet">Datacard Payment</a></li>
									<?php
									if($logged_user_id==100007 || $logged_user_id==100002)
									{
									?>
											<li><a href="ServiceLandlineServlet">Landline / Broadband Payment</a></li>
									<?php
									}
									?>
										</ul>
									</li>
									<li><a href="">Utility Bills</a><img src="../img/drop-arrow-r.png" style="margin:0px;">
										<ul>
											<li><a href="ServiceElecServlet">Electricity Payment</a></li>
											<li><a href="ServiceWaterServlet">Water Payment</a></li>
											<li><a href="ServiceGasServlet">Gas Payment</a></li>
										</ul>
									</li>
									<li><a href="ServiceInsuranceServlet">Insurance Premium Renewals</a></li>
                                </ul>
                            </li>
                            <li><a href="">Transaction <img src="../img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
                                    <li><a href="">Domestic Money Transfer</a><img src="../img/drop-arrow-r.png" style="margin:0px;">
                                        <ul>
											<li><a href="TxnServiceDmtServlet">All Txns with Search</a></li>
											<li><a href="TxnInProgressServiceDmtServlet">In Progress</a></li>
											<li><a href="TxnRefundPendingServiceDmtServlet">Refund Pending</a></li>
											<li><a href="TxnRefundedServiceDmtServlet">Refunded</a></li>
                                        </ul>
                                    </li>
									<li><a href="TxnServiceRcServlet">Prepaid / DTH Recharge</a></li>
									<li><a href="TxnServicePostpaidServlet">Postpaid / Landline / Datacard</a></li>
									<li><a href="TxnServiceUtilityServlet">Electricity / Water / Gas</a></li>
									<li><a href="TxnServiceInsuranceServlet">Insurance Premium Renewals</a></li>
                                </ul>
                            </li>
                            <li><a href="">Support <img src="../img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
                                    <li><a href="BankContactServlet">Bank &amp; Contact Info</a></li>
                                    <li><a href="TicketsSentServlet">List of Tickets (Sent)</a></li>
                                    <li><a href="TicketSendNewServlet">Generate New Ticket</a></li>
                                </ul>
                            </li>
                            <li><a href="">Commission <img src="../img/drop-arrow.png" class="drop-arrow-icon"></a>
                                <ul>
                                    <li><a href="CommissionMyEarning">My Earning</a></li>
                                </ul>
                            </li>
                            <li><a href="LogoutServlet">Logout</a></li>
                    	</ul>
						<!--
                        <form class="search-main w3-right">
                            <a href=""><img src="../img/search-icon.png" class="search-icon"></a>
                            <div class="search-show">
                            	<input type="text" placeholder="Order by TxnId">
                            </div>
                        </form>
						-->
                    </div>
                </div>
            </div>