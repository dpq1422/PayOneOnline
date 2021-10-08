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
										Upload ICICI Bank Sheet
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
			$bnk_txn_id=$getData[1];//Transaction ID
			$bank_name="ICICI";
			$bnk_date=$getData[2];//Value Date
			$bnk_chk_no=$getData[4];//ChequeNo.
			$bnk_desc=$getData[5];//Description
			$sbi_branch_code=" ";
			$bnk_txn_type=$getData[6];//Cr/Dr
			if($bnk_txn_type=="CR")
			{
				$txn_cr=$getData[7];//Txn Amt(INR)
				$txn_dr="0";//Txn Amt(INR)
			}
			else if($bnk_txn_type=="DR")
			{
				$txn_cr="0";//Txn Amt(INR)
				$txn_dr=$getData[7];//Txn Amt(INR)
			}
			else
			{
				$txn_cr="0";//Txn Amt(INR)
				$txn_dr="0";//Txn Amt(INR)
			}
			$txn_bal=$getData[8];//Available Balance(INR)
			$request_id="0";
			$user_id="0";
			$auth_id="0";
			
			$bnk_dates=explode("-",$bnk_date);
			$bnk_date=$bnk_dates[2]."-".$bnk_dates[1]."-".$bnk_dates[0];
			
			$sql = "INSERT into child_bank_records (bnk_txn_id, bank_name, bnk_date, bnk_chk_no, bnk_desc, sbi_branch_code, bnk_txn_type, txn_cr, txn_dr, txn_bal, request_id, user_id, auth_id)  values ('$bnk_txn_id', '$bank_name', '$bnk_date', '$bnk_chk_no', '$bnk_desc', '$sbi_branch_code', '$bnk_txn_type', '$txn_cr', '$txn_dr', '$txn_bal', '$request_id', '$user_id', '$auth_id')";
			$result+= mysql_query($sql);
		}
		fclose($file);
		if($result>0)
		{
			$msg="<b style='color:green;'>$result records uploaded for ICICI bank.</b>";
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
