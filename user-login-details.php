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
                        <h1>User Login Details <a href="users.php" class="a-button">Back to Users</a></h1>
						<table class="normal" frame="box" rules="all">
							<tr>
								<th>Login Date<br>Login Time</th>
								<th>Logout Date<br>Logout Time</th>
								<th>Access Via</th>
								<th>IP</th>
								<th>Login Status</th>
								<th>Remarks</th>
							</tr>
							<?php
							include('_common.php');							
							$uid=$_REQUEST['id'];
							$query5="select * from parent_user_log where user_id='$uid' order by log_id desc;";
							$result5=mysql_query($query5);
							while($row5=mysql_fetch_array($result5))
							{		
								$st="";
								if($row5['login_status']==1)
								$st="<b style='color:green;'>Success</b>";
								else if($row5['login_status']==0)
								$st="<b style='color:red;'>Failed</b>";
							?>
							<tr>
								<td><?php echo $row5['login_date']; ?><br><?php echo $row5['login_time']; ?></td>
								<td><?php echo $row5['logout_date']; ?><br><?php echo $row5['logout_time']; ?></td>
								<td><?php echo $row5['login_method']; ?></td>
								<td><?php echo $row5['login_ip']; ?></td>
								<td><?php echo $st; ?></td>
								<td><?php echo $row5['login_remarks']; ?></td>
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
