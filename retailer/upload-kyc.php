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
        <div class="col s8 m8 l8 socialMessage">
            <div class="messageBox">
                <div class="card ">
                    <div class="card-content">
                        <h5><i class="fa fa-street-view fa-1x"></i> Upload KYC</h5>
                    </div>
                    <div class="card-action">

                        <div class="row">

                            <div class="col l12 m12 s12 pad-10" id="oneStep">
                                <div class="">
									<?php if(isset($_REQUEST['msg']) && $_REQUEST['msg']=="success") {echo "<b style='color:green;'>KYC documents upload successful.</b><br><br>";} 
									else if(isset($_REQUEST['msg']) && $_REQUEST['msg']=="fail") {echo "<b style='color:red;'>KYC documents upload failed, please try again later.</b><br><br>";} ?>
                                    <div id="theProfile" class="collection margin">
										<table class='responsive-table striped table-bordered'>
											<tbody> 
												<tr>
													<th colspan='2'>UPLOAD KYC DETAILS:</th>
												</tr>
												<tr>
													<td>My ID:</td>
													<td><?php echo $user_id;?></td>
												</tr>
												<tr>
													<td>My Name</td>
													<td><?php echo $user_name;?></td>
												</tr>
											</tbody>
										</table>
										<br><br>
										<table class='responsive-table striped table-bordered'>
											<form action="upload-kyc-code.php" method="post" enctype="multipart/form-data">
											<tbody> 
												<tr>
													<td colspan='2'><b>UPLOAD KYC DETAILS:</b> Upload Documents (JPG, JPEG, PNG, GIF : max size 1 MB)</td>
												</tr>
												<tr>
													<td>PAN CARD:</td>
													<td><input type="hidden" name="kuserid" value="<?php echo $user_id;?>" /><input type="file" name="pan" /></td>
												</tr>
												<tr>
													<td>Passport Size Photo</td>
													<td><input type="file" name="photo" /></td>
												</tr>
												<tr>
													<td>Aadhar Front</td>
													<td><input type="file" name="proofo" /></td>
												</tr>
												<tr>
													<td>Aadhar Back</td>
													<td><input type="file" name="prooft" /></td>
												</tr>
												<tr>
													<td></td>
													<td><input type="submit" value="Upload" class="btn btn-block btn-danger"/></td>
												</tr>
											</tbody>
											</form>
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
        setactiveClass('prof');
    </script>


    
</div>
</body>
</html>
