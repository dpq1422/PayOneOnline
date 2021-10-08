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
                        <h1>Admin Bank Details <a href="bank.php" class="a-button">Add Admin Bank Detail</a></h1>
						<table class="normal" frame="box" rules="all">
							<tr>
								<th>Bank Name</th>
								<th>Account Name</th>
								<th>Account No</th>
								<th>Branch Name / Code</th>
								<th>Address, City</th>
								<th>Distt.</th>
								<th>State</th>
								<th>IFSC Code</th>
								<th>MICR Code</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
							<?php
							include('_common.php');
							include('functions/_ShowDisttName.php');
							include('functions/_ShowStateName.php');
							$query7="select * from parent_bank order by bank_id desc;";
							$result7=mysql_query($query7);
							$st="";
							while($row7=mysql_fetch_array($result7))
							{
								if($row7['account_status']==0)
								$st="<b style='color:red;'>Blocked</b>";
								else if($row7['account_status']==1)
								$st="<b style='color:green;'>Active</b>";
								$selected_distt=show_distt_name($row7['distt_id']);
								$selected_state=show_state_name($row7['state_id']);
							?>
							<tr>
								<td><?php echo $row7['bank_name']; ?></td>
								<td><?php echo $row7['account_name']; ?></td>
								<td><?php echo $row7['account_no']; ?></td>
								<td><?php echo $row7['branch_name']; ?></td>
								<td><?php echo $row7['branch_address']; ?>, <?php echo $row7['city_name']; ?></td>
								<td><?php echo $selected_distt; ?></td>
								<td><?php echo $selected_state; ?></td>
								<td><?php echo $row7['ifsc_code']; ?></td>
								<td><?php echo $row7['micr_code']; ?></td>
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
