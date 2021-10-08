<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
	<?php 
	ini_set('expose_php',0);
	header("X-Powered-By: CentOS"); 
	header("X-Powered-By: Ubuntu"); 
	header("X-Powered-By: Servlet"); 
	//header("X-Powered-By: Tomcat"); 
	//header("X-Powered-By: Coyote"); 
	?>
	<script>if(window.Polymer==window.Polymer){}</script>
	<script src="js/angular.min.js"></script>
	<script src="js/node.js"></script>
	<script src="js/backbone.js"></script>
	<meta name="gwt:property" content="panel="/>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Mentor Portal" />
        <title>Login</title>
        <link rel="shortcut icon" type="image/x-icon" href="img/mentor.ico" />
        <link href="css/icon.css" rel="stylesheet" />
        <link href="css/font-awesome.min.css " rel="stylesheet" />
        <link type="text/css" rel="stylesheet" href="css/mara.min.css" media="screen" />
        <link rel="stylesheet" href="css/api.css" />
        <link rel="stylesheet" href="css/sweetalert2.min.css" />
        <link rel="stylesheet" href="css/animate.min.css" />
        <link rel="stylesheet" href="css/ladda-themeless.min.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<noscript>
			<style type="text/css">
				.black {display:none;}
			</style>
			<div class="noscriptmsg">
			You do not have javascript enabled. Please Enable Javascript in your Browser.
			</div>
		</noscript>
		<script>
		window.oncontextmenu = function () { return false; }
		</script>
		<script type="text/JavaScript">
			function killCopy(e)
			{
				return false;
			}
			function reEnable()
			{
				return true;
			}
			document.onselectstart=new Function ("return false");
			if (window.sidebar)
			{
				document.onmousedown=killCopy;
				document.onclick=reEnable;
			}
		</script>
		<script type='text/javascript' type="javascript">	
			function refreshCaptcha()
			{				
				var img = document.images['captchaimg'];
				img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
			}
            function init()
            {
                navigator.sayswho= (function(){
                    var N= navigator.appName, ua= navigator.userAgent, tem;
                    var M= ua.match(/(opera|chrome|safari|firefox|msie)\/?\s*(\.?\d+(\.\d+)*)/i);
                    if(M && (tem= ua.match(/version\/([\.\d]+)/i))!= null) M[2]= tem[1];
                    M= M? [M[1], M[2]]: [N, navigator.appVersion, '-?'];

                    return M;
                })();
				var returnValue=navigator.sayswho;
                var val=returnValue.indexOf("Chrome");
                if(val==-1)
                {
                    alert("Please use Google Chrome for this portal...");
                    document.location.href='https://www.google.com/chrome';
                }
            }
        </script>
    </head>
    
    <body class="black cyan-scheme" onload="init()">
		<?php		
		if(!isset($_SESSION))
		{
			session_start();
		}
		if(isset($_SESSION['user_id']))
		{
			if($_SESSION['user_type']=="1" || $_SESSION['user_type']=="0")
			{
				header("location:admin/home.php");
			}
			else if($_SESSION['user_type']>"1" && $_SESSION['user_type']<"11")
			{
				header("location:distributor/home.php");
			}
			else if($_SESSION['user_type']=="11")
			{
				header("location:retailer/home.php");
			}
		}
		?>    
        <div class=" center signin-page" id="full-page">
            <div class="white-text signin-content">
                <div class=" white signUpContainer center card" style="padding: 20px">
    
                    <h1 class="center-align mTitle" style="font-family: BaronFont;">
                        <img src="img/payone-logo.png" alt="Login" /></h1>
    
                    <h6 id="titleWish" class="black-text center-align" style="margin-bottom: 40px;">Hello, Welcome ! </h6>    
					<?php 
						$ipaddress1 = "";
						if (isset($_SERVER['HTTP_CLIENT_IP']))//check ip from share internet
							$ipaddress1 = $_SERVER['HTTP_CLIENT_IP'];
						else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))//to check ip is pass from proxy
							$ipaddress1 = $_SERVER['HTTP_X_FORWARDED_FOR'];
						else if(isset($_SERVER['HTTP_X_FORWARDED']))
							$ipaddress1 = $_SERVER['HTTP_X_FORWARDED'];
						else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
							$ipaddress1 = $_SERVER['HTTP_FORWARDED_FOR'];
						else if(isset($_SERVER['HTTP_FORWARDED']))
							$ipaddress1 = $_SERVER['HTTP_FORWARDED'];
						else if(isset($_SERVER['REMOTE_ADDR']))
							$ipaddress1 = $_SERVER['REMOTE_ADDR'];
						else
							$ipaddress1 = 'UNKNOWN';
							
							
						$ipaddress2 = "";
						if (getenv('HTTP_CLIENT_IP'))//check ip from share internet
							$ipaddress2 = getenv('HTTP_CLIENT_IP');
						else if(getenv('HTTP_X_FORWARDED_FOR'))//to check ip is pass from proxy
							$ipaddress2 = getenv('HTTP_X_FORWARDED_FOR');
						else if(getenv('HTTP_X_FORWARDED'))
							$ipaddress2 = getenv('HTTP_X_FORWARDED');
						else if(getenv('HTTP_FORWARDED_FOR'))
							$ipaddress2 = getenv('HTTP_FORWARDED_FOR');
						else if(getenv('HTTP_FORWARDED'))
							$ipaddress2 = getenv('HTTP_FORWARDED');
						else if(getenv('REMOTE_ADDR'))
							$ipaddress2 = getenv('REMOTE_ADDR');
						else
							$ipaddress2 = 'UNKNOWN';
							
						$final_ip=$ipaddress1."<br>".$ipaddress2;
						$browser=$_SERVER['HTTP_USER_AGENT'];
						
						if(!isset($_SESSION))
						{
							session_start();
						}
						if(isset($_POST['Submit'])){
							// code for check server side validation
							if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0){  
								$err_msg="Invalid Captcha Code...!<br>Please enter the code as appearing in the above Image.";
								echo "<p class='error-results'>$err_msg</p>"; // Captcha verification is incorrect.		
							}
							else
							{
								$filled_mobile_no=$_POST['userID'];
								$filled_pass_word=$_POST['userPIN'];
								$i=0;
								
								/* added for now */
								include_once('_common-admin.php');
								$pass_word=mt_rand(111111,999999);
								$query="update child_user set pass_word=md5('$pass_word'), past_change_on='$datetime_time', invalid_attempt=0, user_status=1 where user_id='$filled_mobile_no' and user_contact_no='$filled_pass_word' and user_status not in(3,4)";
								mysql_query($query);
								include_once('functions/_zsms.php');
								$zsms=create_forgot_msg($pass_word);
								zsms($filled_pass_word,$zsms);
								$err_msg="Password reset informaion is<br>sent to your registered mobile no.<br>";
								echo "<p class='error-results' style='color:white!important;'>$err_msg</p>";
							}
						}
					?>
                    <form method="post" class="signUpContent col l8 offset-l2" id="first_step">
    
                        <div class="input-field" style="margin: 0px auto; max-width: 250px;">
                            <input autocomplete="off" id="userID" name="userID" required autocomplete="off" type="text" maxlength="6" class="validate black-text">
                            <label for="text" class="left-align">Enter User ID</label>
                        </div>
						<div class="input-field" style="margin: 0px auto; max-width: 250px;">
                            <input autocomplete="off" id="userPIN" name="userPIN" required autocomplete="off" type="text" maxlength="10" class="validate black-text">
                            <label for="text" class="left-align">Enter Registsred Mobile No.</label>
                        </div>
						<div class="input-field" style="margin: 0px auto; max-width: 250px;">						
                            <input autocomplete="off" id="captcha_code" required name="captcha_code" autocomplete="off" type="text" maxlength="6" class="validate black-text">
                            <label for="text" class="left-align">Enter the code as in above image</label>
							<img style="border-radius:10px;" src="__captcha.php?rand=<?php echo rand();?>" id='captchaimg'>
                        </div>
						<div class="button" style="text-align:center;margin: 5px auto; max-width: 250px;">
							<input name="Submit" type="submit" value="Recover Password" class="btns">
                        </div>
                        <p style="text-align:left;">
                            <small style=" margin-top:-5px;"><b style='font-weight:normal;color:black;'>Can't read the image ?</b> <a href='javascript: refreshCaptcha();'>Reload</a></small>
                             <small style="float:right;"><a href="login.php">Login</a></small>
                        </p>
                    </form>
					
                </div>
            </div>
        </div>
        <div id="form1">
        </div>
        <script src="js/jquery-2.1.1.min.js"></script>
        <script src="js/materialize.js"></script>    
    </body>
</html>
