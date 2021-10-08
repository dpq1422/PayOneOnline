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
                        <h1>Admin Users <a href="user.php" class="a-button">Add Admin User</a></h1>
						<table class="normal" frame="box" rules="all">
							<tr>
								<th>User ID</th>
								<th>Joining Date Time</th>
								<th>User Type</th>
								<th>Name</th>
								<th>City, Distt., State</th>
								<th>Email</th>
								<th>Contact No</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
							<?php
							include('_common.php');
							include('functions/_ShowDisttName.php');
							include('functions/_ShowStateName.php');
							$query5="select * from parent_user order by user_id desc;";
							$result5=mysql_query($query5);
							$ut="";
							$st="";
							while($row5=mysql_fetch_array($result5))
							{
								$ut=show_user_type_name($row5['user_type']);
								
								if($row5['user_status']==0)
								$st="<b style='color:red;'>Blocked</b>";
								else if($row5['user_status']==1)
								$st="<b style='color:green;'>Active</b>";
								
								$selected_distt=show_distt_name($row5['distt_id']);
								$selected_state=show_state_name($row5['state_id']);
							?>
							<tr>
								<td><?php echo $row5['user_id']; ?></td>
								<td>
									<?php echo $row5['join_date']; ?>
									 @ 
									<?php echo $row5['join_time']; ?>
								</td>
								<td><?php echo $ut; ?></td>
								<td><?php echo $row5['user_name']; ?></td>
								<td><?php echo $row5['city_name'].", ".$selected_distt.", ".$selected_state; ?></td>
								<td><?php echo $row5['e_mail']; ?></td>
								<td><?php echo $row5['user_contact_no']; ?></td>
								<td><?php echo $st; ?></td>
								<td>
									<a href="">Change Status</a>
									<br>
									<a href="user-login-details.php?id=<?php echo $row5['user_id']; ?>">Login Details</a>
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
