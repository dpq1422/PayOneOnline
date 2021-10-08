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
                        <h5><i class="fa fa-support fa-1x"></i> My Tickets</h5><input type="button" value="Generate New Ticket" onclick="location.href='ticket.php';" style="float:right;"  class="waves-effect waves-light btn white-text green margin-bottom-10 ladda-button" /><br>
                    </div>
                    <div class="card-action">

                        <div class="row" id="oneStep">

                            <div class="col l12 m12 s12 pad-10">
                                <div id="ContentPlaceHolder1_myMarginSet">
									<form method="post">
									<table>
									<?php											
									$s1="";
									$s2="";
									$s3="";
									$cond=" ";
									if(isset($_POST['a']))
									{
										$s1=$_POST['a'];
										if($s1!="")
										$cond=" and date(date_time)='$s1' ";
									}
									if(isset($_POST['b']))
									{
										$s2=$_POST['b'];
										if($s2!="")
										$cond=" and ticket_id=$s2 ";
									}
									?>
										<tr>
											<td width='375'><input type='number' id='b' onclick='document.getElementById("a").value="";' value="<?php echo $s2;?>" name='b' placeholder='Ticket ID'/></td>
											<td width='375'><input type='date' id='a' onclick='document.getElementById("b").value="";' value="<?php echo $s1;?>" name='a' placeholder='Deposit Date'/></td>
											<td><input class="btn btn-block btn-danger" type="submit" name='submit' value='Search'/></td>
										</tr>
									</table>
									</form>
									<table class='responsive-table striped table-bordered'>
										<thead>
											<tr class="gridheader" align="center">
												<th>Ticket ID</th>
												<th>Ticket Type</th>
												<th>Date Time</th>
												<th>User ID / User Name</th>
												<th>Details</th>
												<th>Status</th>
												<th>Action</th>
											</tr>														
										</thead>
										<tbody>
									<?php 
										include '../_common-retail.php';
										
										$query="SELECT * FROM child_tickets where user_id='$user_id' $cond order by ticket_id desc limit 0,50";
												$result=mysql_query($query);
												$num_rows = mysql_num_rows($result);	
												$i=0;
												if($num_rows>0)
												{
													include '../functions/_my_uname.php';
													while($rs = mysql_fetch_assoc($result))
													{
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
														
														$tstatus=$rs['ticket_status'];
														if($tstatus==1)
														$tstatus="Opened";
														else if($tstatus==2)
														$tstatus="In-Progress";
														else if($tstatus==3)
														$tstatus="Re-Opened";
														else if($tstatus==4)
														$tstatus="Closed";
											
									?>
												<tr <?php echo $style;?>>
													<td><?php echo $rs['ticket_id'];?></td>
													<td><?php echo $ttype;?></td>
													<td><?php echo $rs['date_time'];?></td>
													<td><?php echo show_my_uname($rs['user_id']);?></td>
													<td><?php echo $rs['ticket_description'];?></td>
													<td><?php echo $tstatus;?></td>
													<td>
														<a href="ticket-show.php?tid=<?php echo $rs['ticket_id'];?>">Show Details</a>
														&nbsp;&nbsp;&nbsp;
														<a href="ticket-reply.php?tid=<?php echo $rs['ticket_id'];?>">Reply</a>
													</td>
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
