<?php
	$flag_page=0;
	for($stp=0;$stp<count($ssc);$stp++)
	{
		$sscv=$ssc[$stp];
		if($sscv==101)
		$flag_page++;
	}
	if($flag_page==1)
	header('location:commission-show-101.php');
?>