<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head id="ctl00_Head1"><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
		<?php include '_head-tag.php'; ?>
		<script type="text/javascript" src="../js/admin-validation-functions.js"></script>
		<script type="text/javascript" src="../js/admin-validations-applied.js"></script>
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
										Bank Details and Contact Info
									</div>
									<div class="panel-body panel-primary text-center">
										<table class="table clsgrid rounded_corners" cellspacing="0" rules="all" border="1" id="ctl00_ContentPlaceHolder1_tagcost" style="width:100%;border-collapse:collapse;font-family:Calibri;font-weight:500;">
											<tbody>
												<tr class="gridheader" align="center" style="background-color:#009DE2;">
													<th>S.No.</th>
													<th>Bank Name</th>
													<th>Account Name</th>
													<th>Account No.</th>
													<th>Branch Name</th>
													<th>IFSC Code</th>
												</tr>
									<?php 
										$query="SELECT * FROM child_bank where account_status=1 order by bank_name";
										$result=mysql_query($query);
										$num_rows = mysql_num_rows($result);	
										if($num_rows>0)
										{		
											$i=0;
											$status="";
											//$userstatus="";
											while($rs = mysql_fetch_assoc($result)) {
											$i++;
											if($i%2!=0)
											$style="style='background-color:white;'";
											else
											$style="style='background-color:#e5e5e5;'";
											
											if($rs['account_status']==1)
											{
												$status="Active";
											}
											else
											{
												$status="Blocked";
											}
									?>
												<tr <?php echo $style;?>>
													<td><?php echo $i;?></td>
													<td><?php echo $rs['bank_name'];?></td>
													<td><?php echo $rs['account_name'];?></td>
													<td><?php echo $rs['account_no'];?></td>
													<td><?php echo $rs['branch_name'];?></td>
													<td><?php echo $rs['ifsc_code'];?></td>
												</tr>
									<?php
											}
										}
										else
										{
									?>
												<tr>No Records Available</tr>
									<?php
										}
									?>
											</tbody>
										</table>
									<?php
									$query4a="select * from child_company where company_id='1';";
									$result4a=mysql_query($query4a);
									while($rs=mysql_fetch_assoc($result4a))
									{
										$contact_no=$rs['contact_no'];
										$e_mail=$rs['e_mail'];
									}
									?>
										<table>
											<tr>
												<td align="left" valign="top" width="175"><b>Contact No Description</b></td>
												<td width="75"></td>
												<td align="left"><textarea style="border:none;" readonly rows="4" cols="100"><?php echo $contact_no;?></textarea></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td align="left" valign="top"><b>E-mail Description</b></td>
												<td width="75"></td>
												<td align="left"><textarea style="border:none;" readonly rows="4" cols="100"><?php echo $e_mail;?></textarea></td>
											</tr>
											<tr><td>&nbsp;</td></tr>
										</table>
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
