<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head id="ctl00_Head1"><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<?php include '_head-tag.php'; ?>
	</head>
	<body><!--oncontextmenu="return false"-->
		<div class="container-fluid">
			<div class="col-md-12">
				<div class="col-sm-12 col-md-12 col-xs-12 col-comn" style="box-shadow: 0 0 3px #c9c9c9;
					padding: 0px">
					<?php include '../_logged-user-info.php'; ?>
					<?php include '_nav-menu.php'; ?>
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-12">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Upload SBI Bank Sheet
									</div>
									<div class="panel-body panel-primary text-center">
										<?php
$msg="&nbsp;";
if(isset($_POST["UploadFile"]))
{
	$filename=$_FILES["file"]["tmp_name"];		
	if($_FILES["file"]["size"] > 0)
	{
		$file = fopen($filename, "r");
		$result=0;
		while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
		{
			$bnk_txn_id="0";//Transaction ID
			$bank_name="SBI";
			$bnk_date=$getData[0];//Value Date
			$bnk_chk_no=$getData[3];//ChequeNo.
			$bnk_desc=$getData[2];//Description
			$sbi_branch_code=$getData[4];
			$bnk_txn_type=" ";//Cr/Dr
			$txn_cr=$getData[6];//Txn Amt(INR)
			$txn_cr=str_replace(",","",$txn_cr);
			if($txn_cr=="" || $txn_cr==" ")
				$txn_cr=0;
			$txn_dr=$getData[5];//Txn Amt(INR)
			$txn_dr=str_replace(",","",$txn_dr);
			if($txn_dr=="" || $txn_dr==" ")
				$txn_dr=0;
			$txn_bal=$getData[7];//Available Balance(INR)
			$txn_bal=str_replace(",","",$txn_bal);
			if($txn_bal=="" || $txn_bal==" ")
				$txn_bal=0;
			$request_id="0";
			$user_id="0";
			$auth_id="0";
			
			$bnk_dates=explode("-",$bnk_date);
			$bnk_dates[2]+=2000;
			$mnt=array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
			for($abc=0;$abc<sizeof($mnt);$abc++)
			{
				if($mnt[$abc]==$bnk_dates[1])
				{
					$bnk_dates[1]=$abc;
				}
			}
			
			$bnk_date=$bnk_dates[2]."-".$bnk_dates[1]."-".$bnk_dates[0];
			
			$sql = "INSERT into child_bank_records (bnk_txn_id, bank_name, bnk_date, bnk_chk_no, bnk_desc, sbi_branch_code, bnk_txn_type, txn_cr, txn_dr, txn_bal, request_id, user_id, auth_id)  values ('$bnk_txn_id', '$bank_name', '$bnk_date', '$bnk_chk_no', '$bnk_desc', '$sbi_branch_code', '$bnk_txn_type', '$txn_cr', '$txn_dr', '$txn_bal', '$request_id', '$user_id', '$auth_id')";
			$result+= mysql_query($sql);
		}
		fclose($file);
		if($result>0)
		{
			$msg="<b style='color:green;'>$result records uploaded for SBI bank.</b>";
		}
	}
}
										?>
										<form method="post" enctype="multipart/form-data">
											<table>
												<tr align='left'><td colspan="2"><?php echo $msg;?></td></tr>
												<tr><td colspan="3">&nbsp;</td></tr>
												<tr>
													<td align="left"><input type="file" required  name="file" id="file" /></td>
													<td align="left" width="50"></td>
													<td align="left"><input type="submit" name="UploadFile" value="Upload Records" /></td>
												</tr>
												<tr><td>&nbsp;</td></tr>
											</table>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php include '_footer.php'; ?>
				</div>
			</div>
		</div>
	</body>
</html>
