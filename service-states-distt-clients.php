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
                        <h1>List of Clients in Distt.</h1>
						<table class="normal" frame="box" rules="all">
							<tr>
								<th>Client Name</th>
								<th>Distt.</th>
								<th>State</th>
								<th>Contact No</th>
								<th>E-mail</th>
								<th>DOB</th>
								<th>Wallet Balance</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
							<?php
							include('_common.php');
							include('functions/_ShowDisttName.php');
							include('functions/_ShowStateName.php');
							$city_id=$_REQUEST['ct'];
							$query25="select * from parent_client where client_contact_no!=0 and distt_id='$city_id' order by client_id desc;";
							$result25=mysql_query($query25);
							$ut="";
							$st="";
							while($row25=mysql_fetch_array($result25))
							{
								
								if($row25['client_status']==1)
								$st="<b style='color:green;'>Active</b>";
								else if($row25['client_status']==2)
								$st="<b style='color:red;'>Blocked</b>";
								
								$selected_distt=show_distt_name($row25['distt_id']);
								$selected_state=show_state_name($row25['state_id']);
							?>
							<tr>
								<td><?php echo $row25['client_name']; ?></td>
								<td><?php echo $selected_distt; ?></td>
								<td><?php echo $selected_state; ?></td>
								<td><?php echo $row25['client_contact_no']; ?></td>
								<td><?php echo $row25['e_mail']; ?></td>
								<td><?php echo $row25['dob']; ?></td>
								<td><?php echo $row25['wallet_balance']; ?></td>
								<td><?php echo $st; ?></td>
								<td><a href="">Change Status</a></td>
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
