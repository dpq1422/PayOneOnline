<!DOCTYPE html>
<html>
<head>
<title>PayOneOnline.com</title>
<?php 
ini_set('expose_php',0);
header("X-Powered-By: CentOS"); 
header("X-Powered-By: Ubuntu"); 
header("X-Powered-By: Servlet"); 
//header("X-Powered-By: Tomcat"); 
//header("X-Powered-By: Coyote"); 
ob_start();
?>
<script>if(window.Polymer==window.Polymer){}</script>
<script src="js/angular.min.js"></script>
<script src="js/node.js"></script>
<script src="js/backbone.js"></script>
<meta name="gwt:property" content="panel="/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
<link rel="stylesheet" href="css/w3.css" type="text/css">
<link rel="stylesheet" href="css/style.css" type="text/css">
<script src="js/jquery-1.7.2.min.js" type="text/javascript"></script>
<link href="css/tinyslide.css" rel="stylesheet" />	
<script src="js/tinyslide.js" /></script>	
<style>
 p#err{color:#dd5d5d;text-align:center;font-weight:bold;}
</style>
<script>
function check_user()
{
	var filled_mobile_no = $("#filled_mobile_no").val();
	$(".pass-val").hide();
	$("#error-box").hide();
	$("#filled_pass_word").val('');
	$("#captcha_code").val('');
	$("#err").html('');
	if(filled_mobile_no.length==6)
	{
		//make the AJAX request, dataType is set to json
		//meaning we are expecting JSON data in response from the server
		$.ajax({
			type: "POST",
			url: "AjaxCheckUserServlet",
			data: {'filled_mobile_no': filled_mobile_no},
			dataType: "json",
		 
			//if received a response from the server
			success: function( data, textStatus, jqXHR) {
				//our country code was correct so we have some information to display/
				if(data==0)
				{
					$("#error-title").html("Who are you?");
					$("#error-message").html("What are you trying to do on this portal?<br><br>An action can be taken against you via your PC and IP address under \"Cyber Crime Activity\"");
					$("#error-box").show();
				}
				else
				{
					data=data.split("@#@");
					if(data[1]==1)
					{
						$("#filled_mobile_no").hide();
						$("#WelcomeUser").html(data[0]);
						$(".pass-val").show();
						$(".login_btu").hide();
						$(".capt").hide();
						$("#filled_pass_word").val('');
						$("#captcha_code").val('');
						$("#filled_pass_word").focus();
					}
					else
					{
						var ermsg="";
						if(data[1]==2)
						{
							ermsg="Your account is <b>blocked</b> due to 3 or more invalid login attempts.<br>Please contact admin.";
						}
						if(data[1]==3)
						{
							ermsg="Your account is <b>suspended</b>. Please contact admin.";
						}
						if(data[1]==4)
						{
							ermsg="Your account is <b>terminated</b>. Please contact admin.";
						}
						$("#error-title").html("Sorry");
						$("#error-message").html("<br>"+data[0]+"<br><br>"+ermsg);
						$("#error-box").show();
					}
				}
			}	 
		});
	}
}
function check_pass()
{
	var filled_pass_word = $("#filled_pass_word").val();
	if(filled_pass_word.length==10)
	{
		$(".pass-val").hide();
		$("#WelcomeUser").show();
		$(".capt").show();
		$(".login_btu").hide();
		$("#captcha_code").focus();
	}
}
function check_captcha()
{
	var captcha_code = $("#captcha_code").val();
	if(captcha_code.length==4)
	{
		$("#ForgotPassword").click();
	}
}
function close_error_box()
{
	document.getElementById('error-box').style.display='none';
	document.getElementById('filled_mobile_no').focus();
}
function xyz()
{
	document.getElementById("refsimgs").src = "img/refresh.gif";
	setTimeout(xyz2,500);
}
function xyz2()
{
	document.getElementById("captchaimg").src = "__captcha";
	document.getElementById("refsimgs").src = "img/refresh.png";
	$("#captcha_code").focus();
}
function myFunction() {
    var x = document.getElementById("filled_pass_word");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
function myFocus()
{
	document.getElementById("filled_mobile_no").focus();
}
</script>
</head>
<body onload="myFocus()">
	<div class="w3-container">
    	<div class="my-center">
        	<div class="login_main_locker">
            	<div class="login_l">
                	<div class="login_header w3-center"><img src="img/loing-center/logo.png" class="w3-image"></div>
                    <div class="login-form">
                        <form method="post">                        
                            <ul>
	<?php 
	$err_msg=$err="";
	if(!isset($_SESSION))
	{
		session_start();
	}
	if(isset($_POST['ForgotPassword']))
	{
		// code for check server side validation
		$err=0;
		if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0){ 
		
			$err=1;// Captcha verification is incorrect.
		}
		else
		{
			include_once('zc-common-admin.php');
			include_once('zf-CheckLogin.php');
			$filled_mobile_no=mysql_real_escape_string($_POST['filled_mobile_no']);
			$filled_pass_word=mysql_real_escape_string($_POST['filled_pass_word']);
			
			$pass_word=mt_rand(11111111,99999999);
			forgot_password($filled_mobile_no, $filled_pass_word, $pass_word);
			include_once('zf-sms.php');
			$zsms=create_forgot_msg($pass_word);
			zsms_new($filled_pass_word,$zsms);
			$err_msg="<b class='w3-text-blue'>Password reset informaion is<br>sent to your registered mobile no.<br/><br/></b>";
		}
	}
	if($err==1)
	{
		echo "<p id='err'>Invalid Captcha Code</p>";
	}
	else if($err==2)
	{
		echo "<p id='err'>Invalid User ID or Registered Mobile No.</p>";
	}
	?>
								<li></li>
								<li>
									<?php if($err_msg!=""){echo $err_msg;}?>
									<p class="pass-val" id="WelcomeUser"></p>
									<input class="w3-input w3-border w3-white w3-round user" placeholder="User ID" name="filled_mobile_no" id="filled_mobile_no" autocomplete="off" onkeyup="check_user()" maxlength="6" required type="text">
								</li>
								<li class="pass-val">
								   <input class="w3-input w3-border w3-white w3-round" id="filled_pass_word" placeholder="Registsred Mobile No." autocomplete="off" maxlength="10" onkeyup="check_pass()" name="filled_pass_word" required type="text">
								</li>
								<li class="capt pass-val">
									<img style="border-radius:4px;" class="w3-left" src="__captcha" id='captchaimg'>
									<img onclick='xyz()' height="25" autocomplete="off" title="Reload Image" id="refsimgs" class="reload-img" src="img/refresh.png">
									<input required maxlength="4" onkeyup="check_captcha()" class="w3-input w3-border w3-round" id='captcha_code' name="captcha_code" type="text">
								</li>
							</ul>
							<div class="login_btu pass-val w3-right">
								<a onclick='xyz()'>Reload Image</a>
								<button name="ForgotPassword" id="ForgotPassword" class="w3-button w3-round-small w3-right w3-blue display-none">Generate Password</button>
							</div>
							<div class="wh w3-left forgot">
								<a href="LoginServlet" class="w3-text-blue w3-right">Login</a>
							</div>
                        </form>
                    </div>
                </div>
                <img src="img/loing-center/locker.png" class="locker">
            </div>
        </div>
    </div>
    <div class="patt"></div> 

 
<div id="error-box" class="w3-modal my-modal-padd">
    <div class="w3-modal-content w3-animate-zoom my-modal">
          <header class="w3-container w3-center w3-blue"> 
		    <span onclick="close_error_box()" class="w3-button w3-display-topright">
				<img src="img/close.png" style="margin-bottom:0px;">
			</span>
            <h4 class="w3-center" id="error-title">ERROR TITLE !!!</h4>
          </header>
          <div class="w3-container w3-center modal-txt">
            <p id="error-message">ERROR MESSAGE</p>
          </div>  
          <footer class="w3-center w3-padding-16">
          	<button onclick="close_error_box()" class="w3-button w3-round-small w3-blue">OK</button>
          </footer>        
    </div>
</div>

<section id="tiny" class="tinyslide">
  <aside class="slides">
    <figure><img src="img/loing-center/bg1.jpg" alt="background" /></figure>
    <figure><img src="img/loing-center/bg2.jpg" alt="background" /></figure>
    <figure><img src="img/loing-center/bg3.jpg" alt="background" /></figure>
    <figure><img src="img/loing-center/bg1.jpg" alt="background" /></figure>
    <figure><img src="img/loing-center/bg2.jpg" alt="background" /></figure>
    <figure><img src="img/loing-center/bg3.jpg" alt="background" /></figure>
    <figure><img src="img/loing-center/bg1.jpg" alt="background" /></figure>
    <figure><img src="img/loing-center/bg2.jpg" alt="background" /></figure>
    <figure><img src="img/loing-center/bg3.jpg" alt="background" /></figure>
  </aside>
</section>

<!--banner js-->
<script>
  var tiny = $('#tiny').tiny().data('api_tiny');
</script>

</body>
</html> 