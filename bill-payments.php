<!DOCTYPE html>
<html>
<head>
<?php include('name.php');?>
<title>Bill Payments :: <?php echo $site_link;?></title>
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
                        <li><a class="w3-text-deep-orange">Services <i class="fa fa-angle-down"></i> </a>
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
    
    <div class="inner-banner money-bg w3-center wh w3-left w3-text-white">
    	<h2 style="display:none;">Lorem Ipsum is <strong class="w3-text-yellow">Simply Dummy text</strong> of the printing.</h2>
    </div>
          
    <section class="wh w3-left w3-padding-48">
    	<div class="my-center">
            <div class="w3-row-padding">
                <div class="w3-col l3 m3 w3-padding-16">
                    <div class="left-menu wh w3-left">
						<h3 class="w3-text-deep-orange">Featured Services</h3>
                    	<ul>
							<li><a href="money-transfer.php">Money Transfer</a></li>
							<li><a href="recharge.php">Recharge</a></li>
							<li><a href="dth-subscriptions.php">DTH Subscriptions</a></li>
							<li><a class="active-arrow" href="bill-payments.php">Bill Payments</a></li>
							<li><a href="pan-card.php">Pan Card Services</a></li>
							<li><a href="aeps.php">AEPS</a></li>
							<li><a href="mpos-devices.php">mPOS / POS Devices</a></li>
							<li><a href="prepaid-cards.php">Prepaid Cards</a></li>
							<li><a href="flight-booking.php">Flight Booking</a></li>
							<li><a href="railway-reservation.php">Railway Reservation</a></li>
							<li><a href="bus.php">Bus Booking</a></li>
                        </ul>
                    </div>
                </div>
                <div class="w3-col l9 m9 w3-padding-16">
                    <div class="right-contact wh w3-left show-tab">
						<div class="money-feature w3-margin-top wh w3-left">
						    <p>
                                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                <!-- Ad Responsive -->
                                <ins class="adsbygoogle"
                                     style="display:block"
                                     data-ad-client="ca-pub-2599914045511481"
                                     data-ad-slot="3198649652"
                                     data-ad-format="auto"
                                     data-full-width-responsive="true"></ins>
                                <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>
						    </p>
						</div>
                    	<h2 class="w3-text-deep-orange">Bill Payments</h2>
                        <p class="w3-margin-top w3-justify">
We provide bill payment services for electricity, water and gas connections. We also support insurance premium payments. We have joined more than 30 electricity providers all over India. We are continuously adding more and more operators to our network. We are aggressively working on more integration in our platform which will get many more billers from all over India on board.  </p>
						<div class="money-feature w3-margin-top wh w3-left">
						    <p>
                                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                <!-- Ad Responsive -->
                                <ins class="adsbygoogle"
                                     style="display:block"
                                     data-ad-client="ca-pub-2599914045511481"
                                     data-ad-slot="3198649652"
                                     data-ad-format="auto"
                                     data-full-width-responsive="true"></ins>
                                <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>
						    </p>
						</div>
                        <div class="money-feature w3-margin-top wh w3-left">
                        	<h6><strong>Some features of our bill payment system are -</strong></h6>
                        	<ul>
                            	<li><p>Instant settlement after successful transaction.</p></li>
                                <li><p>High success ratio and fast bill settlement.</p></li>
                                <li><p>Automatic refunds in case of failures (OTP Based for enhanced security)</p></li>
                                <li><p>Get the due amount of electricity bill for most of billers automatically. </p></li>
                                <li><p>Automatic reconciliation for Pending transaction. </p></li>
                            </ul>
                            <div class="wh w3-right">
                            	<a href="join-us.php" class="w3-right w3-button w3-deep-orange w3-round-medium w3-margin-top w3-hover-green">Join Us Today</a>
                            </div>
                        </div>
						<div class="money-feature w3-margin-top wh w3-left">
						    <p>
                                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                <!-- Ad Responsive -->
                                <ins class="adsbygoogle"
                                     style="display:block"
                                     data-ad-client="ca-pub-2599914045511481"
                                     data-ad-slot="3198649652"
                                     data-ad-format="auto"
                                     data-full-width-responsive="true"></ins>
                                <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>
						    </p>
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
