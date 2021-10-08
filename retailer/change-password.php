<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php include('_head-tag.php'); ?>
		<script type="text/javascript" src="../js/admin-validation-functions.js"></script>
		<script type="text/javascript" src="../js/admin-validations-applied.js"></script>
	</head>
<body class="cyan-scheme">
<div id="form1">

    <!--Page load animation-->
 
    <div class="wrapper vertical-sidebar" id="full-page">
        <?php include('_nav-menu.php'); ?>

        <main id="content">
            <div id="page-content">
			
			<?php
			$oldP="";
			$newP="";
			$msg="";
			if(isset($_POST['oldP']))
			$oldP=$_POST['oldP'];
			if(isset($_POST['newP']))
			$newP=$_POST['newP'];
			if(isset($_POST['submit']))
			{
				$oldP=md5($oldP);
				$newP=md5($newP);
				$query23="update child_user set pass_word='$newP', past_change_on='$datetime_time' where user_id='$user_id' and pass_word='$oldP';";
				mysql_query($query23);
				$result23=mysql_affected_rows();

				if($result23>0)
				$msg="<b style='color:green;'>Password updated</b>";
				else
				$msg="<b style='color:red;'>Old password not matched</b>";
			}
			?>

                
     <div class="row content-container elements">
    
    <div class="col s12 m12 l6 socialMessage">
        <div class="messageBox">
            <div class="card ">
                <div class="card-content">
                    <h5><i class="fa fa-gear fa-1x"></i> Change Password</h5>
                </div>
                <div class="card-action">

                    <div class="row" id="oneStep">
						<?php echo $msg;?>
						<br><br>

                        <div class="col l12 m12 s12 pad-10">
							<form method="post" onsubmit="return chang_pass()">
								<div class="input-field col l8 m12 s12 offset-l2">
									<input name="oldP" id="oldP" type="password" required class="validate myDate" style="font-size: 1.8rem">
									<label for="sDate" class="">Old Password</label>
								</div>
								
								<div class="input-field col l8 m12 s12 offset-l2">
									<input name="newP" id="newP" type="password" required class="validate myDate" style="font-size: 1.8rem">
									<label for="eDate" class="">New Password</label>
								</div>
								
								<div class="input-field col l8 m12 s12 offset-l2">
									<input name="conP" id="conP" type="password" required class="validate myDate" style="font-size: 1.8rem">
									<label for="eDate" class="">Confirm Password</label>
								</div>
								
								<div class="col m12 s12 btn-div buttons-s text-center">
									<input type="submit" name="submit" class="btn green" value="Update">
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
    
      <!-- datePicker Script -->
    <script src="../assets/DatePicker/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".myDate").datepicker({

                todayHighlight: true,
                format: "dd/mm/yyyy",
                endDate: '+1d',
                autoclose: true

            });
        })
    </script>
    
    <script>


        $(document).ready(function () {

            $('html,body').animate({
                scrollTop: $("#valueTransferLog").offset().top
            },
      'slow');

            setTimeout(function () {

                $('html,body').animate({
                    scrollTop: $("#form1").offset().top
                },
            'slow');


            }, 2000)

            $(".myDate").datepicker({

                todayHighlight: true,
                format: "dd/mm/yyyy",
                endDate: '+0d',
                autoclose: true

            });

            ValTransferShow();

            setactiveClass('valTran');

        });

        function ValTransferShow() {

            $("#fetchValueTransfers").unbind('click').click(function (e) {


                e.preventDefault();

                var startDate = $("#sDate").val();
                var endDate = $("#eDate").val();

                $("#valueTransferLog").html("");

                var btn = $(this).ladda();

                btn.ladda('start');

                $.ajax({
                    type: 'POST',
                    url: 'ValueTransfers.aspx/GetValueTransfers',
                    data: "{'sDate' : " + JSON.stringify(startDate) + ", 'eDate' : " + JSON.stringify(endDate) + "}",
                    contentType: 'application/json; charset:utf-8',
                    dataType: 'json',
                    success: function (data, status) {


                        btn.ladda('stop');

                        var cc = data.d.split('_SEP_').pop();

                        if (cc == "0") {

                            swal({
                                type: 'error',
                                text: data.d.replace('_SEP_0', ''),
                                allowOutsideClick: false

                            })

                        } else {

                            $("#valueTransferLog").html(data.d);

                            $('html,body').animate({
                                scrollTop: $("#valueTransferLog").offset().top
                            },
   'slow');
                        }




                    }, error: function (cc) {

                        alert(cc.responseText);

                    }

                });



            });

        }

    </script>



    
</div>
</body>
</html>
