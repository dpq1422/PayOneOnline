<!DOCTYPE html>
<html>
<head>
<?php include_once('_all-inner-pages-html-title.php'); ?>
<script type="text/javascript" src="../js/admin-validation-functions.js"></script>
<!--date picker-->
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script> 
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet"> -->
<!--date picker-->    
<?php include_once('../zc-session-admin.php'); ?>
<script>
$(document).ready(function(){
	$(".search-icon").click(function(){
	$(".search-show").toggleClass("s-show");
	});
	
	$(".them").click(function(){
	$(".them ul").toggleClass("them-top");
	});
});
</script>
<script>
var click=0;
function recharge_mobile()
{
	click++;
	if(click==1)
	$("#RechargeMobile").click();
}
function check_values() {
	var operator=$("#operator").val();
	var mobile=$("#mobile").val();
	var amount=$("#amount").val();
	var txn_pn=$("#txn_pn").val();
	
	var error_message="";
	
	if(isEmpty(operator)==1)//customerid//customerid//customerno//crn-no//bp-no//customerid//arn-no//consumerno
		error_message+="<li>Select Gas Provider.</li>";
	if(operator=="4@48@Adani Gas Gujrat" && isEmpty(mobile)==1)
		error_message+="<li>Customer ID should not be empty.</li>";
	if(operator=="4@172@Adani Gas Haryana" && isEmpty(mobile)==1)
		error_message+="<li>Customer ID should not be empty.</li>";
	if(operator=="4@49@Gujrat Gas" && isEmpty(mobile)==1)
		error_message+="<li>Customer No should not be empty.</li>";
	if(operator=="4@166@Haryana City Gas" && isEmpty(mobile)==1)
		error_message+="<li>CRN Number should not be empty.</li>";
	if(operator=="4@50@IndraPrastha Gas" && isEmpty(mobile)==1)
		error_message+="<li>Business Partner Number should not be empty.</li>";
	if(operator=="4@167@Sabarmati Gas" && isEmpty(mobile)==1)
		error_message+="<li>Customer ID should not be empty.</li>";
	if(operator=="4@168@Siti Energy Gas UttarPradesh" && isEmpty(mobile)==1)
		error_message+="<li>ARN Number should not be empty.</li>";
	if(operator=="4@169@Tripura Natural Gas" && isEmpty(mobile)==1)
		error_message+="<li>Consumer Number should not be empty.</li>";
	//if(isNumeric(mobile)==1)
		//error_message+="<li>Customer No should has Numeric Only.</li>";	
	if(isEmpty(amount)==1)
		error_message+="<li>Amount should not be empty.</li>";
	if(isNumeric(amount)==1)
		error_message+="<li>Amount should has Numeric Only.</li>";
	if(isEmpty(txn_pn)==1)
		error_message+="<li>T-PIN should not be empty.</li>";	
	if(isSize(txn_pn,4,4)==1)
		error_message+="<li>T-PIN No must have 4 characters/digits.</li>";
	
	if(error_message!="")
	{
		error_message="<ul class='error-message'>"+error_message+"</ul>";
		$("#error-title").html("Required Fileds/Values");
		$("#error-message").html(error_message);
		$("#ButtonFirst").show();
		$("#ButtonSecond").hide();
		$("#ViewServlet").hide();
		$("#error-box").show();
		return false;
	}
	else
	{
		$("#error-title").html("Confirm");
		$("#error-message").html("Do you want to pay bill for Gas?");
		$("#ButtonFirst").hide();
		$("#ButtonSecond").show();
		$("#ViewServlet").show();
		$("#error-box").show();
		return true;
	}
}
function show_field() {
	var operator=$("#operator").val();
	var error_message="ID / Number";
	
	if(operator=="4@48@Adani Gas Gujrat")
		error_message="Customer ID";
	if(operator=="4@172@Adani Gas Haryana")
		error_message="Customer ID";
	if(operator=="4@49@Gujrat Gas")
		error_message="Customer No";
	if(operator=="4@166@Haryana City Gas")
		error_message="CRN Number";
	if(operator=="4@50@IndraPrastha Gas")
		error_message="Business Partner Number";
	if(operator=="4@167@Sabarmati Gas")
		error_message="Customer ID";
	if(operator=="4@168@Siti Energy Gas UttarPradesh")
		error_message="ARN Number";
	if(operator=="4@169@Tripura Natural Gas")
		error_message="Consumer Number";
	
	$("#showfield").html(error_message);
}
</script>  

</head>
<body>

	<?php include_once('_header.php'); ?>
    
    <section class="boxes wh w3-left">
        <!--<div class="w3-container">-->
            <!--<div class="w3-row-padding">
                <div class="w3-col m12">
                	<h4 class="heading wh w3-left"><span>Submit Form</span></h4>
                </div>
            </div>-->
            <div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m12 wow bounceIn">
                	<div class="table-box wh w3-left">
                    	<div class="box-head">
                        	<h3>Gas Bill Payment</h3>
                        </div>
						<?php
						$msg="";
						if(isset($_REQUEST['msg']))
							$msg=$_REQUEST['msg'];
						$service=114;
						if(isset($_POST['RechargeMobile']))
						{
							include_once('../zc-session-admin.php');
							$service=114;
							$txn_pn=mysql_real_escape_string($_POST['txn_pn']);
							if($txn_pn==$logged_tpin)
							{
								$op1=$op2=$op3=$op4=$op5="0";
								$mobile=mysql_real_escape_string($_POST['mobile']);
								$operator=mysql_real_escape_string($_POST['operator']);
								$operators=explode("@",$operator);
								$source_id=$operators[0];
								$operator_code=$operators[1];
								$operator_name=$operators[2];
								$circle="GAS";
								$amount=mysql_real_escape_string($_POST['amount']);
								include_once('../zf-WalletTxnElec.php');
								$result_transaction="";
								$result_transaction=txn_recharge_with_op1to5($logged_user_id, $service, $mobile, $operator_code, $operator_name, $circle, $amount, $source_id, $op1, $op2, $op3, $op4, $op5);
								if($result_transaction!="")
								{
									$msg=$result_transaction;
									echo "<script>document.location.href='ServiceGasServlet?msg=$msg'</script>";
								}
								else
								{
									echo "<script>document.location.href='TxnServiceUtilityServlet'</script>";
								}
							}
							else
							{
								$msg="T-PIN not matched";
								echo "<script>document.location.href='ServiceGasServlet?msg=$msg'</script>";
							}
						}
						if($logged_tpin=="1234")
						{
						?>
						<form class="wh w3-left w3-white w3-padding w3-padding-32 w3-round-large" method="post">
						<h3 class="w3-block w3-center w3-text-red">Update default T-PIN to start Transaction</h3>
						<p>Click here to update default T-PIN <a class="w3-button w3-round w3-blue" href="MyChangeTpinServlet">Update T-PIN</a></p>
						</form>
						<?php 
						}
						else
						{
						?>
                        <form class="wh w3-left" method="post">
                        	<div class="w3-row-padding w3-margin-bottom">  
								<div class="w3-col m12 l12 w3-margin-top">
									<p><?php if($msg!="" && $msg=="repeated") {echo "<b class='w3-text-red'>Repeated Transaction</b>:: You already had performed same transaction with same amount to same mobile today. If you still want to continue, kindly change recharge amount.";}
									else if($msg!="") {echo "<b class='w3-text-red'>$msg</b>";}
									?></p>
								</div>   	
                            	<div class="w3-col m6 l4 w3-margin-top">
                                	<label>Gas Provider</label>	
                                	<select class="w3-select w3-border w3-round" onchange="show_field()" id="operator" name="operator">
                                        <option value="" required disabled selected>Choose your option</option>
									<?php
									include_once('../zf-ServiceMarginRc.php');
									$state_result=show_operators(" where operator_status=1 and service_id=$service ");
									while($state_row=mysql_fetch_array($state_result))
									{
										$oprid=$state_row['operator_id'];
										$sourceid=show_operator_active_source($oprid,$service);
										if($sourceid==4)
											echo "<option value='$sourceid@".$state_row['api_code_3']."@".$state_row['operator_name']."'>".$state_row['operator_name']."</option>";
									}
									?>
                                    </select>                       
                                </div>     
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label id="showfield">ID / Number</label>
                                	<input id="mobile" name="mobile" type="text" placeholder="" class="w3-input w3-border w3-round">
                                </div> 
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>Amount</label>
                                	<input id="amount" name="amount" type="text" placeholder="Amount" class="w3-input w3-border w3-round">
                                </div>
                                
                                <div class="w3-col m6 l4 w3-margin-top">
                                	<label>T-PIN</label>
                                	<input id="txn_pn" name="txn_pn" type="password" placeholder="T-PIN" class="w3-input w3-border w3-round">
                                </div>
                                   
                                <div class="w3-col m12 w3-margin-top w3-right-align">
									<button onclick="check_values()" name="RechargeMobile" id="RechargeMobile" class="w3-button w3-round-small w3-right w3-blue display-none">RechargeMobile</button>
                                	<a class="w3-button w3-round w3-blue" onclick="check_values()">Pay Bill</a>
                                </div>                               
                        	</div>
                        </form>
						<?php
						}
						?>
                    </div>
                </div>
          	 </div>                       
        <!--</div>-->
    </section>
    
  <div id="error-box" class="w3-modal">
    <div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round list-pop">
      <header class="w3-container w3-blue"> 
        <span onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-display-topright"><img src="../img/close.png" style="margin-bottom:0px;"></span>
        <h3 class="w3-center" id="error-title">Confirm</h3> 
      </header> 
      <div class="w3-container w3-center">
      	<p id="error-message">Do you want to pay bill for Postpaid Mobile?</p>
      </div>  
        <div class="w3-container" style="margin-bottom:10px;">
            <div class="w3-bar w3-center">
                <a id="ViewServlet" onclick="recharge_mobile()" class="w3-button w3-green w3-round">Accept &amp; Confirm</a>
                <a id="ButtonFirst" onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-blue w3-round">OK</a>
                <a id="ButtonSecond" onclick="document.getElementById('error-box').style.display='none';" class="w3-button w3-orange w3-round">Do it later</a>
            </div> 
        </div> 
    </div>
  </div>
       
    <?php include_once('_footer.php');?>

<!--date picker-->
<!--<script type="text/javascript">
    $( "#datepicker" ).datepicker();
	$( "#timepicker" ).timepicker();
</script>-->
<!--date picker-->
</body>
</html> 
