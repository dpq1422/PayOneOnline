<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<script>window.location.href='home.php';</script>
		<?php include('_head-tag.php'); ?>
		<script language="javascript" type="text/javascript">
		/*
		document.onkeydown = function()
		{
			switch (event.keyCode)
			{
				case 8 : //backspace
					event.returnValue = false;
					event.keyCode = 0;
					return false;
				case 116 : //F5
					event.returnValue = false;
					event.keyCode = 0;
					return false;
				case 123 : //CTRL+R
					event.returnValue = false;
					event.keyCode = 0;
					return false;
				case 154 : //CTRL+F5
					event.returnValue = false;
					event.keyCode = 0;
					return false;
				case 82 : //R button
					if (event.ctrlKey)
					{ 
						event.returnValue = false;
						event.keyCode = 0;
						return false;
					}
			}
			location.href='transactions.php';
		}
		*/
		</script>
		<script language="javascript" type="text/javascript">
			var submitbtn=0;
			function display_rate(uid,sid,mid,amount)
			{
				//make the AJAX request, dataType is set to json
				//meaning we are expecting JSON data in response from the server
				$.ajax({
					type: "POST",
					url: "_ajax-rate-of-uid.php",
					data: {'uid': uid, 'sid': sid, 'mid': mid, 'amount': amount },
					dataType: "json",
				 
					//if received a response from the server
					success: function( data, textStatus, jqXHR) {
						//our country code was correct so we have some information to display/
						document.getElementById("surcharges").value=data;
						//document.getElementById("taken").value=data;
					}	 
				});
			}
			function sbmtbtn()
			{
				submitbtn++;
				if(submitbtn==1)
				document.getElementById("frmTransfer").submit();
				
				document.getElementById("transfer_btn").setAttribute("disabled","disabled");
			}
			function hide_trans()
			{
				document.getElementById("transfer_btn").style.display = 'none';
				document.getElementById("transfer_btn").setAttribute("disabled","disabled");
			}
			function show_trans()
			{
				document.getElementById("transfer_btn").style.display = 'block';
				document.getElementById("transfer_btn").removeAttribute("disabled");
			}
			function change_method()
			{
				hide_trans();
				var channel=document.getElementById("channel").value;
				var amount=document.getElementById("amount").value;
				var uid=<?php echo $_SESSION['user_id'];?>;
				var sid=1;
				var mid=0;
				if(channel=="NEFT")
				mid=1;
				else if(channel=="IMPS")
				mid=2;
				display_rate(uid,sid,mid,amount);
			}
			//<input id="amount" onblur="checkLimit()" onclick="hide_trans()" onkeyup="calc_ded()" />
			function calc_ded()
			{
				change_method();
				var channel=document.getElementById("channel").value;
				if(channel=="0")
				{
					alert("Please select Payment Method NEFT/IMPS");
					hide_trans();
				}
				else if(channel!="0")
				{
					var amount=document.getElementById("amount").value;
					var charges=c00;
					var taken=charges;
					var deducted=parseFloat(amount)+parseFloat(taken);
					document.getElementById("surcharges").value=charges;
					document.getElementById("taken").value=taken;
					document.getElementById("deducted").value=deducted;
					checkLimit();
					hide_trans();
				}
			}
			function calc_ded2()
			{
				change_method();
				var channel=document.getElementById("channel").value;
				if(channel=="0")
				{
					alert("Please select Payment Method NEFT/IMPS");
					hide_trans();
				}
				else if(channel!="0")
				{
					var amount=document.getElementById("amount").value;
					var charges=document.getElementById("surcharges").value;
					var taken=document.getElementById("taken").value;
					var lim1=charges;
					var lim2=amount*0.02;
					if(parseFloat(taken)<=parseFloat(charges))
					{
						taken=lim1;
					}
					if(parseFloat(taken)>=parseFloat(lim2))
					{
						taken=lim2;
					}
					if(parseFloat(taken)<parseFloat(charges))
					{
						taken=charges;
					}
					var deducted=parseFloat(amount)+parseFloat(taken);
					document.getElementById("surcharges").value=charges;
					document.getElementById("taken").value=taken;
					document.getElementById("deducted").value=deducted;
					process();
				}
			}
			function checkLimit()
			{
				var err_err="";
				var amount=document.getElementById("amount").value;
				var channel=document.getElementById("channel").value;
				var ilimit=document.getElementById("ilimit").value;
				var nlimit=document.getElementById("nlimit").value;
				ilimit=parseInt(ilimit);
				nlimit=parseInt(nlimit);
				if(channel=="IMPS" && (amount<100 || amount>ilimit))
				{
					err_err="Please fill amount between 100 and "+ilimit;
				}
				if(channel=="NEFT" && (amount<100 || amount>nlimit))
				{
					err_err="Please fill amount between 100 and "+nlimit;
				}
				if(err_err=="")
				{
					//show_trans();
					document.getElementById("msgr").innerHTML="&nbsp;";
					return true;
				}
				else
				{
					hide_trans();
					document.getElementById("msgr").innerHTML=err_err;
					return false;
				}
			}
			function process()
			{
				var channel=document.getElementById("channel").value;
				if(channel=="0")
				{
					alert("Please select Payment Method NEFT/IMPS");
					hide_trans();
				}
				else if(channel!="0")
				{
					var taken=document.getElementById("taken").value;
					var surcharges=document.getElementById("surcharges").value;
					var tax=parseFloat((taken-surcharges)*.18);
					var comms=parseFloat(taken-surcharges-tax);
					<?php
					/*
					var comms=parseFloat((taken-surcharges)/1.18);
					var tax=taken-surcharges-comms;
					*/
					?>				
					document.getElementById("t1").innerHTML=channel;
					document.getElementById("t2").innerHTML=document.getElementById("amount").value;
					document.getElementById("t3").innerHTML=taken;
					document.getElementById("t4").innerHTML=surcharges;
					document.getElementById("t5").innerHTML=freeze_2place(tax);
					document.getElementById("t6").innerHTML=freeze_2place(comms);
					document.getElementById("gst_charged").value=freeze_2place(tax);
					document.getElementById("com_earned").value=freeze_2place(comms);
					show_trans();
					checkLimit();
				}
			}
			function freeze_2place(val_old)
			{
				var val_new=val_old.toFixed(2);
				return val_new;
			}
			function myunl()
			{
				location.href='transactions.php';
			}
		</script>
</head>
<body class="cyan-scheme" onunload="myunl()">
<div id="form1">

    <!--Page load animation-->
 
    <div class="wrapper vertical-sidebar" id="full-page">
        <?php include('_nav-menu.php'); ?>

        <main id="content">
            <div id="page-content">
			
			<?php
			$mentor_rate=9;
			$payone_rate=9;
			$retailer_rate=10;
			$msg="";
			$msg1="";
			$msg2="";
			
			$bankapi_user_id="100001";
			$bankapi_user_pass="9729877577";
			$bankapi_method="SHOW_SENDER";
			$sender_number=$_REQUEST['srm'];

			include_once('../_gyan-info-retail.php');
			include_once('../functions/_user-channel-service-rate.php');

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
				}
			}
			if($status==0 && $response_type_id==33)
			{	
				$rlimit="Remain Limit :: IMPS <i class='fa fa-inr'></i><span id='remitLimit'>".$result['data']['limit'][4]['remaining']."</span>";
				$rlimit="$rlimit , NEFT <i class='fa fa-inr'></i><span id='remitLimit'>".$result['data']['limit'][3]['remaining']."</span>";
				$vals_limit="<input type='hidden' id='ilimit' value='".$result['data']['limit'][4]['remaining']."'/>";
				$vals_limit.="<input type='hidden' id='nlimit' value='".$result['data']['limit'][3]['remaining']."'/>";
			}
			
			if(isset($_POST['submit']))
			{
				$prebal_group=1;
				$customer_id=$_POST['sender'];
				$receiver_id1=$_POST['receiver'];
				$recipient_id=$_POST['recid'];
				$full_amount=$_POST['amount'];
				$full_charges=$_POST['surcharges'];//auto by user imposed
				$full_taken=$_POST['taken'];//modified by user for income
				if($full_charges>$full_taken)//hided the taken field and copied value as same the surcharges field
					$full_taken=$full_charges;
				
				$channel=$_POST['channel'];
				$mid=0;
				if($channel=="NEFT" || $channel==1)
				$mid=1;
				else if($channel=="IMPS" || $channel==2)
				$mid=2;
				$server_bal=0;
				$bulk_amount=$full_amount;
				$bulk_charges=$full_taken;
				$bulk_total=$bulk_amount+$bulk_charges;
				
				if($full_charges>$full_taken)
				$server_bal=$full_amount+$full_charges;
				else
				$server_bal=$full_amount+$full_taken;
				
				$user_cur_bal=wallet_balance($user_id);
				$server_cur_bal=admin_wallet_balance();
				$server_cur_bal=$server_cur_bal-1000000;
				
				if($user_cur_bal<$server_bal)
				$msg1="<b style='color:red;'>Your Balance is low for transation.</b>";
				
				$server_st=1;
				if($server_cur_bal<$server_bal)
				$server_st=-1;
				
				if($msg1=="" && $msg2=="")
				{
					$full_gst=$_POST['gst_charged'];
					$full_earned=$_POST['com_earned'];
					$full_deducted=$_POST['deducted'];
					$ramount=$full_amount;
					
					$group_id=0;	
					$source=1;				
				//if($full_amount>5000)
				//{
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
					
					$res_sender_name="";
					$qry_sender="select sender_name from eko_sender where sender_number='$sender_number'";
					$res_sender=mysql_query($qry_sender);
					while($rs_sender=mysql_fetch_array($res_sender))
					{
						$res_sender_name=$rs_sender['sender_name'];
					}
					
					$res_receiver_name="";
					$res_receiver_bank="";
					$res_receiver_accno="";
					$res_receiver_ifsc="";
					$qry_receiver="select * from eko_receiver where receiver_id='$recipient_id'";
					$res_receiver=mysql_query($qry_receiver);
					while($rs_receiver=mysql_fetch_array($res_receiver))
					{
						$res_receiver_name=$rs_receiver['receiver_name'];
						$res_receiver_bank=$rs_receiver['bank'];
						$res_receiver_accno=$rs_receiver['receiver_acc_no'];
						$res_receiver_ifsc=$rs_receiver['ifsc'];
					}
					
					$chk_tdt="$date_time";
					$chk_rtr="$user_id";
					$chk_rcv="$recipient_id";
					$chk_amt="$full_amount";
					$chk_src="$source";
					$chk_mth="$mid";
					$chk_record=0;
					
					$chk_qry="SELECT count(*) as nums FROM `main_transaction_mt_bulk` where date(date_time)='$chk_tdt' and retailer_id='$chk_rtr' and receiver_id='$recipient_id' and amount='$full_amount' and source='$source' and method='$mid'";
					$chk_res=mysql_query($chk_qry);
					while($chk_rs=mysql_fetch_array($chk_res))
					{
						$chk_record=$chk_rs['nums'];
					}
					if($chk_record==0)
					{
					
						$qry="insert into main_transaction_mt_bulk(date_time, retailer_id, receiver_id, sname, rname, rbname, racc, rifsc, amount, source, method) value ('$datetime_time', '$user_id', '$recipient_id', '$res_sender_name', '$res_receiver_name', '$res_receiver_bank', '$res_receiver_accno', '$res_receiver_ifsc', '$full_amount', '$source', '$mid');";
						mysql_query($qry);				
						$group_id=mysql_insert_id();
						if($group_id%1000==0)
						{
							include_once('../functions/_zsms.php');
							zsms("8146145674","Bulk Order No $group_id started on dated $datetime_time");
						}
					//}
						
						$limit=5000;	
						do
						{
							if($ramount>$limit)
							{
								$amount=$limit;
							}
							else
							{
								$amount=$ramount;
							}
							$ramount=$ramount-$amount;
							$deducted=0;
							
							$amount2=0;
							$amount3=0;
							$charges=0;
							
							$new_charges=user_channel_service_rate($user_id,$source,$mid,$amount);
							
							$charges=$new_charges;//$full_charges*$amount/$full_amount;
							if($full_charges!=$full_taken)
							{
								$com_charged=$full_taken*$amount/$full_amount;
								$gst_charged=$full_gst*$amount/$full_amount;
								$com_earned=$full_earned*$amount/$full_amount;
								$deducted=$amount+$com_charged;
							}
							else
							{
								$com_charged=$charges;
								$gst_charged=0;
								$com_earned=0;
								$deducted=$amount+$com_charged;
							}
							
							$deducted2=$amount+6;//-($retailer_rate-$payone_rate);
							$deducted3=$amount+5.90;//-($retailer_rate-$mentor_rate);
							
							// starting new code for storing details of retailer dist sd admin //
							$retailer_id_new=$user_id;
							$retailer_charges_new=0;
							
							$admin_id_new=100000;
							$admin_charges_new=6;
							
							$sadmin_id_new=1;
							$sadmin_charges_new=5.90;
							
							$dist_id_new=0;
							$dist_charges_new=0;
							
							$sd_id_new=0;
							$sd_charges_new=0;
							
							$qry6="SELECT * FROM child_user where user_id=$retailer_id_new;";
							$res6=mysql_query($qry6);
							while($rs6=mysql_fetch_assoc($res6))
							{
								$admin_id_new=$rs6['hierarchy_1_id'];
								$sd_id_new=$rs6['hierarchy_2_id'];
								$dist_id_new=$rs6['hierarchy_3_id'];
							}
							
							$retailer_charges_new=user_channel_service_rate($retailer_id_new,$source,$mid,$amount);
							$admin_charges_new=user_channel_service_rate($admin_id_new,$source,$mid,$amount);
							if($dist_id_new!=0)
							$dist_charges_new=user_channel_service_rate($dist_id_new,$source,$mid,$amount);
							if($sd_id_new!=0)
							$sd_charges_new=user_channel_service_rate($sd_id_new,$source,$mid,$amount);
							// ending new code for storing details of retailer dist sd admin //
							
							$qry="insert into main_transaction_mt(user_id, sender_number, receiver_number, receiver_id, amount, charges, com_charged, gst_charged, com_earned, deducted, created_on, updated_on, eko_transaction_status, tid, group_id, ip, source, retailer_id, retailer_charges, dist_id, dist_charges, sd_id, sd_charges, admin_id, admin_charges, sadmin_id, sadmin_charges, channel, channel_desc, sname, rname, rbname, racc, rifsc, status_response) 
							value($user_id, $customer_id, $receiver_id1, $recipient_id, $amount, $charges, $com_charged, $gst_charged, $com_earned, $deducted, '$datetime_time', '$datetime_time', $server_st, '', '$group_id', '$main_ip', '$source', '$retailer_id_new', '$retailer_charges_new', '$dist_id_new', '$dist_charges_new', '$sd_id_new', '$sd_charges_new', '$admin_id_new', '$admin_charges_new', '$sadmin_id_new', '$sadmin_charges_new', '$mid', '$channel', '$res_sender_name', '$res_receiver_name', '$res_receiver_bank', '$res_receiver_accno', '$res_receiver_ifsc','' );";
							mysql_query($qry);				
							$client_ref_id=mysql_insert_id();
							if($client_ref_id%1000==0)
							{
								include_once('../functions/_zsms.php');
								zsms("8146145674","Order No $client_ref_id started on dated $datetime_time");
							}
							
							$bankapi_user_id="100001";
							$bankapi_user_pass="9729877577";
							$bankapi_method="FUND_TRANSFER_INITIATE";
							$sender_number=$customer_id;
							$receiver_id=$recipient_id;
							$order_number=$client_ref_id;
							$transfer_method=$channel;
							//echo str_replace('+00:00', 'Z', gmdate('c', strtotime('2013-05-07 18:56:57')))
							$timestamp=str_replace('+00:00', 'Z', gmdate('c', strtotime($date_time." ".$time_time)));
							
							
							/* API CALL 1 */
							
							include_once('../_gyan-info-retail.php');
							$url = "$call_url" . "?";
							$url = $url . "bankapi_user_id=" . $bankapi_user_id;
							$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
							$url = $url . "&bankapi_method=" . $bankapi_method;
							$url = $url . "&sender_number=" . $sender_number;
							$url = $url . "&receiver_id=" . $receiver_id;
							$url = $url . "&amount=" . $amount;
							$url = $url . "&order_number=" . $order_number;
							$url = $url . "&timestamp=" . $timestamp;
							$url = $url . "&transfer_method=" . $transfer_method;	

							/* API RESULT 1 */
							
							/**********************************************************/												
							//include('../_common-retail.php');
							//include('../_session-retail.php');
							include_once '../functions/_wallet_balance.php';

							//$request_id=$_POST['reqid'];
							//$userid=$_POST['uid'];
							$filled_amount=$deducted;
							$sender_id=$user_id;

							$result24=0;
							$result24c=0;
							$amt_ads=wallet_balance($sender_id);
							$prev_bal=$amt_ads;
							$post_bal=$amt_ads;
							if($filled_amount<=$amt_ads)
							{
								$txntype=$channel;
								if($txntype==1)
									$txntype="NEFT";
								else if($txntype==2)
									$txntype="IMPS";
								$desc = "<br>Txn Type : $txntype, <br>Sender : $sender_number $res_sender_name, <br>Receiver : $receiver_id1 $res_receiver_name, <br>Bank : $res_receiver_bank, <br>Acc.No. : $res_receiver_accno, <br>Amount : $amount, <br>Charges : $com_charged";
								$bal1=$filled_amount;
								$pre_bal9=wallet_balance($sender_id);
								$bal1=$pre_bal9-$bal1;
								/*
								if($bal1==$filled_amount)
								{
									$bal1=$bal*(-1);
								}
								*/

								$filled_remarks="Money Transfer Order No. $client_ref_id, $desc ";
								$query4b="insert into child_wallet_remain value 
								(NULL,'$date_time','$time_time','$sender_id','0','$client_ref_id','6','$filled_remarks',
								'$pre_bal9', '0','$filled_amount','$bal1');";
								$result24c+=mysql_query($query4b);
								$wallet_ref_id=mysql_insert_id();
								
								if($prebal_group==1)
								{
									$post_balance_remain=$pre_bal9-$full_amount-$full_taken;
									$qry111="update main_transaction_mt_bulk set pre_bal='$pre_bal9',post_bal='$post_balance_remain',sender='$customer_id',receiver='$receiver_id1' where bulk_id='$group_id';";
									mysql_query($qry111);
								}
								$prebal_group++;
								if($ramount<=0)
								{
									$qry="update main_transaction_mt_bulk set amount='$bulk_amount',com_charged='$bulk_charges',deducted='$bulk_total',gst_charged='$full_gst',com_earned='$full_earned',charges='$full_charges' where bulk_id='$group_id';";
									mysql_query($qry);
									$prebal_group++;
								}
								
								$qrss="select * from child_wallet_realtime order by wallet_id desc limit 0,1";
								$resss=mysql_query($qrss);
								$pre_bal14=0;
								while($rsss = mysql_fetch_assoc($resss))
								{
									$pre_bal14=$rsss['amount_bal'];
								}
								$bal2=$pre_bal14-$deducted2;
								
								$filled_remarks2="Money Transfer Order No. $client_ref_id by $user_id, $desc";
								$query4b="insert into child_wallet_realtime value 
								(NULL,'$date_time','$time_time','$sender_id','$client_ref_id','0','2','$filled_remarks2',
								'$pre_bal14', '0','$deducted2','$bal2');";
								$result24c+=mysql_query($query4b);
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
								$bal3=$pre_bal20-$deducted3;
								$bal3_live=$pre_bal24-$deducted3;
								
								$filled_remarks3="Money Transfer Order No. $client_ref_id by $user_id of 1001, $desc";
								$query4b="insert into parent_wallet_realtime value 
								(NULL,'$date_time','$time_time',1001,'$sender_id','$client_ref_id','0','2','$filled_remarks3',
								'$pre_bal20','0','$deducted3','$bal3','$pre_bal24','0','$deducted3','$bal3_live');";
								$result24c+=mysql_query($query4b);
								$wallet_ref_id3=mysql_insert_id();
								
								/* API CALL 2 */
								if($server_st!=-1)
								{
								
									$tid=0;
									$response=NULL;
									$curl = curl_init($url);
									curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
									$response = curl_exec($curl);

									/* API RESULT 2 */
									
									$err = curl_error($curl);
									curl_close($curl);
									if ($err) {
									  $msg="<br>cURL Error : " . $err;
									}
									else
									{
										//echo $response;
										$result="";
										//do
										//{
										//}
										//while(!isset($response));
										if(empty($response) || $response==NULL)
										{
											$result= json_decode($response, true);
											$message= $result['message'];
											$message=str_replace("Last_used_OkeyKey: 235","",$message);
											$msg=$msg."<br>".$message;
											$response_type_id= $result['response_type_id'];
											$response_status_id= $result['response_status_id'];
											$status= $result['status'];
											$qry2="update main_transaction_mt set response='$response', response_type_id=$response_type_id, response_status_id=$response_status_id, response_status=$status, response_message='$message' where eko_transaction_id=$client_ref_id";
											mysql_query($qry2);
											$txstatus_desc=0;
											if($response_type_id==325 && $response_status_id==0 && $status==0)
											{
												$tid=$result['data']['tid'];
												$service_tax=$result['data']['service_tax'];
												$fee=$result['data']['fee'];
												$collectable_amount=$result['data']['collectable_amount'];
												$balance=$result['data']['balance'];
												$bank_ref_num=$result['data']['bank_ref_num'];
												$account=$result['data']['account'];
												$channel=$result['data']['channel'];
												$channel_desc=$result['data']['channel_desc'];
												$txstatus_desc=$result['data']['txstatus_desc'];
												if($txstatus_desc=="Initiated")
												$txstatus_desc=1;
												else if($txstatus_desc=="Success")
												$txstatus_desc=2;
												else
												$txstatus_desc=3;
												
												$post_bal=$prev_bal-$deducted;
												
												$qry2="update main_transaction_mt set tid='$tid', service_tax='$service_tax', fee='$fee', collectable_amount='$collectable_amount', bal_before='$prev_bal', bal_after='$post_bal',  balance='$balance', bank_ref_no='$bank_ref_num', account='$account', channel='$channel', 
												channel_desc='$channel_desc', eko_transaction_status=$txstatus_desc where eko_transaction_id=$client_ref_id";
												mysql_query($qry2);
												
												$msg=$msg."<br><b style='color:green;'>TxnNo.: $tid</b>";
												$filled_remarks="<br>, TxnNo.: $tid";

												$qry2="update child_wallet_remain set transaction_description=concat(transaction_description,'$filled_remarks') where wallet_id=$wallet_ref_id";
												mysql_query($qry2);
												
												$qry2="update child_wallet_realtime set source_order_id='$tid', transaction_description=concat(transaction_description,'$filled_remarks') where wallet_id=$wallet_ref_id2";
												mysql_query($qry2);
												
												$qry2="update parent_wallet_realtime set source_order_id='$tid', transaction_description=concat(transaction_description,'$filled_remarks'), real_dr='$collectable_amount', real_bal='$balance' where wallet_id=$wallet_ref_id3";
												mysql_query($qry2);		
												
												include_once '../functions/_update_wallet.php';
												update_wallet($user_id);
												update_wallet(100001);
											}
											/*
											else
											{
												$msg=$msg."<br><b style='color:red;'>".str_replace("Last_used_OkeyKey: 233","",$message)."</b>";
												$qry2="update main_transaction_mt set bal_before='$prev_bal', bal_after='$prev_bal', response='$response', response_type_id=$response_type_id, response_status_id=$response_status_id, response_status=$status, response_message='$message', eko_transaction_status=$txstatus_desc where eko_transaction_id=$client_ref_id";
												mysql_query($qry2);
												$filled_remarks="<br>".str_replace("Last_used_OkeyKey: 233","",$message);
												
												$pre_bal10=wallet_balance($sender_id);
												$bal1=$pre_bal10+$filled_amount;

												$filled_remarks="Money Transfer order $client_ref_id refunded";
												$query4b="insert into child_wallet_remain value 
												(NULL,'$date_time','$time_time','$sender_id','0','$client_ref_id','7','$filled_remarks', '$pre_bal10', '$filled_amount','0','$bal1');";
												$result24c+=mysql_query($query4b);
												$wallet_ref_id=mysql_insert_id();
												update_wallet($user_id);
												
												$qrss="select * from child_wallet_realtime order by wallet_id desc limit 0,1";
												$resss=mysql_query($qrss);
												$pre_bal15=0;
												while($rsss = mysql_fetch_assoc($resss))
												{
													$pre_bal15=$rsss['amount_bal'];
												}
												$bal2=$pre_bal15+$deducted2;
												
												$filled_remarks2="Money Transfer order $client_ref_id refunded";
												$query4b="insert into child_wallet_realtime value 
												(NULL,'$date_time','$time_time','$sender_id','$client_ref_id','0','3','$filled_remarks2','$pre_bal15','$deducted2','0','$bal2');";
												$result24c+=mysql_query($query4b);
												$wallet_ref_id2=mysql_insert_id();
												
												$qrss2="select * from parent_wallet_realtime order by wallet_id desc limit 0,1";
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
												
												$filled_remarks3="Money Transfer order $client_ref_id refunded";
												$query4b="insert into parent_wallet_realtime value 
												(NULL,'$date_time','$time_time',1001,'$sender_id','$client_ref_id','0','3','$filled_remarks3',
												'$pre_bal21','$deducted3','0','$bal3','$pre_bal25','$deducted3','0','$bal3_live');";
												$result24c+=mysql_query($query4b);
												$wallet_ref_id3=mysql_insert_id();
											}
											*/
											/*NEFT
											{
											  "message": "Transaction successful Last_used_OkeyKey: 233",
											  "response_type_id": 325,
											  "response_status_id": 0,
											  "status": 0,
											  "data": {
												"pinNo": "",
												"state": "1",
												"recipient_id": 10013645,
												"is_otp_required": "0",
												"service_tax": "0.00",
												"aadhar": "",
												"currency": "INR",
												"amount": "1000.00",
												"timestamp": "2017-07-25T01:34:01.241Z",
												"npr": "",
												"balance": "4315269.39",
												"payment_mode_desc": "",
												"ekyc_enabled": "0",
												"tid": "12725329",
												"commission": "",
												"last_used_okekey": "233",
												"tds": "",
												"tx_status": "2",
												"paymentid": "",
												"collectable_amount": "1000.0",
												"totalfee": "",
												"bank_ref_num": "",
												"fee": "0.0",
												"mdr": "",
												"debit_user_id": "9910028267",
												"txstatus_desc": "Initiated",
												"account": "30083122712",
												"channel": "1",
												"customer_id": "9729877577",
												"channel_desc": "NEFT"
											  }
											}
											*/
											/*IMPS
											{
											  "message": "Transaction successful Last_used_OkeyKey: 233",
											  "response_type_id": 325,
											  "response_status_id": 0,
											  "status": 0,
											  "data": {
												"pinNo": "",
												"state": "1",
												"recipient_id": 10013645,
												"is_otp_required": "0",
												"service_tax": "0.78",
												"aadhar": "",
												"currency": "INR",
												"amount": "1000.00",
												"timestamp": "2017-07-25T01:34:35.160Z",
												"npr": "",
												"balance": "4314263.39",
												"payment_mode_desc": "",
												"ekyc_enabled": "0",
												"tid": "12725330",
												"commission": "",
												"last_used_okekey": "233",
												"tds": "",
												"tx_status": "0",
												"paymentid": "",
												"collectable_amount": "1006.0",
												"totalfee": "",
												"bank_ref_num": "87669973",
												"fee": "6.0",
												"mdr": "",
												"debit_user_id": "9910028267",
												"txstatus_desc": "Success",
												"account": "30083122712",
												"channel": "2",
												"customer_id": "9729877577",
												"channel_desc": "IMPS"
											  }
											}
											*/
										}
										$msg=$message="<br><b style='color:green;'>Transaction is in progress</b>";
									}
								}
							}
							else
							{
								$filled_remarks="Order $client_ref_id Cannot be processed due to low balance in wallet.";
								$qry2="update main_transaction_mt set bal_before='$prev_bal', bal_after='$prev_bal', eko_transaction_status=0, response_message='$filled_remarks' where eko_transaction_id=$client_ref_id";
								mysql_query($qry2);
								$msg=$msg."<br><b style='color:red;'>$filled_remarks</b>";
							}
							/**********************************************************/

							//sleep(3);
							include_once '../functions/_update_wallet.php';
							update_wallet($user_id);					
						}
						while($ramount>0);
						include_once '../functions/_update_wallet.php';
						update_wallet($user_id);
						echo "<script>document.location.href='transaction.php?gid=$group_id'</script>";
					}
					else
					{
						$msg2="<b style='color:red;'>Repeated Transaction</b><br>You have already performed same transaction with same amount to this receipient today. if you still want to continue, kindly change transaction amount.";
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
			?>

                
     <div class="row content-container elements">
			<form method="post" id="frmTransfer" onsubmit="return checkLimit()">
            <div class="col s12 m12 l6" id="addBeneficiary"  style="float:left!important;">
                <div class="card project-stats">
                    <div class="card-content">
                        <h5><i class="fa fa-money fa-1x"></i> Transfer Money </h5>
                    </div>
                    <div class="card-action min-height">
                        <div class="row extra-elements">
									<p style='text-align:center!important;'><?php echo $rlimit;?></p>
									<?php if($msg!="")echo $msg."<br><br>"; echo $vals_limit;?>
									<p style='text-align:center!important;color:red;' id="msgr">&nbsp;</p>
							
								<div class="input-field col l8 m12 s12 offset-l2">
									<input id="recid" name="recid" required readonly value="<?php echo $_REQUEST['rid'];?>" type="hidden" class="validate" maxlength="10">
									<input id="sender" name="sender" required readonly value="<?php echo $_REQUEST['srm'];?>" type="hidden" class="validate" maxlength="10">
									<!--<label for="sender" class="">Remitter Mobile No.</label>-->
									<input id="receiver" name="receiver" required readonly value="<?php echo $_REQUEST['rrm'];?>" type="hidden" class="validate" maxlength="10">
									<!--<label for="receiver" class="">Beneficiary Mobile No.</label>-->
									
									<?php
									$qry_bnk="select bank from eko_receiver where receiver_id='".$_REQUEST['rid']."';";
									$res_bnk=mysql_query($qry_bnk);
									$val_bank="";
									while($rs_bnk=mysql_fetch_array($res_bnk))
									{
										$val_bank=$rs_bnk['bank'];
									}
									$qry_meth="SELECT * FROM eko_bank where name='$val_bank' or bank_name='$val_bank';";
									$res_meth=mysql_query($qry_meth);
									$val_meth=-1;
									while($rs_meth=mysql_fetch_array($res_meth))
									{
										$val_meth=$rs_meth['available_channels'];
									}
									?>
									
									<select class="chosen" name="channel" onchange="change_method()" required id="channel">
										<option value='0'></option>
										<?php
										if($val_meth==1)
										{
											echo "<option>NEFT</option>";
										}
										else if($val_meth==2)
										{
											echo "<option>IMPS</option>";
										}
										else
										{
											echo "<option>IMPS</option>";
											echo "<option>NEFT</option>";
										}
										?>
									</select>
								</div>

								<div class="input-field col l8 m12 s12 offset-l2" id="IFSCCoder" style="margin-top: 28px;">
									<input id="amount" onblur="checkLimit()" onclick="hide_trans()" autocomplete="off" name="amount" type="text" required onkeyup="calc_ded()" value="" class="validate">
									<label for="amount" class="">Amount</label>
								</div>

								<div class="input-field col l8 m12 s12 offset-l2" id="IFSCCoder" style="margin-top: 28px;">
									<input id="surcharges" name="surcharges" type="text" required readonly value="0" class="validate">
									<label for="surcharges" class="">Surcharge</label>
								</div>

								<div class="input-field col l8 m12 s12 offset-l2" id="IFSCCoder" style="margin-top: 28px;">
									<input id="taken" name="taken" type="text" onkeyup="hide_trans()" onclick="hide_trans()" required value="0" class="validate">
									<label for="taken" class="">Commission Charged</label>
								</div>

								<div class="input-field col l8 m12 s12 offset-l2" id="IFSCCoder" style="margin-top: 28px;">
									<input id="deducted" name="deducted" type="hidden" required readonly value="0" class="validate">
									<input id="gst_charged" name="gst_charged" type="hidden" required readonly value="0" class="validate">
									<input id="com_earned" name="com_earned" type="hidden" required readonly value="0" class="validate">
									<label for="deducted" class="">Deduction</label>
								</div>

								<div class="input-field col l8 m6 s12 offset-l2 btn-div buttons-s">
									<input type="button" name="button" onclick="calc_ded2()" style="width:100%;" class="btn btn-block btn-danger" value="Process">
								</div>
                        </div>
                    </div>
                </div>
			</div>
			<div class="col s12 m12 l6" id="addBeneficiary"  style="float:left!important;">
				<div class="card project-stats" style="float:left!important;">
                    <div class="card-content">
                        <h5><i class="fa fa-money fa-1x"></i> Confirmation Details</h5>
                    </div>
                    <div class="card-action min-height">
                        <div class="row extra-elements">
									<?php echo $msg;?>
									
									<?php
									$qry1="SELECT * FROM eko_sender WHERE sender_number = ".$_REQUEST['srm'];
									$result1=mysql_query($qry1);
									$sname="";
									$rname="";
									$rbank="";
									$raccount="";
									while($rs1 = mysql_fetch_assoc($result1))
									{
										$sname=$rs1['sender_name'];
									}
									
									$qry2="SELECT * FROM eko_receiver WHERE receiver_id = ".$_REQUEST['rid'];
									$result2=mysql_query($qry2);
									while($rs2 = mysql_fetch_assoc($result2))
									{
										$rname=$rs2['receiver_name'];
										$rbank=$rs2['bank'];
										$raccount=$rs2['receiver_acc_no'];
									}
									?>
									
									<table>
										<tr>
											<td><b>Remitter Mobile No.</b> </td>
											<td><?php echo $_REQUEST['srm'];?></td>
										</tr>
										<tr>
											<td width="200"><b>Remitter Name</b></td>
											<td width="200"><?php echo $sname;?></td>
										</tr>
										<!--<tr>
											<td><b>Beneficiary Mobile No.</b></td>
											<td><?php echo $_REQUEST['rrm'];?></td>
										</tr>-->
										<tr>
											<td><b>Beneficiary Name</b></td>
											<td><?php echo $rname;?></td>
										</tr>
										<tr>
											<td><b>Bank Name</b></td>
											<td><?php echo $rbank;?></td>
										</tr>
										<tr>
											<td><b>Account Number</b></td>
											<td><?php echo $raccount;?></td>
										</tr>
										<tr>
											<td><b>Transfer Mode</b></td>
											<td id="t1"></td>
										</tr>
										<tr>
											<td><b>Amount</b></td>
											<td id="t2"></td>
										</tr>
										<tr style="display:none;">
											<td><b>Commission Charged</b></td>
											<td id="t3"></td>
										</tr>
										<tr>
											<td><b>Transfer Charges</b></td>
											<td id="t4"></td>
										</tr>
										<tr>
											<td><b>Service Tax</b></td>
											<td id="t5"></td>
										</tr>
										<tr>
											<td><b>Commission Earned</b></td>
											<td id="t6"></td>
										</tr>
									</table>

								<div class="input-field col l8 m6 s12 offset-l2 btn-div buttons-s">
									<input type="submit" id="transfer_btn" style="display:none;" disabled name="submit" style="width:100%;" class="btn btn-block btn-danger" onclick='sbmtbtn()' value="Confirm & Transfer">
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
                  <h5>&nbsp;</h5>
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
