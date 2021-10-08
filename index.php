<!DOCTYPE html>
<html>
<head>
<?php include('name.php');?>
<title><?php echo $site_title;?> :: <?php echo $site_link;?></title>
<meta name="fl-verify" content="9ea64a241405742103e5a2c899134e93">
<link rel="stylesheet" href="css/w3.css" type="text/css">
<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="css/animation.css" type="text/css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">

<script type="text/javascript">
window.oncontextmenu = function () { return false; }
function killCopy(e) { return false; }
function reEnable() { return true; }
document.onselectstart=new Function ("return false");
if (window.sidebar) { document.onmousedown=killCopy; document.onclick=reEnable; }
</script>
<!--responsive menu js start-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
  $(".menu-icon").click(function() {
    $(".menu-show").slideToggle(100, function() {
      $(this).toggleClass('shown');  /* Toggle "display" class */
      $(this).removeAttr('style');   /* Remove style attribute */
    });
  });  
});
</script>
<!--responsive menu js end-->
</head>
<body>

	<header class="header wh w3-left w3-white">
    	<div class="my-center">
        	<div class="w3-container">
            	<div class="w3-left"><a href="index.php" class="logo"><img height="70" src="img/logo.png"></a></div>
                <nav class="menu w3-right">
                	<div class="menu-icon w3-right"><a href="#"><i class="fa fa-bars"></i></a></div>
                    <ul class="menu-show">
                        <li><a href="index.php" class="w3-text-deep-orange">Home</a></li>
                        <li><a href="about-us.php">About Us</a></li>
                        <li><a>Services <i class="fa fa-angle-down"></i> </a>
                            <ul class="drop-menu w3-white w3-card">
                                <li><a href="money-transfer.php">Money Transfer</a></li>
								<li><a href="recharge.php">Recharge</a></li>
								<li><a href="dth-subscriptions.php">DTH Subscriptions</a></li>
								<li><a href="bill-payments.php">Bill Payments</a></li>
								<li><a href="pan-card.php">Pan Card Services</a></li>
								<li><a href="aeps.php">AEPS</a></li>
								<li><a href="mpos-devices.php">mPOS / POS Devices</a></li>
								<li><a href="prepaid-cards.php">Prepaid Cards</a></li>
								<li><a href="flight-booking.php">Flight Booking</a></li>
								<li><a href="railway-reservation.php">Railway Reservation</a></li>
								<li><a href="bus.php">Bus Booking</a></li>
                            </ul>
                        </li>
                        <li><a href="join-us.php">Join Us</a></li>
                        <li><a href="contact-us.php">Contact Us</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    
    <div class="banenr wh w3-left">
        <div class="w3-display-container">        
            <div class="w3-display-container mySlides">
              <img src="img/s1.png" style="width:100%">
              <div class="w3-display-middle w3-center w3-text-white banner-txt">
                <!--<h1>Join <strong class="w3-text-yellow">NAME</strong></h1>
                <h6>Become your own BOSS.</h6>-->
              </div>
            </div>            
            <div class="w3-display-container mySlides">
              <img src="img/s2.png" style="width:100%">
              <div class="w3-display-middle w3-center w3-text-white banner-txt">
                <!--<h1>Join <strong class="w3-text-yellow">NAME</strong></h1>
                <h6>Become your own BOSS.</h6>-->
              </div>
            </div>               
            <div class="w3-display-container mySlides">
              <img src="img/s3.png" style="width:100%">
              <div class="w3-display-middle w3-center w3-text-white banner-txt">
                <!--<h1>Join <strong class="w3-text-yellow">NAME</strong></h1>
                <h6>Become your own BOSS.</h6>-->
              </div>
            </div>     
                   
            <button class="w3-button w3-display-left w3-black" onclick="plusDivs(-1)">&#10094;</button>
            <button class="w3-button w3-display-right w3-black" onclick="plusDivs(1)">&#10095;</button>        
        </div>
    </div>
    
    <div class="my-center">
    	<div class="w3-row-padding wh w3-left w3-padding-48">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-2599914045511481"
                 data-ad-slot="3198649652"
                 data-ad-format="auto"
                 data-full-width-responsive="true"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </div>
    
    <div class="my-center">
    	<div class="w3-row-padding wh w3-left w3-padding-48">
        	<div class="w3-col l6 m6">
            	<div class="vision wh w3-left">
			<img class="w3-image" src="img/1.png">
			<p class="w3-margin-top wh w3-justify">
                    	<div class="money-feature w3-margin-top wh w3-left" style="padding-left:15px;">
	                    	<ul>
	                    		<li>Non-KYC Customer transaction Limit: Rs 50,000/- per month.</li>
	                    		<li>Automatic refunds in case of failures (OTP based for enhanced security)</li>
	                    		<li>Support for bill payments of credit cards using NEFT.</li>
	                    		<li>Switching mode IMPS & NEFT along with IFSC Finding Tool.</li>
	                    	</ul>
                    	</div>
                    </p>
                </div>
            </div>
            
            <div class="w3-col l6 m6">
            	<div class="vision wh w3-left">
			<img class="w3-image" src="img/2.png">
			<p class="w3-margin-top wh w3-justify">
	                    <div class="money-feature w3-margin-top wh w3-left" style="padding-left:15px;">
	                    <img src="img/comming-soon.png" class="w3-pad" height="95" align="right" />
	                    	<ul style="width:auto;">
	                    		<li style="float:none;">Cash Withdrawl from any Aadhar linked Bank Account</li>
	                    		<li style="float:none;">Cash Deposit of any Aadhar linked Bank Account</li>
	                    		<li style="float:none;">Money Transfer in any Bank Account</li>
	                    		<li style="float:none;">Balance Inquiry of any Aadhar linked Bank Account</li>
	                    	</ul>
	                    </div>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="my-center">
    	<div class="w3-row-padding wh w3-left w3-padding-48">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-2599914045511481"
                 data-ad-slot="3198649652"
                 data-ad-format="auto"
                 data-full-width-responsive="true"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </div>
    
    <div class="my-center">
    	<div class="w3-row-padding wh w3-left w3-padding-48">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-2599914045511481"
                 data-ad-slot="3198649652"
                 data-ad-format="auto"
                 data-full-width-responsive="true"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </div>
    
    <footer class="wh w3-left w3-black footer w3-margin-top">
    	<div class="my-center">
        	<div class="w3-container">
                <div class="w3-left"><p><?php echo $site_footer;?></p></div>
            	<div class="w3-right"><p>All rights are reserved.</p></div>
            </div>
        </div>
    </footer>    
    
<!--banner js-->
<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}
</script>
<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 3000); // Change image every 2 seconds
}
</script>
<!--banner js-->

</body>
</html> 
