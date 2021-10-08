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
					if(isset($_POST['reply']))
					{
						$tid=$_POST['tid'];
						$response=$_POST['filled_remarks'];
						$status=$_POST['status'];
						$qry="update child_tickets set ticket_response=concat(ticket_response,'<br><br>$response <b>last updated by $user_types ($user_id - $user_name) at $datetime_time</b>'), ticket_status='$status' where ticket_id='$tid';";
						$res=mysql_query($qry);
						include_once('../functions/_zsms.php');
						zsms("9580958000","Ticket Updated by $user_id");
						if($res)
						{
							echo "<script>document.location.href='tickets.php'</script>";
						}
					}
					?>
                    <div class="card-action">
						<div class="row extra-elements">
                        <div class="row" id="oneStep">

                            <div class="col l12 m12 s12 pad-10">
                                <div id="ContentPlaceHolder1_myMarginSet">
									<table>
										<form id="frmReplyTicket" method="post">
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
									</table>
									<form></form>
									<form id="frmReplyTicket" method="post">
										<div class="input-field l8 m12 s12 offset-l2">
											<select required name="status" class="chosen">
												<option value="">Select Updated Status</option>
												<option value="2">In-Progress</option>
												<option value="3">Re-Opened</option>
												<option value="4">Closed</option>
											</select>
											<br><br>
										</div>

										<div class="input-field l8 m12 s12 offset-l2">
											Latest Updated Response about Ticket<br>
											<input type="hidden" name="tid" value="<?php echo $tids;?>"/>
											<textarea rows="5" style="height:150px;" cols="100" required name="filled_remarks"></textarea>
										</div>

										<div class="input-field l8 m12 s12 offset-l2">
											<input value="Reply" class="waves-effect waves-light btn white-text green margin-bottom-10 ladda-button" name="reply" type="submit" />
										</div>
									</form>
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
