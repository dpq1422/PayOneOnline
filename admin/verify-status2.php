<html>
<head>
<title>Updating PayOne</title>
<link rel="shortcut icon" type="image/x-icon" href="../img/mentor.ico" />
<meta name="gwt:property" content="panel="/>
<script language="javascript" type="text/javascript">
    var timeleft = 5;
    var downloadTimer = setInterval(function(){
    timeleft--;
    document.getElementById("countdowntimer").textContent = timeleft;
    document.getElementById("progressBar").value = 5 - timeleft;
    if(timeleft <= 0)
        clearInterval(downloadTimer);
    },1000);
</script>
<style>
*{font-family: "Courier New", Courier, monospace;}
</style>
</head>
<body>
<table cellspacing="5" cellpadding="5">
<tr>
<td colspan="3" align="center">
<b style='color:#226bfa;'>This is an automated process, please dont refresh the page.</b>
</td>
</tr>
<tr>
<td>
<?php
include_once('../_common-admin.php');

$qry="SELECT * FROM alls_verify_all_mt_order where response='' limit 0,5;";
$res=mysql_query($qry);
while($rs=mysql_fetch_array($res))
{
	$oid=$rs['order_id'];
	
	$bankapi_user_id="100001";
	$bankapi_user_pass="9729877577";
	$bankapi_method="CHECK_ORDER_STATUS";
	$order_number=$oid;									
							
	$url = "$call_url" . "?";
	$url = $url . "bankapi_user_id=" . $bankapi_user_id;
	$url = $url . "&bankapi_user_pass=" . $bankapi_user_pass;
	$url = $url . "&bankapi_method=" . $bankapi_method;
	$url = $url . "&order_number=" . $order_number;
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
		$txstatus_desc="";
		if(!(empty($response) || $response==NULL))
		{
			$result= json_decode($response, true);
			$data= $result['data'];
			$txstatus_desc=$data['txstatus_desc'];
			if($txstatus_desc=="")
			$txstatus_desc=$response;
			$update_qry="update alls_verify_all_mt_order set response='$txstatus_desc' where order_id='$oid'";
			mysql_query($update_qry);
		}
		echo "<br><br>order id : $oid";
		echo "<br>status : $txstatus_desc";
	}
}
	echo "<meta http-equiv='refresh' content='1'>";

	
?>
</td>
<td width="25"></td>
<td valign="top">
<img src="../img/payone.gif" height="300" alt="Payone is updating transaction status" title="Payone is updating transaction status" /><br><br>
</td>
</tr>
<tr>
<td colspan="3" align="center">
<p style="font-weight:bold;color:#226bfa;"> <br>Next process will be executed in <span id="countdowntimer">5</span> Seconds </p>
<progress style="width:100%;" value="0" max="5" id="progressBar"></progress>
</td>
</tr>
</table>
</body>
</html>