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
                        <h1>Received Wallet Requests from Client</h1>
						<table class="normal" frame="box" rules="all">
							<tr>
								<th>Request ID</th>		
								<th>Request Date</th>
								<th>Client Name (ID)</th>
								<th>Company Account</th>											
								<th>Payment Mode</th>
								<th>Ref No</th>
								<th>Amount</th>
								<th>Remarks</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
							<?php 
							include '_common.php';
							include 'functions/_ShowAdminBank.php';
							include 'functions/_ShowClientName.php';
							
							$query="SELECT * FROM parent_wallet_requests order by request_id desc limit 0,50";
							$result=mysql_query($query);
							$num_rows = mysql_num_rows($result);	
							if($num_rows>0)
							{				
								$i=0;
								//$userstatus="";
								while($rs = mysql_fetch_assoc($result)) {
								$i++;
								if($i%2!=0)
								$style="style='background-color:white;'";
								else
								$style="style='background-color:#e5e5e5;'";
								
								$rid=$rs['request_id'];
								$cid=$rs['client_id'];
								
								$pm="";
								if($rs['payment_mode']==1)
								$pm="Demand Draft";
								else if($rs['payment_mode']==2)
								$pm="Cheque";
								else if($rs['payment_mode']==3)
								$pm="NEFT / RTGS";
								else if($rs['payment_mode']==4)
								$pm="IMPS";
								else if($rs['payment_mode']==5)
								$pm="Cash Deposit";
								else if($rs['payment_mode']==6)
								$pm="CDM - Cash Deposit Machine";
								
								$st="";
								if($rs['request_status']==1)
								$st="Received";
								else if($rs['request_status']==2)
								$st="Transferred";
								else if($rs['request_status']==3)
								$st="Rejected";
								
								$act="";
								if($rs['request_status']==1)
								$act="<a href='wallet-admin-transfer-dr-for-client.php?rid=$rid&cid=$cid'>Transfer / Reject</a>";
								else
								$act="<a href='wallet-admin-transfer-dr-for-client.php?rid=$rid&cid=$cid'>Show Details</a>";
								
						?>
						<tr>
							<td><?php echo $rs['request_id'];?></td>
							<td><?php echo $rs['request_date'];?></td>
							<td><?php echo show_client_name($rs['client_id'])." (".$rs['client_id'].")";?></td>
							<td><?php echo show_admin_bank($rs['bank_id']);?></td>
							<td><?php echo $pm;?></td>
							<td><?php echo $rs['ref_no'];?></td>
							<td><?php echo $rs['deposit_amount'];?></td>
							<td><?php echo $rs['remarks'];?></td>
							<td><?php echo $st;?></td>
							<td><?php echo $act;?></td>
						</tr>
						<?php
								}
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
