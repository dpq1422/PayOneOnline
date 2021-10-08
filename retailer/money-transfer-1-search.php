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
			$rmno="";
			$rname="";
			$msg="";
			$rlimit=0;
			if(isset($_POST['rmno']))			
			$rmno=$_POST['rmno'];

			if($rmno!="")
			{
				$action="money-transfer-3-benefs.php";
				$submit="Transfer";
				$rname="";
				
				$id=$rmno;
				
				/* API CALL */
				 
				$bankapi_user_id="100001";
				$bankapi_user_pass="9729877577";
				$bankapi_method="SHOW_SENDER";
				$sender_number=$id;

				include_once('../_gyan-info-retail.php');
				$url = "$call_url" . "?";
				$url = $url . "bankapi_user_id=" . $bankapi_user_id;
				$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
				$url = $url . "&bankapi_method=" . $bankapi_method;
				$url = $url . "&sender_number=" . $sender_number;

							   
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
					$msg="System down for maintenance";
					$strps=strpos($response,$msg);
					$msg="<b style='color:red;'>".$msg."</b>";
					if($strps=="")
					{
						$msg="";
						$result= json_decode($response, true);
						$message= $result['message'];
						$response_type_id= $result['response_type_id'];
						$response_status_id= $result['response_status_id'];
						$status= $result['status'];
						/*
						{
						  "message": "Non-KYC active",
						  "response_type_id": 33,
						  "response_status_id": 0,
						  "status": 0,
						  "data": {
							"limit": [
							  {
								"remaining": "25000.0",
								"status": "0",
								"priority": null,
								"name": "BC_Pipe4",
								"used": "0.0",
								"pipe": "1"
							  },
							  {
								"remaining": "20000.0",
								"status": "0",
								"priority": 7,
								"name": "Wallet",
								"used": "0.0",
								"pipe": "2"
							  },
							  {
								"remaining": "25000.0",
								"status": "0",
								"priority": 2,
								"name": "BC_Pipe3",
								"used": "0.0",
								"pipe": "3"
							  },
							  {
								"remaining": "0.0",
								"status": "0",
								"priority": 3,
								"name": "BC_Pipe2",
								"used": "25000.0",
								"pipe": "4"
							  },
							  {
								"remaining": "96.0",
								"status": "1",
								"priority": 1,
								"name": "Paytm",
								"used": "24904.0",
								"pipe": "5"
							  },
							  {
								"remaining": "25000.0",
								"status": "0",
								"priority": 6,
								"name": "Wallet2",
								"used": "0.0",
								"pipe": "6"
							  }
							],
							"balance": "0.0",
							"name": "Abhishek",
							"state": "2",
							"customer_id_type": "mobile_number",
							"customer_id": "9729877577",
							"state_desc": "Non-Kyc",
							"currency": "INR",
							"mobile": "9729877577"
						  }
						}
						*/
						$qry2="select * from eko_sender where sender_number='$id';";
						$res2=mysql_query($qry2);
						$eko_sender_id="";
						while($row=mysql_fetch_array($res2))
						{
							$eko_sender_id=$row['eko_sender_id'];
						}
						if($status!=0 && $response_type_id==-1)
						{				
							if($eko_sender_id=="")
							{
								$qry="insert into eko_sender(user_id,sender_number,response,response_type_id,response_status_id,response_status,response_message,eko_sender_status,checked_on) value('".$user_id."','".$id."','".$response."','".$response_type_id."','".$response_status_id."','".$status."','".$message."','1','$datetime_time');";
								mysql_query($qry);
							}
							else
							{
								$qry="update eko_sender set checked_on='$datetime_time' where eko_sender_id=$eko_sender_id;";
								mysql_query($qry);
							}
							
							$rname="Remitter is not registered with us";
							$rlimit=0;
							$action="money-transfer-2-otp.php?rmno=$rmno";
							$submit="Register";
						}
						else if($status==0 && $response_type_id==37)
						{
							$rname=$result['data']['name'];
							$rstate=$result['data']['state'];
							$rcustomer_id=$result['data']['customer_id'];
							$rstate_desc=$result['data']['state_desc'];
							if($eko_sender_id!="")
							{
								$qry="update eko_sender set user_id='".$user_id."', sender_number='".$id."', response='".$response."', response_type_id='".$response_type_id."', response_status_id='".$response_status_id."', response_status='".$status."', response_message='".$message."', sender_name='$rname', state='$rstate', customer_id='$rcustomer_id', state_desc='$rstate_desc', eko_sender_status='2', registered_on='$datetime_time' where eko_sender_id=$eko_sender_id;";
								mysql_query($qry);
							}
							
							$rlimit=$result['data']['state_desc'];
							$action="money-transfer-2-otp.php?rmno=$rmno";
							$submit="Verify";
						}
						else if($status==0 && $response_type_id==33)
						{				
							$balance_amount=$result['data']['balance'];
							$rname=$result['data']['name'];
							$rstate=$result['data']['state'];
							$rcustomer_id=$result['data']['customer_id'];
							$rstate_desc=$result['data']['state_desc'];
							$currency=$result['data']['currency'];
							if($eko_sender_id=="")
							{
								$qry="insert into eko_sender(user_id,sender_number,response,response_type_id,response_status_id,response_status,response_message,eko_sender_status,checked_on) value('".$user_id."','".$id."','".$response."','".$response_type_id."','".$response_status_id."','".$status."','".$message."','1','$datetime_time');";
								mysql_query($qry);
							}
							$qry="update eko_sender set response='".$response."', response_type_id='".$response_type_id."', response_status_id='".$response_status_id."', response_status='".$status."', response_message='".$message."', sender_name='$rname', state='$rstate', customer_id='$rcustomer_id', balance_amount='$balance_amount', state_desc='$rstate_desc', eko_sender_status='3', registered_on='$datetime_time', verified_on='$datetime_time' where sender_number=$id;";
							mysql_query($qry);
							
							$limits=$result['data']['limit'];
							for($vals=0;$vals<count($limits);$vals++)
							{
								$field_name="limit_name_".($vals+1);//$limits[$vals]['name'];
								$field_val_remain="limit_remain_".($vals+1);//$limits[$vals]['remaining'];
								$field_val_used="limit_used_".($vals+1);//$limits[$vals]['used'];
								$qry="update eko_sender set $field_name='".$limits[$vals]['name']."', $field_val_remain='".$limits[$vals]['remaining']."', $field_val_used='".$limits[$vals]['used']."' where sender_number=$id;";
								mysql_query($qry);
							}		
											
							$rlimit="Remain Limit<br>IMPS <i class='fa fa-inr'></i><span id='remitLimit'>".$result['data']['limit'][4]['remaining']."</span>";
							$rlimit="$rlimit.<br>NEFT <i class='fa fa-inr'></i><span id='remitLimit'>".$result['data']['limit'][3]['remaining']."</span>";
							$action="money-transfer-3-benefs.php?rmno=$rmno";
							$submit="Transfer";
						}
					}
				}
			}
			?>
			<marquee style='color:red;font-weight:bold;'><br><br>As per Govt. guidelines, its mandatory to submit KYC Documents before 26th Jan 2018 for uninterrupted services. Go to My Profile upload KYC Documents.</marquee>
            <div class="col s12 m12 l6 socialMessage">
                <div class="messageBox">
                    <div class="card ">
                        <div class="card-content">
                            <h5><i class="fa fa-money fa-1x"></i>
                                Money Transfer by Mobile No
                            </h5>
                        </div>
                        <div class="card-action min-height">

                            <div class="row">
							<form action="money-transfer-1-search.php" method="post">

                                <div class="col l12 m12 s12 pad-10" id="firstStep">
									<?php echo $msg;?>
									<br><br>

                                    <div class="input-field col l8 m12 s12 offset-l2">
                                        <input id="mobile" value="<?php echo $rmno;?>" required name="rmno" type="text" class="validate numericOnlyText" style="font-size: 1.8rem" maxlength="10">
                                        <label for="mobile" class="">Remitter's Mobile number.</label>
                                    </div>



                                </div>

                                <div class="col m12 s12 btn-div buttons-s text-center" id="cartoon" style="opacity: 0.8;">
                                    <img src="../img/money_transfer_bg.png" alt="cartoon">
                                    <div class="form-group">
                                        <label>&nbsp;</label>

                                        <input type="submit" name="submit" style="width:100%;" class="btn btn-block btn-danger" value="Check">

                                    </div>
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
										<input type="hidden" value="<?php echo $rmno;?>" name="rmno"/>
                                    </div>

                                    <div class="col l8 m12 s12 offset-l2 text-center">
                                        <h5 class="green-text" id="remitName"><?php echo $rname;?></h5>
                                    </div>

                                    <div class="col l8 m12 s12 offset-l2 text-center">
                                        <h5 class="pink-text">
								<?php
								if($rname!="Remitter is not registered with us")
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
