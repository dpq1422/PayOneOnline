<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<script>window.location.href='home.php';</script>
		<?php include('_head-tag.php'); ?>
		<script language="javascript" type="text/javascript">
		var submitbtn=0;
		function isLimit(strLimit,limit)
		{
			if(strLimit<=limit)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		function isSize(strSize,min,max)
		{
			if(strSize.length<min || strSize.length>max)
			{
				return 1;
			}
			return 0;
		}
		function searchIFSC()
		{
				window.open('search-ifsc.php','Search IFSC Code','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=620,height=800');
		}
		function pullIFSC()
		{
			var bid=document.getElementById("bankCode").value;
			bid=bid.split("@")[0];
			//ifscCode
			$.ajax({
				type: "POST",
				//url: "_ajax-pull-ifsc2.php",
				data: {'bid': bid },
				dataType: "json",
			 
				//if received a response from the server
				success: function( data, textStatus, jqXHR) {
					//our country code was correct so we have some information to display/
					var vals=data.split("@");
					var btns="<input id='verify_btn' onclick='valid_benef()' name='submit2' type='submit' style='width:100%;' class='btn green' value='Add and Verify'>";
					document.getElementById("ifscCode").value=vals[0];
					if(vals[1]==1)
						document.getElementById("verifyaccountbtn").innerHTML = btns;
					else
					{
						document.getElementById("verifyaccountbtn").innerHTML = "";
						//"<b style='color:red;'>Please proceed without account verification, because this facility is not available for selected bank.</b>";
					}
					document.getElementById("ifscCode").focus();
				}	 
			});
		}
		function sbmtbtn()
		{
			submitbtn++;
			if(submitbtn==1)
				document.getElementById("frmRechargeMobile").submit();
			document.getElementById("add_btn").setAttribute("disabled","disabled");
		}
		function checkRech()
		{
			var mobile=document.getElementById("mobile").value;
			var operator=document.getElementById("operator").value;
			var amount=document.getElementById("amount").value;
			var amts=amount.split(".");
			var err="";
			if(mobile=="")
				err+="\n - Mobile number is required";
			if(isSize(mobile,5,15)==1)
				err+="\n - Enter correct DTH Subscriber No.";
			if(operator=="")
				err+="\n - Operator is required";
			if(amount=="")
				err+="\n - Amount is required";
			if(isLimit(amount,0)==1)
				err+="\n - Amount should be greater than zero.";
			if(amount<10 || amount>10000)
				err+="\n - Amount should be between 10 to 10000.";
			if(amts.length>1)
				err+="\n - Amount should not be in decimal value.";
			if(err=="")
				sbmtbtn();
			else
				alert(err);
		}
		</script>
	</head>
	<body class="cyan-scheme">
	<div id="form1">

		<!--Page load animation-->
	 
		<div class="wrapper vertical-sidebar" id="full-page">
			<?php include('_nav-menu.php'); ?>

			<main id="content">
				<div id="page-content">
					
		 <div class="row content-container elements">
		 
		 <?php
		 
			$mob="";
			$opr="";
			$amt="";
			
			$msg="";
			$msg1="";
			$msg2="";
			$desc="";
			
			if(isset($_POST['mobile']))
			$mob=$_POST['mobile'];
			if(isset($_POST['operator']))
			$opr=$_POST['operator'];
			if(isset($_POST['amount']))
			$amt=$_POST['amount'];
	 
			if($mob=="" && $opr=="" && $amt=="")
			{
				$desc="";
			}
			else if($mob!="" && $opr!="" && $amt!="")
			{
				$desc="DTH, $mob, $opr, $amt";
				$operator_id=0;
				$sadmin_chg=0;
				$ret_chg=0;
				$dist_chg=0;
				$sd_chg=0;
				$admin_chg=0;
				$server_st=1;
				include_once('../_gyan-info-retail.php');
				include_once '../functions/_wallet_balance.php';
				$qry1="select * from all_operator where service_type_id=103 and api_code_1='$opr'";
				$res1=mysql_query($qry1);
				while($rs1=mysql_fetch_array($res1))
				{
					$operator_id=$rs1['operator_id'];
				}
				
				$qry2="select * from child_charges_apply where operator_id='$operator_id'";
				$res2=mysql_query($qry2);
				while($rs2=mysql_fetch_array($res2))
				{
					$sadmin_chg=$rs2['sadmin'];
					$ret_chg=$rs2['retailer'];
					$dist_chg=$rs2['dist'];
					$sd_chg=$rs2['sd'];
					$admin_chg=$rs2['admin'];
				}
				$qry3="SELECT * FROM child_user where user_id=$user_id;";
				$res3=mysql_query($qry3);
				while($rs3=mysql_fetch_assoc($res3))
				{
					$admin_id_new=$rs3['hierarchy_1_id'];
					$sd_id_new=$rs3['hierarchy_2_id'];
					$dist_id_new=$rs3['hierarchy_3_id'];
					$retailer_id_new=$rs3['user_id'];
				}
				if($dist_id_new==0)
				{
					$sd_chg+=$dist_chg;
					$dist_chg=0;
				}
				if($sd_id_new==0)
				{
					$admin_chg+=$sd_chg;
					$sd_chg=0;
				}
				
				$ret_amt=$amt-($ret_chg*$amt/100);
				$sadmin_amt=$amt-($sadmin_chg*$amt/100);
				
				$user_cur_bal=wallet_balance($user_id);
				$server_cur_bal=admin_wallet_balance2();
				
				if($user_cur_bal<$ret_amt)
				$msg1="<b style='color:red;'>Your Balance is low for transation.</b>";
				else if($server_cur_bal<$sadmin_chg)
				$server_st=-1;
			
				if($msg1=="" && $msg2=="")
				{
					$ipaddress1 = "";
					if (isset($_SERVER['HTTP_CLIENT_IP']))//check ip from share internet
						$ipaddress1 = $_SERVER['HTTP_CLIENT_IP'];
					else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))//to check ip is pass from proxy
						$ipaddress1 = $_SERVER['HTTP_X_FORWARDED_FOR'];
					else if(isset($_SERVER['HTTP_X_FORWARDED']))
						$ipaddress1 = $_SERVER['HTTP_X_FORWARDED'];
					else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
						$ipaddress1 = $_SERVER['HTTP_FORWARDED_FOR'];
					else if(isset($_SERVER['HTTP_FORWARDED']))
						$ipaddress1 = $_SERVER['HTTP_FORWARDED'];
					else if(isset($_SERVER['REMOTE_ADDR']))
						$ipaddress1 = $_SERVER['REMOTE_ADDR'];
					else
						$ipaddress1 = 'UNKNOWN';
						
						
					$ipaddress2 = "";
					if (getenv('HTTP_CLIENT_IP'))//check ip from share internet
						$ipaddress2 = getenv('HTTP_CLIENT_IP');
					else if(getenv('HTTP_X_FORWARDED_FOR'))//to check ip is pass from proxy
						$ipaddress2 = getenv('HTTP_X_FORWARDED_FOR');
					else if(getenv('HTTP_X_FORWARDED'))
						$ipaddress2 = getenv('HTTP_X_FORWARDED');
					else if(getenv('HTTP_FORWARDED_FOR'))
						$ipaddress2 = getenv('HTTP_FORWARDED_FOR');
					else if(getenv('HTTP_FORWARDED'))
						$ipaddress2 = getenv('HTTP_FORWARDED');
					else if(getenv('REMOTE_ADDR'))
						$ipaddress2 = getenv('REMOTE_ADDR');
					else
						$ipaddress2 = 'UNKNOWN';
						
					$final_ip=$ipaddress1."<br>".$ipaddress2;
					$browser=$_SERVER['HTTP_USER_AGENT'];
					
					$main_ip="$final_ip <br><br> $browser";
					$rcsource=2;
					$rctype=4;
					
					$qry4="SELECT count(*) as nums FROM main_transaction_rc where date(created_on)='$date_time' and user_id='$user_id' and mobile_number='$mob' and amount='$amt' and source='$rcsource' and type='$rctype'";
					$res4=mysql_query($qry4);
					while($rs4=mysql_fetch_array($res4))
					{
						$chk_record=$rs4['nums'];
					}
					
					if($chk_record==0)
					{
						$qry5="insert into main_transaction_rc(user_id, mobile_number, operator, circle, amount, deducted_amt, created_on, updated_on, ip, source, type, ret_id, ret_comm, dist_id, dist_comm, sd_id, sd_comm, admin_id, admin_comm, rc_status) 
						value('$user_id', '$mob', '$opr', 'DTH', '$amt', '$ret_amt', '$datetime_time', '$datetime_time', '$main_ip', '$rcsource', '$rctype', '$retailer_id_new', '$ret_chg', '$dist_id_new', '$dist_chg', '$sd_id_new', '$sd_chg', '$admin_id_new', '$admin_chg', '$server_st');";
						mysql_query($qry5);				
						$client_ref_id=mysql_insert_id();
						if($client_ref_id%1000==0)
						{
							include_once('../functions/_zsms.php');
							zsms("8437033444","RC Order No $client_ref_id started on dated $datetime_time");
						}
						
						/* API CALL 1 */
						
						$bankapi_user_id="100001";
						$bankapi_user_pass="9729877577";
						$bankapi_method="RCPP";
						$cir="PUNJAB";						

						$call_url_rcaq="http://mentor-india.co.in/api-payoneonline.com/rc_ap_live.php";
						$url = "$call_url_rcaq" . "?";
						$url = $url . "bankapi_user_id=" . $bankapi_user_id;
						$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
						$url = $url . "&bankapi_method=" . $bankapi_method;
						$url = $url . "&request_number=" . $client_ref_id;
						$url = $url . "&mobile_number=" . urlencode($mob);
						$url = $url . "&amount=" . urlencode($amt);
						$url = $url . "&operator=" . urlencode($opr);
						$url = $url . "&circle=" . urlencode($cir);
						

						/* API RESULT 1 */
						
						
						$pre_bal=wallet_balance($user_id);
						if($ret_amt<=$pre_bal)
						{
							$pre_bal=wallet_balance($user_id);
							$post_bal=$pre_bal-$ret_amt;

							$filled_remarks="RC Order No. $client_ref_id, $desc ";
							$qry6="insert into child_wallet_remain value 
							(NULL,'$date_time','$time_time','$user_id','0','$client_ref_id','6','$filled_remarks',
							'$pre_bal', '0','$ret_amt','$post_bal');";
							mysql_query($qry6);
							$wallet_ref_id=mysql_insert_id();
							
							$qry7="update main_transaction_rc set pre_bal='$pre_bal', post_bal='$post_bal', rc_status='1', response='', result='' where rc_id=$client_ref_id";
							mysql_query($qry7);
							
							$qry8="select * from child_wallet_realtime order by wallet_id desc limit 0,1";
							$res8=mysql_query($qry8);
							$pre_bal2=0;
							while($rs8 = mysql_fetch_assoc($res8))
							{
								$pre_bal2=$rs8['amount_bal'];
							}
							$post_bal2=$pre_bal2-$sadmin_amt;
							
							$filled_remarks2="RC Order No. $client_ref_id by $user_id, $desc ";
							$qry9="insert into child_wallet_realtime value 
							(NULL,'$date_time','$time_time','$user_id','$client_ref_id','0','2','$filled_remarks2',
							'$pre_bal2', '0','$sadmin_amt','$post_bal2');";
							mysql_query($qry9);
							$wallet_ref_id2=mysql_insert_id();
							
							$qry10="select * from parent_wallet_realtime_aquams order by wallet_id desc limit 0,1";
							$res10=mysql_query($qry10);
							$pre_bal3=0;
							$pre_bal4=0;
							while($rs10 = mysql_fetch_assoc($res10))
							{
								$pre_bal3=$rs10['amount_bal'];
								$pre_bal4=$rs10['real_bal'];
							}
							$post_bal3=$pre_bal3-$sadmin_amt;
							$post_bal4=$pre_bal4-$sadmin_amt;
							
							$filled_remarks3="RC Order No. $client_ref_id by $user_id of 1001, $desc ";
							$qry11="insert into parent_wallet_realtime_aquams value 
							(NULL,'$date_time','$time_time',1001,'$user_id','$client_ref_id','0','2','$filled_remarks3',
							'$pre_bal3','0','$sadmin_amt','$post_bal3','$pre_bal4','0','$sadmin_amt','$post_bal4');";
							mysql_query($qry11);
							$wallet_ref_id3=mysql_insert_id();
							
							/* API CALL 2 */ //9728140350
							if($server_st!=-1)
							{
								$tid="";
								$response=NULL;
								
								$curl = curl_init($url);
								curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
								$response = curl_exec($curl);
								
								/* API RESULT 2 */
								$err = curl_error($curl);

								curl_close($curl);

								if ($err) {
								  echo "<br>cURL Error : " . $err;
								}
								else
								{
									$result= json_decode($response, true);
									$reponsecode=$result['reponsecode'];
									$responsemsg=$result['responsemsg'];
									if(isset($response))
									{
										$qry12="update main_transaction_rc set response='$response', result='$responsemsg', rc_status='3' where rc_id=$client_ref_id";
										mysql_query($qry12);
									}
								}
							}
						}
						else
						{
							$filled_remarks="Order $client_ref_id Cannot be processed due to low balance in wallet.";
							$qry2="update main_transaction_rc set pre_bal='$pre_bal', post_bal='$pre_bal', rc_status='0', response='$filled_remarks', result='$filled_remarks' where rc_id=$client_ref_id";
							mysql_query($qry2);
							$msg=$msg."<br><b style='color:red;'>$filled_remarks</b>";
						}
						include_once '../functions/_update_wallet.php';
						update_wallet($user_id);
						echo "<script>document.location.href='transactionrc.php'</script>";
					}
					else
					{
						$msg2="<b style='color:red;'>Repeated Transaction</b><br>You have already performed same transaction with same amount to this mobile number today. If you still want to continue, kindly change transaction amount.";
					}					
				}
				if($msg1!="")
				{
					$msg=$msg1;
				}
				else if($msg2!="")
				{
					$msg=$msg2;
				}
			}
			else
			{
				$msg="<b style='color:red;'>One or more values are blank</b>";
			}
		 ?>

				<div class="col s12 m12 l6" id="addBeneficiary" >
					<div class="card project-stats">
						<div class="card-content">
							<h5 style="float:left;"><i class="fa fa-tv fa-1x"></i> DTH Recharge </h5>
							<a href="" class="btn orange" style="float:right;display:none;" >Search Tariff</a>
							<br><br>
						</div>
						<div class="card-action min-height">
							<div class="row extra-elements">
										<?php echo $msg;?>
										<br><br>
								<form method="post" id="frmRechargeMobile">
									<div class="input-field col l8 m12 s12 offset-l2">
										<select class="chosen" name="operator" required id="operator">
											<option value="">Select Operator</option>
											<?php
											$query_bnk="SELECT * FROM all_operator where service_type_id=103";
											$result_bnk=mysql_query($query_bnk);
											while($rs_bnk = mysql_fetch_assoc($result_bnk))
											{		
												$operator_id=$rs_bnk['operator_id'];
												$api_code_1=$rs_bnk['api_code_1'];
												$operator_name=$rs_bnk['operator_name'];
												$query_bnk2="SELECT * FROM child_charges_apply where operator_id='$operator_id'";
												$result_bnk2=mysql_query($query_bnk2);
												$available=0;
												while($rs_bnk2 = mysql_fetch_assoc($result_bnk2))
												{
													$available++;
												}
												if($available==0)
													continue;
											?>
											<option value="<?php echo $api_code_1;?>"><?php echo $operator_name;?></option>
											<?php
											}												
											?>
										</select><br><br>
									</div>									
									
									<div class="input-field col l8 m12 s12 offset-l2">
										<input id="mobile" autocomplete="off" name="mobile" required type="number" class="validate" maxlength="10">
										<label for="mobile" class="">DTH No.</label>
									</div>

									<div class="input-field col l8 m12 s12 offset-l2" style="margin-top: 28px;">
										<input id="amount" autocomplete="off" name="amount" required type="number" class="validate">
										<label for="amount" class="" id="benefAccNum">Amount</label>
									</div>

									<div class="input-field col l8 m6 s12 offset-l2 btn-div buttons-s">
										<input id="add_btn" name="submit1" type="button" style="width:100%;" class="btn blue" onclick="checkRech()" value="Recharge">
									</div>
										
									</div>
								
								</form>
							</div>
						</div>
					</div>

				</div>

				</div>

			</div>

			<div class="col s12 m12 l6" style="display:none;">
				<div class="card project-stats">
					<div class="card-content">
					  <h5>&nbsp;
						  
					  </h5>
					</div>
					<div class="card-action">
						<div id="theLastTransactions" class="text-center">
							<h5>
								   For extended security, it is mandatory to have a 4 DIGIT t-pin for money transfer transactions from Web.
						   
							</h5>
							<br><br>
							<h5 style="color:red;">
								<i class="fa fa-info-circle">&nbsp;</i><i>Please AVOID using common Sequences like 1234, 5678, 6543, 8888, 7777 etc. for your own security.</i>
								<br><br>
							</h5>
						</div>
					</div>


				</div>



			</div>
		</div>


				</div>
			</main>
		
			<?php include('_footer.php');?>
		</div>
		<script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
				
				<script src="../js/spin.js"></script>
				<script src="../js/ladda.js"></script>
				<script src="../js/ladda.jquery.js"></script>
				

				<script type="text/javascript" src="../js/materialize.js"></script>

				<script type="text/javascript" src="../js/prism.min.js"></script>
				<script type="text/javascript" src="../js/mara.min.js"></script>
				<script src="../js/sweetalert2.min.js"></script>
				<script src="../js/site.js"></script>
				<script type="text/javascript" src="../js/chosen.jquery.min.js"></script>
				<script>
					$(".chosen").chosen();
				</script>

				<script>
					jQuery.fn.ForceNumericOnly =
				function () {
					return this.each(function () {
						$(this).keydown(function (e) {
							var key = e.charCode || e.keyCode || 0;
							// allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
							// home, end, period, and numpad decimal
							return (
								key == 8 ||
								key == 9 ||
								key == 13 ||
								key == 46 ||
								key == 110 ||
								key == 190 ||
								(key >= 35 && key <= 40) ||
								(key >= 48 && key <= 57) ||
								(key >= 96 && key <= 105));
						});
					});
				};


					$(".numericOnlyText").ForceNumericOnly();



					function setactiveClass(id) {

						$(".myMenu li a").removeClass('active');

						$("#" + id).addClass('active');
						$("#" + id).parent().addClass('active');

					}
				</script>
		

		<script>

			$(document).ready(function () {

				createOTP();
			})


			function createOTP() {

				$("#createPINOTP").unbind('click').click(function (e) {

					e.preventDefault();

					var yourPIN = $("#yourPIN").val();

					var confPin = $("#confirmPIN").val();

				  
					var l = $(this).ladda();
					l.ladda('start');

					
				 
					var btn = $(this);

					btn.attr('disabled', true);


					$.ajax({
						type: 'POST',
						url: 'CreateTPin.aspx/CreateOTP',
						data: "{'yourPin' : " + JSON.stringify(yourPIN) + ", 'cnfPin' : " + JSON.stringify(confPin) + "}",
						contentType: 'application/json; charset:utf-8',
						dataType: 'json',
						success: function (data, status) {

							

							if (data.d == "1") {


								swal({

									type: 'success',
									text: 'An OTP sent to your registered mobile number. Please note that OTP is case sensitive.',
									allowOutsideClick: false,
									allowEscapeKey: false
								}).then(function () {


									$("#pinPart").hide();

									$("#otpPart").fadeIn(300);

									verifyOTP();
								});

								//$("#infoLabel").html('An OTP sent to your registered mobile number. Please note that OTP is case sensitive.');

								

							} else {

								swal({

									type: 'error',
									text: data.d,
									allowOutsideClick: false,
									allowEscapeKey: false
								}).then(function () {

									l.ladda('stop');

									btn.attr('disabled', false);

								});

								//$("#infoLabel").html(data.d);

							  
							}

						}

					});

				});
			}


			function verifyOTP() {

				$("#submitOTPandPIN").unbind('click').click(function (e) {

					e.preventDefault();

					var yourPIN = $("#yourPIN").val();

					var confPin = $("#confirmPIN").val();

					var otp = $("#pinOTP").val();

					var l = $(this).ladda();
					l.ladda('start');

					//$("#infoLabel").html('<img src="../loading.gif" />');

					var btn = $(this);

					btn.attr('disabled', true);

					$.ajax({
						type: 'POST',
						url: 'CreateTPin.aspx/VerifyOTP',
						data: "{'otp' : " + JSON.stringify(otp) + ", 'yourPin' : " + JSON.stringify(yourPIN) + "}",
						contentType: 'application/json; charset:utf-8',
						dataType: 'json',
						success: function (data, status) {

							if (data.d == "1") {

								swal({

									type: 'success',
									text: 'Your Web T-PIN created successfully.',
									allowOutsideClick: false,
									allowEscapeKey: false,
									confirmButtonText: 'Take Me to Money Transfer'
								}).then(function () {

									location.replace('MoneyTransfer.aspx');

									$("#otpPart").hide();


								});
							  

							} else {

								swal({

									type: 'error',
									text: data.d,
									allowOutsideClick: false,
									allowEscapeKey: false
								}).then(function () {

									l.ladda('stop');

									btn.attr('disabled', false);

								});
							}

						}

					});
					
				})
			}
		</script>


		
		</div>
	</body>
</html>
