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
                        <h1>Orders at Eko</h1>
                        <table class="normal" frame="box" rules="all">
                        	<tr>
                            	<th>Order No<br>Date<br>Time</th>
                            	<th>CID/ID</th>
                            	<th>Transaction Type</th>
                                <th>Transaction Details</th>
                                <th align="right">Previous Balance</th>
                                <th align="right">Amount Cr</th>
                                <th align="right">Amount Dr</th>
                                <th align="right">Update Balance</th>
                            </tr>
							<?php
							//$cond="";
							$query="SELECT * FROM parent_wallet_realtime order by wallet_id desc limit 0,50";
							$result=mysql_query($query);
							$num_rows = mysql_num_rows($result);	
							$i=0;
							if($num_rows>0)
							{
								//include '../functions/_my_uname.php';
								$a=$b=$c=$d=0;
								while($rs = mysql_fetch_assoc($result))
								{
									$i++;
									$ttype=$rs['transaction_type'];
									if($ttype==0)
									$ttype="Account Opened";
									if($ttype==1)
									$ttype="Wallet Received";
									if($ttype==2)
									$ttype="Order Generated";
									if($ttype==3)
									$ttype="Failed Order Refunded";
									
									$uuiidd=$rs['user_id'];
									if($uuiidd==0)
									{
										$uuiidd=100001;
									}
									$stl="";
									if($i%2==0)
									$stl="bgcolor='#e1e1e1''";
									else
									$stl="bgcolor='#ffffff'";
									
							?>
                        	<tr <?php echo $stl;?>>
                            	<td><?php echo $rs['client_order_id'];?><br><?php echo $rs['wallet_date'];?><br><?php echo $rs['wallet_time'];?></td>
                                <td><?php echo $rs['client_id'];?>/<?php echo $rs['user_id'];?></td>
                                <td><?php echo $ttype;?></td>
                                <td><?php echo $rs['transaction_description'];?></td>
                                <td align="right"><?php echo $rs['amount_pre'];?></td>
                                <td align="right"><?php echo $rs['amount_cr'];?></td>
                                <td align="right"><?php echo $rs['amount_dr'];?></td>
                                <td align="right"><?php echo $rs['amount_bal'];?></td>
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
