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
                        <h1>Add Provider / Operator<a href="service-operators.php" class="a-button">Providers / Operators</a></h1>
						<form method="post" action="service-operator-code.php">
							<table class="home" frame="box" rules="all">
								<tr>
									<td align="left">Service Type</td>
									<td align="right">
										<select name="filled_service_type" required>
											<option></option>
											<?php
											include('_common.php');
											$query13="select * from all_service_type where service_type_status=1 order by service_type_id;";
											$result13=mysql_query($query13);
											while($row13=mysql_fetch_array($result13))
											{
											?>
											<option value="<?php echo $row13['service_type_id'];?>"><?php echo $row13['service_type_name'];?></option>
											<?php
											}
											?>
										</select>
									</td>
								</tr>
								<tr>
									<td>Service Provider / Operator Name</td>
									<td align="right"><input name="filled_service_name" type="text" required class="text" /></td>
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
