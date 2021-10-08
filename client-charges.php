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
                        <h1>Set Commission / Charges <a href="clients.php" class="a-button">Back to Clients</a></h1>
						<form method="post" action="client-mt-charges-code.php">
							<?php
							include('_common.php');
							include('functions/_ShowClientName.php');
							include('functions/_ShowClientServices.php');
							include('functions/_ShowOperatorName.php');
							include('functions/_ShowServiceTypeName.php');
							include('functions/_ShowClientMtCharges.php');							
							include('functions/_ShowSourceName.php');		
							$client_id=$_REQUEST['id'];
							$client_name=show_client_name($client_id);
							$service_types=show_client_services($client_id);
							?>
							<table class="home" style="width:100%;" frame="box" rules="all">
								<tr>
									<td>Client ID</td>
									<td colspan="8"><input name="filled_id" type="text" readonly value="<?php echo $client_id; ?>" class="text" /></td>
								</tr>
								<tr>
									<td>Client Name</td>
									<td colspan="8"><input name="filled_name" type="text" readonly value="<?php echo $client_name; ?>" class="text" /></td>
								</tr>
								<tr>
									<td>Source</td>
									<td>Services</td>
									<td>Operator / Provider</td>
									<td>Amount</td>
									<td>Type</td>
									<td>Flat Getting</td>
									<td>Percent Getting</td>
									<td>Flat Applying</td>
									<td>Percent Applying</td>
								</tr>
							<?php		
							$service_type_name="";					
							$service_type_id="";			
							$query_serv="select * from parent_charges_in_mt where service_type_id in($service_types) and service_type_id!=101 and charges_status=1 order by service_type_id;";
							$result_serv=mysql_query($query_serv);
							while($row_serv=mysql_fetch_array($result_serv))
							{
								$charges_in_id=$row_serv['charges_in_id'];
								$source_id=$row_serv['source_id'];
								$source_name=show_source_name($source_id);
								$service_type_id=$row_serv['service_type_id'];
								$operator_id=$row_serv['operator_id'];
								$charges_type=$row_serv['charges_type'];
								$charges_types="";
								if($charges_type>0)
									$charges_types="<span style='color:green;'>Commission</span>";
								else if($charges_type<0)
									$charges_types="<span style='color:blue;'>Surcharge</span>";
								else
									$charges_types="<span style='color:red;>'Not Defined</span>";
								$slab_from=$row_serv['slab_from'];
								$slab_to=$row_serv['slab_to'];
								$surcharges_fix=$row_serv['surcharges_fix'];
								$surcharges_percent=$row_serv['surcharges_percent'];
								$service_type_name=show_service_type_name($service_type_id);
								$operator_name=show_operator_name($operator_id);
								$charges_out=explode("@#@",show_client_mt_charges($client_id,$charges_in_id,$service_type_id,$operator_id,$slab_from,$slab_to));
								
							?>
								<tr>
									<td><?php echo $source_name;?></td>
									<td><?php echo $service_type_name;?></td>
									<td><?php echo $operator_name;?></td>
									<td><?php echo $slab_from." - ".$slab_to;?></td>
									<td><?php echo $charges_types;?></td>
									<td><?php echo $surcharges_fix;?></td>
									<td><?php echo $surcharges_percent;?></td>
									<td>
										<input type="hidden" class="text" style="width:32px;" name="source[]" value="<?php echo $source_id;?>"/>
										<input type="hidden" class="text" style="width:32px;" name="ctype[]" value="<?php echo $charges_type;?>"/>
										<input type="hidden" class="text" style="width:32px;" name="charge[]" value="<?php echo $charges_in_id;?>"/>
										<input type="hidden" class="text" style="width:32px;" name="servic[]" value="<?php echo $service_type_id;?>"/>
										<input type="hidden" class="text" style="width:32px;" name="operat[]" value="<?php echo $operator_id;?>"/>
										<input type="hidden" class="text" style="width:32px;" name="amtf[]" value="<?php echo $slab_from;?>"/>
										<input type="hidden" class="text" style="width:32px;" name="amtt[]" value="<?php echo $slab_to;?>"/>
										<input class="text" style="width:35px;" name="flat[]" value="<?php echo $charges_out[0];?>"/>
									</td>
									<td>
										<input class="text" style="width:35px;" name="perc[]" value="<?php echo $charges_out[1];?>"/>
									</td>
								</tr>
							<?php
							}
							?>	
								<tr>
									<td></td>
									<td align="right" colspan="8"><input type="submit" class="button" /></td>
								</tr>
							</table>  
						</form>						
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
