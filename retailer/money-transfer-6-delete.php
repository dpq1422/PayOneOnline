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

                
     <div class="row content-container elements">
			<?php
			$sender_number="";
			$receiver_number="";
			$receiver_id="";
			$msg="";
			if(isset($_REQUEST['srm']))			
			$sender_number=$_REQUEST['srm'];
			if(isset($_REQUEST['rrm']))			
			$receiver_number=$_REQUEST['rrm'];
			if(isset($_REQUEST['rid']))			
			$receiver_id=$_REQUEST['rid'];

			if($receiver_id!="" && $sender_number!="" && $receiver_number!="")
			{
				
				/* API CALL */
				 
				$bankapi_user_id="100001";
				$bankapi_user_pass="9729877577";
				$bankapi_method="DELETE_RECEIVER";
				$sender_number=$sender_number;
				$receiver_id=$receiver_id;

				include_once('../_gyan-info-retail.php');
				$url = "$call_url" . "?";
				$url = $url . "bankapi_user_id=" . $bankapi_user_id;
				$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
				$url = $url . "&bankapi_method=" . $bankapi_method;
				$url = $url . "&sender_number=" . $sender_number;
				$url = $url . "&receiver_id=" . $receiver_id;

							   
				$curl = curl_init($url);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($curl);
				
				/* API RESULT */

				$err = curl_error($curl);

				curl_close($curl);

				if ($err) {
				  echo "<br>cURL Error : " . $err;
				}
				else
				{
					//echo $response;
					$msg="";
					$result= json_decode($response, true);
					$message= $result['message'];
					$response_type_id= $result['response_type_id'];
					$response_status_id= $result['response_status_id'];
					$status= $result['state'];
					
					if($response_type_id==27 && $response_status_id==0 && $state==0)
					{
						$msg="<b style='color:green;'>".$message."</b>";
					}
					else
					{
						$msg="<b style='color:red;'>".$message."</b>";
					}
				}
			}
			?>
            <div class="col s12 m12 l6 socialMessage">
                <div class="messageBox">
                    <div class="card ">
                        <div class="card-content">
                            <h5><i class="fa fa-money fa-1x"></i>
                                Delete Beneficiery
                            </h5>
                        </div>
                        <div class="card-action min-height">

                            <div class="row">
							<form action="money-transfer-1-search.php" method="post">

                                <div class="col l12 m12 s12 pad-10" id="firstStep">
									<?php echo $msg;?>
									<br><br>
                                    <div class="input-field col m12 s12 text-center">
                                        <img src="../img/smartphone2.png" class="operatorImage" height="80" style="margin-bottom: 10px;">
                                    </div>

                                    <div class="input-field col l8 m12 s12 offset-l2">
                                        <input id="mobile" value="<?php echo $sender_number;?>" readonly required name="rmno" type="text" class="validate numericOnlyText" style="font-size: 1.8rem" maxlength="10">
                                        <label for="mobile" class="">Sender's Mobile number.</label>
                                    </div>

                                    <div class="input-field col l8 m12 s12 offset-l2">
                                        <input id="mobile" value="<?php echo $receiver_number;?>" readonly required name="rmno" type="text" class="validate numericOnlyText" style="font-size: 1.8rem" maxlength="10">
                                        <label for="mobile" class="">Receiver's Mobile number.</label>
                                    </div>

                                    <div class="input-field col l8 m12 s12 offset-l2">
                                        <input id="mobile" value="<?php echo $receiver_id;?>" readonly required name="rmno" type="text" class="validate numericOnlyText" style="font-size: 1.8rem" maxlength="10">
                                        <label for="mobile" class="">Receiver's ID number.</label>
                                    </div>

                                </div>

                                <div class="col m12 s12 btn-div buttons-s text-center" id="cartoon" style="opacity: 0.8;">
                                    <img src="../img/money_transfer_bg.png" alt="cartoon">
                                </div>

							</form>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
			<?php
			if(isset($_POST['submit']) && $msg=="")
			{
			?>
            <div class="col s12 m12 l6">
			<div class="socialMessage">
                <div class="messageBox">
                    <div class="card ">
                        <div class="card-content">
                            <h5><i class="fa fa-money fa-1x"></i>
                                Remitter's Details 
                            </h5>
                        </div>
						<div class="card-action min-height">

							<div class="row">
			<div class="col l12 m12 s12 pad-10" id="twoStep" >
			<form action="<?php echo $action;?>" method="post">

                                    <div class="col l8 m12 s12 offset-l2 text-center">
                                        <h4 class="orange-text">+91-<span id="mobile2"><?php echo $rmno;?></span></h4>
										<input type="hidden" value="<?php echo $rmno;?>" name="rmno"/>
                                    </div>

                                    <div class="col l8 m12 s12 offset-l2 text-center">
                                        <h5 class="green-text" id="remitName"><?php echo $rname;?></h5>
                                    </div>

                                    <div class="col l8 m12 s12 offset-l2 text-center">
                                        <h5 class="pink-text">
								<?php
								if($rname!="Remitter is not regestered with us")
								{
								?>
										<?php echo $rlimit;?>
								<?php
								}
								else
								{
								echo "&nbsp;";
								}
								?>
										</h5>
                                    </div>

                                    <div class="col l8 m12 s12 offset-l2 text-center" style="display:none;">
                                        <label class="label label-sucess" id="addKyc"></label>
                                    </div>

                                <div class="col m12 s12 btn-div buttons-s text-center" id="cartoon" style="opacity: 0.8;">
                                    <img src="../img/money_transfer_bg.png" alt="cartoon">
                                    <div class="form-group">
                                        <label>&nbsp;</label>

                                        <input type="submit" style="width:100%;" class="btn btn-block btn-danger" value="<?php echo $submit;?>">

                                    </div>
                                </div>

						</form>
                                </div>
								</div></div></div></div></div>
            </div>
			<?php
			}
			?>

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
