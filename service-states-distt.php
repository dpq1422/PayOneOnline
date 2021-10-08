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
                        <h1>No. of Clients in Distt.</h1>
						<table class="home" frame="box" rules="all">
							<tr>
								<th>Distt. in State</th>
								<th>No. of Active Clients in Distt.</th>
							</tr>
							<?php
							include('_common.php');
							include('functions/_CountDisttClient.php');
							$state_id=$_REQUEST['state'];
							$query10="select * from all_state_distt where distt_id in(select distt_id from parent_client where state_id='$state_id') order by distt_name;";
							$result10=mysql_query($query10);
							$distt_num="";
							while($row10=mysql_fetch_array($result10))
							{
								$distt_id=$row10['distt_id'];								
								$distt_num=count_distt_client($distt_id);
							?>
							<tr>
								<td><?php echo $row10['distt_name']; ?></td>
								<td align="right"><?php echo $distt_num; ?> ( <a href="service-states-distt-clients.php?ct=<?php echo $distt_id; ?>">Active Clients</a> )</td>
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
