<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
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
        <div class="col s12 m12 l12 socialMessage">
            <div class="messageBox">
                <div class="card ">
                    <div class="card-content">
                        <h5><i class="fa fa-calendar fa-1x"></i> Contact Details</h5>
                    </div>
                    <div class="card-action">

                        <div class="row" id="oneStep">

                            <div class="col l12 m12 s12 pad-10">
                                <div id="ContentPlaceHolder1_myMarginSet">
									<table class='responsive-table striped table-bordered'>
										<thead>
											<tr class="gridheader" align="center">
												<th>S.No.</th>
												<th>Bank Name</th>
												<th>Account Name</th>
												<th>Account No.</th>
												<th>Branch Name</th>
												<th>IFSC Code</th>
											</tr>														
										</thead>
										<tbody>
									<?php 
										include '../_common-retail.php';
										
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
											$style="style='background-color:#f2f2f2;'";
											
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
												<tr>
													<td colspan="8">No Records Available</td>
												</tr>
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
									<p>&nbsp;</p>
										<table class='responsive-table striped table-bordered'>
											<tr class="gridheader" align="center">
												<td align="left" valign="top" width="175"><h5>Contact No :</h5></td>
												<td align="left"><h5><?php echo $contact_no;?></h5></td>
											</tr>
											<tr><td colspan="3">&nbsp;</td></tr>
											<tr>
												<td align="left" valign="top"><h5>E-mail Id :</h5></td>
												<td align="left"><h5><?php echo $e_mail;?></h5></td>
											</tr>
										</table>
								</div>
                                </div>
                            </div>
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
        setactiveClass("prodMar");
    </script>


    
</div>
</body>
</html>
