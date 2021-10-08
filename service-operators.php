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
                        <h1>Providers / Operators <a href="service-operator.php" class="a-button">Add Provider / Operator</a></h1>
						<table class="normal" frame="box" rules="all">
							<tr>
								<th>Operator /Provider ID</th>
								<th>Service Type</th>
								<th>Service Operator Name</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
							<?php
							include('_common.php');
							include('functions/_ShowServiceTypeName.php');
							
							$query15="select * from all_operator where service_type_id!=0 order by service_type_id desc,operator_name asc;";
							$result15=mysql_query($query15);
							$tp="";
							$tp_name="";
							while($row15=mysql_fetch_array($result15))
							{
								$tp=$row15['service_type_id'];
								$tp_name=show_service_type_name($tp);
								$st=$row15['operator_status'];
								if($st==1)
								$st="<b style='color:green;'>Active</b>";
								else
								$st="<b style='color:red;'>Blocked</b>";
							?>
							<tr>
								<td><?php echo $row15['operator_id']; ?></td>
								<td><?php echo $tp_name; ?></td>
								<td><?php echo $row15['operator_name']; ?></td>
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
