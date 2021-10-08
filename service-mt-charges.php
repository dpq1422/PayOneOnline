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
                        <h1>Commission / Charges <a href="service-mt-charge.php" class="a-button">Add Commission / Charge</a></h1>
						<table class="normal" frame="box" rules="all">
							<tr>
								<th>Recharge Source</th>
								<th>Service Type</th>
								<th>Service Provider</th>
								<th>Amount From - To</th>
								<th>Type</th>
								<th>Commission / Surcharges</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
							<?php
							include('_common.php');							
							include('functions/_ShowServiceTypeName.php');							
							include('functions/_ShowSourceName.php');							
							include('functions/_ShowOperatorName.php');							
							
							$query19="select * from parent_charges_in_mt order by source_id, service_type_id, operator_id;";
							$result19=mysql_query($query19);
							$st="";
							while($row19=mysql_fetch_array($result19))
							{								
								$st="";
								
								if($row19['charges_status']==0)
								$st="<b style='color:red;'>Blocked</b>";
								else if($row19['charges_status']==1)
								$st="<b style='color:green;'>Active</b>";
								$src=show_source_name($row19['source_id']);
								$tp=show_service_type_name($row19['service_type_id']);
								$prvr=show_operator_name($row19['operator_id']);
								$res_slab=$row19['slab_from']." - ".$row19['slab_to'];
								
								$charges_type=$row19['charges_type'];
								if($charges_type>0)
									$charges_type="<b style='color:green;'>Commission</b>";
								else if($charges_type<0)
									$charges_type="<b style='color:blue;'>Surcharge</b>";
								else
									$charges_type="<b style='color:red;>'Not Defined</b>";
								
								$res_charges="";
								if($row19['surcharges_fix']!=0)
								$res_charges=$res_charges."<b>".$row19['surcharges_fix']."</b> FLAT";
								if($row19['surcharges_percent']!=0 && $row19['surcharges_fix']==0)
								$res_charges=$res_charges."<b>".$row19['surcharges_percent']."</b> PERCENT";
								if($row19['surcharges_percent']!=0 && $row19['surcharges_fix']!=0)
								$res_charges=$res_charges."<br><b>".$row19['surcharges_percent']."</b> PERCENT<br>which is higher";
							
								$sts="";
								if($row19['charges_status']==0)
									$sts=1;
								else if($row19['charges_status']==1)
									$sts=0;
								$href="?id=".$row19['charges_in_id']."&sts=$sts";
							?>
							<tr>
								<td><?php echo $src; ?></td>
								<td><?php echo $tp; ?></td>
								<td><?php echo $prvr; ?></td>
								<td><?php echo $res_slab; ?></td>
								<td><?php echo $charges_type; ?></td>
								<td><?php echo $res_charges; ?></td>
								<td><?php echo $st; ?></td>
								<td><a href="service-mt-chargest.php<?php echo $href;?>">Change Status</a></td>
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
