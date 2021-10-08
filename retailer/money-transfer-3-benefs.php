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
			$rmno="";
			if(isset($_REQUEST['rmno']))
			$rmno=$_REQUEST['rmno'];
			
			$action="money-transfer-3-benefs.php";
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
			  $msg="<br>cURL Error : " . $err;
			}
			else
			{
				//echo "<pre>".$response."</pre>";
				$result= json_decode($response, true);
				$message= $result['message'];
				$response_type_id= $result['response_type_id'];
				$response_status_id= $result['response_status_id'];
				$status= $result['status'];
			}
			if($status==0 && $response_type_id==33)
			{				
				$balance_amount=$result['data']['balance'];
				$rname=$result['data']['name'];
				$rstate=$result['data']['state'];
				$rcustomer_id=$result['data']['customer_id'];
				$rstate_desc=$result['data']['state_desc'];
				$currency=$result['data']['currency'];
				
				include_once('../_gyan-info-retail.php');
				
				$qry2="select * from eko_sender where sender_number='$id';";
				$res2=mysql_query($qry2);
				$eko_sender_id="";
				while($row=mysql_fetch_array($res2))
				{
					$eko_sender_id=$row['eko_sender_id'];
				}
				$qry_del="delete from eko_receiver where sender_number='$id'";
				mysql_query($qry_del);
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
			}			
			
			/* API CALL */
				 
			$bankapi_user_id="100001";
			$bankapi_user_pass="9729877577";
			$bankapi_method="SHOW_RECEIVERS";
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
			  $msg="<br>cURL Error : " . $err;
			}
			else
			{
				$result= json_decode($response, true);
				$message= $result['message'];
				$response_type_id= $result['response_type_id'];
				$response_status_id= $result['response_status_id'];
				$status= $result['status'];
			}
			if($response_type_id==-1 && $response_status_id==1 && $status==463)
			{
				/*
				{
				  "message": "Customer id does not exist in system.",
				  "response_type_id": -1,
				  "response_status_id": 1,
				  "status": 463,
				  "invalid_params": {
					"customer_id": "Agent does not exist in Sytem"
				  }
				}
				*/
			}
			else if($response_type_id==22 && $response_status_id==-1 && $status==0)
			{
				/*
				{
				  "message": "No recepients found",
				  "response_type_id": 22,
				  "response_status_id": -1,
				  "status": 0
				}
				*/
			}
			else if($response_type_id==23 && $response_status_id==0 && $status==0)
			{
				/*
				{
				  "message": "Success",
				  "response_type_id": 23,
				  "response_status_id": 0,
				  "status": 0,
				  "data": {
					"recipient_list": [
					  {
						"is_verified": 0,------------------------------------------
						"imps_inactive_reason": "",
						"is_otp_required": "0",
						"recipient_id": 10013621,
						"recipient_mobile": "8146145590", ################################################
						"pipes": {
						  "3": {
							"status": 1,
							"pipe": 3
						  }
						},
						"recipient_name": "Shweta Sharma", ################################################
						"recipient_id_type": "acc_ifsc", ################################################
						"is_self_account": "0", ################################################
						"allowed_channel": 0,
						"is_rblbc_recipient": 1,
						"ifsc_status": 3,
						"account": "093501508577", ################################################
						"bank": "ICICI BANK LTD",
						"channel_absolute": 0,
						"is_imps_scheduled": 0,
						"available_channel": 0,
						"channel": 0,
						"ifsc": "ICIC0000005",
						"account_type": "Bank Account"
					  }
					]
				  }
				}
				*/
			}
			?>
		
		<div class="row content-container elements">

            <div class="col s12 m12 l12" id="transferTable" style="">
                <div class="card project-stats">
                    <div class="card-content">
                        <h5><i class="fa fa-money fa-1x"></i> Transfer <small><a href="money-transfer-4-benef.php?rmno=<?php echo $rmno;?>" id="addBenef" style="font-size: 12px;">Add New Beneficiary</a></small></h5>
                    </div>
                    <div class="card-action" id="transferElements">
						<small>
							<table class="table cart-table custom custom-striped">
								<thead>
										<tr>
											<th>Benef. Name: </th>
											<th>Benef. Mobile</th>
											<th>Account No.</th>
											<th>Bank</th>
											<th>Verified or Not</th>
											<th>Transaction</th>
											<!--<th>Delete Benef.</th>-->
										</tr>
								</thead>
								<tbody>
								<?php
								if($response_type_id==-1 && $response_status_id==1 && $status==463)								
								{
									echo "<tr><td colspan='7'>Remitter does not exist</td></tr>";
								}
								else if($response_type_id==22 && $response_status_id==-1 && $status==0)
								{
									echo "<tr><td colspan='7'>No Beneficiary registered</td></tr>";
								}
								else if($response_type_id==23 && $response_status_id==0 && $status==0)
								{
									$benefs=$result['data']['recipient_list'];
									include('../_gyan-info-retail.php');
									for($i=0;$i<count($benefs);$i++)
									{
										$benef=$benefs[$i];
										$j=0;
										$sender_number=$id;
										$receiver_number=$benef['recipient_mobile'];
										$rec_name="";
										$rec_acc="";
										$rec_name=$benef['recipient_name'];
										$rec_acc=$benef['account'];
										
										$is_verified=0;
										$qry2="select * from eko_receiver where sender_number='$sender_number' and receiver_name='$rec_name' and receiver_acc_no='$rec_acc';";
										$res2=mysql_query($qry2);
										$eko_sender_id="";
										while($row=mysql_fetch_array($res2))
										{
											$j++;
										}
										if($j==0)
										{
											$response_message2="Success!Please transact using Recipientid";
											$response_type_id2=43;
											$response_status_id2=0;
											$response_status2=0;
											$qry="";
											$acc_stt="1";
											if($benef['is_verified']==0)
											$acc_stt="2";
											else
											{
												$acc_stt="3";
												$is_verified=1;
											}
											$qry="insert into eko_receiver
											(user_id, sender_number, receiver_number, 
											receiver_id_type, receiver_acc_no, receiver_name, response,  
											response_type_id, response_status_id, response_status, 
											response_message, is_self_account, receiver_id, 
											is_verified, imps_inactive_reason, is_otp_required, 
											allowed_channel, is_rblbc_recipient, ifsc_status, 
											bank, channel_absolute, is_imps_scheduled, 
											available_channel, channel, ifsc, 
											account_type, updated_on, eko_receiver_status) value
											($user_id, $sender_number, $receiver_number, 
											'".$benef['recipient_id_type']."', '".$benef['account']."', '".$benef['recipient_name']."', '', 
											'".$response_type_id2."', '".$response_status_id2."', '".$response_status2."', 
											'".$response_message2."', '".$benef['is_self_account']."', '".$benef['recipient_id']."', 
											'".$benef['is_verified']."', '".$benef['imps_inactive_reason']."', '".$benef['is_otp_required']."', 
											'".$benef['allowed_channel']."', '".$benef['is_rblbc_recipient']."', '".$benef['ifsc_status']."', 
											'".$benef['bank']."', '".$benef['channel_absolute']."', '".$benef['is_imps_scheduled']."', 
											'".$benef['available_channel']."', '".$benef['channel']."', '".$benef['ifsc']."', 
											'".$benef['account_type']."', '$datetime_time', $acc_stt );";
											mysql_query($qry);
										}
										$is_stored=0;
										$qry_store="select * from eko_receiver_verified where bank='".$benef['bank']."' and ifsc='".$benef['ifsc']."' and receiver_acc_no='".$benef['account']."';";
										$result_store=mysql_query($qry_store);
										while($row_store=mysql_fetch_array($result_store))
										{
											$is_stored++;
										}
										
										if($is_verified==1 && $is_stored==0)
										{
											$qry="insert into eko_receiver_verified(bank, ifsc, receiver_acc_no, receiver_name, receiver_id_type, updated_on, source) value('".$benef['bank']."', '".$benef['ifsc']."', '".$benef['account']."', '".$benef['recipient_name']."', '".$benef['recipient_id_type']."', '$datetime_time', 1);";
											mysql_query($qry);
										}
								?>
									<tr>
										<td><?php echo $benef['recipient_name'];?></td>
										<td><?php echo $benef['recipient_mobile'];?></td>
										<td><?php echo $benef['account'];?></td>
										<td><?php echo $benef['bank'];?></td>
										<td>
											<?php 
											
											if($benef['is_verified']==0) 
											{
											?>
											Not Verified
											<?php
											}
											else
											{
											?>
												<img height="20" src="../img/verified.png"/>
											<?php
											}
											
											?>
										</td>
										<td><a href="money-transfer-5-transfer.php?srm=<?php echo $rmno;?>&rrm=<?php echo $benef['recipient_mobile'];?>&rid=<?php echo $benef['recipient_id'];?>" class="btn orange">Select</a></td>
										<td><a href="money-transfer-6-delete.php?srm=<?php echo $rmno;?>&rrm=<?php echo $benef['recipient_mobile'];?>&rid=<?php echo $benef['recipient_id'];?>" class="btn red">Delete</a></td>
									</tr>
								<?php
									}
								}
								?>
								</tbody>
							</table>
						</small>
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
