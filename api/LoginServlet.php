<!DOCTYPE html>
<html>
<head>
<title>Mentor India :: Money Transfer API, Prepaid Mobile Recharge API, Airline Ticketing API, Hotel Reservation API, Bus Ticketing API, Railway Ticketing API, mPOS, Postpaid Mobile Bill Payment API, DTH Recharge API, Electricity Bill Payment API</title>
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
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
<link rel="stylesheet" href="css/w3.css" type="text/css">
<link rel="stylesheet" href="css/style.css" type="text/css">
<meta name="description"  content="Mentor India provides you best price/sommission Money Transfer API, Prepaid Mobile Recharge API, Airline Ticketing API, Hotel Reservation API, Bus Ticketing API, Railway Ticketing API, mPOS, Postpaid Mobile Bill Payment API, DTH Recharge API, Electricity Bill Payment API." />
<meta name="keywords"  content="Best price/sommission on Money Transfer API, Prepaid Mobile Recharge API, Airline Ticketing API, Hotel Reservation API, Bus Ticketing API, Railway Ticketing API, mPOS, Postpaid Mobile Bill Payment API, DTH Recharge API, Electricity Bill Payment API." />
<script>
function abcd()
{
	var kkr=document.getElementById('kkr').value;
	
	if(kkr.length==6)
	{document.getElementById('id01').style.display='block';}
}
</script>

<script>
function myFunction() {
    var x = document.getElementById("myInput");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
</script>
</head>
<body>
	<?php
	if(isset($_POST['SignIn']))
	{
		header("location: DashboardServlet");
	}
	?>
	<div class="w3-container">
    	<div class="my-center">
        	<div class="login_main_right">
            	<div class="login_header w3-center"><img src="img/loing-center/logo.png" class="w3-image"></div>
                <div class="login-form">
                	<form method="post">                        
                        <ul>
                        	<li>
                                <input class="w3-input w3-border w3-white w3-round user" id='kkr' onkeyup="abcd()" placeholder="User Id" type="text">
                                <!--<label>First Name</label>-->
                            </li>
                            <li>
                               <input class="w3-input w3-border w3-white w3-round key" id="myInput" placeholder="Password" type="password">
                                <img src="img/eye.png" class="login-eye" onclick="myFunction()">                               
                                <!--<label>First Name</label>-->
                            </li>
                            <li class="capt">
                            	<img src="img/loing-center/capt.jpg">
                                <input class="w3-input w3-border w3-round" name="first" type="text">
                            </li>
                        </ul>
                        <div class="login_btu">
                            <a  class="w3-text-dark-grey w3-left">Reload Captcha</a>
                            <button name="SignIn" class="w3-button w3-round-small w3-right w3-blue">SIGN IN</button>
                        </div>
                        <div class="wh w3-left forgot">
                        	<a  class="w3-text-dark-grey w3-left">Forgot your user id ?</a>
                            <a  class="w3-text-red w3-right">Forgot your password ?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="patt"></div> 
    <div class="bg"><img src="img/loing-center/bg1.jpg"></div>   

 
<div id="id01" class="w3-modal my-modal-padd">
    <div class="w3-modal-content w3-animate-zoom my-modal">
          <header class="w3-container w3-center"> 
            <span onclick="document.getElementById('id01').style.display='none'" 
            class="w3-button w3-display-topright">&times;</span>
            <h2 class="modal-title">Modal Header</h2>
          </header>
          <div class="w3-container w3-center modal-txt">
            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has</p>
          </div>  
          <footer class="w3-center w3-padding-16">
          	<button onclick="document.getElementById('id01').style.display='none'"  class="w3-button w3-round-small w3-blue">OK</button>
          </footer>        
    </div>
</div>

</body>
</html> 
