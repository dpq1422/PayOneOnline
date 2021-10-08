<!DOCTYPE html>
<html>
<head>
<?php include_once('_all-inner-pages-html-title.php'); ?>
<script>
$(document).ready(function(){
	$("#welcome-message").show();
});
</script>
<!--
<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script type="text/javascript">
window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer",
	{
		theme: "theme2",		
		data: [
		{       
			type: "pie", //pie//bra//line
			showInLegend: true,
			toolTipContent: "#percent % : {y}",
			yValueFormatString: "#/-",
			legendText: "{indexLabel}",
			dataPoints: [
				{  y: 4181563, indexLabel: "Haryana" },
				{  y: 2175498, indexLabel: "Punjab" },
				{  y: 3125844, indexLabel: "Jammu & Kashmir" },
				{  y: 1176121, indexLabel: "Himachal"},
				{  y: 1727161, indexLabel: "Chandigarh" },
			]
		}
		]
	});
	chart.render();
	
	var chart = new CanvasJS.Chart("chartContainer2",
	{
		theme: "theme2",		
		data: [
		{       
			type: "pie",
			showInLegend: true,
			toolTipContent: "#percent % : {y}",
			yValueFormatString: "#/-",
			legendText: "{indexLabel}",
			dataPoints: [
				{  y: 4181563, indexLabel: "State Bank of India" },
				{  y: 3125844, indexLabel: "ICICI Bank" },
				{  y: 2175498, indexLabel: "Punjab Natioal Bank" },
			]
		}
		]
	});
	chart.render();
	
	var chart = new CanvasJS.Chart("chartContainer3",
	{
		theme: "theme2",		
		data: [
		{       
			type: "pie",
			showInLegend: true,
			toolTipContent: "#percent % : {y}",
			yValueFormatString: "#/-",
			legendText: "{indexLabel}",
			dataPoints: [
				{  y: 4181563, indexLabel: "Cash" },
				{  y: 2175498, indexLabel: "IMPS" },
				{  y: 1158948, indexLabel: "NEFT/RTGS" },
				{  y: 1128454, indexLabel: "CDM" },
				{  y: 825844, indexLabel: "Cheque" },
				{  y: 525844, indexLabel: "DD" },
			]
		}
		]
	});
	chart.render();
}
</script>-->
</head>
<body>

	<?php include_once('_header.php'); ?>
    <?php
	if($logged_user_id==1001)
		echo "<script>window.location.href='WalletClientRequestsReceivedServlet';</script>";
	include_once('zf-DashboardAdmin.php');
	$holding1=txn_holding_amountss("txn_mt where mmt_status=-4 and source=1 ");
	$holding2=txn_holding_amountss("txn_rc where mmt_status=-4 and source=2 ");
	$holding3=txn_holding_amountss("txn_mt where mmt_status=-4 and source=3 ");
	$holding4=txn_holding_amountss("txn_rc where mmt_status=-4 and source=4 ");
	$total_rt=$rt1+$rt2+$rt3+$rt4;
	$total_holding=$holding1[1]+$holding2[1]+$holding3[1]+$holding4[1];
	$total_rts=$total_rt+$total_holding;
	
	$clnt_rt1=show_client_balancess(1,1001);
	$clnt_rt2=show_client_balancess(1,1002);
	$clnt_rt3=show_client_balancess(1,1003);
	$clnt_rt4=show_client_balancess(2,2000);
	$clnt_rt_total=$clnt_rt1+$clnt_rt2+$clnt_rt3+$clnt_rt4;
	
	$clnt_dummy1=show_client_dummy_balancess(1001);
	$clnt_dummy2=show_client_dummy_balancess(1002);
	$clnt_dummy3=show_client_dummy_balancess(1003);
	$clnt_dummy4=show_client_dummy_balancess(2000);
	$clnt_dummy_total=$clnt_dummy1+$clnt_dummy2+$clnt_dummy3+$clnt_dummy4;
	
	$clnt_remain1=$clnt_rt1-$clnt_dummy1;
	$clnt_remain2=$clnt_rt2-$clnt_dummy2;
	$clnt_remain3=$clnt_rt3-$clnt_dummy3;
	$clnt_remain4=$clnt_rt4-$clnt_dummy4;
	$clnt_remain_total=$clnt_remain1+$clnt_remain2+$clnt_remain3+$clnt_remain4;
	
	$mentor_earn1=show_mentor_earningss(1001);
	$mentor_earn2=show_mentor_earningss(1002);
	$mentor_earn3=show_mentor_earningss(1003);
	$mentor_earn4=show_mentor_earningss(2000);
	$mentor_earn_total=$mentor_earn1+$mentor_earn2+$mentor_earn3+$mentor_earn4;
	
	//$mentor_distributed=show_distributed_balancess();
	//$total_rt=$clnt1+$mentor_distributed-$mentor_earn;
    ?>
	
	<section class="boxes wh w3-left">
        
            <div class="w3-row-padding">
                <div class="w3-col m12">
                	<h4 class="heading wh w3-left"><span>REALTIME BALANCE</span></h4>
                </div>
            </div>
            <div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m6 wow bounceIn">
                	<div class="table-box wh w3-left">
                    	<div class="box-head">
                        	<h3>SOURCE REALTIME BALANCE </h3>
                        </div>
                        <div class="w3-responsive">
                            <table class="w3-table-all" id="myTable">
                                <tr class="table-head">
                                  <th>SOURCE<br>(NAME)</th>
                                  <th style="text-align:right">SOURCE<br>(OUR.BAL)</th>
                                  <th style="text-align:right">SOURCE<br>(HOLDING)</th>
                                  <th style="text-align:right">SOURCE BAL</th>
                                </tr>
                                <tr>
                                  <td>EKO</td>
                                  <td style="text-align:right"><?php echo $rt1;?></td>
                                  <td style="text-align:right"><?php echo $holding1[1];?></td>
                                  <td style="text-align:right"><?php echo $rt1+$holding1[1];?></td>
                                </tr>
                                <tr>
                                  <td>AQUA</td>
                                  <td style="text-align:right"><?php echo $rt2;?></td>
                                  <td style="text-align:right"><?php echo $holding2[1];?></td>
                                  <td style="text-align:right"><?php echo $rt2+$holding2[1];?></td>
                                </tr>
                                <tr>
                                  <td>SHRI</td>
                                  <td style="text-align:right"><?php echo $rt3;?></td>
                                  <td style="text-align:right"><?php echo $holding3[1];?></td>
                                  <td style="text-align:right"><?php echo $rt3+$holding3[1];?></td>
                                </tr>
                                <tr>
                                  <td>RECH</td>
                                  <td style="text-align:right"><?php echo $rt4;?></td>
                                  <td style="text-align:right"><?php echo $holding4[1];?></td>
                                  <td style="text-align:right"><?php echo $rt4+$holding4[1];?></td>
                                </tr>
                                <tr class="table-head">
                                  <th>TOTAL</th>
                                  <th style="text-align:right"><?php echo $total_rt;?></th>
                                  <th style="text-align:right"><?php echo $total_holding;?></th>
                                  <th style="text-align:right"><?php echo $total_rts;?></th>
                                </tr>
                            </table>	
                        </div>

                    </div>
                </div>
                
                <div class="w3-col m6 wow bounceIn">
                	<div class="table-box wh w3-left">
                    	<div class="box-head">
                        	<h3>CLIENT REALTIME BALANCE </h3>
                        </div>
                        <div class="w3-responsive">
                            <table class="w3-table-all">
                                <tr class="table-head">
                                  <th>CLIENT<br>(NAME)</th>
                                  <th style="text-align:right">REALTIME</th>
                                  <th style="text-align:right">DUMMY</th>
                                  <th style="text-align:right">ACTUAL</th>
                                  <th style="text-align:right">MENTOR<br>EARNING</th>
                                </tr>
                                <tr>
								  <td>PayOne</td>
                                  <td style="text-align:right"><?php echo $clnt_rt1;?></td>
                                  <td style="text-align:right"><?php echo $clnt_dummy1;?></td>
                                  <td style="text-align:right"><?php echo $clnt_remain1;?></td>
                                  <td style="text-align:right"><?php echo $mentor_earn1;?></td>
                                </tr>
                                <tr>
								  <td>24x7Transfer</td>
                                  <td style="text-align:right"><?php echo $clnt_rt2;?></td>
                                  <td style="text-align:right"><?php echo $clnt_dummy2;?></td>
                                  <td style="text-align:right"><?php echo $clnt_remain2;?></td>
                                  <td style="text-align:right"><?php echo $mentor_earn2;?></td>
                                </tr>
                                <tr>
								  <td>DreamPay</td>
                                  <td style="text-align:right"><?php echo $clnt_rt3;?></td>
                                  <td style="text-align:right"><?php echo $clnt_dummy3;?></td>
                                  <td style="text-align:right"><?php echo $clnt_remain3;?></td>
                                  <td style="text-align:right"><?php echo $mentor_earn3;?></td>
                                </tr>
                                <tr>
								  <td>Blyss</td>
                                  <td style="text-align:right"><?php echo $clnt_rt3;?></td>
                                  <td style="text-align:right"><?php echo $clnt_dummy3;?></td>
                                  <td style="text-align:right"><?php echo $clnt_remain3;?></td>
                                  <td style="text-align:right"><?php echo $mentor_earn3;?></td>
                                </tr>
                                <tr class="table-head">
                                  <th>TOTAL</th>
                                  <th style="text-align:right"><?php echo $clnt_rt_total;?></th>
                                  <th style="text-align:right"><?php echo $clnt_dummy_total;?></th>
                                  <th style="text-align:right"><?php echo $clnt_remain_total;?></th>
                                  <th style="text-align:right"><?php echo $mentor_earn_total;?></th>
                                </tr>
                            </table>	
                        </div>

                    </div>
                </div>
            </div>
        
    </section>
	
	<section class="boxes wh w3-left">
	<?php
	$av1s=txn_status_countss("txn_mt where mmt_status=2 and source=1 and type=2;");
	$av1q=txn_status_countss("txn_mt where mmt_status in(-1,-2) and source=1 and type=2;");
	$av1i=txn_status_countss("txn_mt where mmt_status in(1,3) and source=1 and type=2;");
	$av1p=txn_status_countss("txn_mt where mmt_status=4 and source=1 and type=2;");
	$av1f=txn_status_countss("txn_mt where mmt_status=-4 and source=1 and type=2;");
	$av1r=txn_status_countss("txn_mt where mmt_status=5 and source=1 and type=2;");
	$av1t=txn_status_countss("txn_mt where mmt_status!=0 and source=1 and type=2;");
	$av1=($av1s*100)/$av1t;
	$av1=number_format((float)$av1, 2, '.', '');
	
	$mt1s=txn_status_countss("txn_mt where mmt_status=2 and source=1 and type=1;");
	$mt1q=txn_status_countss("txn_mt where mmt_status in(-1,-2) and source=1 and type=1;");
	$mt1i=txn_status_countss("txn_mt where mmt_status in(1,3) and source=1 and type=1;");
	$mt1p=txn_status_countss("txn_mt where mmt_status=4 and source=1 and type=1;");
	$mt1f=txn_status_countss("txn_mt where mmt_status=-4 and source=1 and type=1;");
	$mt1r=txn_status_countss("txn_mt where mmt_status=5 and source=1 and type=1;");
	$mt1t=txn_status_countss("txn_mt where mmt_status!=0 and source=1 and type=1;");
	$mt1=($mt1s*100)/$mt1t;
	$mt1=number_format((float)$mt1, 2, '.', '');
	
	$av3s=txn_status_countss("txn_mt where mmt_status=2 and source=3 and type=2;");
	$av3q=txn_status_countss("txn_mt where mmt_status in(-1,-2) and source=3 and type=2;");
	$av3i=txn_status_countss("txn_mt where mmt_status in(1,3) and source=3 and type=2;");
	$av3p=txn_status_countss("txn_mt where mmt_status=4 and source=3 and type=2;");
	$av3f=txn_status_countss("txn_mt where mmt_status=-4 and source=3 and type=2;");
	$av3r=txn_status_countss("txn_mt where mmt_status=5 and source=3 and type=2;");
	$av3t=txn_status_countss("txn_mt where mmt_status!=0 and source=3 and type=2;");
	$av3=($av3s*100)/$av3t;
	$av3=number_format((float)$av3, 2, '.', '');
	
	$mt3s=txn_status_countss("txn_mt where mmt_status=2 and source=3 and type=1;");
	$mt3q=txn_status_countss("txn_mt where mmt_status in(-1,-2) and source=3 and type=1;");
	$mt3i=txn_status_countss("txn_mt where mmt_status in(1,3) and source=3 and type=1;");
	$mt3p=txn_status_countss("txn_mt where mmt_status=4 and source=3 and type=1;");
	$mt3f=txn_status_countss("txn_mt where mmt_status=-4 and source=3 and type=1;");
	$mt3r=txn_status_countss("txn_mt where mmt_status=5 and source=3 and type=1;");
	$mt3t=txn_status_countss("txn_mt where mmt_status!=0 and source=3 and type=1;");
	$mt3=($mt3s*100)/$mt3t;
	$mt3=number_format((float)$mt3, 2, '.', '');
	
	$mtavs=$av1s+$av3s+$mt1s+$mt3s;
	$mtavq=$av1q+$av3q+$mt1q+$mt3q;
	$mtavi=$av1i+$av3i+$mt1i+$mt3i;
	$mtavp=$av1p+$av3p+$mt1p+$mt3p;
	$mtavf=$av1f+$av3f+$mt1f+$mt3f;
	$mtavr=$av1r+$av3r+$mt1r+$mt3r;
	$mtavt=$av1t+$av3t+$mt1t+$mt3t;
	$mtav=($mtavs*100)/$mtavt;
	$mtav=number_format((float)$mtav, 2, '.', '');
	?>
        
            <div class="w3-row-padding">
                <div class="w3-col m12">
                	<h4 class="heading wh w3-left"><span>MONEY TRANSFER / ACCOUNT VERIFICATION</span></h4>
                </div>
            </div>
            <div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m12 wow bounceIn">
                	<div class="table-box wh w3-left">
                    	<div class="box-head">
                        	<h3>SOURCE 1 AND 3 </h3>
                        </div>
                        <div class="w3-responsive">
                            <table class="w3-table-all">
                                <tr class="table-head">
                                  <th>SOURCE<br>(NAME)</th>
                                  <th>TXN<br>TYPE</th>
                                  <th style="text-align:right">SUCCESS</th>
                                  <th style="text-align:right">QUEUED</th>
                                  <th style="text-align:right">IN<br>PROGRESS</th>
                                  <th style="text-align:right">PENDING<br>REFIND</th>
                                  <th style="text-align:right">FAILED</th>
                                  <th style="text-align:right">REFUNDED</th>
                                  <th style="text-align:right">TOTAL</th>
                                  <th style="text-align:right;">SUCCESS<br>RATE</th>
                                </tr>
                                <tr class='w3-light-green'>
								  <td>EKO</td>
								  <td>AV</td>
                                  <td style="text-align:right"><?php echo $av1s;?></td>
                                  <td style="text-align:right"><?php echo $av1q;?></td>
                                  <td style="text-align:right"><?php echo $av1i;?></td>
                                  <td style="text-align:right"><?php echo $av1p;?></td>
                                  <td style="text-align:right"><?php echo $av1f;?></td>
                                  <td style="text-align:right"><?php echo $av1r;?></td>
                                  <td style="text-align:right"><?php echo $av1t;?></td>
                                  <td style="text-align:right"><?php echo $av1;?>%</td>
                                </tr>
                                <tr>
								  <td>EKO</td>
								  <td>MT</td>
                                  <td style="text-align:right"><?php echo $mt1s;?></td>
                                  <td style="text-align:right"><?php echo $mt1q;?></td>
                                  <td style="text-align:right"><?php echo $mt1i;?></td>
                                  <td style="text-align:right"><?php echo $mt1p;?></td>
                                  <td style="text-align:right"><?php echo $mt1f;?></td>
                                  <td style="text-align:right"><?php echo $mt1r;?></td>
                                  <td style="text-align:right"><?php echo $mt1t;?></td>
                                  <td style="text-align:right"><?php echo $mt1;?>%</td>
                                </tr>
                                <tr class='w3-light-green'>
								  <td>SHRI</td>
								  <td>AV</td>
                                  <td style="text-align:right"><?php echo $av3s;?></td>
                                  <td style="text-align:right"><?php echo $av3q;?></td>
                                  <td style="text-align:right"><?php echo $av3i;?></td>
                                  <td style="text-align:right"><?php echo $av3p;?></td>
                                  <td style="text-align:right"><?php echo $av3f;?></td>
                                  <td style="text-align:right"><?php echo $av3r;?></td>
                                  <td style="text-align:right"><?php echo $av3t;?></td>
                                  <td style="text-align:right"><?php echo $av3;?>%</td>
                                </tr>
                                <tr>
								  <td>SHRI</td>
								  <td>MT</td>
                                  <td style="text-align:right"><?php echo $mt3s;?></td>
                                  <td style="text-align:right"><?php echo $mt3q;?></td>
                                  <td style="text-align:right"><?php echo $mt3i;?></td>
                                  <td style="text-align:right"><?php echo $mt3p;?></td>
                                  <td style="text-align:right"><?php echo $mt3f;?></td>
                                  <td style="text-align:right"><?php echo $mt3r;?></td>
                                  <td style="text-align:right"><?php echo $mt3t;?></td>
                                  <td style="text-align:right"><?php echo $mt3;?>%</td>
                                </tr>
                                <tr class="table-head">
                                  <th colspan="2">TOTAL</th>
                                  <th style="text-align:right"><?php echo $mtavs;?></th>
                                  <th style="text-align:right"><?php echo $mtavq;?></th>
                                  <th style="text-align:right"><?php echo $mtavi;?></th>
                                  <th style="text-align:right"><?php echo $mtavp;?></th>
                                  <th style="text-align:right"><?php echo $mtavf;?></th>
                                  <th style="text-align:right"><?php echo $mtavr;?></th>
                                  <th style="text-align:right"><?php echo $mtavt;?></th>
                                  <th style="text-align:right"><?php echo $mtav;?>%</th>
                                </tr>
                            </table>	
                        </div>

                    </div>
                </div>
			</div>
        
    </section>
	
	<section class="boxes wh w3-left">
	<?php
	$av2s=txn_status_countss("txn_rc where mrc_status=2 and source=2 and type=3;");
	$av2q=txn_status_countss("txn_rc where mrc_status in(-1,-2) and source=2 and type=3;");
	$av2i=txn_status_countss("txn_rc where mrc_status in(1,3) and source=2 and type=3;");
	$av2p=txn_status_countss("txn_rc where mrc_status=4 and source=2 and type=3;");
	$av2f=txn_status_countss("txn_rc where mrc_status=-4 and source=2 and type=3;");
	$av2r=txn_status_countss("txn_rc where mrc_status=5 and source=2 and type=3;");
	$av2t=txn_status_countss("txn_rc where mrc_status!=0 and source=2 and type=3;");
	$av2=($av2s*100)/$av2t;
	$av2=number_format((float)$av2, 2, '.', '');
	
	$mt2s=txn_status_countss("txn_rc where mrc_status=2 and source=2 and type=4;");
	$mt2q=txn_status_countss("txn_rc where mrc_status in(-1,-2) and source=2 and type=4;");
	$mt2i=txn_status_countss("txn_rc where mrc_status in(1,3) and source=2 and type=4;");
	$mt2p=txn_status_countss("txn_rc where mrc_status=4 and source=2 and type=4;");
	$mt2f=txn_status_countss("txn_rc where mrc_status=-4 and source=2 and type=4;");
	$mt2r=txn_status_countss("txn_rc where mrc_status=5 and source=2 and type=4;");
	$mt2t=txn_status_countss("txn_rc where mrc_status!=0 and source=2 and type=4;");
	$mt2=($mt2s*100)/$mt2t;
	$mt2=number_format((float)$mt2, 2, '.', '');
	
	$av4s=txn_status_countss("txn_rc where mrc_status=2 and source=4 and type=3;");
	$av4q=txn_status_countss("txn_rc where mrc_status in(-1,-2) and source=4 and type=3;");
	$av4i=txn_status_countss("txn_rc where mrc_status in(1,3) and source=4 and type=3;");
	$av4p=txn_status_countss("txn_rc where mrc_status=4 and source=4 and type=3;");
	$av4f=txn_status_countss("txn_rc where mrc_status=-4 and source=4 and type=3;");
	$av4r=txn_status_countss("txn_rc where mrc_status=5 and source=4 and type=3;");
	$av4t=txn_status_countss("txn_rc where mrc_status!=0 and source=4 and type=3;");
	$av4=($av4s*100)/$av4t;
	$av4=number_format((float)$av4, 2, '.', '');
	
	$mt4s=txn_status_countss("txn_rc where mrc_status=2 and source=4 and type=4;");
	$mt4q=txn_status_countss("txn_rc where mrc_status in(-1,-2) and source=4 and type=4;");
	$mt4i=txn_status_countss("txn_rc where mrc_status in(1,3) and source=4 and type=4;");
	$mt4p=txn_status_countss("txn_rc where mrc_status=4 and source=4 and type=4;");
	$mt4f=txn_status_countss("txn_rc where mrc_status=-4 and source=4 and type=4;");
	$mt4r=txn_status_countss("txn_rc where mrc_status=5 and source=4 and type=4;");
	$mt4t=txn_status_countss("txn_rc where mrc_status!=0 and source=4 and type=4;");
	$mt4=($mt4s*100)/$mt4t;
	$mt4=number_format((float)$mt4, 2, '.', '');	
	
	$mt5s=txn_status_countss("txn_rc where mrc_status=2 and source=4 and type=5;");
	$mt5q=txn_status_countss("txn_rc where mrc_status in(-1,-2) and source=4 and type=5;");
	$mt5i=txn_status_countss("txn_rc where mrc_status in(1,3) and source=4 and type=5;");
	$mt5p=txn_status_countss("txn_rc where mrc_status=4 and source=4 and type=5;");
	$mt5f=txn_status_countss("txn_rc where mrc_status=-4 and source=4 and type=5;");
	$mt5r=txn_status_countss("txn_rc where mrc_status=5 and source=4 and type=5;");
	$mt5t=txn_status_countss("txn_rc where mrc_status!=0 and source=4 and type=5;");
	$mt5=($mt5s*100)/$mt5t;
	$mt5=number_format((float)$mt5, 2, '.', '');
	
	$special_cond=" and date(created_on)>='2018-06-01'";
	//$special_cond="";
	
	$mt6s=txn_status_countss("txn_rc where mrc_status=2 and source=4 and type=6;");
	$mt6q=txn_status_countss("txn_rc where mrc_status in(-1,-2) and source=4 and type=6 $special_cond;");
	$mt6i=txn_status_countss("txn_rc where mrc_status in(1,3) and source=4 and type=6 $special_cond;");
	$mt6p=txn_status_countss("txn_rc where mrc_status=4 and source=4 and type=6 $special_cond;");
	$mt6f=txn_status_countss("txn_rc where mrc_status=-4 and source=4 and type=6 $special_cond;");
	$mt6r=txn_status_countss("txn_rc where mrc_status=5 and source=4 and type=6 $special_cond;");
	$mt6t=txn_status_countss("txn_rc where mrc_status!=0 and source=4 and type=6 $special_cond;");
	$mt6=($mt6s*100)/$mt6t;
	$mt6=number_format((float)$mt6, 2, '.', '');
	
	$mt7s=txn_status_countss("txn_rc where mrc_status=2 and source=4 and type=7 $special_cond;");
	$mt7q=txn_status_countss("txn_rc where mrc_status in(-1,-2) and source=4 and type=7 $special_cond;");
	$mt7i=txn_status_countss("txn_rc where mrc_status in(1,3) and source=4 and type=7 $special_cond;");
	$mt7p=txn_status_countss("txn_rc where mrc_status=4 and source=4 and type=7 $special_cond;");
	$mt7f=txn_status_countss("txn_rc where mrc_status=-4 and source=4 and type=7 $special_cond;");
	$mt7r=txn_status_countss("txn_rc where mrc_status=5 and source=4 and type=7 $special_cond;");
	$mt7t=txn_status_countss("txn_rc where mrc_status!=0 and source=4 and type=7 $special_cond;");
	$mt7=($mt7s*100)/$mt7t;
	$mt7=number_format((float)$mt7, 2, '.', '');
	
	$mt8s=txn_status_countss("txn_rc where mrc_status=2 and source=4 and type=8 $special_cond;");
	$mt8q=txn_status_countss("txn_rc where mrc_status in(-1,-2) and source=4 and type=8 $special_cond;");
	$mt8i=txn_status_countss("txn_rc where mrc_status in(1,3) and source=4 and type=8 $special_cond;");
	$mt8p=txn_status_countss("txn_rc where mrc_status=4 and source=4 and type=8 $special_cond;");
	$mt8f=txn_status_countss("txn_rc where mrc_status=-4 and source=4 and type=8 $special_cond;");
	$mt8r=txn_status_countss("txn_rc where mrc_status=5 and source=4 and type=8 $special_cond;");
	$mt8t=txn_status_countss("txn_rc where mrc_status!=0 and source=4 and type=8 $special_cond;");
	$mt8=($mt8s*100)/$mt8t;
	$mt8=number_format((float)$mt8, 2, '.', '');
	
	$mt9s=txn_status_countss("txn_rc where mrc_status=2 and source=4 and type=9 $special_cond;");
	$mt9q=txn_status_countss("txn_rc where mrc_status in(-1,-2) and source=4 and type=9 $special_cond;");
	$mt9i=txn_status_countss("txn_rc where mrc_status in(1,3) and source=4 and type=9 $special_cond;");
	$mt9p=txn_status_countss("txn_rc where mrc_status=4 and source=4 and type=9 $special_cond;");
	$mt9f=txn_status_countss("txn_rc where mrc_status=-4 and source=4 and type=9 $special_cond;");
	$mt9r=txn_status_countss("txn_rc where mrc_status=5 and source=4 and type=9 $special_cond;");
	$mt9t=txn_status_countss("txn_rc where mrc_status!=0 and source=4 and type=9 $special_cond;");
	$mt9=($mt9s*100)/$mt9t;
	$mt9=number_format((float)$mt9, 2, '.', '');
	
	$mt10s=txn_status_countss("txn_rc where mrc_status=2 and source=4 and type=10 $special_cond;");
	$mt10q=txn_status_countss("txn_rc where mrc_status in(-1,-2) and source=4 and type=10 $special_cond;");
	$mt10i=txn_status_countss("txn_rc where mrc_status in(1,3) and source=4 and type=10 $special_cond;");
	$mt10p=txn_status_countss("txn_rc where mrc_status=4 and source=4 and type=10 $special_cond;");
	$mt10f=txn_status_countss("txn_rc where mrc_status=-4 and source=4 and type=10 $special_cond;");
	$mt10r=txn_status_countss("txn_rc where mrc_status=5 and source=4 and type=10 $special_cond;");
	$mt10t=txn_status_countss("txn_rc where mrc_status!=0 and source=4 and type=10 $special_cond;");
	$mt10=($mt10s*100)/$mt10t;
	$mt10=number_format((float)$mt10, 2, '.', '');
	
	$mt11s=txn_status_countss("txn_rc where mrc_status=2 and source=4 and type=11 $special_cond;");
	$mt11q=txn_status_countss("txn_rc where mrc_status in(-1,-2) and source=4 and type=11 $special_cond;");
	$mt11i=txn_status_countss("txn_rc where mrc_status in(1,3) and source=4 and type=11 $special_cond;");
	$mt11p=txn_status_countss("txn_rc where mrc_status=4 and source=4 and type=11 $special_cond;");
	$mt11f=txn_status_countss("txn_rc where mrc_status=-4 and source=4 and type=11 $special_cond;");
	$mt11r=txn_status_countss("txn_rc where mrc_status=5 and source=4 and type=11 $special_cond;");
	$mt11t=txn_status_countss("txn_rc where mrc_status!=0 and source=4 and type=11 $special_cond;");
	$mt11=($mt11s*100)/$mt11t;
	$mt11=number_format((float)$mt11, 2, '.', '');
	
	$mtavs=$av2s+$av4s+$mt2s+$mt4s+$mt5s+$mt6s+$mt7s+$mt8s+$mt9s+$mt10s+$mt11s;
	$mtavq=$av2q+$av4q+$mt2q+$mt4q+$mt5q+$mt6q+$mt7q+$mt8q+$mt9q+$mt10q+$mt11q;
	$mtavi=$av2i+$av4i+$mt2i+$mt4i+$mt5i+$mt6i+$mt7i+$mt8i+$mt9i+$mt10i+$mt11i;
	$mtavp=$av2p+$av4p+$mt2p+$mt4p+$mt5p+$mt6p+$mt7p+$mt8p+$mt9p+$mt10p+$mt11p;
	$mtavf=$av2f+$av4f+$mt2f+$mt4f+$mt5f+$mt6f+$mt7f+$mt8f+$mt9f+$mt10f+$mt11f;
	$mtavr=$av2r+$av4r+$mt2r+$mt4r+$mt5r+$mt6r+$mt7r+$mt8r+$mt9r+$mt10r+$mt11r;
	$mtavt=$av2t+$av4t+$mt2t+$mt4t+$mt5t+$mt6t+$mt7t+$mt8t+$mt9t+$mt10t+$mt11t;
	$mtav=($mtavs*100)/$mtavt;
	$mtav=number_format((float)$mtav, 2, '.', '');
	?>
        
            <div class="w3-row-padding">
                <div class="w3-col m12">
                	<h4 class="heading wh w3-left"><span>PREPAID / DTH / POSTPAID / LANDLINE / DATACARD / ELEC / WATER / GAS / INSURANCE</span></h4>
                </div>
            </div>
            <div class="w3-row-padding w3-margin-top">                
                <div class="w3-col m12 wow bounceIn">
                	<div class="table-box wh w3-left">
                    	<div class="box-head">
                        	<h3>SOURCE 2 AND 4 </h3>
                        </div>
                        <div class="w3-responsive">
                            <table class="w3-table-all">
                                <tr class="table-head">
                                  <th>SOURCE<br>(NAME)</th>
                                  <th>TXN<br>TYPE</th>
                                  <th style="text-align:right">SUCCESS</th>
                                  <th style="text-align:right">QUEUED</th>
                                  <th style="text-align:right">IN<br>PROGRESS</th>
                                  <th style="text-align:right">PENDING<br>REFIND</th>
                                  <th style="text-align:right">FAILED</th>
                                  <th style="text-align:right">REFUNDED</th>
                                  <th style="text-align:right">TOTAL</th>
                                  <th style="text-align:right;">SUCCESS<br>RATE</th>
                                </tr>
                                <tr class='w3-light-green'>
								  <td>AQUA</td>
								  <td>PREPAID</td>
                                  <td style="text-align:right"><?php echo $av2s;?></td>
                                  <td style="text-align:right"><?php echo $av2q;?></td>
                                  <td style="text-align:right"><?php echo $av2i;?></td>
                                  <td style="text-align:right"><?php echo $av2p;?></td>
                                  <td style="text-align:right"><?php echo $av2f;?></td>
                                  <td style="text-align:right"><?php echo $av2r;?></td>
                                  <td style="text-align:right"><?php echo $av2t;?></td>
                                  <td style="text-align:right"><?php echo $av2;?>%</td>
                                </tr>
                                <tr class='w3-khaki'>
								  <td>AQUA</td>
								  <td>DTH</td>
                                  <td style="text-align:right"><?php echo $mt2s;?></td>
                                  <td style="text-align:right"><?php echo $mt2q;?></td>
                                  <td style="text-align:right"><?php echo $mt2i;?></td>
                                  <td style="text-align:right"><?php echo $mt2p;?></td>
                                  <td style="text-align:right"><?php echo $mt2f;?></td>
                                  <td style="text-align:right"><?php echo $mt2r;?></td>
                                  <td style="text-align:right"><?php echo $mt2t;?></td>
                                  <td style="text-align:right"><?php echo $mt2;?>%</td>
                                </tr>
                                <tr class='w3-light-green'>
								  <td>RECH</td>
								  <td>PREPAID</td>
                                  <td style="text-align:right"><?php echo $av4s;?></td>
                                  <td style="text-align:right"><?php echo $av4q;?></td>
                                  <td style="text-align:right"><?php echo $av4i;?></td>
                                  <td style="text-align:right"><?php echo $av4p;?></td>
                                  <td style="text-align:right"><?php echo $av4f;?></td>
                                  <td style="text-align:right"><?php echo $av4r;?></td>
                                  <td style="text-align:right"><?php echo $av4t;?></td>
                                  <td style="text-align:right"><?php echo $av4;?>%</td>
                                </tr>
                                <tr class='w3-khaki'>
								  <td>RECH</td>
								  <td>DTH</td>
                                  <td style="text-align:right"><?php echo $mt4s;?></td>
                                  <td style="text-align:right"><?php echo $mt4q;?></td>
                                  <td style="text-align:right"><?php echo $mt4i;?></td>
                                  <td style="text-align:right"><?php echo $mt4p;?></td>
                                  <td style="text-align:right"><?php echo $mt4f;?></td>
                                  <td style="text-align:right"><?php echo $mt4r;?></td>
                                  <td style="text-align:right"><?php echo $mt4t;?></td>
                                  <td style="text-align:right"><?php echo $mt4;?>%</td>
                                </tr>
                                <tr>
								  <td>RECH</td>
								  <td>POSTPAID</td>
                                  <td style="text-align:right"><?php echo $mt5s;?></td>
                                  <td style="text-align:right"><?php echo $mt5q;?></td>
                                  <td style="text-align:right"><?php echo $mt5i;?></td>
                                  <td style="text-align:right"><?php echo $mt5p;?></td>
                                  <td style="text-align:right"><?php echo $mt5f;?></td>
                                  <td style="text-align:right"><?php echo $mt5r;?></td>
                                  <td style="text-align:right"><?php echo $mt5t;?></td>
                                  <td style="text-align:right"><?php echo $mt5;?>%</td>
                                </tr>
                                <tr class='w3-pale-red'>
								  <td>RECH</td>
								  <td>ELECTRICITY</td>
                                  <td style="text-align:right"><?php echo $mt6s;?></td>
                                  <td style="text-align:right"><?php echo $mt6q;?></td>
                                  <td style="text-align:right"><?php echo $mt6i;?></td>
                                  <td style="text-align:right"><?php echo $mt6p;?></td>
                                  <td style="text-align:right"><?php echo $mt6f;?></td>
                                  <td style="text-align:right"><?php echo $mt6r;?></td>
                                  <td style="text-align:right"><?php echo $mt6t;?></td>
                                  <td style="text-align:right"><?php echo $mt6;?>%</td>
                                </tr>
                                <tr class='w3-pale-red'>
								  <td>RECH</td>
								  <td>WATER</td>
                                  <td style="text-align:right"><?php echo $mt7s;?></td>
                                  <td style="text-align:right"><?php echo $mt7q;?></td>
                                  <td style="text-align:right"><?php echo $mt7i;?></td>
                                  <td style="text-align:right"><?php echo $mt7p;?></td>
                                  <td style="text-align:right"><?php echo $mt7f;?></td>
                                  <td style="text-align:right"><?php echo $mt7r;?></td>
                                  <td style="text-align:right"><?php echo $mt7t;?></td>
                                  <td style="text-align:right"><?php echo $mt7;?>%</td>
                                </tr>
                                <tr class='w3-pale-red'>
								  <td>RECH</td>
								  <td>GAS</td>
                                  <td style="text-align:right"><?php echo $mt8s;?></td>
                                  <td style="text-align:right"><?php echo $mt8q;?></td>
                                  <td style="text-align:right"><?php echo $mt8i;?></td>
                                  <td style="text-align:right"><?php echo $mt8p;?></td>
                                  <td style="text-align:right"><?php echo $mt8f;?></td>
                                  <td style="text-align:right"><?php echo $mt8r;?></td>
                                  <td style="text-align:right"><?php echo $mt8t;?></td>
                                  <td style="text-align:right"><?php echo $mt8;?>%</td>
                                </tr>
                                <tr class='w3-pale-red'>
								  <td>RECH</td>
								  <td>LL/BB</td>
                                  <td style="text-align:right"><?php echo $mt9s;?></td>
                                  <td style="text-align:right"><?php echo $mt9q;?></td>
                                  <td style="text-align:right"><?php echo $mt9i;?></td>
                                  <td style="text-align:right"><?php echo $mt9p;?></td>
                                  <td style="text-align:right"><?php echo $mt9f;?></td>
                                  <td style="text-align:right"><?php echo $mt9r;?></td>
                                  <td style="text-align:right"><?php echo $mt9t;?></td>
                                  <td style="text-align:right"><?php echo $mt9;?>%</td>
                                </tr>
                                <tr class='w3-pale-red'>
								  <td>RECH</td>
								  <td>DATACARD</td>
                                  <td style="text-align:right"><?php echo $mt10s;?></td>
                                  <td style="text-align:right"><?php echo $mt10q;?></td>
                                  <td style="text-align:right"><?php echo $mt10i;?></td>
                                  <td style="text-align:right"><?php echo $mt10p;?></td>
                                  <td style="text-align:right"><?php echo $mt10f;?></td>
                                  <td style="text-align:right"><?php echo $mt10r;?></td>
                                  <td style="text-align:right"><?php echo $mt10t;?></td>
                                  <td style="text-align:right"><?php echo $mt10;?>%</td>
                                </tr>
                                <tr class='w3-pale-red'>
								  <td>RECH</td>
								  <td>INSURANCE</td>
                                  <td style="text-align:right"><?php echo $mt11s;?></td>
                                  <td style="text-align:right"><?php echo $mt11q;?></td>
                                  <td style="text-align:right"><?php echo $mt11i;?></td>
                                  <td style="text-align:right"><?php echo $mt11p;?></td>
                                  <td style="text-align:right"><?php echo $mt11f;?></td>
                                  <td style="text-align:right"><?php echo $mt11r;?></td>
                                  <td style="text-align:right"><?php echo $mt11t;?></td>
                                  <td style="text-align:right"><?php echo $mt11;?>%</td>
                                </tr>
                                <tr class="table-head">
                                  <th colspan="2">TOTAL</th>
                                  <th style="text-align:right"><?php echo $mtavs;?></th>
                                  <th style="text-align:right"><?php echo $mtavq;?></th>
                                  <th style="text-align:right"><?php echo $mtavi;?></th>
                                  <th style="text-align:right"><?php echo $mtavp;?></th>
                                  <th style="text-align:right"><?php echo $mtavf;?></th>
                                  <th style="text-align:right"><?php echo $mtavr;?></th>
                                  <th style="text-align:right"><?php echo $mtavt;?></th>
                                  <th style="text-align:right"><?php echo $mtav;?>%</th>
                                </tr>
                            </table>	
                        </div>

                    </div>
                </div>
            </div>
        
    </section>
    
    <section class="boxes wh w3-left">
        
            <div class="w3-row-padding">
                <div class="w3-col m12">
                	<h4 class="heading wh w3-left"><span>ACCOUNTS</span></h4>
                </div>
            </div>
            <div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m3  wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>Our Users <img src="img/user2-icon.png" class="w3-right"></h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class='w3-text-green'><?php echo base_status_countss("parent_user");?></span>
                        </div>
                    </div>
                </div>  
                
                <div class="w3-col m3 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>White Labels (Dynamic) <img src="img/user2-icon.png" class="w3-right"></h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class='w3-text-green'><?php echo base_status_countss("parent_client where client_type=1 and client_status=1");?></span>
                        </div>
                    </div>
                </div>          
                
                <div class="w3-col m3 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>White Labels (Fixed) <img src="img/user2-icon.png" class="w3-right"></h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class='w3-text-green'><?php echo base_status_countss("parent_client where client_type=2 and client_status=1");?></span>
                        </div>
                    </div>
                </div>           
                
                <div class="w3-col m3 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>API Clients <img src="img/user2-icon.png" class="w3-right"></h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span class='w3-text-green'><?php echo base_status_countss("parent_client where client_type=3 and client_status=1");?></span>
                        </div>
                    </div>
                </div>    
            </div>
    </section>
    
    <section class="boxes wh w3-left display-none">
        
            <div class="w3-row-padding">
                <div class="w3-col m12">
                	<h4 class="heading wh w3-left"><span>NOTIFICATIONS</span></h4>
                </div>
            </div>
            <div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m6 wow bounceIn">
                	<div class="table-box wh w3-left">
                    	<div class="box-head">
                        	<h3>SUPPORT TICKETS <span class="w3-right w3-blue w3-center badges">20</span></h3>
                        </div>
                        <div class="w3-responsive">
                            <table class="w3-table-all" id="myTable">
                                <tr class="table-head">
                                  <th>Ticket No</th>
                                  <th>Date/Time</th>
                                  <th>Client Name</th>
                                  <th>Subject</th>
                                  <th>Status</th>
                                </tr>
                                <tr>
                                  <td>A</td>
                                  <td>B</td>
                                  <td>C</td>
                                  <td>D</td>
                                  <td>E</td>
                                </tr>
                                <tr>
                                  <td>F</td>
                                  <td>G</td>
                                  <td>H</td>
                                  <td>I</td>
                                  <td>J</td>
                                </tr>
                                <tr>
                                  <td>K</td>
                                  <td>L</td>
                                  <td>M</td>
                                  <td>N</td>
                                  <td>O</td>
                                </tr>
                                <tr>
                                  <td>P</td>
                                  <td>Q</td>
                                  <td>R</td>
                                  <td>S</td>
                                  <td>T</td>
                                </tr>
                                <tr>
                                  <td>U</td>
                                  <td>V</td>
                                  <td>W</td>
                                  <td>X</td>
                                  <td>Y</td>
                                </tr>
                            </table>	
                        </div>

                    </div>
                </div>
                
                <div class="w3-col m6 wow bounceIn">
                	<div class="table-box wh w3-left">
                    	<div class="box-head">
                        	<h3>WALLET REQUESTS <span class="w3-right w3-blue w3-center badges">20</span></h3>
                        </div>
                        <div class="w3-responsive">
                            <table class="w3-table-all">
                                <tr class="table-head">
                                  <th>Request No</th>
                                  <th>Date/Time</th>
                                  <th>Client Name</th>
                                  <th>Bank/Method</th>
                                  <th>Amount</th>
                                </tr>
                                <tr>
                                  <td>Date1</td>
                                  <td>Date2</td>
                                  <td>Date3</td>
                                  <td>Date4</td>
                                  <td>Date5</td>
                                </tr>
                                <tr>
                                  <td>Date1</td>
                                  <td>Date2</td>
                                  <td>Date3</td>
                                  <td>Date4</td>
                                  <td>Date5</td>
                                </tr>
                                <tr>
                                  <td>Date1</td>
                                  <td>Date2</td>
                                  <td>Date3</td>
                                  <td>Date4</td>
                                  <td>Date5</td>
                                </tr>
                                <tr>
                                  <td>Date1</td>
                                  <td>Date2</td>
                                  <td>Date3</td>
                                  <td>Date4</td>
                                  <td>Date5</td>
                                </tr>
                                <tr>
                                  <td>Date1</td>
                                  <td>Date2</td>
                                  <td>Date3</td>
                                  <td>Date4</td>
                                  <td>Date5</td>
                                </tr>
                            </table>	
                        </div>

                    </div>
                </div>
            </div>
        
    </section>
	
	<?php include_once('_DashboardWelcomeMessage.php');?>
       
    <?php include_once('_footer.php');?>

</body>
</html> 
