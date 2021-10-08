<?php
include('functions/_AdminWalletBalanceShow.php');
$amt_ars=admin_reals();
$amt_ars2=admin_reals2();
$amt_ads=admin_distributions();
?>
			<div class="scroll-news-top">
				<marquee behavior="slide" class="scroll-news" scrollamount="90"><?php echo "Welcome, $user_name ( RTB-Eko : $amt_ars , RTB-Aqua : $amt_ars2 and D Limit : $amt_ads )"; ?></marquee>
			</div>
			<div class="scroll-news-top" style="background:none;height:0;">&nbsp;
			</div>
			<div class="scroll-news-top">
				<marquee behavior="alternate" class="scroll-news" scrolldelay="120">NOTE: Server will be down for maintenance between 11PM to 3AM daily.</marquee>
			</div>