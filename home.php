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
						<?php
						$a1=0;
						$a2=0;
						$a3=0;
						$qry_a="SELECT * FROM `parent_wallet_realtime` ORDER BY `wallet_id` DESC limit 0,1";
						$result_a=mysql_query($qry_a);
						while($row_a=mysql_fetch_array($result_a))
						{
							$a1=$row_a['real_bal'];
							$a2=$row_a['amount_bal'];
							$a3=$a1-$a2;
						}
						$a3=number_format((float)$a3, 2, '.', '');
						$b1=0;
						$b2=0;
						$b3=0;
						$b4=0;
						$qry_b1="SELECT * FROM `child_wallet_realtime` ORDER BY `wallet_id` DESC limit 0,1";
						$result_b1=mysql_query($qry_b1);
						while($row_b1=mysql_fetch_array($result_b1))
						{
							$b1=$row_b1['amount_bal'];
						}
						$b3=$a2;
						$b2=$b3-$b1;
						$b4=$b1+$b2-$b3;
						$b2=number_format((float)$b2, 2, '.', '');
						$b4=number_format((float)$b4, 2, '.', '');
						$c1=0;
						$c2=0;
						$c3=0;
						$c4=0;
						$c5=0;
						$c6=0;
						$qry_c1="SELECT count(*) num FROM `main_transaction_mt`";
						$result_c1=mysql_query($qry_c1);
						while($row_c1=mysql_fetch_array($result_c1))
						{
							$c1=$row_c1['num'];
						}
						$qry_c2="SELECT count(*) num FROM `main_transaction_mt` where eko_transaction_status in (1,3,6)";
						$result_c2=mysql_query($qry_c2);
						while($row_c2=mysql_fetch_array($result_c2))
						{
							$c2=$row_c2['num'];
						}
						$qry_c3="SELECT count(*) num FROM `main_transaction_mt` where eko_transaction_status=2";
						$result_c3=mysql_query($qry_c3);
						while($row_c3=mysql_fetch_array($result_c3))
						{
							$c3=$row_c3['num'];
						}
						$qry_c4="SELECT count(*) num FROM `main_transaction_mt` where eko_transaction_status in(4,5)";
						$result_c4=mysql_query($qry_c4);
						while($row_c4=mysql_fetch_array($result_c4))
						{
							$c4=$row_c4['num'];
						}
						$qry_c5="SELECT count(*) num FROM `main_transaction_mt` where eko_transaction_status=0";
						$result_c5=mysql_query($qry_c5);
						while($row_c5=mysql_fetch_array($result_c5))
						{
							$c5=$row_c5['num'];
						}
						$c6=$c1-$c2-$c3-$c4-$c5;
						$c6=number_format((float)$c6, 2, '.', '');
						?>
						<table cellspacing='20'>
							<tr>
								<td width='357'>
									<div class="home-box-border">
										<br>E-REAL WALLET BALANCE
										<br><br>
										<p class="home-box-value"><?php echo $a1;?></p><br>
									</div>
								</td>
								<td width='357'>
									<div class="home-box-border">
										<br>OUR BALANCE WITH E
										<br><br>
										<p class="home-box-value"><?php echo $a2;?></p><br>
									</div>
								</td>
								<td width='357'>
									<div class="home-box-border">
										<br>DIFFERENCE
										<br><br>
										<p class="home-box-value"><?php echo $a3;?></p><br>
									</div>		
								</td>
							</tr>
						</table>
						<table cellspacing='20'>
							<tr>
								<td width='350'>
									<div class="home-box-border">
										<br>OUR BALANCE WITH E
										<br><br>
										<p class="home-box-value"><?php echo $b3;?></p><br>
									</div>		
								</td>
								<td width='350'>
									<div class="home-box-border">
										<br>PAY REAL WALLET
										<br><br>
										<p class="home-box-value"><?php echo $b1;?></p><br>
									</div>
								</td>
								<td width='350'>
									<div class="home-box-border">
										<br>MENTOR EARNING
										<br><br>
										<p class="home-box-value"><?php echo $b2;?></p><br>
									</div>
								</td>
								<td width='350'>
									<div class="home-box-border">
										<br>DIFFERENCE
										<br><br>
										<p class="home-box-value"><?php echo $b4;?></p><br>
									</div>		
								</td>
							</tr>
						</table>
						<table cellspacing='20'>
							<tr>
								<td width='350'>
									<div class="home-box-border">
										<br>Total Orders
										<br><br>
										<p class="home-box-value"><?php echo $c1;?></p><br>
									</div>
								</td>
								<td width='350'>
									<div class="home-box-border">
										<br>Not Initiated
										<br><br>
										<p class="home-box-value"><?php echo $c5;?></p><br>
									</div>
								</td>
								<td width='350'>
									<div class="home-box-border">
										<br>In Progress
										<br><br>
										<p class="home-box-value"><?php echo $c2;?></p><br>
									</div>
								</td>
								<td width='350'>
									<div class="home-box-border">
										<br>Success
										<br><br>
										<p class="home-box-value"><?php echo $c3;?></p><br>
									</div>		
								</td>
								<td width='350'>
									<div class="home-box-border">
										<br>Failed Refunded
										<br><br>
										<p class="home-box-value"><?php echo $c4;?></p><br>
									</div>		
								</td>
								<td width='350'>
									<div class="home-box-border">
										<br>Difference
										<br><br>
										<p class="home-box-value"><?php echo $c6;?></p><br>
									</div>		
								</td>
							</tr>
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
