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
                        <h1>Service Types <a href="service-type.php" class="a-button">Add Service Type</a></h1>						
						<h1 style="color:red;">Contact IT Head to add new service type<br> because for every new service type need to activate few links</h1>
						<table class="normal" frame="box" rules="all">
							<tr>
								<th>Service Type ID</th>
								<th>Service Type Name</th>
								<th>Remarks</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
							<?php
							include('_common.php');
							$query12="select * from all_service_type where service_type_id!=0 order by service_type_id asc;";
							$result12=mysql_query($query12);
							$st="";
							while($row12=mysql_fetch_array($result12))
							{
								if($row12['service_type_status']==0)
								$st="<b style='color:red;'>Blocked</b>";
								else if($row12['service_type_status']==1)
								$st="<b style='color:green;'>Active</b>";
								
							?>
							<tr>
								<td><?php echo $row12['service_type_id']; ?></td>
								<td><?php echo $row12['service_type_name']; ?></td>
								<td><?php echo $row12['service_remarks']; ?></td>
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
