		<div class="navbar bs-docs-nav" role="banner">

            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
                    <!-- Navigation links starts here -->
                    <ul class="nav navbar-nav">
                        <!-- Main menu -->
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about-us.php">About Us</a></li>
                        <!--<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Prepaid<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">AirCel</a></li>
                                <li><a href="#">AirTel</a></li>
                                <li><a href="#">BSNL</a></li>
                                <li><a href="#">Idea</a></li>
                                <li><a href="#">Jio</a></li>
                                <li><a href="#">Loop</a></li>
                                <li><a href="#">MTNL</a></li>
                                <li><a href="#">MTS</a></li>
                                <li><a href="#">Reliance CDMA</a></li>
                                <li><a href="#">Reliance GSM</a></li>
                                <li><a href="#">S Tel</a></li>
                                <li><a href="#">Spice</a></li>
                                <li><a href="#">T24</a></li>
                                <li><a href="#">Tata Docomo</a></li>
                                <li><a href="#">Tata Indicom</a></li>
                                <li><a href="#">Uninor</a></li>
                                <li><a href="#">Videocon</a></li>
                                <li><a href="#">Virgin</a></li>
                                <li><a href="#">Vodafone</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">DTH<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Airtel DTH</a></li>
                                <li><a href="#">Big TV</a></li>
                                <li><a href="#">Dish TV</a></li>
                                <li><a href="#">Sun Direct</a></li>
                                <li><a href="#">Tata Sky</a></li>
                                <li><a href="#">Videocon D2h</a></li>
                            </ul>
                        </li>-->  
						<li><a href="track-order.php">Track Order</a></li>
                        <li><a href="contact-us.php">Contact Us</a></li>
						<?php
							if(isset($_SESSION['eml']))
							{
								echo '<li><a href="user-account.php">My Account</a></li>';
								echo '<li><a href="logout.php">Logout</a></li>';
							}
							else
							{
								echo '<li><a href="login.php">Login</a></li>';
							}
						?>
                    </ul>
                </nav>
            </div>
        </div>