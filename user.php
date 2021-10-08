<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Home :: Mentor Business Systems</title>
        <link href="css/design.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="js/admin-validation-functions.js"></script>
		<script type="text/javascript" src="js/admin-validations-applied.js"></script>
		<script src="js/jquery-1.7.2.min.js" type="text/javascript"></script>	
		<script>
		function ShowDistOfState()
		{
			var StateName = $("#StateName").val();
			//make the AJAX request, dataType is set to json
			//meaning we are expecting JSON data in response from the server
			$.ajax({
				type: "POST",
				url: "functions/_ajax-ShowDistOfState.php",
				data: {'StateName': StateName },
				dataType: "json",
			 
				//if received a response from the server
				success: function( data, textStatus, jqXHR) {
					//our country code was correct so we have some information to display/
					$("#LoadDist").html(data);
				},
				error: function(xhr, textStatus, errorThrown) {
					// Handle error
					//alert(xhr+":"+textStatus+":"+errorThrown);
				}	 
			});
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
                        <h1>Add Admin User <a href="users.php" class="a-button">Admin Users</a></h1>
						<form method="post" action="user-code.php" onsubmit="return validateUser()">
							<table class="home" frame="box" rules="all">
								<tr>
									<td align="left">User Type</td>
									<td align="right">
										<select required name="filled_user_type">
											<option></option>
											<option value="1">Application Admin</option>
											<option value="2">Service Manager</option>
											<option value="3">Tariff Manager</option>
											<option value="4">Client Manager</option>
											<option value="5">Order Manager</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>Name</td>
									<td align="right"><input name="filled_name" type="text" required class="text" /></td>
								</tr>
								<tr>
									<td valign="top">Address</td>
									<td align="right"><textarea name="filled_address" required></textarea></td>
								</tr>
								<tr>
									<td>State</td>
									<td align="right">
										<select id="StateName" name="filled_state" onchange="ShowDistOfState()" required>
											<option></option>
											<?php
											include('_common.php');
											$query32="select * from all_state where state_status!=0 and state_id!=0 order by state_id;";
											$result32=mysql_query($query32);
											while($row32=mysql_fetch_array($result32))
											{
											?>
											<option value="<?php echo $row32['state_id'];?>"><?php echo $row32['state_name'];?></option>
											<?php
											}
											?>
										</select>
									</td>
								</tr>
								<tr>
									<td>Distt.</td>
									<td align="right" id="LoadDist">
										<select name="filled_dist" required>
											<option></option>
										</select>
									</td>
								</tr>
								<tr>
									<td>City</td>
									<td align="right">
										<input type="text" class="text" name="filled_city" required />
									</td>
								</tr>
								<tr>
									<td>Area Pin Code</td>
									<td align="right"><input id="filled_area_pin_code" name="filled_area_pin_code" type="number" required class="text" /></td>
								</tr>
								<tr>
									<td>E-Mail</td>
									<td align="right"><input id="filled_e_mail" name="filled_e_mail" type="email" required class="text" /></td>
								</tr>
								<tr>
									<td>Contact No</td>
									<td align="right"><input id="filled_contact_no" name="filled_contact_no" type="text" required class="text" /></td>
								</tr>
								<tr>
									<td>Password</td>
									<td align="right"><input name="filled_pass_word" type="password" required class="text" /></td>
								</tr>
								<tr>
									<td>User Status</td>
									<td align="right">
										<select name="filled_user_status" required>
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
