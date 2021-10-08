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
                        <h1>My Profile <a href="change-password.php" class="a-button">Change Password</a></h1>
						<?php
						include('_common.php');
						include('functions/_ShowDisttName.php');
						include('functions/_ShowStateName.php');
						$name="";
						$address="";
						$city="";
						$distt="";
						$state="";
						$contact_no="";
						
						$query1="select * from parent_user where user_id='$user_id'";
						$result1=mysql_query($query1);						
						while($row1=mysql_fetch_array($result1))
						{
							$name=$row1['user_name'];
							$address=$row1['address'];
							$city=$row1['city_name'];
							$distt=show_distt_name($row1['distt_id']);
							$state=show_state_name($row1['state_id']);
							$contact_no=$row1['user_contact_no'];
						}
						?>
                        <table class="home" frame="box" rules="all">
                        	<tr>
                            	<td>User ID</td>
                                <td align="right"><?php echo $user_id; ?></td>
                            </tr>
                        	<tr>
                            	<td>Name</td>
                                <td align="right"><?php echo $name; ?></td>
                            </tr>
                        	<tr>
                            	<td>Registered Mobile</td>
                                <td align="right"><?php echo $contact_no; ?></td>
                            </tr>
                        	<tr>
                            	<td>Designation</td>
                                <td align="right"><?php echo $user_types; ?></td>
                            </tr>
                        	<tr>
                            	<td>Address</td>
                                <td align="right"><?php echo $address; ?></td>
                            </tr>
                        	<tr>
                            	<td>City</td>
                                <td align="right"><?php echo $city; ?></td>
                            </tr>
                        	<tr>
                            	<td>Distt</td>
                                <td align="right"><?php echo $distt; ?></td>
                            </tr>
                        	<tr>
                            	<td>State</td>
                                <td align="right"><?php echo $state; ?></td>
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
