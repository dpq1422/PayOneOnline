<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Home :: Mentor Business Systems</title>
        <link href="css/design.css" rel="stylesheet" type="text/css" />
    </head>
    
    <body class="bgcolor">
    	<div class="main-container">
        	<div class="header">
				<?php include('_menu.php');?>
            </div>
            <div class="clr">
            </div>
			<?php include('_news-top.php');?>
            <div class="clr">
            </div>
			<div class="data-container">
            	<div class="data-left">
                	<?php include('_aid-left.php');?>
                </div>
            	<div class="data-mid">
                	<!-- Main Data starts Here -->
                        <h1>Eko Wallet (Real Txn of Cr/Dr)<a href="wallet-admin-transfer-cr-to-admin.php" class="a-button">Update Admin Wallet</a></h1>
                        <table class="normal" frame="box" rules="all">
                        	<tr>
                            	<th align="left">Wallet ID</th>
                            	<th align="left">Date<br>Time</th>
                            	<th align="left">Client ID<br>User ID</th>
                            	<th align="left">Client Order ID<br>Source Order ID</th>
                            	<th align="left">Transaction Type</th>
                            	<th align="left">Transaction Description</th>
                                <th align="right">Cr</th>
                                <th align="right">Dr</th>
                                <th align="right">Balance</th>
                            </tr>
							<?php
							include('_common.php');
							$query5="select * from parent_wallet_realtime order by wallet_id desc limit 0,100;";
							$result5=mysql_query($query5);
							while($row5=mysql_fetch_array($result5))
							{
								$transaction_type=$row5['transaction_type'];
								if($transaction_type==1)
								$transaction_type="Admin Wallet Amount Received";
								else
								$transaction_type="Transaction Made By Client";
							?>
                        	<tr>
                            	<td><?php echo $row5['wallet_id'];?></td>
                            	<td><?php echo $row5['wallet_date'];?><br><?php echo $row5['wallet_time'];?></td>
                            	<td>
									<?php if($row5['client_id']!=0) echo $row5['client_id']; else echo "Admin Wallet Request";?>
									<br>
									<?php if($row5['user_id']!=0) echo $row5['user_id'];?>
								</td>
                            	<td>
									<?php if($row5['client_order_id']!=0) echo $row5['client_order_id']; else echo "Admin Wallet Update"?>
									<br>
									<?php if($row5['source_order_id']!=0) echo $row5['source_order_id'];?>
								</td>
                            	<td><?php echo $transaction_type?></td>
                            	<td><?php echo $row5['transaction_description'];?></td>
                                <td align="right"><?php echo $row5['amount_cr'];?></td>
                                <td align="right"><?php echo $row5['amount_dr'];?></td>
                                <td align="right"><?php echo $row5['amount_bal'];?></td>
                            </tr>
							<?php
							}
							?>
                        </table>                       
                	<!-- Main Data ends Here -->
                    <div class="clr">
                    </div>
                    <?php include('_news-bottom.php');?>
                </div>
            	<div class="data-right">
                	<?php include('_aid-right.php');?>
                </div>
			</div>
            <div class="clr">
            </div>
            <div class="data-bottom">
                <?php include('_aid-bottom.php');?>
            </div>
            <div class="clr">
            </div>
			<div class="footer">
				<?php include('_footer.php');?>
			</div>
        </div>
    </body>
</html>