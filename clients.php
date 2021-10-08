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
                        <h1>List of Clients <a href="client.php" class="a-button">Add Client</a></h1>
						<h1 style="color:red;">Contact IT Head to add new client<br> because for every new client need to manage different wallet</h1>
						<table class="normal" frame="box" rules="all">
							<tr>
								<th>Client ID</th>
								<th>Client Name, Distt., State</th>
								<th>Contact No, E-mail</th>
								<th>Wallet Balance</th>
								<th>Services</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
							<?php
							include('_common.php');
							include('functions/_ShowDisttName.php');
							include('functions/_ShowStateName.php');
							include('functions/_ShowServiceTypeName.php');
							$query25="select * from parent_client where client_id!=0 order by client_id desc;";
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
								
								$service_types=explode(",",$row25['service_types']);
								$service_type="";
								$mt_avail=0;
								$ot_avail=0;
								for($aa=0;$aa<count($service_types);$aa++)
								{
									$service_typ=$service_types[$aa];
									$service_type=$service_type.show_service_type_name($service_typ)."<br><br>";
									
									if($service_typ!=0 && $service_typ!=101)
									$ot_avail++;
									if($service_typ==101)
									$mt_avail++;
									
								}
								
							?>
							<tr>
								<td><?php echo $row25['client_id']; ?></td>
								<td>
									<?php echo $row25['client_name']; ?>
									<br><br><?php echo $selected_distt; ?>
									<br><br><?php echo $selected_state; ?>
								</td>
								<td>
									<?php echo $row25['client_contact_no']; ?>
									<br><br><?php echo $row25['e_mail']; ?>
								</td>
								<td><?php echo $row25['wallet_balance']; ?></td>
								<td><?php echo $service_type; ?></td>
								<td><?php echo $st; ?></td>
								<td>
									<a href="client-services.php?id=<?php echo $row25['client_id']; ?>">Allocate Service</a>
									<?php 
									
									if($ot_avail!=0)
									{
									?>
									<br><br><a href="client-charges.php?id=<?php echo $row25['client_id']; ?>">Set Commission / Charges</a>
									<?php 
									echo "&nbsp;&nbsp;&nbsp;";
									} 
									if($mt_avail!=0)
									{
										
									?>
									<br><br><a href="client-mt-charges.php?id=<?php echo $row25['client_id']; ?>"><b>Set Money Transfer Charges</b></a>
									<?php 
									
									}
									
									?>
									
								</td>
							<tr/>
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
