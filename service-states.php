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
                        <h1>No. of Clients in States</h1>
						<table class="home" frame="box" rules="all">
							<tr>
								<th>State Name</th>
								<th>No. of Active Clients in States</th>
							</tr>
							<?php
							include('_common.php');
							include('functions/_CountStateClient.php');
							$query8="select * from all_state where state_id!=0 and state_status!=0 order by state_name;";
							$result8=mysql_query($query8);
							$state_id="";
							$state_num="";
							while($row8=mysql_fetch_array($result8))
							{
								$state_id=$row8['state_id'];
								$state_num=count_state_client($state_id);
							?>
							<tr>
								<td><?php echo $row8['state_name']; ?></td>
								<td align="right">
								<?php 
								if($state_num!=0) 
								{
								echo $state_num; ?> ( <a href="service-states-distt.php?state=<?php echo $row8['state_id']; ?>">Active Clients</a> )
								<?php
								}
								?>
								</td>
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
