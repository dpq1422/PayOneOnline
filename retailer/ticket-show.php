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
                        <h5><i class="fa fa-support fa-1x"></i> My Ticket Details</h5>
                    </div>
					<?php
									
					$tid="";
					if(isset($_REQUEST['tid']))
					$tid=$_REQUEST['tid'];
					if($tid!="")
					{
						$query4a="select * from child_tickets where user_id='$user_id' and  ticket_id='$tid';";
						$result4a=mysql_query($query4a);
						include '../functions/_my_uname.php';
						while($rs=mysql_fetch_assoc($result4a))
						{
							$tids=$rs['ticket_id'];
							$uid=$rs['user_id'];
							$uids=show_my_uname($rs['user_id']);
							$tdate=$rs['date_time'];
							$ttype=$rs['ticket_type'];
							if($ttype==1)
							$ttype="Money Transfer Dispute";
							else if($ttype==2)
							$ttype="Technical Support";
							else if($ttype==3)
							$ttype="Sales Enquiry";
							else if($ttype==4)
							$ttype="Billing Enquiry";
							else if($ttype==5)
							$ttype="Commission Issues";
							$tdesc=$rs['ticket_description'];
							$tresp=$rs['ticket_response'];
							$tstatus=$rs['ticket_status'];
						}
					}
					?>
                    <div class="card-action">

                        <div class="row" id="oneStep">

                            <div class="col l12 m12 s12 pad-10">
                                <div id="ContentPlaceHolder1_myMarginSet">
									<table>
										<tr>
											<td align="left">Ticket ID<br><?php echo $tids;?></td>
											<td width="75"></td>
											<td align="left">Generated Date Time<br><?php echo $tdate;?></td>
										</tr>
										<tr>
											<td align="left">User ID<br><?php echo $uid;?></td>
											<td width="75"></td>
											<td align="left">User Name<br><?php echo $uids;?></td>
										</tr>
										<tr>
											<td align="left">Ticket Type<br><?php echo $ttype;?></td>
											<td width="75"></td>
											<td align="left">Ticket Description<br><?php echo $tdesc;?></td>
										</tr>
										<tr>
											<td align="left" colspan="5"><b>Ticket Reponse</b><br><?php echo $tresp;?></td>
										</tr>
										<tr><td>&nbsp;</td></tr>
										<tr>
											<td align="left">
												<input type="button"class="waves-effect waves-light btn white-text green margin-bottom-10 ladda-button" value="Back" onclick="document.location.href='tickets.php'" />
											</td>
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
