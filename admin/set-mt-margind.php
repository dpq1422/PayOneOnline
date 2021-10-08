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
					<?php 
					$uid=$_REQUEST['uid'];
					
					function dRate($rate1,$rate2)
					{
						if($rate1==$rate2)
						echo "<option selected>$rate2</option>";
						else
						echo "<option>$rate2</option>";
					}
					
					$utp="";
					$qry1="select user_type from child_user where user_id='$uid'";
					$result1=mysql_query($qry1);
					while($rs1=mysql_fetch_assoc($result1))
					{
						$utp=$rs1['user_type'];
					}
					
					$products="";
					$qry2="select money_transfer from child_products where user_id='$uid'";
					$result2=mysql_query($qry2);
					while($rs2=mysql_fetch_assoc($result2))
					{
						$products=explode(',',$rs2['money_transfer']);
					}
					?>
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-12">
								<div class="panel panel-primary">
									<div class="panel-heading bgheadcolor">
										Set Margin
									</div>
									<div class="panel-body panel-primary text-center">
										<form action="set-mt-margin-code.php" method="post">
											<table>
					<?php											
					for($i=0;$i<count($products);$i++)
					{
						$pid=$products[$i];
						$source_name="";
						$qry3="select source_name from all_recharge_source where source_id='$pid'";
						$result3=mysql_query($qry3);
						while($rs3=mysql_fetch_assoc($result3))
						{
							$source_name=$rs3['source_name'];
						}
						$qry4="select * from child_products_margin_mt where user_id='$uid' and source_id='$pid' and payment_method='1';";
						$result4=mysql_query($qry4);
						while($rs4=mysql_fetch_assoc($result4))
						{							
							$rate_01a=0;
							$rate_02a=0;
							$rate_03a=0;
							$rate_04a=0;
							$rate_05a=0;
							$rate_10a=0;
							$rate_15a=0;
							$rate_20a=0;
							$rate_25a=0;
								
							$rate_01a=$rs4['m_01000'];
							$rate_02a=$rs4['m_02000'];
							$rate_03a=$rs4['m_03000'];
							$rate_04a=$rs4['m_04000'];
							$rate_05a=$rs4['m_05000'];
							$rate_10a=$rs4['m_10000'];
							$rate_15a=$rs4['m_15000'];
							$rate_20a=$rs4['m_20000'];
							$rate_25a=$rs4['m_25000'];
						}
						$qry4="select * from child_products_margin_mt where user_id='$uid' and source_id='$pid' and payment_method='2';";
						$result4=mysql_query($qry4);
						while($rs4=mysql_fetch_assoc($result4))
						{
							$rate_01b=0;
							$rate_02b=0;
							$rate_03b=0;
							$rate_04b=0;
							$rate_05b=0;
							$rate_10b=0;
							$rate_15b=0;
							$rate_20b=0;
							$rate_25b=0;
								
							$rate_01b=$rs4['m_01000'];
							$rate_02b=$rs4['m_02000'];
							$rate_03b=$rs4['m_03000'];
							$rate_04b=$rs4['m_04000'];
							$rate_05b=$rs4['m_05000'];
							$rate_10b=$rs4['m_10000'];
							$rate_15b=$rs4['m_15000'];
							$rate_20b=$rs4['m_20000'];
							$rate_25b=$rs4['m_25000'];
						}
					?>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<th align="left">
														Set Margin for <?php echo $source_name;?> through NEFT
														<input type="hidden" name="user_id[]" value="<?php echo $uid;?>"/>
														<input type="hidden" name="source_id[]" value="<?php echo $pid;?>"/>
														<input type="hidden" name="payment_method[]" value="1"/>
													</th>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left">Set Charges between 0-1000<br>
														<select name="c01[]">
															<?php
															if($utp==3)
															{
																for($mark=9;$mark<=11;$mark++)
																dRate($rate_01a,$mark);
															}
															?>
														</select>
													</td>
													<td width="75"></td>
													<td align="left">Set Charges between 1001-2000<br>
														<select name="c02[]">
															<?php
															if($utp==3)
															{
																for($mark=11;$mark<=13;$mark++)
																dRate($rate_02a,$mark);
															}
															?>
														</select>
													</td>
													<td width="75"></td>
													<td align="left">Set Charges between 2001-3000<br>
														<select name="c03[]">
															<?php
															if($utp==3)
															{
																for($mark=14;$mark<=18;$mark++)
																dRate($rate_03a,$mark);
															}
															?>
														</select>
													</td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left">Set Charges between 3001-4000<br>
														<select name="c04[]">
															<?php
															if($utp==3)
															{
																for($mark=14;$mark<=18;$mark++)
																dRate($rate_04a,$mark);
															}
															?>
														</select>
													</td>
													<td width="75"></td>
													<td align="left">Set Charges between 4001-5000<br>
														<select name="c05[]">
															<?php
															if($utp==3)
															{
																for($mark=14;$mark<=18;$mark++)
																dRate($rate_05a,$mark);
															}
															?>
														</select>
													</td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<th align="left">
														Set Margin for <?php echo $source_name;?> through IMPS
														<input type="hidden" name="user_id2[]" value="<?php echo $uid;?>"/>
														<input type="hidden" name="source_id2[]" value="<?php echo $pid;?>"/>
														<input type="hidden" name="payment_method2[]" value="2"/>
													</th>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left">Set Charges between 0-1000<br>
														<select name="c01b[]">
															<?php
															if($utp==3)
															{
																for($mark=9;$mark<=11;$mark++)
																dRate($rate_01b,$mark);
															}
															?>
														</select>
													</td>
													<td width="75"></td>
													<td align="left">Set Charges between 1001-2000<br>
														<select name="c02b[]">
															<?php
															if($utp==3)
															{
																for($mark=11;$mark<=13;$mark++)
																dRate($rate_02b,$mark);
															}
															?>
														</select>
													</td>
													<td width="75"></td>
													<td align="left">Set Charges between 2001-3000<br>
														<select name="c03b[]">
															<?php
															if($utp==3)
															{
																for($mark=14;$mark<=18;$mark++)
																dRate($rate_03b,$mark);
															}
															?>
														</select>
													</td>
												</tr>
												<tr><td>&nbsp;</td></tr>
												<tr>
													<td align="left">Set Charges between 3001-4000<br>
														<select name="c04b[]">
															<?php
															if($utp==3)
															{
																for($mark=14;$mark<=18;$mark++)
																dRate($rate_04b,$mark);
															}
															?>
														</select>
													</td>
													<td width="75"></td>
													<td align="left">Set Charges between 4001-5000<br>
														<select name="c05b[]">
															<?php
															if($utp==3)
															{
																for($mark=14;$mark<=18;$mark++)
																dRate($rate_05b,$mark);
															}
															?>
														</select>
													</td>
												</tr>
												<tr><td>&nbsp;</td></tr>
					<?php
					}
					?>
												<tr>
													<input type="hidden" name="utp" value="<?php echo $utp?>"/>
													<td colspan="5" align="center"><input type="submit" /></td>
												</tr>
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
