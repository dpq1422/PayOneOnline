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
                        <h1>Allocate Service <a href="clients.php" class="a-button">Back to Clients</a></h1>
						<form method="post" action="client-services-code.php">
							<?php
							include('_common.php');
							include('functions/_ShowClientName.php');
							include('functions/_ShowClientServices.php');
							include('functions/_ShowOperatorName.php');
							include('functions/_ShowServiceTypeName.php');
							include('functions/_ShowClientMtCharges.php');
							$client_id=$_REQUEST['id'];
							$client_name=show_client_name($client_id);
							$service_types=show_client_services($client_id);
							$service_types=explode(",",$service_types);
							?>
							<table class="home" frame="box" rules="all">
								<tr>
									<td>Client ID</td>
									<td><input name="filled_id" type="text" readonly value="<?php echo $client_id; ?>" class="text" /></td>
								</tr>
								<tr>
									<td>Client Name</td>
									<td><input name="filled_name" type="text" readonly value="<?php echo $client_name; ?>" class="text" /></td>
								</tr>
								<tr>
									<td>Services</td>
									<td>
									<?php		
							$service_type_name="";					
							$service_type_id="";					
							$query_serv="select * from all_service_type where service_type_id!=0 and service_type_status=1;";
							$result_serv=mysql_query($query_serv);
							while($row_serv=mysql_fetch_array($result_serv))
							{
								$service_type_name=$row_serv['service_type_name'];
								$service_type_id=$row_serv['service_type_id'];
								$flag=0;
								for($aa=0;$aa<count($service_types);$aa++)
								{
									$service_typ=$service_types[$aa];
									if($service_typ==$service_type_id)
									{
										$flag++;
									?>
			<input name="filled_services[]" checked type="checkbox" value="<?php echo $row_serv['service_type_id'];?>" />&nbsp;&nbsp;<?php echo $row_serv['service_type_name'];?><br><br>
									<?php
										break;
									}
								}
								if($flag==0)
								{
									?>
			<input name="filled_services[]" type="checkbox" value="<?php echo $row_serv['service_type_id'];?>" />&nbsp;&nbsp;<?php echo $row_serv['service_type_name'];?><br><br>
									<?php
								}
							}
									?>									
									</td>
								</tr>
								<tr>
									<td></td>
									<td align="right"><input type="submit" class="button" /></td>
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
