<!DOCTYPE html>
<html>
<head>
<?php include('name.php'); header('location: contact-us.php');?>
<title>Join :: <?php echo $site_link;?></title>
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
                        <li><a href="index.php">Home</a></li>
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
                        <li><a href="join-us.php" class="w3-text-deep-orange">Join Us</a></li>
                        <li><a href="contact-us.php">Contact Us</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    
    <div class="inner-banner join-bg w3-center wh w3-left w3-text-white">
    	<h2>Join Us and <strong class="w3-text-yellow">Become Your own Boss</strong></h2>
    </div>
          
    <section class="wh w3-left w3-padding-48">
    	<div class="my-center">
            <div class="join-us wh w3-left w3-round-large">
            	<div class="w3-row-padding">
                	<div class="w3-col l7 w3-padding-64 w3-center"><img class="w3-image" src="img/join-us-img.png"></div>
                    <div class="w3-col l4 w3-padding">
                    	<div class="join-form wh w3-left">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <footer class="wh w3-left w3-black footer w3-margin-top">
    	<div class="my-center">
        	<div class="w3-container">
                <div class="w3-left"><p><?php echo $site_footer;?></p></div>
            	<div class="w3-right"><p>All rights are reserved.</p></div>
            </div>
        </div>
    </footer>
        
</body>
</html> 
