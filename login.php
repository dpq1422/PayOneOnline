<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-89933769-7', 'auto');
	  ga('send', 'pageview');
	
	</script>
        <title>Login :: Mentor Business Systems</title>
        <link href="css/design.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" type="image/x-icon" href="image/mentor.ico" />
		<meta name="gwt:property" content="panel="/>
		<noscript>
			<style type="text/css">
				.bgcolor {display:none;}
			</style>
			<div class="noscriptmsg">
			You do not have javascript enabled. Please Enable Javascript in your Browser.
			</div>
		</noscript>
		<script>
		window.oncontextmenu = function () { return false; }
		</script>
		<script type='text/javascript'>
			function refreshCaptcha()
			{
				var img = document.images['captchaimg'];
				img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
			}
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
		<script type="text/javascript" language="javascript">
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
    
    <body class="bgcolor" onload="init()">
    	<div class="login-image">
        	<img src="image/bg.jpg" />
        </div>
    	<div class="login-main-container">
        	<div class="login-header">
            	<div class="login-logo">
					<a href="login.php">
						<img src="image/mentor.png" alt="Mentor Business Systems" title="Mentor Business Systems" />
					</a><br><br>
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
						if(isset($_SESSION['super_user_id']))
						{
							header("location:home.php");
						}
						if(isset($_POST['Submit'])){
							// code for check server side validation
							if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0){  
								echo "<p class='error-results'>Invalid Code! Please enter the code as appearing in the above Image.</p>";// Captcha verification is incorrect.		
							}
							else
							{
								$filled_mobile_nos=$_POST['filled_mobile_no'];
								$filled_pass_words=$_POST['filled_pass_word'];
								
								/* added for now */
								include('_common.php');
								$i=0;
								$user_id="";
								$user_type="";
								$user_name="";
								$log_id="";
								
								$response=array('val1'=>"$i",'val2'=>"$user_id",'val3'=>"$user_type",'val4'=>"$user_name");
								$query="select * from parent_user where user_id='$filled_mobile_nos' and pass_word='$filled_pass_words' and user_status=1";
								$result=mysql_query($query);	
								while($row=mysql_fetch_array($result))
								{
									$i++;
									$user_id=$row['user_id'];
									$user_type=$row['user_type'];
									$user_name=$row['user_name'];
									$response=array('val1'=>"$i",'val2'=>"$user_id",'val3'=>"$user_type",'val4'=>"$user_name");
						
									$query_log="insert into parent_user_log(user_id,login_date,login_time,login_ip,login_method,login_status,login_remarks) value('$user_id','$date_time','$time_time','$final_ip','Web','1','$browser');";
									$result_log=mysql_query($query_log);
									$log_id=mysql_insert_id();
									
								}
								if($response['val1']==1)
								{
									if(!isset($_SESSION))
									{
										session_start();
									}
									$_SESSION['super_user_id']=$response['val2'];
									$_SESSION['super_user_type']=$response['val3'];
									$_SESSION['super_user_name']=$response['val4'];
									$_SESSION['log_id']=$log_id;
									header("location:home.php");
								}
								else if($response['val1']==0)
								{
									$user_id="$filled_mobile_nos";
									$query_log="insert into parent_user_log(user_id,login_date,login_time,login_ip,login_method,login_status,login_remarks) value('$user_id','$date_time','$time_time','$final_ip','Web','0','$browser');";
									$result_log=mysql_query($query_log);
									echo "<p class='error-results'>Invalid Mobile or Password</p>";
								}
							}
						}
					?>
					<form class="form" method="post">
						<input autocomplete="off" type="text" name="filled_mobile_no" required class="text" placeholder="Mobile No." />
						<input autocomplete="off" type="password" name="filled_pass_word" required class="text" placeholder="Password" />
						<p align="center">
						<br><img style="border-radius:10px;" src="__captcha.php?rand=<?php echo rand();?>" id='captchaimg'>
						<br><label for='message'></label>
						<br><input autocomplete="off" id="captcha_code" placeholder="Enter the code as in above image" name="captcha_code" required class="text" type="text">
						<br>Can't read the image ? <a href='javascript: refreshCaptcha();'>reload</a></p>
						<input name="Submit" type="submit" class="button" value="Login" />
					</form>
                </div>
            </div>
        </div>
    </body>
</html>
