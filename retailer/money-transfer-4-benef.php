<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<script>window.location.href='home.php';</script>
		<?php include('_head-tag.php'); ?>
		<script language="javascript" type="text/javascript">
		var submitbtn=0;
		function searchIFSC()
		{
				window.open('search-ifsc.php','Search IFSC Code','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=620,height=800');
		}
		function pullIFSC()
		{
			var bid=document.getElementById("bankCode").value;
			var ifsc_status=bid.split("@")[2];
			bid=bid.split("@")[0];
			//ifscCode
			$.ajax({
				type: "POST",
				url: "_ajax-pull-ifsc2.php",
				data: {'bid': bid },
				dataType: "json",
			 
				//if received a response from the server
				success: function( data, textStatus, jqXHR) {
					//our country code was correct so we have some information to display/
					var vals=data.split("@");
					var btns="<input id='verify_btn' onclick='valid_benef()' name='submit2' type='submit' style='width:100%;' class='btn green' value='Add and Verify'>";
					//document.getElementById("ifscCode").value=vals[0];
					//alert("IFSC : "+ifsc_status);
					if(ifsc_status==1 || ifsc_status==3)
					{
						document.getElementById('IFSCCoder').style.display='none';
						document.getElementById('sifsc').style.display='none';
						document.getElementById("ifscCode").value=vals[0];
						if(vals[0]=="")
						document.getElementById("ifscCode").value="ABCD1234567";
					}
					else
					{
						document.getElementById('IFSCCoder').style.display='block';
						document.getElementById('sifsc').style.display='block';
						document.getElementById("ifscCode").value='';
					}
					
					if(vals[1]==1)
					{
						document.getElementById("verifyaccountbtn").innerHTML = btns;
					}
					else
					{
						document.getElementById("verifyaccountbtn").innerHTML = "";
					}
					//document.getElementById("ifscCode").focus();
				}	 
			});
		}
		function sbmtbtn()
		{
			submitbtn++;
			if(submitbtn==1)
			{
				document.myform.target='money-transfer-4-benef.php';
				document.getElementById("frmVerifyss").submit();
			}
			document.getElementById("add_btn").setAttribute("disabled","disabled");
			document.getElementById("verify_btn").setAttribute("disabled","disabled");
		}
		function valid_benef()
		{
			var recMob=document.getElementById("recMob").value;
			var recName=document.getElementById("recName").value;
			var bankCode=document.getElementById("bankCode").value;
			var account=document.getElementById("account").value;
			var ifscCode=document.getElementById("ifscCode").value;
			var err="";
			if(recMob=="")
				err+="\n - Beneficiary mobile number is required";
			if(recName=="")
				err+="\n - Beneficiary Name is required";
			if(bankCode=="")
				err+="\n - Bank Name is required";
			if(account=="")
				err+="\n - Account number is required";
			if(ifscCode=="")
				err+="\n - IFSC Code is required";
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
				<?php
				//$extra_variable="<br>";
				$rmno="";
				if(isset($_REQUEST['rmno']))
				$rmno=$_REQUEST['rmno'];
				$msg="";
				$benef_rmno="";
				$benef_rmname="";
				$benef_bankcode="";
				$benef_bankaccno="";
				$benef_bankifsccode="";
				
				if(isset($_POST['submit1'])) /////////////////////// add without verify
				{
					$rmno=$_POST['rmno'];
					$benef_rmno=$_POST['brmno'];
					$benef_rmname=mysql_real_escape_string($_POST['rmname']);	
					$benef_bankaccno=$_POST['bankaccno'];
					$benef_bankifsccode=$_POST['bankifsccode'];
					
					$bnks=$_POST['bankcode'];
					$bnks=explode("@",$bnks);
					$benef_bankid=$bnks[0];
					$benef_bankcode=$bnks[1];
					$benef_ifsc_status=$bnks[2];
					
					
					$recipient_name=$benef_rmname;
					$recipient_mobile=$benef_rmno;
					$cust_id=$rmno;
					
					/* API CALL */
					 
					$bankapi_user_id="100001";
					$bankapi_user_pass="9729877577";
					$bankapi_method="SAVE_RECEIVER";
					$sender_number=$cust_id;
					$receiver_number=$recipient_mobile;
					$receiver_name=$recipient_name;
					$receiver_bank_bankid=$benef_bankid;//
					$receiver_bank_ifscstatus=$benef_ifsc_status;//
					$receiver_bank_bankcode=$benef_bankcode;//
					$receiver_bank_ifsccode=$benef_bankifsccode;//
					$receiver_bank_accno=$benef_bankaccno;

					include_once('../_gyan-info-retail.php');
					$url = "$call_url" . "?";
					$url = $url . "bankapi_user_id=" . $bankapi_user_id;
					$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
					$url = $url . "&bankapi_method=" . $bankapi_method;
					$url = $url . "&sender_number=" . $sender_number;
					$url = $url . "&receiver_number=" . $receiver_number;
					$url = $url . "&receiver_bank_bankid=" . $receiver_bank_bankid;
					$url = $url . "&receiver_bank_ifscstatus=" . $receiver_bank_ifscstatus;
					$url = $url . "&receiver_bank_bankcode=" . $receiver_bank_bankcode;
					$url = $url . "&receiver_bank_ifsccode=" . $receiver_bank_ifsccode;
					$url = $url . "&receiver_bank_accno=" . $receiver_bank_accno;
					$post_values = "";
					$post_values = $post_values . "receiver_name=" . $receiver_name;
								   
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
						//echo $response;//die();
						$result= json_decode($response, true);
						$msg=$message=$result['message'];
						$response_type_id="";
						$response_status_id="";
						$status="";
						if($message!="No key for Response")
						{
							$response_type_id=$result['response_type_id'];
							$response_status_id=$result['response_status_id'];
							$status=$result['status'];
						}					
						/*
						{
						  "message": "No key for Response"
						}
						*/
						/*
						{
						  "message": "Please provide valid bank details",
						  "response_type_id": 464,
						  "response_status_id": 1,
						  "status": 464
						}
						*/
						/*
						{
						  "message": "Recipient mobile should be numeric and doesnt start with 0",
						  "response_type_id": -1,
						  "response_status_id": 1,
						  "status": 145,
						  "data": {
							"pipes": {}
						  },
						  "invalid_params": {
							"recipient_mobile": "Recipient mobile should be numeric and doesnt start with 0 {2} {3}"
						  }
						}
						*/
						/*
						{
						  "message": "Success!",
						  "response_type_id": "43",
						  "response_status_id": "0",
						  "status": "0",
						  "data": {
							"recipient_id_type": "acc_ifsc",
							"recipient_id": "10002332",
							"recipient_mobile": "8987896897",
							"customer_id": "9962817283",
							"is_self_account": "0"
						  }
						}
						*/
						if($response_type_id==342 && $response_status_id==-1 && $status==0)
						{
							$msg="<b style='color:green;'>Beneficiary Added</b>";
							echo "<script>document.location.href='money-transfer-3-benefs.php?rmno=$rmno'</script>";
						}
						else if($response_type_id==43 && $status==0)
						{
							$recipient_id_type=$result['data']['recipient_id_type'];
							$recipient_id=$result['data']['recipient_id'];
							$is_self_account=$result['data']['is_self_account'];
							$qry="insert into eko_receiver
							(user_id, sender_number, receiver_number, receiver_id_type, 
							receiver_acc_no, receiver_name, response, response_type_id, 
							response_status_id, response_status, response_message, is_self_account, 
							receiver_id, is_verified, bank, ifsc, 
							updated_on, eko_receiver_status) values
							($user_id, $cust_id, $recipient_mobile, '$recipient_id_type', 
							'$benef_bankaccno', '$recipient_name', '$response', '$response_type_id', 
							'$response_status_id', '$status', '$message', '$is_self_account', 
							'$recipient_id', 0, '$benef_bankcode', '$benef_bankifsccode', 
							'$datetime_time', 2);";
							mysql_query($qry);
							$msg="<b style='color:green;'>Beneficiary Added</b>";
							echo "<script>document.location.href='money-transfer-3-benefs.php?rmno=$rmno'</script>";
						}
						else
						{
							$msg="<b style='color:red;'>".$message."</b>";
						}
					}
				}
				$sender_number="";
				$receiver_number="";
				$receiver_id="";
				//$msg="";
				if(isset($_REQUEST['rmno']))			
				$sender_number=$_REQUEST['rmno'];
				if(isset($_POST['rmno']))			
				$sender_number=$_POST['rmno'];
				if(isset($_POST['brmno']))			
				$receiver_number=$_POST['brmno'];
				//if(isset($_POST['rid']))			
				//$receiver_id=$_POST['rid'];
				
				$bname="";
				$bbank="";
				$bifsc="";
				$bacc="";
				/* API CALL */
				if(isset($_POST['submit2'])) /////////////////////// add and verify
				{
					// check wallet balance
					// wallet deduct
					// generate order
					// update wallet with order id
					
					$verify=0;
					$verification_charges=5;					
					$verification_charges2=2;					
					$verification_charges3=2;					
					$user_cur_bal=wallet_balance($user_id);
					$server_cur_bal=admin_wallet_balance();
					$server_cur_bal=$server_cur_bal-1000000;
				
					if($user_cur_bal<$verification_charges)
					$msg1="<b style='color:red;'>Your Balance is low for transation.</b>";
				
					$server_st=1;
					if($server_cur_bal<$server_bal)
					$server_st=-1;
					
					if($msg1=="" && $msg2=="")
					{
						$group_id=0;
						
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
						
						$sender_number=$_POST['rmno'];	
						$receiver_number=$_POST['brmno'];
						$receiver_id=0;
						
						$res_sender_name="";
						$qry_sender="select sender_name from eko_sender where sender_number='$sender_number'";
						$res_sender=mysql_query($qry_sender);
						while($rs_sender=mysql_fetch_array($res_sender))
						{
							$res_sender_name=$rs_sender['sender_name'];
						}
						
						$qry="insert into main_transaction_mt_bulk(date_time, retailer_id, receiver_id, sname, source, method) value ('$datetime_time', '$user_id', '$receiver_id', '$res_sender_name', 1, 2);";
						mysql_query($qry);				
						$group_id=mysql_insert_id();
						if($group_id%1000==0)
						{
							include_once('../functions/_zsms.php');
							zsms("8146145674","Bulk Order No $group_id started on dated $datetime_time");
						}			
						
						$qry="insert into main_transaction_mt(user_id, sender_number, receiver_number, receiver_id, amount, charges, com_charged, gst_charged, com_earned, deducted, created_on, updated_on, eko_transaction_status, tid, group_id,ip,source,type,sname, channel, channel_desc) 
						value($user_id, $sender_number, $receiver_number, $receiver_id, $verification_charges, 0, 0, 0, 0, '$verification_charges', '$datetime_time', '$datetime_time', $server_st, '', '$group_id','$main_ip',1,2,'$res_sender_name',2,'IMPS');";
						mysql_query($qry);				
						$client_ref_id=mysql_insert_id();
						if($client_ref_id%1000==0)
						{
							include_once('../functions/_zsms.php');
							zsms("8146145674","Order No $client_ref_id started on dated $datetime_time");
						}
						
						
						$sender_id=$user_id;
						$amt_ads=wallet_balance($sender_id);
						if($amt_ads>=$verification_charges)
						{
							$new_rec_name=$_POST['rmname'];
							$new_bankapi_ifsc=$_POST['bankifsccode'];
							$new_bankapi_acc=$_POST['bankaccno'];
							$new_bank_name=$_POST['bankcode'];
							$bnks=explode("@",$new_bank_name);
							$benef_bankid=$new_bank_name=$bnks[0];
							$new_query_bnk="SELECT * FROM eko_bank where eko_bank_id='$new_bank_name'";
							$new_result_bnk=mysql_query($new_query_bnk);
							while($new_rs_bnk = mysql_fetch_assoc($new_result_bnk))
							{
								$new_bank_name=$new_rs_bnk['bank_name'];
							}
							$desc = "<br>Txn Type : IMPS, <br>Sender : $sender_number $res_sender_name, <br>Receiver : $receiver_number $new_rec_name, <br>Bank : $new_bank_name, <br>Acc.No. : $new_bankapi_acc, <br>IFSC : $new_bankapi_ifsc, <br>Amount : $verification_charges, <br>Charges : 0";
							$bal1=$verification_charges;
							$pre_bal9=wallet_balance($sender_id);
							$bal1=$pre_bal9-$bal1;
							/*
							if($bal1==$verification_charges)
							{
								$bal1=$bal*(-1);
							}
							*/													
							$post_balance_remain=$bal1;
							$qry111="update main_transaction_mt_bulk set pre_bal='$pre_bal9', post_bal='$post_balance_remain', sender='$sender_number', receiver='$receiver_number', amount='$verification_charges', com_charged='0', deducted='$verification_charges', gst_charged='0', com_earned='0', charges='0' where bulk_id='$group_id';";
							mysql_query($qry111);
							

							$filled_remarks="Account Verification Order No. $client_ref_id, $desc ";
							$query4b="insert into child_wallet_remain value 
							(NULL,'$date_time','$time_time','$sender_id','0','$client_ref_id','6','$filled_remarks',
							'$pre_bal9', '0','$verification_charges','$bal1');";
							mysql_query($query4b);
							$wallet_ref_id=mysql_insert_id();	
							
							
							$qrss="select * from child_wallet_realtime order by wallet_id desc limit 0,1";
							$resss=mysql_query($qrss);
							$pre_bal14=0;
							while($rsss = mysql_fetch_assoc($resss))
							{
								$pre_bal14=$rsss['amount_bal'];
							}
							$bal2=$pre_bal14-$verification_charges2;
							
							$filled_remarks2="Account Verification Order No. $client_ref_id by $user_id, $desc";
							$query4b="insert into child_wallet_realtime value 
							(NULL,'$date_time','$time_time','$sender_id','$client_ref_id','0','2','$filled_remarks2',
							'$pre_bal14', '0','$verification_charges2','$bal2');";
							mysql_query($query4b);
							$wallet_ref_id2=mysql_insert_id();
							
							$qrss2="select * from parent_wallet_realtime order by wallet_id desc limit 0,1";
							$resss2=mysql_query($qrss2);
							$pre_bal20=0;
							$pre_bal24=0;
							while($rsss2 = mysql_fetch_assoc($resss2))
							{
								$pre_bal20=$rsss2['amount_bal'];
								$pre_bal24=$rsss2['real_bal'];
							}
							$bal3=$pre_bal20-$verification_charges3;
							$bal3_live=$pre_bal24-$verification_charges3;
							
							$filled_remarks3="Account Verification Order No. $client_ref_id by $user_id of 1001, $desc";
							$query4b="insert into parent_wallet_realtime value 
							(NULL,'$date_time','$time_time',1001,'$sender_id','$client_ref_id','0','2','$filled_remarks3',
							'$pre_bal20','0','$verification_charges3','$bal3','$pre_bal24','0','$verification_charges3','$bal3_live');";
							mysql_query($query4b);
							$wallet_ref_id3=mysql_insert_id();
							
							if($server_st!=-1)
							{
								$tid=0;
							
								$bankapi_user_id="100001";
								$bankapi_user_pass="9729877577";
								$bankapi_method="VERIFY_RECEIVER";
								$bankapi_ifsc=$_POST['bankifsccode'];
								$bankapi_acc=$_POST['bankaccno'];
								$receiver_bank_bankid=$benef_bankid;

								include_once('../_gyan-info-retail.php');
								$url = "$call_url" . "?";
								$url = $url . "bankapi_user_id=" . $bankapi_user_id;
								$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
								$url = $url . "&bankapi_method=" . $bankapi_method;
								$url = $url . "&receiver_bank_bankid=" . $receiver_bank_bankid;
								$url = $url . "&bankapi_ifsc=" . $bankapi_ifsc;
								$url = $url . "&bankapi_acc=" . $bankapi_acc;
								$post_values = "";
								$post_values = $post_values . "sender_number=" . $sender_number;

								
								
								
										
										
										   
								$curl = curl_init($url);
								curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
								curl_setopt($curl, CURLOPT_POST, 1);
								curl_setopt($curl, CURLOPT_POSTFIELDS, $post_values);
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
									/*
									{
										"message":"Success! Account details found",
										"response_type_id":61,
										"response_status_id":-1,
										"status":0,
										"data":
										{
											"account":"61046336411",
											"bank":"STATE BANK OF INDIA",
											"recipient_name":"Nirmal Maheshwari",
											"is_name_editable":"0",
											"tid":"12516566",
											"amount":1.00,
											"fee":3.00,
											"is_Ifsc_required":"0",
											"ifsc":"SBIN0000001",
											"aadhar":""
										}
									}
									///////////
									{
										"message":"Recipient already verified.",
										"response_type_id":345,
										"response_status_id":-1,
										"status":0,
										"data":
										{
											"is_Ifsc_required":"0",
											"is_name_editable":"1",
											"recipient_name":"unknown"
										}
									}
									/////////////////////
									{
										"message":"Failed! Invalid ifsc code",
										"response_type_id":-1,
										"response_status_id":1,
										"status":45,
										"invalid_params":
										{
											"ifsc":"Please provide valid IFSC code."
										}
									}
									*/
									
									$msg="";
									$result= json_decode($response, true);
									$message= $result['message'];
									$response_type_id= $result['response_type_id'];//345
									$response_status_id= $result['response_status_id'];//-1
									$status= $result['status'];//0
									
									
									
									if(($response_type_id==61 || $response_type_id==345) && $response_status_id==-1 && $state==0)
									{
										$verify++;
										$qry2s2="update main_transaction_mt set response='$response', response_type_id=$response_type_id, response_status_id=$response_status_id, response_status=$status, response_message='$message', bal_before='$pre_bal9',bal_after='$post_balance_remain', eko_transaction_status=2 where eko_transaction_id=$client_ref_id";
										mysql_query($qry2s2);
									}
									else
									{
										$qry2s2="update main_transaction_mt set response='$response', response_type_id=$response_type_id, response_status_id=$response_status_id, response_status=$status, response_message='$message', bal_before='$pre_bal9',bal_after='$post_balance_remain', eko_transaction_status=2 where eko_transaction_id=$client_ref_id";
										mysql_query($qry2s2);
										
									/*
										// get user id and transfer amount without charges of order id
										$qry3="select * from main_transaction_mt where eko_transaction_id=$client_ref_id";
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
										$deducted2=2;
										$deducted3=2;
										
										// get order deducted amount of user wallet with wallet id
										$query_ref="select * from child_wallet_remain where user_id='$uid' and user_id2='0' and request_id='$oid' and transaction_type='6'";
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
										$filled_remarks="Account Verification order $oid refunded";
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
										$filled_remarks2="Account Verification order $oid refunded";
										$query4b="insert into child_wallet_realtime value (NULL, '$date_time', '$time_time', '$uid', '$oid', '0', '3', '$filled_remarks2', '$pre_bal15', '$deducted2', '0', '$bal2');";
										$result24c+=mysql_query($query4b);
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
										$filled_remarks3="Account Verification order $oid refunded";
										$query4b="insert into parent_wallet_realtime value (NULL, '$date_time', '$time_time', 1001, '$uid', '$oid', '0', '3', '$filled_remarks3', '$pre_bal21', '$deducted3', '0', '$bal3', '$pre_bal25', '$deducted3', '0', '$bal3_live');";
										$result24c+=mysql_query($query4b);
										$refund_mid=mysql_insert_id();
							
										// order status updated not initiated to refunded
										$qry2="update main_transaction_mt set eko_transaction_status=5, refund_cid=$refund_cid, refund_aid=$refund_aid, refund_mid=$refund_mid, updated_on='$datetime_time' where eko_transaction_id=$oid";
										mysql_query($qry2);	
										*/
									}
								}
							}
						}
					}
					
					$rmno=$_POST['rmno'];
					$benef_rmno=$_POST['brmno'];
					$benef_rmname=mysql_real_escape_string($_POST['rmname']);	
					$benef_bankaccno=$_POST['bankaccno'];
					$benef_bankifsccode=$_POST['bankifsccode'];
					
					$bnks=$_POST['bankcode'];
					$bnks=explode("@",$bnks);
					$benef_bankid=$bnks[0];
					$benef_bankcode=$bnks[1];
					$benef_ifsc_status=$bnks[2];
					
					
					$recipient_name=$benef_rmname;
					$recipient_mobile=$benef_rmno;
					$cust_id=$rmno;
					
					$bankapi_user_id="100001";
					$bankapi_user_pass="9729877577";
					$bankapi_method="SAVE_RECEIVER";
					$sender_number=$cust_id;
					$receiver_number=$recipient_mobile;
					$receiver_name=$recipient_name;
					$receiver_bank_bankid=$benef_bankid;//
					$receiver_bank_ifscstatus=$benef_ifsc_status;//
					$receiver_bank_bankcode=$benef_bankcode;//
					$receiver_bank_ifsccode=$benef_bankifsccode;//
					$receiver_bank_accno=$benef_bankaccno;

					include_once('../_gyan-info-retail.php');
					$url = "$call_url" . "?";
					$url = $url . "bankapi_user_id=" . $bankapi_user_id;
					$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
					$url = $url . "&bankapi_method=" . $bankapi_method;
					$url = $url . "&sender_number=" . $sender_number;
					$url = $url . "&receiver_number=" . $receiver_number;
					$url = $url . "&receiver_bank_bankid=" . $receiver_bank_bankid;
					$url = $url . "&receiver_bank_ifscstatus=" . $receiver_bank_ifscstatus;
					$url = $url . "&receiver_bank_bankcode=" . $receiver_bank_bankcode;
					$url = $url . "&receiver_bank_ifsccode=" . $receiver_bank_ifsccode;
					$url = $url . "&receiver_bank_accno=" . $receiver_bank_accno;
					$post_values = "";
					$post_values = $post_values . "receiver_name=" . $receiver_name;
								   
					$curl = curl_init($url);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($curl, CURLOPT_POST, 1);
					curl_setopt($curl, CURLOPT_POSTFIELDS, $post_values);
					$response = curl_exec($curl);
					
					
					
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
						$response_type_id="";
						$response_status_id="";
						$status="";
						if($message!="No key for Response")
						{
							$response_type_id=$result['response_type_id'];
							$response_status_id=$result['response_status_id'];
							$status=$result['status'];
						}	
						if($response_type_id==342 && $response_status_id==-1 && $status==0)
						{
							$msg="<b style='color:green;'>Beneficiary Added</b>";
							echo "<script>document.location.href='money-transfer-3-benefs.php?rmno=$rmno'</script>";
						}
						else if($response_type_id==43 && $status==0)
						{
							$recipient_id_type=$result['data']['recipient_id_type'];
							$recipient_id=$result['data']['recipient_id'];
							$is_self_account=$result['data']['is_self_account'];
							$qry="insert into eko_receiver
							(user_id, sender_number, receiver_number, receiver_id_type, 
							receiver_acc_no, receiver_name, response, response_type_id, 
							response_status_id, response_status, response_message, is_self_account, 
							receiver_id, is_verified, bank, ifsc, 
							updated_on, eko_receiver_status) values
							($user_id, $cust_id, $recipient_mobile, '$recipient_id_type', 
							'$benef_bankaccno', '$recipient_name', '$response', '$response_type_id', 
							'$response_status_id', '$status', '$message', '$is_self_account', 
							'$recipient_id', $verify, '$benef_bankcode', '$benef_bankifsccode', 
							'$datetime_time', 2);";
							mysql_query($qry);
							
							$qry_main_bank="select bank_name from eko_bank where bank_code='$benef_bankcode';";
							$res_main_bank=mysql_query($qry_main_bank);
							while($rs_main_bank=mysql_fetch_array($res_main_bank))
							{
								$benef_bankcode=$rs_main_bank['bank_name'];
							}
							
							$qry_main_trans="update main_transaction_mt set rname='$recipient_name', rbname='$benef_bankcode', racc='$benef_bankaccno', rifsc='$benef_bankifsccode', receiver_id='$recipient_id' where group_id='$group_id';";
							mysql_query($qry_main_trans);
							
							$qry_main_transg="update main_transaction_mt_bulk set rname='$recipient_name', rbname='$benef_bankcode', racc='$benef_bankaccno', rifsc='$benef_bankifsccode', receiver_id='$recipient_id' where bulk_id='$group_id';";
							mysql_query($qry_main_transg);
							
							$msg="<b style='color:green;'>Beneficiary Added</b>";
							echo "<script>document.location.href='money-transfer-3-benefs.php?rmno=$rmno'</script>";
						}
						else
						{
							$msg="<b style='color:red;'>".$message."</b>";
						}
					}
				}
				include_once '../functions/_update_wallet.php';
				update_wallet($user_id);					
				
				?>

					
		 <div class="row content-container elements">

				<div class="col s12 m12 l6" id="addBeneficiary" >
					<div class="card project-stats">
						<div class="card-content">
							<h5 style="float:left;"><i class="fa fa-money fa-1x"></i> Add Beneficiary </h5>
							<a href="" id="sifsc" class="btn orange" style="float:right;display:none;" onclick='searchIFSC()'>Search IFSC</a>
							<br><br>
						</div>
						<div class="card-action min-height">
							<div class="row extra-elements">
										<?php echo $msg;?>
										<br><br>
								<form method="post" id="frmVerifyss">
									<div class="input-field col l8 m12 s12 offset-l2">
										<input type="hidden" value="<?php echo $rmno;?>" name="rmno" />
										<input id="recMob" autocomplete="off" name="brmno" value="<?php echo $benef_rmno;?>" required type="text" class="validate numericOnlyText" maxlength="10">
										<label for="recMob" class="">Beneficiary Mobile No.</label>
									</div>

									<div class="input-field col l8 m12 s12 offset-l2">
										<input id="recName" autocomplete="off" name="rmname" value="<?php echo $benef_rmname;?>" required type="text" class="validate">
										<label for="recName" class="">Beneficiary Name</label>
									</div>

									<div class="input-field col l8 m12 s12 offset-l2">
										<select class="chosen" name="bankcode" onchange="pullIFSC()" required id="bankCode">
											<option value="">Select Bank</option>
											<option value="108@SBIN@1">STATE BANK OF INDIA</option>
											<?php
											$query_bnk="SELECT * FROM eko_bank where ifsc_status!=-1";
											$result_bnk=mysql_query($query_bnk);
											while($rs_bnk = mysql_fetch_assoc($result_bnk))
											{		
												if($rs_bnk['eko_bank_id']==108)
													continue;
												$bnk=$rs_bnk['eko_bank_id']."@".$rs_bnk['bank_code']."@".$rs_bnk['ifsc_status'];
												$bnk_name=$rs_bnk['bank_name'];
											?>
											<option value="<?php echo $bnk;?>"><?php echo $bnk_name;?></option>
											<?php
											}												
											?>
										</select>
									</div>

									<div class="input-field col l8 m12 s12 offset-l2" style="margin-top: 28px;">
										<input id="account" autocomplete="off" name="bankaccno" value="<?php echo $benef_bankaccno;?>" required type="text" class="validate">
										<label for="account" class="" id="benefAccNum">Beneficiary Account Number</label>
									</div>

									<div class="input-field col l8 m12 s12 offset-l2" id="IFSCCoder" style="margin-top: 28px;display:none;">
										<input id="ifscCode" autocomplete="off" name="bankifsccode" value="<?php echo $benef_bankifsccode;?>" required type="text" class="validate">
										<label for="ifscCode" class="">IFSC Code</label>
									</div>

									<div class="input-field col l8 m6 s12 offset-l2 btn-div buttons-s">
										<input id="add_btn" onclick='valid_benef()' name="submit1" type="submit" style="width:100%;" class="btn blue" value="Add without Verify">
									</div>

									<div id="verifyaccountbtn" class="input-field col l8 m6 s12 offset-l2 btn-div buttons-s">
										
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
