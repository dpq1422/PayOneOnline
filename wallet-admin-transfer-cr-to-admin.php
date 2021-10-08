<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Home :: Mentor Business Systems</title>
        <link href="css/design.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="js/admin-validation-functions.js"></script>
		<script type="text/javascript" src="js/admin-validations-applied.js"></script>
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
                        <h1>Update Admin Wallet <a href="wallet-client.php" class="a-button">Distribution Wallet</a></h1>
						<form method="post" action="wallet-admin-transfer-cr-to-admin-code.php" onsubmit="return validateAmount()">
							<table class="home" frame="box" rules="all">
								<tr>
									<td>Received Date</td>
									<td align="right"><input name="filled_date" type="date" required class="text" /></td>
								</tr>
								<tr>
									<td>Wallet Source</td>
									<td align="right">
										<select required name="source_wallet">
											<option value=''></option>
											<option value='1'>Eko</option>
											<option value='2'>Aqua</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>Amount</td>
									<td align="right"><input id="filled_amount" name="filled_amount" type="text" required class="text" /></td>
								</tr>
								<tr>
									<td valign="top">Description</td>
									<td align="right"><textarea name="filled_description" required></textarea></td>
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
