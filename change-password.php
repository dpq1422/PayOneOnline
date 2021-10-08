<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Home :: Mentor Business Systems</title>
        <link href="css/design.css" rel="stylesheet" type="text/css" />
		<script language="javascript" type="text/javascript">
		function check()
		{
			var p1=document.getElementById("p1").value;
			var p2=document.getElementById("p2").value;
			if(p1!=p2)
			{
				alert("New Password and Confirm Password not matched");
				return false;
			}
			else
			{
				return true;
			}
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
                        <h1>Change Password</h1>
						<form method="post" action="change-password-code.php" onsubmit="return check()">
							<table class="home" frame="box" rules="all">
							<?php
								if(isset($_REQUEST['msg']))
								{
									if($_REQUEST['msg']=="same")
									{
										echo "<caption class='error-result' style='text-align:center!important;'>Old Password and New Password should not be same</caption>";
									}
									else if($_REQUEST['msg']=="fail")
									{
										echo "<caption class='error-result' style='text-align:center!important;'>Old Password not matched</caption>";
									}
									else if($_REQUEST['msg']=="done")
									{
										echo "<caption class='error-result' style='text-align:center!important;'>Password Changed</caption>";
									}
									else
									{
										echo "<caption>&nbsp;</caption>";
									}
								}
								else
								{
									echo "<caption>&nbsp;</caption>";
								}
							?>
								<tr>
									<td align="left">Old Password</td>
									<td align="right">
										<input name="filled_old_pass" type="password" required class="text" />
									</td>
								</tr>
								<tr>
									<td>New Password</td>
									<td align="right"><input name="filled_new_pass" id="p1" type="password" required class="text" /></td>
								</tr>
								<tr>
									<td>Confirm Password</td>
									<td align="right"><input id="p2" type="password" required class="text" /></td>
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
