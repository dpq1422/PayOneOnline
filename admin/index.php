<!DOCTYPE html>
<?php
							if(!isset($_SESSION)) {
								session_start();
							}
?>
<html lang="en">
<head>
    <meta name="google-site-verification" content="" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <!-- Title -->
    <title>Prepaid Mobile Recharge :: SigmaDeal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Description, Keywords -->
    <meta name="description" content="SigmaDeal is a B2C where people can come easily to make their mobile recharges and bill payments any time from anywhere./">
    <meta name="keywords" content="prepaid mobile recharge, post paid mobile bill payments, utility bill payments, gas bill payments, electricity bill payments, prepaid recharge online, online mobile recharge" />
    <meta name="author" content="SigmaDeal" />

    <!-- Google web fonts -->
    <link href='css/gcss1.css?family=Oswald:400,700' rel='stylesheet' type='text/css'>
    <link href='css/gcss2.css?family=PT+Sans:400,700,400italic' rel='stylesheet' type='text/css'>

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/select2.css" rel="stylesheet" />
    <link href="css/slider.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    <!--[if IE 7]>
  <link rel="stylesheet" href="css/font-awesome-ie7.css">
  <![endif]-->
    <link href="css/style.css" rel="stylesheet">
    <!-- Color Stylesheet - orange, blue, pink, brown, red or green-->
    <link href="css/orange.css" rel="stylesheet">


    <!-- HTML5 Support for IE -->
    <!--[if lt IE 9]>
  <script src="js/html5shim.js"></script>
  <![endif]-->

    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon/favicon.png">

    


    <!-- Google Tag Manager -->
	<!--
    <noscript>
        <iframe src="//www.googletagmanager.com/ns.html?id=GTM-NCLSRK"
            height="0" width="0" style="display: none; visibility: hidden"></iframe>
    </noscript>
    <script>(function (w, d, s, l, i) {
    w[l] = w[l] || []; w[l].push({
        'gtm.start':
        new Date().getTime(), event: 'gtm.js'
    }); var f = d.getElementsByTagName(s)[0],
    j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
    '//www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
})(window, document, 'script', 'dataLayer', 'GTM-NCLSRK');</script>
	-->
    <!-- End Google Tag Manager -->

</head>

<body>
    <form method="post" action="">

<script src="js/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="js/valid.js?d=x2nkrMJGXkMELz33nwnakPZqaV204dGU9mVRdVoLKm8zhKnyOHQEy8T8yj48wwZ25kH6Aee2_oW4OOynmTjAS4SOjsY1&amp;t=636233464529959633" type="text/javascript"></script>
<script type="text/javascript">
//<![CDATA[
function WebForm_OnSubmit() {
if (typeof(ValidatorOnSubmit) == "function" && ValidatorOnSubmit() == false) return false;
return true;
}
//]]>
</script>
        <!-- Header starts -->

		<?php include("header.php");?>

        <!-- Header ends -->

        <!-- Navigation Starts -->

        <!-- Note down the syntax before editing. It is the default twitter bootstrap navigation -->

        <?php include("menu.php");?>


        <!-- Navigation Ends -->

        <!-- Content strats -->
        
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Slider (Parallax Slider) -->
                    
                    <!-- Slider ends -->

                    <!-- Features list. Note down the class name before editing. -->
                    <div class="tabbable tabs-left">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs">
                            <!-- Navigation tabs (Job titles ). Use unique value in anchor tags. -->
                            <li class="active" style="background-image: none; padding: 0px;"><a href="#tab1" data-toggle="tab">Mobile Recharge</a></li>
                            <li style="background-image: none; padding: 0px;"><a href="#tab2" data-toggle="tab">DTH Recharge</a></li>
                        </ul>
                        <div class="tab-content">

                            <!-- In "id", use the value which you used in above anchor tags -->
                            <div class="tab-pane active" id="tab1">
                                <!-- Content -->
                                <div class="col-md-6 col-sm-6">
                                    <div class="cwell" style="padding-top: 10px;">
                                        <h5>Mobile Recharge</h5>
                                        <div class="form">
                                            <!-- Contact form (not working)-->
                                            <form method="post">
											<div class="form-horizontal">
                                                <!-- Name -->
                                                <div class="form-group">
                                                    <label class="control-label col-md-3" for="name">Mobile Number</label>
                                                    <div class="col-md-9">
                                                        <input type="number" class="form-control" id="mob_no" name="mob_no">
                                                    </div>
                                                </div>
                                                <!-- Email -->
                                                <div class="form-group ">
                                                    <label class="control-label col-md-3" for="name">Provider</label>
                                                    <div class="col-md-9">
                                                        <select name="operator" id="operator" class="form-control" style="height:34px;">
															<option value="0">Select Operator</option>
															<option value="1">AirCel</option>
															<option value="2">AirTel</option>
															<option value="3">BSNL </option>
															<option value="4">Idea</option>
															<option value="5">Jio</option>
															<option value="6">Loop</option>
															<option value="7">MTNL</option>
															<option value="8">MTS</option>
															<option value="9">Reliance CDMA</option>
															<option value="10">Reliance GSM</option>
															<option value="11">S Tel</option>
															<option value="12">Spice</option>
															<option value="13">T24</option>
															<option value="14">Tata Docomo</option>
															<option value="15">Tata Indicom</option>
															<option value="16">Uninor</option>
															<option value="17">Videocon</option>
															<option value="18">Vodafone</option>
														</select>
                                                        <span data-val-controltovalidate="BodyContentPlaceHolder_ddlServiceProviders" data-val-focusOnError="t" data-val-errormessage="Please&#32;select&#32;Service&#32;Provider." data-val-validationGroup="RECHARGE" id="BodyContentPlaceHolder_RequiredFieldValidator2" data-val="true" data-val-evaluationfunction="RequiredFieldValidatorEvaluateIsValid" data-val-initialvalue="Select&#32;Operator" style="color:#660033;visibility:hidden;">Please select Service Provider.</span>
                                                        
                                                    </div>
                                                </div>
                                                <!-- Website -->
                                                <div class="form-group">
                                                    <label class="control-label col-md-3" for="website">Amount</label>
                                                    <div class="col-md-9">
                                                        <input type="number" class="form-control" id="amt" name="amt">
                                                    </div>
                                                </div>

                                                <!-- Buttons -->
                                                <div class="form-group">
                                                    <!-- Buttons -->
                                                    <div class="col-md-9 col-md-offset-3">
                                                        <div class="button"><input type="submit" name="recharge" id="recharge" value="Submit"/></div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
											</form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab2">
                                <div class="col-md-6 col-sm-6">
                                    <div class="cwell" style="padding-top: 10px;">
                                        <h5>DTH Recharge</h5>
                                        <div class="form">
                                            <!-- Contact form (not working)-->
                                            <div class="form-horizontal">
                                                <!-- Email -->
                                                <div class="form-group ">
                                                    <label class="control-label col-md-3" for="name">Provider</label>
                                                    <div class="col-md-9">
                                                        <select name="ctl00$BodyContentPlaceHolder$ddlServiceProvidersDTH" id="BodyContentPlaceHolder_ddlServiceProvidersDTH" class="form-control">
															<option value="0">Select Operator</option>
															<option value="1">Airtel DTH</option>
															<option value="2">Big TV </option>
															<option value="3">Dish TV </option>
															<option value="4">Sun Direct</option>
															<option value="5">Tata Sky</option>
															<option value="6">Videocon D2h</option>
														</select>

                                                        <span data-val-controltovalidate="BodyContentPlaceHolder_ddlServiceProvidersDTH" data-val-focusOnError="t" data-val-errormessage="Please&#32;select&#32;Service&#32;Provider." data-val-validationGroup="RECHARGE" id="BodyContentPlaceHolder_RequiredFieldValidator1" data-val="true" data-val-evaluationfunction="RequiredFieldValidatorEvaluateIsValid" data-val-initialvalue="Select&#32;Operator" style="color:#660033;visibility:hidden;">Please select Service Provider.</span>
                                                        
                                                        <input type="hidden" name="ctl00$BodyContentPlaceHolder$hiddenPCode" id="BodyContentPlaceHolder_hiddenPCode" />
                                                    </div>
                                                </div>
                                                <!-- Name -->
                                                <div class="form-group">
                                                    <label class="control-label col-md-3" for="name">Mobile Number</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="Text1">
                                                    </div>
                                                </div>
                                                <!-- Website -->
                                                <div class="form-group">
                                                    <label class="control-label col-md-3" for="website">Amount</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="Text2">
                                                    </div>
                                                </div>

                                                <!-- Buttons -->
                                                <div class="form-group">
                                                    <!-- Buttons -->
                                                    <div class="col-md-9 col-md-offset-3">
                                                        <div class="button"><a href="#">Submit</a></div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Content ends -->

        <!-- Footer -->
        <?php include("footer.php");?>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>

        <script src="js/select2.js"></script>

        <script src="js/jquery.isotope.js"></script>
        <script src="js/jquery.prettyPhoto.js"></script>
        <script src="js/filter.js"></script>

        <script src="js/jquery.cslider.js"></script>
        <script src="js/modernizr.custom.28468.js"></script>
        <script src="js/custom.js"></script>
        <script type="text/javascript">
            ////$(document).ready(function () {
            //$(function () {
            //    $('#da-slider').cslider({
            //        autoplay: true,
            //        interval: 5000
            //    });

            //});
            ////});
        </script>

        
    <script>
        $(document).ready(function () {
            $(function () {
                $('#BodyContentPlaceHolder_ddlServiceProviders').select2({ placeholder: "Select Operator", allowClear: true });
            });
        });
        $(document).ready(function () {
            $(function () {
                $('#BodyContentPlaceHolder_ddlServiceProvidersDTH').select2({ placeholder: "Select Operator", allowClear: true });
            });
        });
    </script>

    </form>
</body>
</html>
<?php
if (isset($_POST['recharge']))
	{
		$mob_no=$_POST['mob_no'];
		$operator=$_POST['operator'];
		$amount=$_POST['amt'];
		$userid=$_SESSION['eml'];
		//$dateofbirth=$_POST['dateofbirth'];
		//$dateofbirth=date_format($dateofbirth,"Y-m-d");
		include("db-conn.php");
		$qry="insert into txn_data value 
		(NULL,sysdate(),'$mob_no','$userid','1','$operator','0','0','0','$amount','0','0','0','0','0','0',sysdate(),sysdate(),sysdate(),'1','0');";
		mysql_query($qry);
		$txn_id=mysql_insert_id();
		$order_status=1;
		//echo $txn_id;
		//Curl request sent to demo api
		$user_id="demouser";
		$user_pass="demo1234";
		$access_method="RECHARGE";
		
		$txnid=$txn_id;
		$mob=$mob_no;
		$opr=$operator;
		$amt=$amount;
		
		$url = "http://hostkrit.com/recharge_demo_api.php?";
		$url = $url . "user_id=" . $user_id;
		$url = $url . "&user_pass=" . $user_pass;
		$url = $url . "&access_method=" . $access_method;
		$url = $url . "&order_number=" . $txnid;
		$url = $url . "&mobile_number=" . $mob;
		$url = $url . "&operator=" . $opr;
		$url = $url . "&amount=" . $amt;
								   
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($curl);
		
		$err = curl_error($curl);
		
		curl_close($curl);
		
		if ($err) {
			$response="cURL Error : " . $err;
		}
		else
		{
			//echo $response;
			
			$json_result= json_decode($response, true);
			$json_message=$json_result['message'];
			if($json_message=="SUCCESS")
			$order_status=100;
			else if($json_message=="PENDING")
			$order_status=200;
			else if($json_message=="FAILED")
			$order_status=300;
			else
			$order_status=200;
		}
		$qry1="update txn_data set other_remarks='$response', txn_status='$order_status' where txn_id='$txnid';";
		mysql_query($qry1);
	}
?>