<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<script>window.location.href='home.php';</script>
		<?php include('_head-tag.php'); ?>
</head>
<body class="cyan-scheme">
<div id="form1">

    <!--Page load animation-->
 
    <div class="wrapper vertical-sidebar" id="full-page">
        <?php include('_nav-menu.php'); ?>

        <main id="content">
            <div id="page-content">
			<?php
			//"<br>"
			$rmnootp="";
			$msg="";
			$rmno="";
			$rmnootp="";
			$name="";
			if(isset($_REQUEST['rmno']))
			$rmno=$_REQUEST['rmno'];			
			if(isset($_REQUEST['rname']))			
			$name=$_REQUEST['rname'];
			if(isset($_POST['submit1']))
			{
				if(isset($_POST['rmno']))
				$rmno=$_POST['rmno'];
				if(isset($_POST['rname']))
				$name=mysql_real_escape_string($_POST['rname']);
				
				$id=$rmno;
				
				/* API CALL */
				 
				$bankapi_user_id="100001";
				$bankapi_user_pass="9729877577";
				$bankapi_method="SAVE_SENDER";
				$sender_number=$id;
				$sender_name=$name;

				include_once('../_gyan-info-retail.php');
				$url = "$call_url" . "?";
				$url = $url . "bankapi_user_id=" . $bankapi_user_id;
				$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
				$url = $url . "&bankapi_method=" . $bankapi_method;
				$url = $url . "&sender_number=" . $sender_number;
				$post_values = "";
				$post_values = $post_values . "sender_name=" . $sender_name;

							   
				$curl = curl_init($url);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_POST, 1);
				curl_setopt($curl, CURLOPT_POSTFIELDS, $post_values);
				$response = curl_exec($curl);
				
				/* API RESULT */
				
				$err = curl_error($curl);
				curl_close($curl);
				if ($err) {
				  $msg="<br>cURL Error : " . $err;
				}
				else
				{
					//echo $response;
					$result= json_decode($response, true);
					$message= $result['message'];
					$response_type_id= $result['response_type_id'];
					$response_status_id= $result['response_status_id'];
					$status= $result['status'];
				}
				if($status==17 && $response_type_id==-1)
				{
					/*
					{
					  "message": "Sender already registered",
					  "response_type_id": -1,
					  "response_status_id": 1,
					  "status": 17,
					  "data": {
						"reason": "",
						"name": "abhinav",
						"customer_id_type": "mobile_number",
						"customer_id": "9729877577"
					  },
					  "invalid_params": {
						"customer_id": "DEPOSITOR ALREADY REGISTERED."
					  }
					}
					*/
					echo "<script>document.location.href='money-transfer-3-benefs.php?rmno=$rmno'</script>";
				}
				if($status==0 && $response_type_id==327)
				{
					/*
					{
					  "message": "OTP sent. Proceed with verification.",
					  "response_type_id": 327,
					  "response_status_id": 0,
					  "status": 0,
					  "data": {
						"name": "",
						"state": "",
						"customer_id_type": "mobile_number",
						"otp": "432",
						"customer_id": "9729877579",
						"state_desc": ""
					  }
					}
					*/
					/*
					{
					  "message": "Enrollment done. Verify customer using OTP.",
					  "response_type_id": 327,
					  "response_status_id": 0,
					  "status": 0,
					  "data": {
						"name": "abhinav",
						"state": "1",
						"customer_id_type": "mobile_number",
						"otp": "681",
						"customer_id": "9729877570",
						"state_desc": "Verification Pending"
					  }
					}
					*/
					$customer_id_type= $result['data']['customer_id_type'];
					$rstate= $result['data']['state'];
					$rcustomer_id= $result['data']['customer_id'];
					$otp= $result['data']['otp'];
					$rstate_desc= $result['data']['state_desc'];
					$rmnootp=$otp;
					if($rstate=="")
					$rstate=1;
					
					if($name!=" ")
					$qry="update eko_sender set response='".$response."', response_type_id='".$response_type_id."', response_status_id='".$response_status_id."', response_status='".$status."', response_message='".$message."', sender_name='$name', state='$rstate', customer_id='$rcustomer_id', response_otp='$otp', state_desc='$rstate_desc', eko_sender_status='2', registered_on='$datetime_time' where sender_number=$id;";
					else
					$qry="update eko_sender set response='".$response."', response_type_id='".$response_type_id."', response_status_id='".$response_status_id."', response_status='".$status."', response_message='".$message."', state='$rstate', customer_id='$rcustomer_id', response_otp='$otp', state_desc='$rstate_desc', eko_sender_status='2', registered_on='$datetime_time' where sender_number=$id;";
					mysql_query($qry);
				}
			}
			if(isset($_POST['submit2']))
			{
				if(isset($_POST['rmno']))
				$rmno=$_POST['rmno'];
				if(isset($_POST['rname']))
				$name=mysql_real_escape_string($_POST['rname']);
				if(isset($_POST['rmnootp']))
				$rmnootp=$_POST['rmnootp'];
				
				$id_type="mobile_number";
				$id=$rmno;
				
				/* API CALL */
				 
				$bankapi_user_id="100001";
				$bankapi_user_pass="9729877577";
				$bankapi_method="SENDER_OTP_VERIFY";
				$sender_number=$id;
				$sender_name=$name;
				$sender_otp=$rmnootp;

				include_once('../_gyan-info-retail.php');
				$url = "$call_url" . "?";
				$url = $url . "bankapi_user_id=" . $bankapi_user_id;
				$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
				$url = $url . "&bankapi_method=" . $bankapi_method;
				$url = $url . "&sender_number=" . $sender_number;
				$url = $url . "&sender_otp=" . $sender_otp;
				$post_values = "";
				$post_values = $post_values . "sender_name=" . $sender_name;

							   
				$curl = curl_init($url);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_POST, 1);
				curl_setopt($curl, CURLOPT_POSTFIELDS, $post_values);
				$response = curl_exec($curl);
				
				/* API RESULT */
				
				$err = curl_error($curl);
				curl_close($curl);
				if ($err) {
				  $msg="<br>cURL Error : " . $err;
				}
				else
				{
					//echo $response;
					$result= json_decode($response, true);					
					$message= $result['message'];
					$response_type_id= $result['response_type_id'];
					$response_status_id= $result['response_status_id'];
					$status= $result['status'];
				}
				$msg="";
				if(($response_type_id==300 && $response_status_id==0 && $status==0) ||
				($response_type_id==301 && $response_status_id==-1 && $status==0))
				{
					/*
					{
						"message":"Wallet opened successfully.",
						"response_type_id":300,
						"response_status_id":0,
						"status":0,
						"data": {
							"state":"2",
							"customer_id_type":"",
							"customer_id":"8146145111",
							"state_desc":"Non-Kyc"
						}
					}
					*/
					/*
					{
						"message":"Customer already verified",
						"response_type_id":301,
						"response_status_id":-1,
						"status":0
					}
					*/
					/*
					{
						"message":"Please enter correct OTP or do resend OTP",
						"response_type_id":-1,
						"response_status_id":1,
						"status":302,
						"invalid_params": {
							"otp":"Please enter correct OTP or do resend OTP request."
						}
					}
					*/
					$qry="update eko_sender set response='".$response."', response_type_id='".$response_type_id."', response_status_id='".$response_status_id."', response_status='".$status."', response_message='".$message."', eko_sender_status='3', verified_on='$datetime_time' where sender_number=$id;";
					
					if($response_type_id==300 && $response_status_id==0 && $status==0)
					echo "<script>document.location.href='money-transfer-3-benefs.php?rmno=$rmno'</script>";
				}
				else
				{
					$msg="<b style='color:red;'>Please enter correct OTP ... Get OTP again ... !!!</b>";
				}
			}
			
			?>

                
     <div class="row content-container elements">

            <div class="col s12 m12 l6" id="registerNewRemitter">
                <div class="card project-stats">
                    <div class="card-content">
                        <h5><i class="fa fa-money fa-1x"></i> Register New Remitter </h5>
                    </div>
                    <div class="card-action min-height">
                        <div class="row extra-elements">
						<form method="post">
                            <div id="step2point5">
								<?php echo $msg;?>
								<br><br>																	
								<?php
								if($msg!="")
								$name=" ";
								if($name=="")								
								{								
								?>
                                <div class="input-field col l8 m12 s12 offset-l2">
                                    <input id="senderMobile" name="rmno" readonly value="<?php echo $rmno;?>" required type="text" class="validate" maxlength="10" >
                                    <label for="senderMobile" class="">Remitter Mobile No.</label>
                                </div>

                                <div class="input-field col l8 m12 s12 offset-l2">
                                    <input id="senderName" name="rname" value="<?php echo $name;?>" required type="text" class="validate">
                                    <label for="senderName" class="">Remitter Name</label>
                                </div>

                                <div class="input-field col l8 m12 s12 offset-l2 btn-div buttons-s">
                                    <input name="submit1" type="submit" style="width:100%;" class="btn btn-block btn-danger" value="Get OTP">
                                </div>								
								<?php								
								}								
								?>
                                </div>
                            <div id="OTPEntry">								
								<?php								
								if($name!="")								
								{	
									$domain_name=$_SERVER['HTTP_HOST'];
									if($domain_name=="localhost" || $domain_name=="demo.payoneonline.com")
									{
										echo "<script>alert('your otp is : $otp');</script>";
									}
								?>
                                <div class="input-field col l8 m12 s12 offset-l2">
                                    <input id="enterOTP" name="rmnootp" type="text" required class="validate numericOnlyText">
                                    <label for="enterOTP" class="">Enter OTP</label>
									<input id="senderName" name="rname" value="<?php echo $name;?>" required type="hidden" class="validate">
                                    <a onclick="javascript:window.location.reload();" id="resendThyOTP">Resend OTP</a>
                                </div>
                                <div class="input-field col l8 m12 s12 offset-l2 btn-div buttons-s">
                                    <input name="submit2" type="submit" style="width:100%;" class="btn btn-block btn-danger" value="Submit OTP">
                                </div>								
								<?php								
								}								
								?>
                            </div>
						</form>
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
