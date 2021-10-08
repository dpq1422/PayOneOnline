<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php include('_head-tag.php'); ?>
		<script type="text/javascript" src="../js/admin-validation-functions.js"></script>
		<script type="text/javascript" src="../js/admin-validations-applied.js"></script>
		<script language="javascript" type="text/javascript">
		var submitbtn=0;
		function sbmtbtn()
		{
			submitbtn++;
			if(submitbtn==1)
			document.getElementById("frmSendRetailerRequest").submit();
			
			document.getElementById("btnSubmitButton").setAttribute("disabled","disabled");
			document.getElementById("btnSubmitButton2").setAttribute("disabled","disabled");
		}
		function checkformfill()
		{
			var result=validateAmountr();
			if(result)
				sbmtbtn();
		}
		function checkformfill2()
		{
			var result=validateAmountr2();
			if(result)
				sbmtbtn();
		}
		function ShowPaymentMode()
		{
			var bank_id=document.getElementById("bank_id").value;
			var PaymentMode=document.getElementById("payment_mode").value;
			var res="";
			if(PaymentMode==0)
				res="";
			if(PaymentMode==1)
				res="DD No. (Ref.No.)<br><input id='ref_no' name='ref_no' required type='text' />";
			if(PaymentMode==2)
				res="Cheque No. (Ref.No.)<br><input id='ref_no' name='ref_no' required type='text' />";
			if(PaymentMode==3)
				res="Ref No.<br><input id='ref_no' name='ref_no' required type='text' />";
			if(PaymentMode==4)
				res="Ref No.<br><input id='ref_no' name='ref_no' required type='text' />";
			if(PaymentMode==6 && bank_id==1)
				res="<b style='color:red;'>Rs. 25/- CDM deposit charges will be charged.</b><br>Ref No.<br><input id='ref_no' name='ref_no' required type='text' />";
			if(PaymentMode==6 && bank_id==2)
				res="<b style='color:red;'>Submit CDM Location with Ref.No. for fast approval.</b><br>CDM Location ref.No.<br><input id='ref_no' name='ref_no' required type='text' />";
			if(PaymentMode==5 && bank_id==1)
				res="<b style='color:red;' id='SbiChg'>Rs 118/- Cash deposit charges will be charged.</b><br>Ref No.<br><input id='ref_no' name='ref_no' required type='text' />";
			if(PaymentMode==5 && bank_id==2)
				res="<b style='color:red;'>Submit Branch Name with Ref.No. for fast approval.</b><br>Branch Name. (Ref.No.)<br><input id='ref_no' name='ref_no' required type='text' />";
			document.getElementById("ResPaymentMode").innerHTML=res;
			SbiChg();
		}
		function SbiChg()
		{
			var bank_id=document.getElementById("bank_id").value;
			var PaymentMode=document.getElementById("payment_mode").value;
			amt=document.getElementById("filled_amount").value;
			sbi1=118;
			sbi2=0;
			sbi=0;
			if(PaymentMode==5 && bank_id==1)
			{
				sbi2=(amt*.89);
				sbi2=sbi2/1000;
				sbi2=sbi2+59;

				if(sbi1>sbi2)
					sbi=sbi1;
				else
					sbi=sbi2;
			}
			sbi=sbi.toPrecision(4);
			if(sbi!=0)
				document.getElementById("SbiChg").innerHTML="Rs "+sbi+"/- Cash deposit charges will be charged.";
		}
		function requestto()
		{
			document.getElementById("reqto").innerHTML="";
			var request_to=document.getElementById("request_to").value;
			var res="";
			document.getElementById("reqto1").style.display="none";
			document.getElementById("reqto2").style.display="none";
			
			if(request_to==0)
				res="0";
			else if(request_to==100001)
				document.getElementById("reqto1").style.display="block";
			else
				document.getElementById("reqto2").style.display="block";
			
			if(res!="")
			document.getElementById("reqto").innerHTML="<b style='color:red;'>Please select Request To</b>";
		}
		</script>
	</head>
<body class="cyan-scheme">
<div id="form1">

    <!--Page load animation-->
 
    <div class="wrapper vertical-sidebar" id="full-page">
        <?php include('_nav-menu.php'); ?>

        <main id="content">
		<div id="page-content">
		
	<?php
		$my_sd=0;
		$my_d=0;
		$qry_my_team="select * from child_user where user_id=$user_id;";
		$res_my_team=mysql_query($qry_my_team);
		while($rs_my_team=mysql_fetch_array($res_my_team))
		{
			$my_sd=$rs_my_team['hierarchy_2_id'];
			$my_d=$rs_my_team['hierarchy_3_id'];
		}
	?>
                
     <div class="row content-container elements">
     <marquee style='color:red;font-weight:bold;'><br><br>Dear Partner, ICICI Bank Account is closed now. Use only SBI Account for depost / transfer money for fast processing of LIMIT.</marquee>

            <div class="col s12 m12 l6" id="addBdddeneficiary" >
                <div class="card">
                    <div class="card-content">
                        <h5><i class="fa fa-money fa-1x"></i> Send Wallet Request </h5>
                    </div>
                    <div class="card-action">
                        <div class="row extra-elements">
							<form action="send-wallet-request-code.php" id="frmSendRetailerRequest" method="post">
								<div class="input-field col l8 m12 s12 offset-l2">
									Request To
									<select required name="request_to" class="chosen" id="request_to" onchange="requestto()">
										<option value=''>Select Request To</option>
										<option value='100001'>Company</option>
										<option value='100004'>D-100004</option>
										<option value='100149'>D-100149</option>
										<?php
										if($my_sd!=0)
											echo "<option value='$my_sd'>D-$my_sd</option>";
										if($my_d!=0)
											echo "<option value='$my_d'>D-$my_d</option>";
										?>
									</select>
								</div>
								
								<div class="input-field col l8 m12 s12 offset-l2" id="reqto">
								</div>
								
								<div id="reqto1" style="display:none;">
									<div class="input-field col l8 m12 s12 offset-l2">
										Deposit Date
										<input id="deposit_date" name="deposit_date" required type="date" class="validate myDate" style="font-size: 1.8rem">
									</div>
									
									<div class="input-field col l8 m12 s12 offset-l2">
										Bank
										<select id="bank_id" name="bank_id" class="chosen" onchange="ShowPaymentMode()">
											<option value="">Select Bank</option>
											<?php
											include '../_common-retail.php';
											$query_bnk="SELECT * FROM child_bank where account_status=1";
											$result_bnk=mysql_query($query_bnk);	
											while($rs_bnk = mysql_fetch_assoc($result_bnk)) 
											{
											?>
													<option value="<?php echo $rs_bnk['bank_id'];?>"><?php echo $rs_bnk['bank_name']." - ".$rs_bnk['account_no'];?></option>
											<?php
											}
											?>
										</select>
									</div>
									
									<div class="input-field col l8 m12 s12 offset-l2">
										Payment Mode
										<select required name="payment_mode" class="chosen" id="payment_mode" onchange="ShowPaymentMode()">
											<option value=''>Select Payment Mode</option>
											<option value='5'>Cash Deposit</option>
											<option value='3'>NEFT / RTGS</option>
											<option value='4'>IMPS</option>
											<option value='6'>CDM - Cash Deposit Machine</option>
											<option value='2'>Cheque</option>
											<option value='1'>Demand Draft</option>
										</select>
									</div>

									<div class="input-field col l8 m12 s12 offset-l2" id="ResPaymentMode">
									</div>

									<div class="input-field col l8 m12 s12 offset-l2">
										Amount
										<input id="filled_amount" onkeyup="SbiChg()" name="deposit_amount" required type="number" style="font-size: 1.8rem">
									</div>

									<div class="input-field col l8 m12 s12 offset-l2">
										Remarks
										<input id="remarks" name="remarks" type="text" style="font-size: 1.8rem">
									</div>

									<div class="input-field col l8 m12 s12 offset-l2">
										<input value="Send Request" class="waves-effect waves-light btn white-text green margin-bottom-10 ladda-button" id="btnSubmitButton" type="button" onclick="checkformfill()"/>
									</div>
								</div>
								<div id="reqto2" style="display:none;">
									
									<div class="input-field col l8 m12 s12 offset-l2">
										Request Type
										<select required name="payment_mode2" class="chosen" id="payment_mode2">
											<option value=''>Select Request Type</option>
											<option value='7'>Cash Value</option>
										</select>
									</div>

									<div class="input-field col l8 m12 s12 offset-l2">
										Amount
										<input id="filled_amount2" name="deposit_amount2" required type="number" style="font-size: 1.8rem">
									</div>

									<div class="input-field col l8 m12 s12 offset-l2">
										Remarks
										<input id="remarks2" name="remarks2" type="text" style="font-size: 1.8rem">
									</div>

									<div class="input-field col l8 m12 s12 offset-l2">
										<input value="Send Request" class="waves-effect waves-light btn white-text green margin-bottom-10 ladda-button" id="btnSubmitButton2" type="button" onclick="checkformfill2()"/>
									</div>
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
