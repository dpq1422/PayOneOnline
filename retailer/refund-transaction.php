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
			$order="";
			$txn="";
			$otp="";
			$msg="";
			if(isset($_REQUEST['order']))
			$order=$_REQUEST['order'];			
			if(isset($_REQUEST['txn']))			
			$txn=$_REQUEST['txn'];
			
			/* API CALL */
				 
			$bankapi_user_id="100001";
			$bankapi_user_pass="9729877577";
			$bankapi_method="FUND_REFUND_OTP_RESEND";
			$tid=$txn;

			include_once('../_gyan-info-retail.php');
			$url = "$call_url" . "?";
			$url = $url . "bankapi_user_id=" . $bankapi_user_id;
			$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
			$url = $url . "&bankapi_method=" . $bankapi_method;
			$url = $url . "&tid=" . $tid;
						   
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
				$result= json_decode($response, true);
				$message= $result['message'];
				$response_type_id= $result['response_type_id'];
				$response_status_id= $result['response_status_id'];
				$status= $result['status'];
			}
			if($status==0 && $response_type_id==169 && $response_status_id==-1)
			{
				$otp= $result['data']['otp'];
				$domain_name=$_SERVER['HTTP_HOST'];
				if($domain_name=="localhost" || $domain_name=="demo.payoneonline.com")
				{
					$msg="<b style='color:green;'>your otp is : $otp</b>";
				}
				/*
				{
				  "message": "Success!Refund OTP resent",
				  "response_type_id": 169,
				  "response_status_id": -1,
				  "status": 0,
				  "data": {
					"tid": "12735434",
					"otp": "7668294572"
				  }
				}
				*/
			}
			else
			{
				$msg="<b style='color:red;'>$message</b>";
			}
				
			if(isset($_POST['submit']))
			{
				$order=$_POST['order'];
				$txn=$_POST['txn'];
				$otp=$_POST['eotp'];
				
				/* API CALL */
				 
				$bankapi_user_id="100001";
				$bankapi_user_pass="9729877577";
				$bankapi_method="FUND_REFUND";
				$order_number=$order;
				$tid=$txn;

				include_once('../_gyan-info-retail.php');
				//$url = "$call_url" . "?";
				$url = $url . "bankapi_user_id=" . $bankapi_user_id;
				$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
				$url = $url . "&bankapi_method=" . $bankapi_method;
				$url = $url . "&order_number=" . $order_number;
				$url = $url . "&tid=" . $tid;
				$url = $url . "&otp=" . $otp;
							   
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
					$result= json_decode($response, true);
					$message= $result['message'];
					$response_type_id= $result['response_type_id'];
					$response_status_id= $result['response_status_id'];
					$status= $result['status'];
				}
				if($status==0 && $response_type_id==74 && $response_status_id==0)
				{
					$refund_tid=0;
					if(isset($result['data']['refund_tid']))
						$refund_tid=$result['data']['refund_tid'];
					/*
					{
					  "message": "Refund done",
					  "response_type_id": 74,
					  "response_status_id": 0,
					  "status": 0,
					  "data": {
						"refunded_amount": "5000.00",
						"timestamp": "2017-08-02T12:09:41.135Z",
						"fee": "0.0",
						"amount": "5000.00",
						"tid": "12735435",
						"refund_tid": "12737093",
						"currency": "INR"
					  }
					}
					*/
					
					// get user id and transfer amount without charges of order id
					$qry3="select * from main_transaction_mt where tid=$tid";
					$res3=mysql_query($qry3);
					$uid=0;
					$trans_amt=0;
					$ord_stat=0;
					$oid=0;
					while($rs3=mysql_fetch_array($res3))
					{
						$oid=$rs3['eko_transaction_id'];
						$uid=$rs3['user_id'];
						$trans_amt=$rs3['amount'];
						$ord_stat=$rs3['eko_transaction_status'];
					}
					$deducted2=$trans_amt+6;
					$deducted3=$trans_amt+5.90;
					
					// get order deducted amount of user wallet with wallet id
					$query_ref="select * from child_wallet_remain where user_id='$user_id' and user_id2='0' and request_id='$oid' and transaction_type='6'";
					$result_ref=mysql_query($query_ref);
					$num_rows_ref = mysql_num_rows($result_ref);
					$amt=0;
					if($num_rows_ref>0)
					{
						while($rs_ref = mysql_fetch_assoc($result_ref))
						{
							$amt=$rs_ref['amount_dr'];
						}
					}
					
					// get last updated balance of user
					update_wallet($uid);
					$wb=wallet_balance($uid);
					$new_bal=$wb+$amt;
					
					//refund order amount to user wallet
					$filled_remarks="Money Transfer order $oid refunded";
					$query4b="insert into child_wallet_remain value (NULL, '$date_time', '$time_time', '$uid', '0', '$oid', '7', '$filled_remarks', '$wb', '$amt', '0', '$new_bal');";
					mysql_query($query4b);
					$refund_cid=mysql_insert_id();
					update_wallet($uid);
					
					// get last updated balance of payone realtime wallet
					$qrss="select * from child_wallet_realtime order by wallet_id desc limit 0, 1";
					$resss=mysql_query($qrss);
					$pre_bal15=0;
					while($rsss = mysql_fetch_assoc($resss))
					{
						$pre_bal15=$rsss['amount_bal'];
					}
					$bal2=$pre_bal15+$deducted2;
					
					// refund order amount to payone realtime wallet
					$filled_remarks2="Money Transfer order $oid refunded";
					$query4b="insert into child_wallet_realtime value (NULL, '$date_time', '$time_time', '$uid', '$oid', '0', '3', '$filled_remarks2', '$pre_bal15', '$deducted2', '0', '$bal2');";
					$result24c=mysql_query($query4b);
					$refund_aid=mysql_insert_id();
					
					// get last updated balance of mentor realtime wallet
					$qrss2="select * from parent_wallet_realtime order by wallet_id desc limit 0, 1";
					$resss2=mysql_query($qrss2);
					$pre_bal21=0;
					$pre_bal25=0;
					while($rsss2 = mysql_fetch_assoc($resss2))
					{
						$pre_bal21=$rsss2['amount_bal'];
						$pre_bal25=$rsss2['real_bal'];
					}
					$bal3=$pre_bal21+$deducted3;
					$bal3_live=$pre_bal25+$deducted3;
					
					// refund order amount to mentor realtime wallet
					$filled_remarks3="Money Transfer order $oid refunded";
					$query4b="insert into parent_wallet_realtime value (NULL, '$date_time', '$time_time', 1001, '$uid', '$oid', '0', '3', '$filled_remarks3', '$pre_bal21', '$deducted3', '0', '$bal3', '$pre_bal25', '$deducted3', '0', '$bal3_live');";
					$result24c+=mysql_query($query4b);
					$refund_mid=mysql_insert_id();
		
					// order status updated not initiated to refunded
					$qry2="update main_transaction_mt set eko_transaction_status=5, response='$response', refund_tid='$refund_tid', refund_cid=$refund_cid, refund_aid=$refund_aid, refund_mid=$refund_mid, updated_on='$datetime_time' where eko_transaction_id=$oid";
					mysql_query($qry2);	
					
					echo "<script>document.location.href='fund-refund.php';</script>";
				}
				else
				{
					$msg="<b style='color:red;'>$message</b>";
				}
			}			
			?>

                
     <div class="row content-container elements">

            <div class="col s12 m12 l6" id="registerNewRemitter"">
                <div class="card project-stats">
                    <div class="card-content">
                        <h5><i class="fa fa-money fa-1x"></i> Refund Initiate </h5>
                    </div>
                    <div class="card-action min-height">
                        <div class="row extra-elements">
						<form method="post">
                            <div id="step2point5">
								<?php echo $msg;?>
								<br><br>	
                                <div class="input-field col l8 m12 s12 offset-l2">
                                    <input id="order" name="order" readonly value="<?php echo $order;?>" required type="text" class="validate" maxlength="10" >
                                    <label for="order" class="">Order No.</label>
                                </div>

                                <div class="input-field col l8 m12 s12 offset-l2">
                                    <input id="txn" name="txn" readonly value="<?php echo $txn;?>" required type="text" class="validate">
                                    <label for="txn" class="">Txn No.</label>
                                </div>

                                <div class="input-field col l8 m12 s12 offset-l2">
                                    <input id="eotp" name="eotp" value="" required type="text" class="validate">
                                    <label for="txn" class="">Enter OTP</label>
									<a href="refund-transaction.php?order=<?php echo $_REQUEST['order'];?>&txn=<?php echo $_REQUEST['txn'];?>" id="resendThyOTP">Resend OTP</a>
                                </div>

                                <div class="input-field col l8 m12 s12 offset-l2 btn-div buttons-s">
                                    <input name="submit" type="submit" style="width:100%;" class="btn btn-block btn-danger" value="Refund">
                                </div>	
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
