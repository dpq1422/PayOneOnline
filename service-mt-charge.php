<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Home :: Mentor Business Systems</title>
        <link href="css/design.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="js/admin-validation-functions.js"></script>
		<script type="text/javascript" src="js/admin-validations-applied.js"></script>
		<script type="text/javascript" src="js/jquery-1.4.1.min.js" rel="javascript"></script>
		<script type="text/javascript">
		function displayTypeToProvider() 
		{
			var xhttp; 
			stype=document.getElementById("stype").value;
			xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() 
			{
				if (this.readyState == 4 && this.status == 200) 
				{
					document.getElementById("spro").innerHTML = this.responseText;
				}
			};
			xhttp.open("GET", "functions/_ajax-service-type-to-provider.php?stype="+stype, true);
			xhttp.send();
		}
		</script>
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
                        <h1>Add Commission / Charges <a href="service-mt-charges.php" class="a-button">Commission / Charges</a></h1>
						<form method="post" action="service-mt-charge-code.php" onsubmit="return validateServiceMtCharges()">
							<table class="home" frame="box" rules="all">
								<tr>
									<td align="left">Recharge Source</td>
									<td align="right">
										<select name="filled_source_name" required>
											<option></option>
											<?php
											include('_common.php');
											$query17="select * from all_recharge_source where source_status=1 order by source_id;";
											$result17=mysql_query($query17);
											while($row17=mysql_fetch_array($result17))
											{
											?>
											<option value="<?php echo $row17['source_id'];?>"><?php echo $row17['source_name'];?></option>
											<?php
											}
											?>
										</select>
									</td>
								</tr>
								<tr>
									<td>Service Type</td>
									<td align="right">
										<select id="stype" name="filled_service_name" required onchange="displayTypeToProvider()">
											<option></option>
											<?php
											$query18="select * from all_service_type where service_type_status=1 order by service_type_id;";
											$result18=mysql_query($query18);
											while($row18=mysql_fetch_array($result18))
											{
											?>
											<option value="<?php echo $row18['service_type_id'];?>"><?php echo $row18['service_type_name'];?></option>
											<?php
											}
											?>
										</select>
									</td>
								</tr>
								<tr>
									<td>Service Provider</td>
									<td align="right">
										<select id="spro" name="filled_provider_name" required>
											<option></option>
										</select>
									</td>
								</tr>
								<tr>
									<td>Commission / SurCharges</td>
									<td align="right">
										<select name="filled_ctype" required>
											<option></option>
											<option value='1'>Commission</option>
											<option value='-1'>Surcharges</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>Amount From</td>
									<td align="right"><input id="filled_from" name="filled_from" type="number" required class="text" value="0" /></td>
								</tr>
								<tr>
									<td>Amount Upto</td>
									<td align="right"><input id="filled_to" name="filled_to" type="number" required class="text" value="0" /></td>
								</tr>
								<tr>
									<td>Charges (Flat)</td>
									<td align="right"><input id="filled_flat" name="filled_flat" type="text" required class="text" value="0" /></td>
								</tr>
								<tr>
									<td>Charges (Percent)</td>
									<td align="right"><input id="filled_percent" name="filled_percent" type="text" required class="text" value="0" /></td>
								</tr>
								<tr>
									<td>Service Charge Status</td>
									<td align="right">
										<select name="filled_charge_status" class="text" required>
											<option value="1">Active</option>
											<option value="0">Block</option>
										</select>
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
