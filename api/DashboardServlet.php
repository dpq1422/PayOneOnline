<!DOCTYPE html>
<html>
<head>
<?php include_once('_all-inner-pages-html-title.php'); ?>
<script>
$(document).ready(function(){
	$(".search-icon").click(function(){
	$(".search-show").toggleClass("s-show");
	});
	
	$(".them").click(function(){
	$(".them ul").toggleClass("them-top");
	});
});
</script>

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
</script>
</head>
<body>

	<?php include_once('_header.php'); ?>
    
    <section class="boxes wh w3-left">
        
            <div class="w3-row-padding">
                <div class="w3-col m12">
                	<h4 class="heading wh w3-left"><span>ACCOUNTS</span></h4>
                </div>
            </div>
            <div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m2  wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>Our Users <img src="img/user2-icon.png" class="w3-right"></h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span>10</span>
                        </div>
                    </div>
                </div>  
                
                <div class="w3-col m2 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>API Clients <img src="img/user2-icon.png" class="w3-right"></h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span>5</span>
                        </div>
                    </div>
                </div>         
                
                <div class="w3-col m2 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>White Labels <img src="img/user2-icon.png" class="w3-right"></h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span>10</span>
                        </div>
                    </div>
                </div>   
                
                <div class="w3-col m2 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>Client Members <img src="img/user2-icon.png" class="w3-right"></h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span>130</span>
                        </div>
                    </div>
                </div>      
                
                <div class="w3-col m2 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>Client Retailers <img src="img/user2-icon.png" class="w3-right"></h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span>1525</span>
                        </div>
                    </div>
                </div>      
                
                <div class="w3-col m2 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>Total Users <img src="img/user2-icon.png" class="w3-right"></h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span>1680</span>
                        </div>
                    </div>
                </div>              
            </div>
    </section>
   
    <section class="boxes wh w3-left">
        
            <div class="w3-row-padding">
                <div class="w3-col m12">
                	<h4 class="heading wh w3-left"><span>SOURCE REALTIME WALLET</span></h4>
                </div>
            </div>
            <div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m4 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>EKO REALTIME</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span>1</span>
                        </div>
                    </div>
                </div>  
                
                <div class="w3-col m4 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>AQUA REALTIME</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span>0</span>
                        </div>
                    </div>
                </div>      
                
                <div class="w3-col m4 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>TOTAL REALTIME</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span>0</span>
                        </div>
                    </div>
                </div>        
            </div>
       
    </section>
    
    <section class="boxes wh w3-left">
        
            <div class="w3-row-padding">
                <div class="w3-col m12">
                	<h4 class="heading wh w3-left"><span>CLIENT REALTIME WALLET</span></h4>
                </div>
            </div>
            <div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m6 l3 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>PAYONE REALTIME</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span>1</span>
                        </div>
                    </div>
                </div>  
                
                <div class="w3-col m6 l3 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>24x7TRANSFER REALTIME</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span>0</span>
                        </div>
                    </div>
                </div>      
                
                <div class="w3-col m6 l3 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>MENTOR EARNING</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span>1</span>
                        </div>
                    </div>
                </div>  
                
                <div class="w3-col m6 l3 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>TOTAL REALTIME</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span>0</span>
                        </div>
                    </div>
                </div>      
            </div>
       
    </section>
    
    <section class="boxes wh w3-left">
        
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
                                  <th onclick="sortTable(0)">Ticket No</th>
                                  <th onclick="sortTable(1)">Date/Time</th>
                                  <th onclick="sortTable(2)">Client Name</th>
                                  <th onclick="sortTable(3)">Subject</th>
                                  <th onclick="sortTable(4)">Status</th>
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
    
    <section class="boxes wh w3-left">
        
            <div class="w3-row-padding">
                <div class="w3-col m12">
                	<h4 class="heading wh w3-left"><span>MONEY TRANSFER / ACCOUNT VERIFICATION</span></h4>
                </div>
            </div>
            <div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m6 l2 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>INITIATED</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span>1</span>
                        </div>
                    </div>
                </div>  
                
                <div class="w3-col m6 l2 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>SUCCESS</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span>0</span>
                        </div>
                    </div>
                </div>      
                
                <div class="w3-col m6 l2 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>IN PROGRESS</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span>1</span>
                        </div>
                    </div>
                </div>  
                
                <div class="w3-col m6 l2 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>PENDING REFUND</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span>1</span>
                        </div>
                    </div>
                </div>  
                
                <div class="w3-col m6 l2 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>REFUNDED</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span>0</span>
                        </div>
                    </div>
                </div> 
                
                <div class="w3-col m6 l2 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>TOTAL</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span>0</span>
                        </div>
                    </div>
                </div> 
                     
            </div>
        
    </section>
    
    <section class="boxes wh w3-left">
        
            <div class="w3-row-padding">
                <div class="w3-col m12">
                	<h4 class="heading wh w3-left"><span>PREPAID MOBILE RECHARGE / DTH RECHARGE</span></h4>
                </div>
            </div>
            <div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m6 l2 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>INITIATED</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span>1</span>
                        </div>
                    </div>
                </div>  
                
                <div class="w3-col m6 l2 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>SUCCESS</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span>0</span>
                        </div>
                    </div>
                </div>      
                
                <div class="w3-col m6 l2 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>IN PROGRESS</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span>1</span>
                        </div>
                    </div>
                </div>  
                
                <div class="w3-col m6 l2 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>FAILED</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span>1</span>
                        </div>
                    </div>
                </div>  
                
                <div class="w3-col m6 l2 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>REFUNDED</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span>0</span>
                        </div>
                    </div>
                </div> 
                
                <div class="w3-col m6 l2 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head wh w3-left">
                        	<h3>TOTAL TXN</h3>
                        </div>
                        <div class="box-contant wh w3-left w3-center">
                        	<span>0</span>
                        </div>
                    </div>
                </div> 
                     
            </div>
        
    </section>
    
    <section class="boxes wh w3-left">
        
            <div class="w3-row-padding">
                <div class="w3-col m12">
                	<h4 class="heading wh w3-left"><span>STATISTICS</span></h4>
                </div>
            </div>
            <div class="w3-row-padding w3-margin-top">
            	<div class="w3-col m4 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head">
                        	<h3>Area Wise Transactions (Today)</h3>
                        </div>
                    	<div class="pie-chart">
                        	<div id="chartContainer" style="height: 300px; width: 100%;"></div>
                        </div>
                    </div>
                </div>  
                
                <div class="w3-col m4 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head">
                        	<h3>Bank Wise Request (Today)</h3>
                        </div>
                    	<div class="pie-chart">
                        	<div id="chartContainer2" style="height: 300px; width: 100%;"></div>
                        </div>
                    </div>
                </div> 
				
            	<div class="w3-col m4 wow bounceIn">
                	<div class="box-part wh w3-left">
                    	<div class="box-head">
                        	<h3>Deposit Method Wise Request (Today)</h3>
                        </div>
                    	<div class="pie-chart">
                        	<div id="chartContainer3" style="height: 300px; width: 100%;"></div>
                        </div>
                    </div>
                </div>  
           	</div>
        
    </section>
       
    <?php include_once('_footer.php');?>

<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>

</body>
</html> 
